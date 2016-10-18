<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible for registration of a new    |
 * |  Marksheet into the school.                                       |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newMarksheetRegistration_Model extends Zf_Model {
    

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
    public function registerNewMarksheet(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('gradeName')
                                ->zf_validateFormData('zf_maximumLength', 4, 'Grade label')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Grade label')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade label')

                                ->zf_postFormData('gradeAlias')
                                ->zf_validateFormData('zf_maximumLength', 10, 'Grade alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade alias')
                
                                ->zf_postFormData('gradePoints')
                                ->zf_validateFormData('zf_maximumLength', 2, 'Grade points')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Grade points')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade points')
                
                                ->zf_postFormData('gradeComments')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Grade comments')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Grade comments')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade comments')
                
                                ->zf_postFormData('gradeStatus')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>New Grade Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        

        if(empty($this->_errorResult)){
            
            $gradeName = $this->_validResult['gradeName'];
            $systemSchoolCode = $identificationArray[2];
            $systemGradeCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($gradeName);
            
            //We prepare SQL values
            $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValues['systemGradeCode'] = Zf_QueryGenerator::SQLValue($systemGradeCode);
            $zvs_sqlValues['gradeName'] = Zf_QueryGenerator::SQLValue($gradeName);
            
            //Here we prepare target column
            $zvs_sqlColumns = array('systemGradeCode','gradeName');
            
            //Check if a similar subject has already been registered
            $zvs_checkGrade = Zf_QueryGenerator::BuildSQLSelect("zvs_school_grades", $zvs_sqlValues, $zvs_sqlColumns);
            $zvs_executeCheckGrade = $this->Zf_AdoDB->Execute($zvs_checkGrade);
            
            if(!$zvs_executeCheckGrade){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeCheckGrade->RecordCount() > 0){
                    
                    //A similar grade has already been registered for the same school
                    Zf_SessionHandler::zf_setSessionVariable("grade_setup", "existing_grade_error");
                    
                    $zf_errorData = array("zf_fieldName" => "gradeName", "zf_errorMessage" => "* This grade already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_marksheet', $identificationCode);
                    exit();
                    
                }else{
                    
                    //Prepare all database values
                    foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {
                        
                        if($zvs_fieldName != 'gradeName' && $zvs_fieldName != 'adminIdentificationCode' ){
                        
                            $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                            
                        }
                        
                    }
                    
                    $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                    
                    //Insertion sql query and execution
                    $zvs_insertNewGrade = Zf_QueryGenerator::BuildSQLInsert("zvs_school_grades", $zvs_sqlValues);
                    $zvs_executeInsertNewGrade = $this->Zf_AdoDB->Execute($zvs_insertNewGrade);
                    
                    if(!$zvs_executeInsertNewGrade){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Insertion successful
                         Zf_SessionHandler::zf_setSessionVariable("grade_setup", "grade_setup_success");
                         Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_marksheet',$identificationCode);
                         exit();
                        
                    }
                    
                }
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("grade_setup", "grade_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_marksheet',$identificationCode);
            exit();
            
        }
        
    }
    
    
}

?>
