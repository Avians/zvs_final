<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school classes and a new  |
 * |  new streams into the classess.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newStudentRegistration_Model extends Zf_Model {
    
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
     * This method is used to register new student into the school.
     */
    public function registerNewStudent($identificationCode){
        
        
        //echo "We are here!!";
        
         //Here we chain all form data.
        
        //In this section we chain all student personal data
        $this->zf_formController->zf_postFormData('studentFirstName')
                
                                ->zf_postFormData('studentMiddleName')
                
                                ->zf_postFormData('studentLastName')
                
                                ->zf_postFormData('studentGender')
                
                                ->zf_postFormData('studentDateOfBirth')
                
                                ->zf_postFormData('studentReligion')
                
                                ->zf_postFormData('studentCountry')
                
                                ->zf_postFormData('studentLocality')
                
                                ->zf_postFormData('studentBoxAddress')//not required field
                
                                ->zf_postFormData('studentPhoneNumber')//not required field
                
                                ->zf_postFormData('studentLanguage');
        
        
        
        //In this section we chain all guardian related data
        $this->zf_formController->zf_postFormData('guardianDesignation')
                    
                                ->zf_postFormData('guardianFirstName')
                    
                                ->zf_postFormData('guardianMiddleName')//not required field
                
                                ->zf_postFormData('guardianLastName')
                
                                ->zf_postFormData('guardianGender')
                
                                ->zf_postFormData('guardianDateOfBirth')//not required field
                
                                ->zf_postFormData('guardianReligion')//not required field
                
                                ->zf_postFormData('guardianCountry')
        
                                ->zf_postFormData('guardianLocality')
                    
                                ->zf_postFormData('guardianBoxAddress')//not required field
                
                                ->zf_postFormData('guardianPhoneNumber')//not required field
                
                                ->zf_postFormData('guardianRelation')
                
                                ->zf_postFormData('guardianOccupation')//not required field
                
                                ->zf_postFormData('guardianLanguage');
        
        
        
        //In this section we chain all student medical data
        $this->zf_formController->zf_postFormData('isStudentBloodGroup')
        
                                ->zf_postFormData('studentBloodGroup')//not required field
        
                                ->zf_postFormData('isStudentDisable')
        
                                ->zf_postFormData('studentDisability')//not required field
        
                                ->zf_postFormData('isStudentMedicated')
        
                                ->zf_postFormData('studentMedication')//not required field
        
                                ->zf_postFormData('isStudentAllergic')
        
                                ->zf_postFormData('studentAllergic')//not required field
        
                                ->zf_postFormData('isStudentTreatment')
        
                                ->zf_postFormData('studentTreatment')//not required field
        
                                ->zf_postFormData('isStudentPhysician')
        
                                ->zf_postFormData('physicianDesignation')//not required field
        
                                ->zf_postFormData('physicianFirstName')//not required field
        
                                ->zf_postFormData('physicianLastName')//not required field
        
                                ->zf_postFormData('1stMobileNumber')//not required field
        
                                ->zf_postFormData('2ndMobileNumber')//not required field
        
                                ->zf_postFormData('physicianEmailAddress')//not required field
        
                                ->zf_postFormData('physicianBoxAddress')//not required field
        
                                ->zf_postFormData('physicianCountry')//not required field
        
                                ->zf_postFormData('physicianLocality')//not required field
        
                                ->zf_postFormData('isStudentHospital')
        
                                ->zf_postFormData('hospitalName')//not required field
        
                                ->zf_postFormData('1stHospitalNumber')//not required field
        
                                ->zf_postFormData('2ndHospitalNumber')//not required field
        
                                ->zf_postFormData('hospitalEmailAddress')//not required field
        
                                ->zf_postFormData('hospitalBoxAddress')//not required field
        
                                ->zf_postFormData('hospitalCountry')//not required field
        
                                ->zf_postFormData('hospitalLocality');//not required field
        
        
        
        //In this section we chain all student class data
        $this->zf_formController->zf_postFormData('studentClassCode')
        
                                ->zf_postFormData('studentStreamCode')
        
                                ->zf_postFormData('studentYearOfStudy')
        
                                ->zf_postFormData('studentAdmissionNumber');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('studentEmailAddress')
                
                                ->zf_postFormData('studentPassword')
        
                                ->zf_postFormData('studentSchoolRole');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('guardianEmailAddress')
        
                                ->zf_postFormData('guardianPassword')
        
                                ->zf_postFormData('guardianSchoolRole');
        
        
        
        $this->zf_formController->zf_postFormData('registeredBy');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        
        $registeredBy = $this->_validResult['registeredBy'];
        
        
        
        //This of debugging purposes only.
        //echo "<pre>All Student Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            
            //Prepare all variables for student form data.
                $studentFirstName = $this->_validResult['studentFirstName'];
                $studnetMiddleName = $this->_validResult['studentMiddleName'];
                $studentLastName = $this->_validResult['studentLastName'];
                $studentGender = $this->_validResult['studentGender'];
                $studentDateOfBirth = $this->_validResult['studentDateOfBirth'];
                $studentReligion = $this->_validResult['studentReligion'];
                $studentCountry = $this->_validResult['studentCountry'];
                $studentLocality = $this->_validResult['studentLocality'];
                $studentBoxAddress = $this->_validResult['studentBoxAddress'];//not required field
                $studentPhoneNumber = $this->_validResult['studentPhoneNumber'];//not required field
                $studentLanguage = $this->_validResult['studentLanguage'];
                $studentClassCode = $this->_validResult['studentClassCode'];
                $studentStreamCode = $this->_validResult['studentStreamCode'];
                $studentYearOfStudy = $this->_validResult['studentYearOfStudy'];
                $studentAdmissionNumber = $this->_validResult['studentAdmissionNumber'];
                $studentEmailAddress = $this->_validResult['studentEmailAddress'];
                $studentPassword = $this->_validResult['studentPassword'];
                $studentRole = explode(ZVSS_CONNECT, $this->_validResult['studentSchoolRole'])[1];
                //Generate unique student access code.
                $studentIdentificationCode = Zf_SecureData::zf_encode_data($studentCountry.ZVSS_CONNECT.$studentLocality.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$studentRole.ZVSS_CONNECT.$studentAdmissionNumber);
              
                
            //Prepare all variable for guardian form data
                $guardianDesignation = $this->_validResult['guardianDesignation'];
                $guardianFirstName = $this->_validResult['guardianFirstName'];
                $guardianMiddleName = $this->_validResult['guardianMiddleName'];//not required field
                $guardianLastName = $this->_validResult['guardianLastName'];
                $guardianGender = $this->_validResult['guardianGender'];
                $guardianDateOfBirth = $this->_validResult['guardianDateOfBirth'];//not required field
                $guardianReligion = $this->_validResult['guardianReligion'];//not required field
                $guardianCountry = $this->_validResult['guardianCountry'];
                $guardianLocality= $this->_validResult['guardianLocality'];
                $guardianBoxAddress = $this->_validResult['guardianBoxAddress'];//not required field
                $guardianPhoneNumber = $this->_validResult['guardianPhoneNumber'];//not required field
                $guardianRelation = $this->_validResult['guardianRelation'];
                $guardianOccupation = $this->_validResult['guardianOccupation'];//not required field
                $guardianLanguage = $this->_validResult['guardianLanguage'];
                $guardianEmail = $this->_validResult['guardianEmailAddress'];
                $guardianPassword = $this->_validResult['guardianPassword'];
                $guardianRole = explode(ZVSS_CONNECT, $this->_validResult['guardianSchoolRole'])[1];
                //Generate unique guardian access code.
                $guardianIdentificationCode = Zf_SecureData::zf_encode_data($guardianCountry.ZVSS_CONNECT.$guardianLocality.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$guardianRole.ZVSS_CONNECT.$studentAdmissionNumber);
            
            
            //Prepare all variables for student medical data
                $isStudentBloodGroup = $this->_validResult['isStudentBloodGroup'];
                $studentBloodGroup = $this->_validResult['studentBloodGroup'];//not required field
                $isStudentDisable = $this->_validResult['isStudentDisable'];
                $studentDisability = $this->_validResult['studentDisability'];//not required field
                $isStudentMedicated = $this->_validResult['isStudentMedicated'];
                $studentMedication = $this->_validResult['studentMedication'];//not required field
                $isStudentAllergic = $this->_validResult['isStudentAllergic'];
                $studentAllergic = $this->_validResult['studentAllergic'];//not required field
                $isStudentTreatment = $this->_validResult['isStudentTreatment'];
                $studentTreatment = $this->_validResult['studentTreatment'];//not required field
                $isStudentPhysician = $this->_validResult['isStudentPhysician'];
                $physicianDesignation = $this->_validResult['physicianDesignation'];//not required field
                $physicianFirstName = $this->_validResult['physicianFirstName'];//not required field
                $physicianLastName = $this->_validResult['physicianLastName'];//not required field
                $firstMobileNumber = $this->_validResult['1stMobileNumber'];//not required field
                $secondMobileNumber = $this->_validResult['2ndMobileNumber'];//not required field
                $physicianEmailAddress = $this->_validResult['physicianEmailAddress'];//not required field
                $physicianBoxAddress = $this->_validResult['physicianBoxAddress'];//not required field
                $physicianCountry = $this->_validResult['physicianCountry'];//not required field
                $physicianLocality = $this->_validResult['physicianLocality'];//not required field
                $isStudentHospital = $this->_validResult['isStudentHospital'];
                $hospitalName = $this->_validResult['hospitalName'];//not required field
                $firstHospitalNumber = $this->_validResult['1stHospitalNumber'];//not required field
                $secondHospitalNumber = $this->_validResult['2ndHospitalNumber'];//not required field
                $hospitalEmailAddress = $this->_validResult['hospitalEmailAddress'];//not required field
                $hospitalBoxAddress = $this->_validResult['hospitalBoxAddress'];//not required field
                $hospitalCountry = $this->_validResult['hospitalCountry'];//not required field
                $hospitalLocality = $this->_validResult['hospitalLocality'];;//not required field
                
                
                //Process Student data for insertion.
                
                //1. Check if a similar student has already been registered in the same school. hint: Each school student must have a unique email address and admission number
                //1. Confirm User information to realize this user is not already registered for another school.
                    $userValues['email'] = Zf_QueryGenerator::SQLValue($studentEmailAddress);
                    $userColumns = array("email");
                    
                    $zvs_userSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $userValues, $userColumns);
                    $zvs_executeUserSqlQuery = $this->Zf_AdoDB->Execute($zvs_userSqlQuery);
                    
                    if(!$zvs_executeUserSqlQuery){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Check if a similar user exists.
                        if($zvs_executeUserSqlQuery->RecordCount() > 0){
                            
                            //This student 
                            Zf_SessionHandler::zf_setSessionVariable("student_registration", "existent_student_email");

                            $zf_errorData = array("zf_fieldName" => "studentEmailAddress", "zf_errorMessage" => "* This email address is already registered!!");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                            exit();
                        
                        }else{
                            
                           echo $studentEmailAddress." ===> Is correct!!";
                            
                            
                            
                        }
                    }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("student_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
            exit();
            
            
        }
       
        
    }
    
  
    
    
}

?>
