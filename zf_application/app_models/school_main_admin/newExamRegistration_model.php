<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new exam onto the     |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newExamRegistration_Model extends Zf_Model {
    

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
    * Register a new hostel within a valid school
    */
    public function registerNewExam(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('examName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Exam name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Exam name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Exam name')

                                ->zf_postFormData('examAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Exam alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Exam alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Exam alias')
                
                                ->zf_postFormData('percentageProportion')
                                ->zf_validateFormData('zf_maximumLength', 3, 'Percentage Proportion')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Percentage Proportion')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Percentage Proportion')
                
                                ->zf_postFormData('examSubject')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Exam subject')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        echo "<pre>All Exam Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            //We concatinate value in order to generate a unique school hostel code.
            $schoolHostelCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['hostelName']).ZVSS_CONNECT.$this->_validResult['hostelGender'];
            
            //Check if a hostel with a similar registration code exists within the same school.
            $hostelValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $hostelValues['schoolHostelCode'] = Zf_QueryGenerator::SQLValue($schoolHostelCode);
            $hostelValues['schoolHostelGender'] = Zf_QueryGenerator::SQLValue($this->_validResult['hostelGender']);
            
            $hostelColumns = array('systemSchoolCode', 'schoolHostelCode', 'schoolHostelGender');
            
            $zvs_hostelSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_hostels', $hostelValues, $hostelColumns);
            
            $zvs_executeHostelSqlQuery = $this->Zf_AdoDB->Execute($zvs_hostelSqlQuery);
            
            if (!$zvs_executeHostelSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeHostelSqlQuery->RecordCount() > 0){
                    
                    //A hostel with similar hostel code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "existent_hostel_error");
                    
                    $zf_errorData = array("zf_fieldName" => "hostelName", "zf_errorMessage" => "* A hostel with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_hostels', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a hostel with a similar hostel name within the same school, therefore store the hostel into the DB.
                    
                    //1. application user details
                    $zvs_hostelDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_hostelDetails['schoolHostelCode'] = Zf_QueryGenerator::SQLValue($schoolHostelCode);
                    $zvs_hostelDetails['schoolHostelName'] = Zf_QueryGenerator::SQLValue($this->_validResult['hostelName']);
                    $zvs_hostelDetails['schoolHostelAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['hostelAlias']);
                    $zvs_hostelDetails['schoolHostelGender'] = Zf_QueryGenerator::SQLValue($this->_validResult['hostelGender']);
                    $zvs_hostelDetails['schoolHostelCapacity'] = Zf_QueryGenerator::SQLValue($this->_validResult['hostelCapacity']);
                    $zvs_hostelDetails['schoolHostelOccupancy'] = Zf_QueryGenerator::SQLValue(0);
                    $zvs_hostelDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_hostelDetails['hostelStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolHostel = Zf_QueryGenerator::BuildSQLInsert('zvs_school_hostels', $zvs_hostelDetails);
                    $executeInsertSchoolHostel = $this->Zf_AdoDB->Execute($insertSchoolHostel);
                    
                    if(!$executeInsertSchoolHostel){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "hostel_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_hostels', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "hostel_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_hostel', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
}

?>
