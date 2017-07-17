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

class process_Hostel_Student_Model extends Zf_Model {
    

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
     * Register a new library category into a school library
     */
    public function newHostelStudentRegistration(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('studentIdentificationCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student name')

                                ->zf_postFormData('schoolHostelCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Student Hostel Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. Check if a library category with a similar library category code already exists
            $hostelStudentExisting  = $this->zvs_fetchStudentHostelDetails($systemSchoolCode, $this->_validResult['studentIdentificationCode']);
            
            
            //2. If one already exists, throw and error, else register as new
            if($hostelStudentExisting == 0){
                
                //2.1 library category variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['schoolHostelCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolHostelCode']);
                $zvs_sqlValues['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['studentIdentificationCode']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                
                //Generate SQL Insert query
                $zvs_insertNewHostelStudent = Zf_QueryGenerator::BuildSQLInsert("zvs_student_hostel_details", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewHostelStudent = $this->Zf_AdoDB->Execute($zvs_insertNewHostelStudent);
                    
                if(!$zvs_executeInsertNewHostelStudent){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("new_hostel_student", "hostel_student_success");
                     Zf_GenerateLinks::zf_header_location("hostel_module", 'hostel_register_student', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //This student already belongs to a school hostel
                Zf_SessionHandler::zf_setSessionVariable("new_hostel_student", "existing_hostel_student_error");

                $zf_errorData = array("zf_fieldName" => "studentIdentificationCode", "zf_errorMessage" => "* This student is already registered!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("hostel_module", 'hostel_register_student', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("new_hostel_student", "new_hostel_student_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("hostel_module", 'hostel_register_student', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    //This private method fetches all hostel details of select student
    private function zvs_fetchStudentHostelDetails($systemSchoolCode, $studentIdentificationCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        
        $fetchStudentHostelDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_student_hostel_details', $zvs_sqlValue);
        
        $zf_executeFetchStudentHostelDetails= $this->Zf_AdoDB->Execute($fetchStudentHostelDetails);

        if(!$zf_executeFetchStudentHostelDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentHostelDetails->RecordCount() > 0){

                while(!$zf_executeFetchStudentHostelDetails->EOF){
                    
                    $results = $zf_executeFetchStudentHostelDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
