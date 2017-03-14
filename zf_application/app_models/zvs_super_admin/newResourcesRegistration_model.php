<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new hostel onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newResourcesRegistration_Model extends Zf_Model {
    

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
    * Register a new module within a valid school
    */
    public function registerNewModule(){
        
        //In this section we chain module data, posted from the form.
        $this->zf_formController->zf_postFormData('moduleName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Module name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Module name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module name')

                                ->zf_postFormData('modulePrefix')
                                ->zf_validateFormData('zf_maximumLength', 6, 'Module prefix')
                                ->zf_validateFormData('zf_minimumLength', 6, 'Module prefix')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module prefix')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Module Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        //$identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        

        if(empty($this->_errorResult)){
            
            //Check if a module with a similar module name already exists on the platform.
            $moduleValues['categoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['moduleName']);
            
            $moduleColumns = array('categoryName');
            
            $zvs_moduleSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories', $moduleValues, $moduleColumns);
            
            
            $zvs_executeModuleSqlQuery = $this->Zf_AdoDB->Execute($zvs_moduleSqlQuery);
            
            if (!$zvs_executeModuleSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeModuleSqlQuery->RecordCount() > 0){
                    
                    //A hostel with similar hostel code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "existent_module_error");
                    
                    $zf_errorData = array("zf_fieldName" => "moduleName", "zf_errorMessage" => "* A similar module already exists on platform!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a module with a similar module name, therefore insert the new module into the database
                    
                    //1. Module Details
                    $zvs_moduleDetails['categoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['moduleName']);
                    $zvs_moduleDetails['categoryPrefix'] = Zf_QueryGenerator::SQLValue($this->_validResult['modulePrefix']);
                    $zvs_moduleDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_moduleDetails['categoryStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertPlatformModule = Zf_QueryGenerator::BuildSQLInsert('zvs_resource_categories', $zvs_moduleDetails);
                    $executeInsertPlatformModule = $this->Zf_AdoDB->Execute($insertPlatformModule);
                    
                    if(!$executeInsertPlatformModule){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "module_setup_success");
                        Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "module_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
   /**
    * Register a new module within a valid school
    */
    public function registerNewResource(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('moduleNamePrefix')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Module name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Module name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module name')

                                ->zf_postFormData('resourceName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Resource name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Resource name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Resource name')
                
                                ->zf_postFormData('resourceDescription')
                                ->zf_validateFormData('zf_maximumLength', 300, 'Resource name')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Resource Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
    
        
        if(empty($this->_errorResult)){
            
            $moduleArray = explode(ZVSS_CONNECT, $this->_validResult['moduleNamePrefix']);
            
            $moduleName = $moduleArray[0]; 
            $modulePrefix = $moduleArray[1];
            $resourceId = $modulePrefix.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['resourceName']);
            
            
            //Check if a module with a similar module name already exists on the platform.
            $resourceValues['resourceId'] = Zf_QueryGenerator::SQLValue($resourceId);
            
            $resourceColumns = array('resourceId');
            
            $zvs_resourceSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources', $resourceValues, $resourceColumns);
            
            
            $zvs_executeResourceSqlQuery = $this->Zf_AdoDB->Execute($zvs_resourceSqlQuery);
            
            if (!$zvs_executeResourceSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeResourceSqlQuery->RecordCount() > 0){
                    
                    //A hostel with similar hostel code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "existent_resource_error");
                    
                    $zf_errorData = array("zf_fieldName" => "resourceName", "zf_errorMessage" => "* A similar resource already exists for the selected module!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a module with a similar module name, therefore insert the new module into the database
                    
                    //1. Resource Details
                    $zvs_resourceDetails['resourceId'] = Zf_QueryGenerator::SQLValue($resourceId);
                    $zvs_resourceDetails['resourceName'] = Zf_QueryGenerator::SQLValue($this->_validResult['resourceName']);
                    $zvs_resourceDetails['resourceCategory'] = Zf_QueryGenerator::SQLValue($moduleName);
                    $zvs_resourceDetails['resourceDescription'] = Zf_QueryGenerator::SQLValue($this->_validResult['resourceDescription']);
                    $zvs_resourceDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_resourceDetails['resourceStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertPlatformResource = Zf_QueryGenerator::BuildSQLInsert('zvs_platform_resources', $zvs_resourceDetails);
                    $executeInsertPlatformResource = $this->Zf_AdoDB->Execute($insertPlatformResource);
                    
                    if(!$executeInsertPlatformResource){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_setup_success");
                        Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
   
    
    
   /**
    * This method is essential in updating an existing module
    */ 
    public function editExistingModule(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('moduleName')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module name')

                                ->zf_postFormData('modulePrefix')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module prefix')

                                ->zf_postFormData('categoryStatus')
                                ->zf_validateFormData('zf_maximumLength', 1, 'Category status')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Category status')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category status')
                
                                ->zf_postFormData('identificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Edit Module Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
    
        //If the error result is empty.
        if (empty($this->_errorResult)) {

                $moduleColumns['categoryStatus'] = Zf_QueryGenerator::SQLValue($this->_validResult['categoryStatus']);
                
                $moduleValues['categoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['moduleName']);
                $moduleValues['categoryPrefix'] = Zf_QueryGenerator::SQLValue($this->_validResult['modulePrefix']);
                
                $zvs_updateModule = Zf_QueryGenerator::BuildSQLUpdate('zvs_resource_categories', $moduleColumns, $moduleValues);
                
                
                $zvss_executeUpdateModule = $this->Zf_AdoDB->Execute($zvs_updateModule);

                if(!$zvss_executeUpdateModule){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{
                    
                    
                    if($this->_validResult['categoryStatus'] == 1){
                        
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "module_activation_success");
                        
                    }else if($this->_validResult['categoryStatus']== 0){
                        
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "module_deactivation_success");
                        
                    }

                    echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                    Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'view_module_details', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$this->_validResult['moduleName'].ZVSS_CONNECT.$this->_validResult['modulePrefix']));
                    exit();

                }
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "module_activation_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$this->_validResult['moduleName'].ZVSS_CONNECT.$this->_validResult['modulePrefix']));
            exit();
            
        }
        
        
    }
    
    
    
    
    /**
    * This method is essential in updating an existing resource
    */ 
    public function editExistingResource(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('resourceName')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Resource name')

                                ->zf_postFormData('modulePrefix')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Module prefix')

                                ->zf_postFormData('resourceStatus')
                                ->zf_validateFormData('zf_maximumLength', 1, 'Category status')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Category status')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category status')
                
                                ->zf_postFormData('identificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Edit Module Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
    
        $resourceID = $this->_validResult['modulePrefix'].ZVSS_CONNECT.$this->_validResult['resourceName'];
                
        //If the error result is empty.
        if (empty($this->_errorResult)) {

                $resourceColumns['resourceStatus'] = Zf_QueryGenerator::SQLValue($this->_validResult['resourceStatus']);
                
                $resourceValues['resourceId'] = Zf_QueryGenerator::SQLValue($resourceID);
                
                $zvs_updateResource = Zf_QueryGenerator::BuildSQLUpdate('zvs_platform_resources', $resourceColumns, $resourceValues);
                
                
                $zvss_executeUpdateResource = $this->Zf_AdoDB->Execute($zvs_updateResource);

                if(!$zvss_executeUpdateResource){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{
                    
                    
                    if($this->_validResult['resourceStatus'] == 1){
                        
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_activation_success");
                        
                    }else if($this->_validResult['resourceStatus']== 0){
                        
                        Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_deactivation_success");
                        
                    }

                    echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                    Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'view_resource_details', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$resourceID));
                    exit();

                }
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_activation_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("zvs_super_admin", 'manage_resources', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$resourceID));
            exit();
            
        }
        
        
    }
    
}

?>
