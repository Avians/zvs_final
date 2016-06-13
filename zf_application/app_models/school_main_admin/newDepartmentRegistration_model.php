<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a department for a      |
 * |  school onto the platform.                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newDepartmentRegistration_Model extends Zf_Model {
    

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
    * Register a new departments within a valid school
    */
    public function registerNewDepartment(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('departmentName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Department name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Department name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Department name')

                                ->zf_postFormData('departmentAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Department alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Department alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Department alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Department Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            //We concatinate value in order to generate a unique school department code.
            $schoolDepartmentCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['departmentName']);
            
            //Check if a departments with a similar registration code exists within the same school.
            $departmentValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $departmentValues['schoolDepartmentCode'] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
            
            $departmentColumns = array('systemSchoolCode', 'schoolDepartmentCode');
            
            $zvs_departmentSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_departments', $departmentValues, $departmentColumns);
            
            $zvs_executeDepartmentSqlQuery = $this->Zf_AdoDB->Execute($zvs_departmentSqlQuery);
            
            if (!$zvs_executeDepartmentSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeDepartmentSqlQuery->RecordCount() > 0){
                    
                    //A class with similar department code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("department_setup", "existent_department_error");
                    
                    $zf_errorData = array("zf_fieldName" => "departmentName", "zf_errorMessage" => "* A department with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a department with a similar department name within the same school, therefore store the department into the DB.
                    
                    //1. school department details
                    $zvs_departmentDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_departmentDetails['schoolDepartmentCode'] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
                    $zvs_departmentDetails['schoolDepartmentName'] = Zf_QueryGenerator::SQLValue($this->_validResult['departmentName']);
                    $zvs_departmentDetails['schoolDepartmentAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['departmentAlias']);
                    $zvs_departmentDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_departmentDetails['departmentStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolDepartment = Zf_QueryGenerator::BuildSQLInsert('zvs_school_departments', $zvs_departmentDetails);
                    $executeInsertSchoolDepartment = $this->Zf_AdoDB->Execute($insertSchoolDepartment);
                    
                    if(!$executeInsertSchoolDepartment){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("department_setup", "department_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("department_setup", "department_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    /**
     * Register a new stream within a class which exists within a valid school.
     */
   public function registerNewSubDepartment(){
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolDepartmentCode')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Department name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Department name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Department name')

                                ->zf_postFormData('subDepartmentName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub-department name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub-department name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub-department name')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Sub-department data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //We concatinate value in order to generate a unique school stream code.
            $schoolSubDepartmentCode = $this->_validResult['schoolDepartmentCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName(ucwords($this->_validResult['subDepartmentName']));
           
            //Check if a similar stream has already been registered in the same class
            $subDepartmentValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $subDepartmentValues['schoolDepartmentCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolDepartmentCode']);
            $subDepartmentValues['schoolSubDepartmentCode'] = Zf_QueryGenerator::SQLValue($schoolSubDepartmentCode);
            
            $subDepartmentColumns = array('systemSchoolCode', 'schoolDepartmentCode', 'schoolSubDepartmentCode');
            
            $zvs_subDepartmentSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_sub_departments', $subDepartmentValues, $subDepartmentColumns);
            
            $zvs_executeSubDepartmentSqlQuery = $this->Zf_AdoDB->Execute($zvs_subDepartmentSqlQuery);
            
            if (!$zvs_executeSubDepartmentSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeSubDepartmentSqlQuery->RecordCount() > 0){
                    
                    //A stream with similar stream code has already been registered onto the platform for the same class and school.
                    Zf_SessionHandler::zf_setSessionVariable("department_setup", "existent_sub_department_error");
                    
                    $zf_errorData = array("zf_fieldName" => "subDepartmentName", "zf_errorMessage" => "* A sub-department with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. sub department details
                    $zvs_subDepartmentDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_subDepartmentDetails['schoolDepartmentCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolDepartmentCode']);
                    $zvs_subDepartmentDetails['schoolSubDepartmentCode'] = Zf_QueryGenerator::SQLValue($schoolSubDepartmentCode);
                    $zvs_subDepartmentDetails['schoolSubDepartmentName'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['subDepartmentName']));
                    $zvs_subDepartmentDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_subDepartmentDetails['subDepartmentStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSubDepartment = Zf_QueryGenerator::BuildSQLInsert('zvs_school_sub_departments', $zvs_subDepartmentDetails);
                    $executeInsertSubDepartment = $this->Zf_AdoDB->Execute($insertSubDepartment);
                    
                    if(!$executeInsertSubDepartment){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("department_setup", "sub_department_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("department_setup", "sub_department_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_departments', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
    
    
}

?>
