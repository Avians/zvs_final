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

class subjects_Teacher_Process_Model extends Zf_Model {
    

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
     * This method processes all transport driving staff that belong to a selected role
     */
    public function processSubjectsTeacher(){
        
        $schoolRoleCode = $_POST['schoolRoleCode'];
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $schoolRoleCode)[0];
        
        //Here we fetch all school staff with this school role code
        $schoolStaffDetails = $this->zvs_fetchSchoolStaff($systemSchoolCode);
        
        $select_options = '';
        
        if($schoolStaffDetails == 0){
            
            $select_options .= '<option value="">No Valid Teacher Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selectSubjectTeacher">Select subjects teacher</option>';
            
            foreach ($schoolStaffDetails as $staffValue) {
                
                //Pull staff identification code
                $identificationCode = $staffValue['identificationCode'];
                
                //Pull staff school role from the identification code        
                $staffRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
                
                //Return only values for staff whose role matches current selected role
                if($schoolRoleCode == $systemSchoolCode.ZVSS_CONNECT.$staffRole){
                    
                    $firstName = $staffValue['staffFirstName']; $lastName = $staffValue['staffLastName'];
                
                    $select_options .= '<option value="'.$identificationCode.'">'.$firstName.' '.$lastName.'</option>';

                }

            }
            
        }
            
        echo $select_options;
        
    }
    
    
    
    
    /**
     * This method inserts a new subjects-teacher assignment record
     */
    public function assignSubjectsToTeacher(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolRoleCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School role')
                
                                ->zf_postFormData('staffIdentificationCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle driver')
        
                                ->zf_postFormData('adminIdentificationCode');
       

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        //We use this function to pull all school classes
        $schoolClassSubjects = $this->zvs_fetchClassSubjectAssignment($systemSchoolCode);
        
        //echo "<pre>"; print_r($schoolClassSubjects); echo "</pre>"; exit();
        
        
        if($schoolClassSubjects == 0){
            
            echo "There are no class-subject assignment in this school as of yet!!"; exit();
            
        }else{
            
            foreach($schoolClassSubjects as $classSubjectValues){
                
                $schoolClassCode = $classSubjectValues['schoolClassCode']; $schoolSubjectCode = $classSubjectValues['schoolSubjectCode'];
                $classSubjectCode = $schoolClassCode.ZVSS_CONNECT.$schoolSubjectCode;
                $cleanClassSubjectCode = str_replace(".","",Zf_Core_Functions::Zf_CleanName($classSubjectCode));
                
                //Here we get the form data for all selected subjects
                $this->zf_formController->zf_postFormData($cleanClassSubjectCode);
                
            }
            
        }
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Subjects-teacher Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        if(empty($this->_errorResult)){
            
            $schoolRoleCode = $this->_validResult['schoolRoleCode'];
            $teacherIdentificationCode = $this->_validResult['staffIdentificationCode'];
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["schoolRoleCode"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
            $zvs_sqlValue["teacherIdentificationCode"] = Zf_QueryGenerator::SQLValue($teacherIdentificationCode);
            
            if($schoolRoleCode == "selectSchoolRole"){
                
                $zf_errorData = array("zf_fieldName" => "schoolRoleCode", "zf_errorMessage" => "* A kindly select a school role first!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else if($staffIdentificationCode == "selectSubjectTeacher"){
                
                $zf_errorData = array("zf_fieldName" => "staffIdentificationCode", "zf_errorMessage" => "* A kindly select a teacher to assign subjects to!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else{
                
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {

                    if($arrayKey != "schoolRoleCode" && $arrayKey != "staffIdentificationCode" && $arrayKey != "adminIdentificationCode"){
                        
                        //This is the class-subject array
                        $classSubjectArray = explode(ZVSS_CONNECT, $arrayValue);
                        
                        //Check if the this class and subject combination has been assigned to this teacher
                        $schoolClassCode = $classSubjectArray[0].ZVSS_CONNECT.$classSubjectArray[1];
                        $classSubjectCode = $classSubjectArray[2].ZVSS_CONNECT.$classSubjectArray[3];
                        
                        //Check if this class-subject combination has already been assigned a teacher
                        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                        $zvs_sqlValue["classSubjectCode"] = Zf_QueryGenerator::SQLValue($classSubjectCode);
                        
                        $checkClassSubjectIfAssigned = Zf_QueryGenerator::BuildSQLSelect('zvs_school_class_subject_teacher_mapper', $zvs_sqlValue);
                        
                        $zf_executeCheckClassSubjectIfAssigned = $this->Zf_AdoDB->Execute($checkClassSubjectIfAssigned);

                        if(!$zf_executeCheckClassSubjectIfAssigned){
                            
                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            if($zf_executeCheckClassSubjectIfAssigned->RecordCount() > 0){

                                //Update records
                                $zvs_updateValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                                $zvs_updateValue["classSubjectCode"] = Zf_QueryGenerator::SQLValue($classSubjectCode);
                                $zvs_updateValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_updateValue["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $updateAssignedTeacher = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_class_subject_teacher_mapper', $zvs_updateValue, $zvs_sqlValue);
                                
                                $executeUpdateAssignedTeacher = $this->Zf_AdoDB->Execute($updateAssignedTeacher);
                            
                                if(!$executeUpdateAssignedTeacher){
                                    
                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }

                            }else{

                                //Insert new records
                                $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                                $zvs_sqlValue["classSubjectCode"] = Zf_QueryGenerator::SQLValue($classSubjectCode);
                                $zvs_sqlValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_sqlValue["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $insertAssignedTeacher = Zf_QueryGenerator::BuildSQLInsert('zvs_school_class_subject_teacher_mapper', $zvs_sqlValue);
                                
                                $executeInsertAssignedTeacher = $this->Zf_AdoDB->Execute($insertAssignedTeacher);
                            
                                if(!$executeInsertAssignedTeacher){
                                    
                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }
                                
                            }
                        }
                        
                    }

                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("subject_module", "teacher_assignment_success");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("subject_module", "teacher_assignment_error");

            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("subject_module", 'subject_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }




    //This private method fetches all details of school staff
    private function zvs_fetchSchoolStaff($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolStaff = Zf_QueryGenerator::BuildSQLSelect('zvs_staff_personal_details', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStaff = $this->Zf_AdoDB->Execute($fetchSchoolStaff);

        if(!$zf_executeFetchSchoolStaff){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStaff->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStaff->EOF){
                    
                    $results = $zf_executeFetchSchoolStaff->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method returns class-subject assignment
    private function zvs_fetchClassSubjectAssignment($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchClassSubjects = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subject_class_assignment', $zvs_sqlValue);
        
        $zf_executeFetchClassSubjects= $this->Zf_AdoDB->Execute($fetchClassSubjects);

        if(!$zf_executeFetchClassSubjects){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassSubjects->RecordCount() > 0){

                while(!$zf_executeFetchClassSubjects->EOF){
                    
                    $results = $zf_executeFetchClassSubjects->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
