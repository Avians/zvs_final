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

class newSubjectRegistration_Model extends Zf_Model {
    

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
    * Register a new subject within a valid school
    */
    public function registerNewSubject(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('subjectName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Subject name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Subject name')

                                ->zf_postFormData('subjectAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Subject alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject alias')
                
                                ->zf_postFormData('schoolSubDepartmentCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Subject Sub-department')
                
                                ->zf_postFormData('subjectCode')
                                ->zf_validateFormData('zf_maximumLength', 4, 'Subject Code')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject Code')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Subject Code')
                
                                ->zf_postFormData('examStatus')
                
                                ->zf_postFormData('subjectStatus')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Subject Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        if(empty($this->_errorResult)){
            
            $subjectName = $this->_validResult['subjectName'];
            $systemSchoolCode = $identificationArray[2];
            $systemSubjectCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['subjectName']);
            
            //We prepare SQL values
            $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValues['systemSubjectCode'] = Zf_QueryGenerator::SQLValue($systemSubjectCode);
            $zvs_sqlValues['subjectName'] = Zf_QueryGenerator::SQLValue($subjectName);
            
            //Here we prepare target column
            $zvs_sqlColumns = array('systemSubjectCode','subjectName');
            
            //Check if a similar subject has already been registered
            $zvs_checkSubject = Zf_QueryGenerator::BuildSQLSelect("zvs_school_subjects", $zvs_sqlValues, $zvs_sqlColumns);
            $zvs_executeCheckSubject = $this->Zf_AdoDB->Execute($zvs_checkSubject);
            
            if(!$zvs_executeCheckSubject){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeCheckSubject->RecordCount() > 0){
                    
                    //A similar subject has already been registered for the same school
                    Zf_SessionHandler::zf_setSessionVariable("subject_setup", "existing_subject_error");
                    
                    $zf_errorData = array("zf_fieldName" => "subjectName", "zf_errorMessage" => "* This subject already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_subjects', $identificationCode);
                    exit();
                    
                    
                }else{
                    
                    //Prepare all database values
                    foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {
                        
                        if($zvs_fieldName != 'subjectName' && $zvs_fieldName != 'adminIdentificationCode' ){
                        
                            $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                            
                        }
                        
                    }
                    
                    //Insertion sql query and execution
                    $zvs_insertNewSubject = Zf_QueryGenerator::BuildSQLInsert("zvs_school_subjects", $zvs_sqlValues);
                    $zvs_executeInsertNewSubject = $this->Zf_AdoDB->Execute($zvs_insertNewSubject);
                    
                    if(!$zvs_executeInsertNewSubject){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Insertion successful
                         Zf_SessionHandler::zf_setSessionVariable("subject_setup", "subject_setup_success");
                         Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_subjects',$identificationCode);
                         exit();
                        
                    }
                    
                }
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("subject_setup", "subject_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_subjects',$identificationCode);
            exit();
            
        }
        
    }
    
    
}

?>
