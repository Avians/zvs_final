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

class transport_Vehicles_Process_Model extends Zf_Model {
    

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
     * Register a new transport vehicle into a school transport system
     */
    public function newTransportVehicle(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportVehicleName')
                                ->zf_validateFormData('zf_maximumLength', 15, 'Vehicle name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Vehicle name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle name')
                                
                                ->zf_postFormData('vehicleRegistrationNumber')
                                ->zf_validateFormData('zf_maximumLength', 15, 'Vehicle registration')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Vehicle registration')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle registration')
                
                                ->zf_postFormData('transportVehicleCapacity')
                                ->zf_validateFormData('zf_maximumLength', 3, 'Vehicle capacity')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Vehicle capacity')
                                ->zf_validateFormData('zf_integerData', 'Vehicle capacity')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle capacity')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Transport Vehicle Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Create transport vehicle code
            $transportVehicleCode = $systemSchoolCode.ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['vehicleRegistrationNumber']));
            
            //2. Check if a transport vehicle with a similar transport vehicle code already exists
            $transportVehicleExisting  = $this->zvs_fetchTransportVehicles($transportVehicleCode);
            
            
            //3. If one already exists, throw and error, else register as new
            if($transportVehicleExisting == 0){
                
                //3.1 transport vehicle variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['transportVehicleCode'] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
                $zvs_sqlValues['vehicleRegistrationNumber'] = Zf_QueryGenerator::SQLValue($this->_validResult['vehicleRegistrationNumber']);
                $zvs_sqlValues['vehicleCapacity'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportVehicleCapacity']);
                $zvs_sqlValues['vehicleName'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportVehicleName']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['vehicleStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewTransportVehicle = Zf_QueryGenerator::BuildSQLInsert("zvs_school_transport_vehicles", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewTransportVehicle = $this->Zf_AdoDB->Execute($zvs_insertNewTransportVehicle);
                    
                if(!$zvs_executeInsertNewTransportVehicle){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "vehicle_setup_success");
                     Zf_GenerateLinks::zf_header_location('transport_module', 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar transport vehicle has already been registered in school transport system
                Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "existing_vehicle_error");

                $zf_errorData = array("zf_fieldName" => "transportVehicleName", "zf_errorMessage" => "* This vehicle already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('transport_module', 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "vehicle_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
   
    
    
    
    /**
     * Register a new transport cost into a school transport system
     */
    public function newTransportCost(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportZoneCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Zone name')
                
                                ->zf_postFormData('transportRouteCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Route name')
                                
                                ->zf_postFormData('schoolAttendancePeriod')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Attendance period')
                                
                                ->zf_postFormData('transportRouteCost')
                                ->zf_validateFormData('zf_maximumLength', 3, 'Transport cost')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Transport cost')
                                ->zf_validateFormData('zf_integerData', 'Transport cost')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transport cost')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Transport Cost Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Prepare transport cost variables
            $transportZoneCode = $this->_validResult['transportZoneCode'];
            $transportRouteCode = $this->_validResult['transportRouteCode'];
            $schoolAttendancePeriod = $this->_validResult['schoolAttendancePeriod'];
            
            //1. Check if there is a cost already assoicated with the same route for the specified period
            $transportCosts = $this->zvs_fetchTransportCosts($transportZoneCode, $transportRouteCode, $schoolAttendancePeriod);
            
            
            //2. If one already exists, throw and error, else register as new
            if($transportCosts == 0){
                
                //3.1 transport vehicle variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['transportZoneCode'] = Zf_QueryGenerator::SQLValue($transportZoneCode);
                $zvs_sqlValues['transportRouteCode'] = Zf_QueryGenerator::SQLValue($transportRouteCode);
                $zvs_sqlValues['schoolAttendancePeriod'] = Zf_QueryGenerator::SQLValue($schoolAttendancePeriod);
                $zvs_sqlValues['transportRouteCost'] = Zf_QueryGenerator::SQLValue($this->_validResult['transportRouteCost']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['transportCostStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewTransportCost = Zf_QueryGenerator::BuildSQLInsert("zvs_school_transport_costs", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewTransportCost = $this->Zf_AdoDB->Execute($zvs_insertNewTransportCost);
                    
                if(!$zvs_executeInsertNewTransportCost){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "cost_setup_success");
                     Zf_GenerateLinks::zf_header_location('transport_module', 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar transport cost has already been registered in school transport system
                Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "existing_cost_error");

                $zf_errorData = array("zf_fieldName" => "schoolAttendancePeriod", "zf_errorMessage" => "* Transport cost already created for this period!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('transport_module', 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_vehicles", "cost_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    /**
     * Assign different transport categories to a selected vehicle
     */
    public function assignCategoriesToVehicles(){
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportVehicleCodeCategory')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle name')
                
                                ->zf_postFormData('adminIdentificationCode');
       

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        //We use this function to pull transport categories that are currently registered in the school
        $schoolTransportCategories = $this->zvs_fetchTransportCategories($systemSchoolCode);
        
        
        if($schoolTransportCategories == 0){
            
            echo "There are no transport categories in this school yet!!"; exit();
            
        }else{
            
            foreach($schoolTransportCategories as $categoryValues){
                
                $transportCategoryCode = $categoryValues['transportCategoryCode']; $transportCategoryName = $categoryValues['transportCategoryName'];
                $cleanTransportCategoryName  = str_replace(".","",Zf_Core_Functions::Zf_CleanName($transportCategoryName));
                
                $this->zf_formController->zf_postFormData($cleanTransportCategoryName);
                
            }
            
        }
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Transport Categories Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            $transportVehicleCode = $this->_validResult['transportVehicleCodeCategory'];
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
            
            if($transportVehicleCode == "selectTransportVehicle"){
                
                $zf_errorData = array("zf_fieldName" => "transportVehicleCodeCategory", "zf_errorMessage" => "* A kindly select a vehicle to assign transport categories to!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else{
                
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {

                    if($arrayKey != "transportVehicleCodeCategory" && $arrayKey != "adminIdentificationCode"){

                        //Check if the category has already been assigned to the selected vehicle
                        $transportCategoryName = $arrayKey;  $transportCategoryCode = $arrayValue; 
                        
                        //Check if this category has already been assigned
                        $zvs_sqlValue["transportCategoryCode"] = Zf_QueryGenerator::SQLValue($transportCategoryCode);

                        $checkTransportCategoryIfAssigned = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicle_category_mapper', $zvs_sqlValue);
                        
                        $zf_executeCheckTransportCategoryIfAssigned= $this->Zf_AdoDB->Execute($checkTransportCategoryIfAssigned);

                        if(!$zf_executeCheckTransportCategoryIfAssigned){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            if($zf_executeCheckTransportCategoryIfAssigned->RecordCount() > 0){

                                //Update records
                                $zvs_updateValue["transportCategoryCode"] = Zf_QueryGenerator::SQLValue($transportCategoryCode);
                                $zvs_updateValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_updateValue["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $updateAssignedCategories = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_transport_vehicle_category_mapper', $zvs_updateValue, $zvs_sqlValue);
                                
                                $executeUpdateAssignedCategories = $this->Zf_AdoDB->Execute($updateAssignedCategories);
                            
                                if(!$executeUpdateAssignedCategories){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }

                            }else{

                                //Insert new records
                                $zvs_sqlValue["transportCategoryCode"] = Zf_QueryGenerator::SQLValue($transportCategoryCode);
                                $zvs_sqlValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_sqlValue["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $insertAssignedCategory = Zf_QueryGenerator::BuildSQLInsert('zvs_school_transport_vehicle_category_mapper', $zvs_sqlValue);
                                
                                $executeInsertAssignedCategory = $this->Zf_AdoDB->Execute($insertAssignedCategory);
                            
                                if(!$executeInsertAssignedCategory){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }
                                
                            }
                        }
                        
                    }

                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("transport_module", "category_assignment_success");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_module", "category_assignment_error");

            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
    
    
    
    
    /**
     * Assign different transport routes to a selected vehicle
     */
    public function assignRoutesToVehicles(){
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('transportVehicleCodeRoute')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Route name')
                
                                ->zf_postFormData('adminIdentificationCode');
       

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        //We use this function to pull transport routes that are currently registered in the school
        $schoolTransportRoutes = $this->zvs_fetchTransportRoutes($systemSchoolCode);
        
        
        if($schoolTransportRoutes == 0){
            
            echo "There are no transport routes in this school yet!!"; exit();
            
        }else{
            
            foreach($schoolTransportRoutes as $routeValues){
                
                $transportRouteCode = $routeValues['transportRouteCode']; $transportRouteName = $routeValues['transportRouteName'];
                $cleanTransportRouteName  = str_replace(".","",Zf_Core_Functions::Zf_CleanName($transportRouteName));
                
                $this->zf_formController->zf_postFormData($cleanTransportRouteName);
                
            }
            
        }
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Transport Routes Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            $transportVehicleCode = $this->_validResult['transportVehicleCodeRoute'];
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
            
            if($transportVehicleCode == "selectTransportVehicle"){
                
                $zf_errorData = array("zf_fieldName" => "transportVehicleCodeRoute", "zf_errorMessage" => "* A kindly select a vehicle to assign transport routes to!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else{
                
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {

                    if($arrayKey != "transportVehicleCodeRoute" && $arrayKey != "adminIdentificationCode"){

                        //Check if the route has already been assigned to the selected vehicle
                        $transportRouteName = $arrayKey;  $transportRouteCode = $arrayValue; 
                        
                        //Check if this route has already been assigned
                        $zvs_sqlValue["transportRouteCode"] = Zf_QueryGenerator::SQLValue($transportRouteCode);

                        $checkTransportRouteIfAssigned = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicle_route_mapper', $zvs_sqlValue);
                        
                        $zf_executeCheckTransportRouteIfAssigned= $this->Zf_AdoDB->Execute($checkTransportRouteIfAssigned);

                        if(!$zf_executeCheckTransportRouteIfAssigned){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            if($zf_executeCheckTransportRouteIfAssigned->RecordCount() > 0){

                                //Update records
                                $zvs_updateValue["transportRouteCode"] = Zf_QueryGenerator::SQLValue($transportRouteCode);
                                $zvs_updateValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_updateValue["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $updateAssignedRoutes = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_transport_vehicle_route_mapper', $zvs_updateValue, $zvs_sqlValue);
                                
                                $executeUpdateAssignedRoutes = $this->Zf_AdoDB->Execute($updateAssignedRoutes);
                            
                                if(!$executeUpdateAssignedRoutes){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }

                            }else{

                                //Insert new records
                                $zvs_sqlValue["transportRouteCode"] = Zf_QueryGenerator::SQLValue($transportRouteCode);
                                $zvs_sqlValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_sqlValue["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $insertAssignedRoutes = Zf_QueryGenerator::BuildSQLInsert('zvs_school_transport_vehicle_route_mapper', $zvs_sqlValue);
                                
                                $executeInsertAssignedRoutes = $this->Zf_AdoDB->Execute($insertAssignedRoutes);
                            
                                if(!$executeInsertAssignedRoutes){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }
                                
                            }
                        }
                        
                    }

                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("transport_module", "route_assignment_success");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_module", "route_assignment_error");

            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'transport_vehicles', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
   
   
   
    
    //This private method fetches all details of school transport vehicles
    private function zvs_fetchTransportVehicles($transportVehicleCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $transportVehicleCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
        
        $fetchTransportVehicles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicles', $zvs_sqlValue);
        
        $zf_executeFetchTransportVehicles = $this->Zf_AdoDB->Execute($fetchTransportVehicles);

        if(!$zf_executeFetchTransportVehicles){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportVehicles->RecordCount() > 0){

                while(!$zf_executeFetchTransportVehicles->EOF){
                    
                    $results = $zf_executeFetchTransportVehicles->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetched all transport costs for the related period
    private function zvs_fetchTransportCosts($transportZoneCode, $transportRouteCode, $schoolAttendancePeriod){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue(explode(ZVSS_CONNECT, $transportZoneCode)[0]);
        $zvs_sqlValue["transportZoneCode"] = Zf_QueryGenerator::SQLValue($transportZoneCode);
        $zvs_sqlValue["transportRouteCode"] = Zf_QueryGenerator::SQLValue($transportRouteCode);
        $zvs_sqlValue["schoolAttendancePeriod"] = Zf_QueryGenerator::SQLValue($schoolAttendancePeriod);
        
        $fetchSchoolTransportCosts = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_costs', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransportCosts = $this->Zf_AdoDB->Execute($fetchSchoolTransportCosts);

        if(!$zf_executeFetchSchoolTransportCosts){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransportCosts->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransportCosts->EOF){
                    
                    $results = $zf_executeFetchSchoolTransportCosts->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method returns school transport categories
    private function zvs_fetchTransportCategories($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransportCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_categories', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransportCategories = $this->Zf_AdoDB->Execute($fetchSchoolTransportCategories);

        if(!$zf_executeFetchSchoolTransportCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransportCategories->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransportCategories->EOF){
                    
                    $results = $zf_executeFetchSchoolTransportCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method returns school transport routes
    private function zvs_fetchTransportRoutes($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransportRoutes = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_routes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransportRoutes = $this->Zf_AdoDB->Execute($fetchSchoolTransportRoutes);

        if(!$zf_executeFetchSchoolTransportRoutes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransportRoutes->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransportRoutes->EOF){
                    
                    $results = $zf_executeFetchSchoolTransportRoutes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
