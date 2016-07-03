<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school role onto  |
 * |  the platform.                                                    |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newRoleRegistration_Model extends Zf_Model {
    

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
    * Register a new role within a valid school
    */
    public function registerNewRole(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('roleName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Role name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Role name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Role name')

                                ->zf_postFormData('roleAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Role alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Role alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Role alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All School Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            //We concatinate value in order to generate a unique school class code.
            $schoolRoleCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['roleName']);
            
            //Check if a role with a similar code exists within the same school.
            $roleValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $roleValues['schoolRoleCode'] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
            
            $roleColumns = array('systemSchoolCode', 'schoolRoleCode');
            
            $zvs_rolesSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_roles', $roleValues, $roleColumns);
            
            $zvs_executeRolesSqlQuery = $this->Zf_AdoDB->Execute($zvs_rolesSqlQuery);
            
            if (!$zvs_executeRolesSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeRolesSqlQuery->RecordCount() > 0){
                    
                    //A role with similar role code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("role_setup", "existent_role_error");
                    
                    $zf_errorData = array("zf_fieldName" => "roleName", "zf_errorMessage" => "* A role with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_roles', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. school role details
                    $zvs_roleDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_roleDetails['schoolRoleCode'] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
                    $zvs_roleDetails['schoolRoleName'] = Zf_QueryGenerator::SQLValue($this->_validResult['roleName']);
                    $zvs_roleDetails['schoolRoleAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['roleAlias']);
                    $zvs_roleDetails['schoolRoleId'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CleanName($this->_validResult['roleName']));
                    $zvs_roleDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_roleDetails['roleStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolRole = Zf_QueryGenerator::BuildSQLInsert('zvs_school_roles', $zvs_roleDetails);
                    
                    $executeInsertSchoolRole = $this->Zf_AdoDB->Execute($insertSchoolRole);
                    
                    if(!$executeInsertSchoolRole){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("role_setup", "role_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_roles', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("role_setup", "role_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_roles', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
   /**
    * This method is essential in updating an existing role
    */ 
    public function editSchoolRole(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('systemSchoolCode')
                
                                ->zf_postFormData('schoolRoleCode')
                
                                 ->zf_postFormData('roleStatus')
                                ->zf_validateFormData('zf_maximumLength', 1, 'Category status')
                                ->zf_validateFormData('zf_minimumLength', 0, 'Category status')
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

                $roleColumns['roleStatus'] = Zf_QueryGenerator::SQLValue($this->_validResult['roleStatus']);
                
                $roleValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['systemSchoolCode']);
                $roleValues['schoolRoleCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolRoleCode']);
                
                
                $zvs_updateSchoolRole = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_roles', $roleColumns, $roleValues);
                
                
                $zvss_executeUpdateSchoolRole = $this->Zf_AdoDB->Execute($zvs_updateSchoolRole);

                if(!$zvss_executeUpdateSchoolRole){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{
                    
                        
                    Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_activation_success");

                    echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                    Zf_GenerateLinks::zf_header_location('school_main_admin', 'view_role_details', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$this->_validResult['schoolRoleCode']));
                    exit();

                }
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("module_resources_setup", "resource_activation_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'view_role_details', Zf_SecureData::zf_encode_data($this->_validResult['identificationCode'].ZVSS_CONNECT.$this->_validResult['schoolRoleCode']));
            exit();
            
        }
        
        
    }
    
    
    
}

?>
