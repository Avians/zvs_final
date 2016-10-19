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
                
                                ->zf_postFormData('schoolSubjectCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Exam subject')
                
                                ->zf_postFormData('examStatus')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Exam Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        

        if(empty($this->_errorResult)){
            
            $schoolSubjectCode = $this->_validResult['schoolSubjectCode'];
            $examName = $this->_validResult['examName'];
            $systemSchoolCode = $identificationArray[2];
            $systemExamCode = $schoolSubjectCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($examName);
            
            //We prepare SQL values
            $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValues['systemExamCode'] = Zf_QueryGenerator::SQLValue($systemExamCode);
            $zvs_sqlValues['examName'] = Zf_QueryGenerator::SQLValue($examName);
            
            //Here we prepare target column
            $zvs_sqlColumns = array('systemExamCode','examName');
            
            //Check if a similar exam has already been registered
            $zvs_checkExam = Zf_QueryGenerator::BuildSQLSelect("zvs_school_examinations", $zvs_sqlValues, $zvs_sqlColumns);
            $zvs_executeCheckExam = $this->Zf_AdoDB->Execute($zvs_checkExam);
            
            if(!$zvs_executeCheckExam){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeCheckExam->RecordCount() > 0){
                    
                    //A similar subject has already been registered for the same school
                    Zf_SessionHandler::zf_setSessionVariable("exam_setup", "existing_exam_error");
                    
                    $zf_errorData = array("zf_fieldName" => "examName", "zf_errorMessage" => "* This exam already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_exams', $identificationCode);
                    exit();
                    
                    
                }else{
                    
                    //Prepare all database values
                    foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {
                        
                        if($zvs_fieldName != 'examName' && $zvs_fieldName != 'adminIdentificationCode' ){
                        
                            $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                            
                        }
                        
                    }
                    
                    //Insertion sql query and execution
                    $zvs_insertNewExam = Zf_QueryGenerator::BuildSQLInsert("zvs_school_examinations", $zvs_sqlValues);
                    $zvs_executeInsertNewExam = $this->Zf_AdoDB->Execute($zvs_insertNewExam);
                    
                    if(!$zvs_executeInsertNewExam){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Insertion successful
                         Zf_SessionHandler::zf_setSessionVariable("exam_setup", "exam_setup_success");
                         Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_exams', $identificationCode);
                         exit();
                        
                    }
                    
                }
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("exam_setup", "exam_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_exams',$identificationCode);
            exit();
            
        }
        
    }
    
    
}

?>
