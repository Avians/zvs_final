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

class newClassRegistration_Model extends Zf_Model {
    

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
    * Register a new class within a valid school
    */
    public function registerNewClass(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('className')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Class name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Class name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Class name')

                                ->zf_postFormData('classAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Class alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Class alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Class alias')
                
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
            $schoolClassCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['className']);
            
            //Check if a class with a similar registration code exists within the same school.
            $classValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $classValues['schoolClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
            
            $classColumns = array('systemSchoolCode', 'schoolClassCode');
            
            $zvs_classSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $classValues, $classColumns);
            
            $zvs_executeClassSqlQuery = $this->Zf_AdoDB->Execute($zvs_classSqlQuery);
            
            if (!$zvs_executeClassSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeClassSqlQuery->RecordCount() > 0){
                    
                    //A class with similar class code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("class_setup", "existent_class_error");
                    
                    $zf_errorData = array("zf_fieldName" => "className", "zf_errorMessage" => "* A class with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_classDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_classDetails['schoolClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                    $zvs_classDetails['schoolClassName'] = Zf_QueryGenerator::SQLValue($this->_validResult['className']);
                    $zvs_classDetails['schoolClassAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['classAlias']);
                    $zvs_classDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_classDetails['classStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolClass = Zf_QueryGenerator::BuildSQLInsert('zvs_school_classes', $zvs_classDetails);
                    $executeInsertSchoolClass = $this->Zf_AdoDB->Execute($insertSchoolClass);
                    
                    if(!$executeInsertSchoolClass){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("class_setup", "class_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("class_setup", "class_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    /**
     * Register a new stream within a class which exists within a valid school.
     */
   public function registerNewStream(){
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolClassCode')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Class name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Class name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Class name')

                                ->zf_postFormData('streamName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Stream name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Stream name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'stream name')

                                ->zf_postFormData('streamCapacity')
                                ->zf_validateFormData('zf_maximumLength', 4, 'Stream capacity')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Stream capacity')
                                ->zf_validateFormData('zf_integerData', 'Stream capacity')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Stream capacity')
                
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
            
            //We concatinate value in order to generate a unique school stream code.
            $schoolStreamCode = $this->_validResult['schoolClassCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName(ucwords($this->_validResult['streamName']));
           
            //Check if a similar stream has already been registered in the same class
            $streamValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $streamValues['schoolClassCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolClassCode']);
            $streamValues['schoolStreamCode'] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
            
            $streamColumns = array('systemSchoolCode', 'schoolClassCode', 'schoolStreamCode');
            
            $zvs_streamSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $streamValues, $streamColumns);
            
            $zvs_executeStreamSqlQuery = $this->Zf_AdoDB->Execute($zvs_streamSqlQuery);
            
            if (!$zvs_executeStreamSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeStreamSqlQuery->RecordCount() > 0){
                    
                    //A stream with similar stream code has already been registered onto the platform for the same class and school.
                    Zf_SessionHandler::zf_setSessionVariable("class_setup", "existent_stream_error");
                    
                    $zf_errorData = array("zf_fieldName" => "streamName", "zf_errorMessage" => "* A stream with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_streamDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_streamDetails['schoolClassCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolClassCode']);
                    $zvs_streamDetails['schoolStreamCode'] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
                    $zvs_streamDetails['schoolStreamName'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['streamName']));
                    $zvs_streamDetails['schoolStreamCapacity'] = Zf_QueryGenerator::SQLValue($this->_validResult['streamCapacity']);
                    $zvs_streamDetails['schoolStreamOccupancy'] = Zf_QueryGenerator::SQLValue(0);
                    $zvs_streamDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_streamDetails['streamStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertClassStream = Zf_QueryGenerator::BuildSQLInsert('zvs_school_streams', $zvs_streamDetails);
                    $executeInsertClassStream = $this->Zf_AdoDB->Execute($insertClassStream);
                    
                    if(!$executeInsertClassStream){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_classes', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
    
    
}

?>
