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

class processSubjectAssignment_Model extends Zf_Model {
    

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
     * Register a new stream within a class which exists within a valid school.
     */
    public function assignSubjectsToClasses(){
       
       //echo "We are here!!"; exit();
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolClassCode')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Class name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Class name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Class name')
                
                                ->zf_postFormData('adminIdentificationCode');
       

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        //We use this function to pull subjects that are currently registered in the school
        $schoolSubjects = $this->getSchoolSubjects($systemSchoolCode);
        
        if($schoolSubjects == 0){
            
            echo "There are no subjects registered in this school yet!!"; exit();
            
        }else{
            
            foreach($schoolSubjects as $subjectValues){
                
                $schoolSubjectCode = $subjectValues['systemSubjectCode']; $schoolSubjectName = $subjectValues['subjectName'];
                $cleanSubjectName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($schoolSubjectName));
                
                $this->zf_formController->zf_postFormData($cleanSubjectName);
                
            }
            
        }
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All School Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            $schoolClassCode = $this->_validResult['schoolClassCode'];
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
            
            if($schoolClassCode == "selectClass"){
                
                $zf_errorData = array("zf_fieldName" => "schoolClassCode", "zf_errorMessage" => "* A kindly select a class to assign subjects to!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else{
                
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {

                    if($arrayKey != "schoolClassCode" && $arrayKey != "adminIdentificationCode"){

                        //Check if the subject has already been assigned to the selected class
                        $schoolSubjectName = $arrayKey;  $schoolSubjectCode = $arrayValue; 

                        //echo $systemSchoolCode." == ".$schoolClassCode." == ".$schoolSubjectCode." == ".$schoolSubjectName."<br><br>";
                        
                        //Check if this subject has already been assigned
                        $zvs_sqlValue["schoolSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);

                        $checkSubjectIfAssigned = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subject_class_assignment', $zvs_sqlValue);
                        
                        $zf_executeCheckSubjectIfAssigned = $this->Zf_AdoDB->Execute($checkSubjectIfAssigned);

                        if(!$zf_executeCheckSubjectIfAssigned){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            if($zf_executeCheckSubjectIfAssigned->RecordCount() > 0){

                                //Update records
                                $zvs_updateValue["schoolSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
                                $zvs_updateValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_updateValue["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $updateAssignedSubject = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_subject_class_assignment', $zvs_updateValue, $zvs_sqlValue);
                                
                                $executeUpdateAssignedSubject = $this->Zf_AdoDB->Execute($updateAssignedSubject);
                            
                                if(!$executeUpdateAssignedSubject){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }

                            }else{

                                //Insert new records
                                $zvs_sqlValue["schoolSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
                                $zvs_sqlValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_sqlValue["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $insertAssignedSubject = Zf_QueryGenerator::BuildSQLInsert('zvs_school_subject_class_assignment', $zvs_sqlValue);
                                
                                $executeInsertAssignedSubject = $this->Zf_AdoDB->Execute($insertAssignedSubject);
                            
                                if(!$executeInsertAssignedSubject){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }
                                
                            }
                        }
                        
                    }

                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("subject_module", "subject_assignment");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("subject_module", "subject_assignment");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
   
   
   
   
    //This private method checks if a subject has already been assigned to a given class
    private function checkSubjectAssignmentStatus($systemSchoolCode, $schoolClassCode, $schoolSubjectCode){
       
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["schoolSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
        
        $fetchAssignedSubjects = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subject_class_assignment', $zvs_sqlValue);
        
        
        echo $fetchAssignedSubjects."<br>"; 
        
        $zf_executeFetchAssignedSubjects = $this->Zf_AdoDB->Execute($fetchAssignedSubjects);

        if(!$zf_executeFetchAssignedSubjects){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAssignedSubjects->RecordCount() > 0){

                while(!$zf_executeFetchAssignedSubjects->EOF){
                    
                    $results = $zf_executeFetchAssignedSubjects->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
       
   }








    //This private method returns school subjects
    private function getSchoolSubjects($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolSubjects = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subjects', $zvs_sqlValue);
        
        $zf_executeFetchSchoolSubjects = $this->Zf_AdoDB->Execute($fetchSchoolSubjects);

        if(!$zf_executeFetchSchoolSubjects){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolSubjects->RecordCount() > 0){

                while(!$zf_executeFetchSchoolSubjects->EOF){
                    
                    $results = $zf_executeFetchSchoolSubjects->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
