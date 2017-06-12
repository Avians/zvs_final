<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class transport_Setup_Process_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();
            
    }
   
    
    
    
    /**
     * Register a new transport zone into a school transport system
     */
    public function newTransportZone(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportZoneName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Zone name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Zone name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Zone name')

                                ->zf_postFormData('transportZoneAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Zone alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Zone alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Zone alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Transport Zone Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Create transport zone code
            $transportZoneCode = $systemSchoolCode.ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['transportZoneName']));
            
            //2. Check if a transport zone with a similar transport zone code already exists
            $transportZoneExisting  = $this->zvs_fetchTransportZones($transportZoneCode);
            
            
            //3. If one already exists, throw and error, else register as new
            if($libraryCategoryExisting == 0){
                
                //3.1 transport zone variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['transportZoneCode'] = Zf_QueryGenerator::SQLValue($transportZoneCode);
                $zvs_sqlValues['transportZoneName'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportZoneName']);
                $zvs_sqlValues['transportZoneAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportZoneAlias']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['transportZoneStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewTransportZone = Zf_QueryGenerator::BuildSQLInsert("zvs_school_transport_zones", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewTransportZone = $this->Zf_AdoDB->Execute($zvs_insertNewTransportZone);
                    
                if(!$zvs_executeInsertNewTransportZone){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("transport_setup", "zone_setup_success");
                     Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar transport zone has already been registered in school transport system
                Zf_SessionHandler::zf_setSessionVariable("transport_setup", "existing_zone_error");

                $zf_errorData = array("zf_fieldName" => "transportZoneName", "zf_errorMessage" => "* This zone already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_setup", "zone_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
   
    
    
    
    /**
     * Register a new transport route into a school transport system
     */
    public function newTransportRoute(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportZoneCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Zone name')
                
                                ->zf_postFormData('transportRouteName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Route name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Route name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Route name')

                                ->zf_postFormData('transportRouteAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Route alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Route alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Route alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Transport Route Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Create transport route code
            $transportRouteCode = $this->_validResult['transportZoneCode'].ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['transportRouteName']));
            
            //2. Check if a transport route with a similar transport route code already exists
            $transportRouteExisting  = $this->zvs_fetchTransportRoutes($this->_validResult['transportZoneCode'], $transportRouteCode);
            
            //3. If one already exists, throw and error, else register as new
            if($transportRouteExisting == 0){
                
                //3.1 transport route variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['transportZoneCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportZoneCode']);
                $zvs_sqlValues['transportRouteCode'] = Zf_QueryGenerator::SQLValue($transportRouteCode);
                $zvs_sqlValues['transportRouteName'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportRouteName']);
                $zvs_sqlValues['transportRouteAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportRouteAlias']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['transportRouteStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewTransportRoute = Zf_QueryGenerator::BuildSQLInsert("zvs_school_transport_routes", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewTransportRoute = $this->Zf_AdoDB->Execute($zvs_insertNewTransportRoute);
                    
                if(!$zvs_executeInsertNewTransportRoute){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("transport_setup", "route_setup_success");
                     Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar transport route has already been registered in school transport system
                Zf_SessionHandler::zf_setSessionVariable("transport_setup", "existing_route_error");

                $zf_errorData = array("zf_fieldName" => "transportRouteName", "zf_errorMessage" => "* This route already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_setup", "route_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
   
    
    
    
    /**
     * Register a new transport category into a school transport system
     */
    public function newTransportCategory(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportCategoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('transportCategoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Transport Category Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Create transport category code
            $transportCategoryCode = $systemSchoolCode.ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['transportCategoryName']));
            
            //2. Check if a transport category with a similar transport category code already exists
            $transportCategoryExisting  = $this->zvs_fetchTransportCategories($transportCategoryCode);
            
            
            //3. If one already exists, throw and error, else register as new
            if($transportCategoryExisting == 0){
                
                //3.1 transport category variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['transportCategoryCode'] = Zf_QueryGenerator::SQLValue($transportCategoryCode);
                $zvs_sqlValues['transportCategoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportCategoryName']);
                $zvs_sqlValues['transportCategoryAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportCategoryAlias']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['transportCategoryStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewTransportCategory = Zf_QueryGenerator::BuildSQLInsert("zvs_school_transport_categories", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewTransportCategory = $this->Zf_AdoDB->Execute($zvs_insertNewTransportCategory);
                    
                if(!$zvs_executeInsertNewTransportCategory){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("transport_setup", "category_setup_success");
                     Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar transport category has already been registered in school transport system
                Zf_SessionHandler::zf_setSessionVariable("transport_setup", "existing_category_error");

                $zf_errorData = array("zf_fieldName" => "transportCategoryName", "zf_errorMessage" => "* This category already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('transport_module', 'transport_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_setup", "category_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    //This private method fetches all details of school transport zones
    private function zvs_fetchTransportZones($transportZoneCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $transportZoneCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["transportZoneCode"] = Zf_QueryGenerator::SQLValue($transportZoneCode);
        
        $fetchTransportZones = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_zones', $zvs_sqlValue);
        
        $zf_executeFetchTransportZones = $this->Zf_AdoDB->Execute($fetchTransportZones);

        if(!$zf_executeFetchTransportZones){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportZones->RecordCount() > 0){

                while(!$zf_executeFetchTransportZones->EOF){
                    
                    $results = $zf_executeFetchTransportZones->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of school transport routes
    private function zvs_fetchTransportRoutes($transportZoneCode, $transportRouteCode = NULL){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $transportZoneCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["transportZoneCode"] = Zf_QueryGenerator::SQLValue($transportZoneCode);
        if($transportRouteCode != NULL && !empty($transportRouteCode) && $transportRouteCode != ''){
            
           $zvs_sqlValue["transportRouteCode"] = Zf_QueryGenerator::SQLValue($transportRouteCode); 
           
        }
        
        $fetchTransportRoutes = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_routes', $zvs_sqlValue);
        
        $zf_executeFetchTransportRoutes = $this->Zf_AdoDB->Execute($fetchTransportRoutes);

        if(!$zf_executeFetchTransportRoutes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportRoutes->RecordCount() > 0){

                while(!$zf_executeFetchTransportRoutes->EOF){
                    
                    $results = $zf_executeFetchTransportRoutes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of school transport categories
    private function zvs_fetchTransportCategories($transportCategoryCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $transportCategoryCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["transportCategoryCode"] = Zf_QueryGenerator::SQLValue($transportCategoryCode);
        
        $fetchTransportCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_categories', $zvs_sqlValue);
        
        $zf_executeFetchTransportCategories = $this->Zf_AdoDB->Execute($fetchTransportCategories);

        if(!$zf_executeFetchTransportCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportCategories->RecordCount() > 0){

                while(!$zf_executeFetchTransportCategories->EOF){
                    
                    $results = $zf_executeFetchTransportCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method processes all transport routes that belong to a selected zone
     */
    public function processTransportRoutes(){
        
        $transportZoneCode = $_POST['transportZoneCode'];
        
        //Here we have all related transport routes
        $transportRoutes = $this->zvs_fetchTransportRoutes($transportZoneCode);
        
        $select_options = '';
        
        
        if($transportRoutes == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a transport route</option>';
            
            foreach ($transportRoutes as $transportRouteValue) {
                
                $transportRouteName = $transportRouteValue['transportRouteName']; $transportRouteCode = $transportRouteValue['transportRouteCode'];
                
                $select_options .= '<option value="'.$transportRouteCode.'">'.$transportRouteName.'</option>';
                
            }
            
        }
              
        echo $select_options;
        
    }
    
    
}

?>
