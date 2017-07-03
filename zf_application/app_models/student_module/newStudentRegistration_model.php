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
        
        
        //Here we chain all form data.
        
        //In this section we chain all student personal data
        $this->zf_formController->zf_postFormData('studentFirstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Student first name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Student first name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student first name')
                
                                ->zf_postFormData('studentMiddleName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Student middle name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Student middle name')
                
                                ->zf_postFormData('studentLastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Student last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Student last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student last name')
                
                                ->zf_postFormData('studentGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student gender')
                
                                ->zf_postFormData('studentDateOfBirth')
                
                                ->zf_postFormData('studentReligion')
                
                                ->zf_postFormData('studentCountry')
                
                                ->zf_postFormData('studentLocality')
                
                                ->zf_postFormData('studentBoxAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Student box address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Student box address')
                
                                ->zf_postFormData('studentPhoneNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 15, 'Student phone number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Student phone number')
                
                                ->zf_postFormData('studentLanguage');
        
        
        
        //In this section we chain all guardian related data
        $this->zf_formController->zf_postFormData('guardianDesignation')
                                //->zf_validateFormData('zf_fieldNotEmpty', 'Guardian desigantion')
                
                                ->zf_postFormData('guardianFirstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Guardian first name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Guardian first name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Guardian first name')
                    
                                ->zf_postFormData('guardianMiddleName')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Guardian middle name')
                                
                                ->zf_postFormData('guardianLastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Guardian last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Guardian last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Guardian last name')
                
                                ->zf_postFormData('guardianGender')
                
                                ->zf_postFormData('guardianDateOfBirth')//not required field
                
                                ->zf_postFormData('guardianReligion')//not required field
                
                                ->zf_postFormData('guardianCountry')
        
                                ->zf_postFormData('guardianLocality')
                   
                                ->zf_postFormData('guardianBoxAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Guardian box address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Guardian box address')
                
                                ->zf_postFormData('guardianPhoneNumber')
                                ->zf_validateFormData('zf_maximumLength', 15, 'Guardian phone number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Guardian phone number')
                
                                ->zf_postFormData('guardianRelation')
                
                                ->zf_postFormData('guardianOccupation')//not required field
                                ->zf_validateFormData('zf_maximumLength', 120, 'Guardian occupation')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Guardian occupation')
                
                                ->zf_postFormData('guardianLanguage');
        
        
        
        //In this section we chain all student medical data
        $this->zf_formController->zf_postFormData('isStudentBloodGroup')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('studentBloodGroup')//not required field
        
                                ->zf_postFormData('isStudentDisable')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('studentDisability')//not required field
                                ->zf_validateFormData('zf_maximumLength', 500, 'Student disability details')
        
                                ->zf_postFormData('isStudentMedicated')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('studentMedication')//not required field
                                ->zf_validateFormData('zf_maximumLength', 500, 'Student current medication details')
        
                                ->zf_postFormData('isStudentAllergic')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('studentAllergic')//not required field
                                ->zf_validateFormData('zf_maximumLength', 500, 'Student allergy details')
        
                                ->zf_postFormData('isStudentTreatment')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('studentTreatment')//not required field
                                ->zf_validateFormData('zf_maximumLength', 500, 'Student special treatment details')
        
                                ->zf_postFormData('isStudentPhysician')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('physicianDesignation')//not required field
        
                                ->zf_postFormData('physicianFirstName')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Physician first name')
        
                                ->zf_postFormData('physicianLastName')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Physician last name')
        
                                ->zf_postFormData('firstPhysicianMobileNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 30, 'Physician 1st mobile number')
        
                                ->zf_postFormData('secondPhysicianMobileNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 30, 'Physician 2nd mobile number')
        
                                ->zf_postFormData('physicianEmailAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Physician email address')
        
                                ->zf_postFormData('physicianBoxAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Physician box address')
        
                                ->zf_postFormData('physicianCountry')//not required field
        
                                ->zf_postFormData('physicianLocality')//not required field
        
                                ->zf_postFormData('isStudentHospital')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'One option')
        
                                ->zf_postFormData('hospitalName')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Hospital name')
        
                                ->zf_postFormData('firstHospitalNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 30, 'Hospital 1st mobile number')
        
                                ->zf_postFormData('secondHospitalNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 30, 'Hospital 2nd mobile number')
        
                                ->zf_postFormData('hospitalEmailAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Hospital email address')
        
                                ->zf_postFormData('hospitalBoxAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Hospital box address')
        
                                ->zf_postFormData('hospitalCountry')//not required field
        
                                ->zf_postFormData('hospitalLocality');//not required field
        
        
        
        //In this section we chain all student class data
        $this->zf_formController->zf_postFormData('studentClassCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student class')
        
                                ->zf_postFormData('studentStreamCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student stream')
        
                                ->zf_postFormData('studentAdmissionNumber')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Student admission number')
                                ->zf_validateFormData('zf_minimumLength', 3, 'Student admission number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student admission number');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('studentEmailAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Student email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Student email address')
                                ->zf_validateFormData('zf_checkEmail', 'studentEmailAddress')
                
                                ->zf_postFormData('studentPassword')
                                ->zf_validateFormData('zf_maximumLength', 120, 'Student password')
                                ->zf_validateFormData('zf_minimumLength', 4, 'Student password')
        
                                ->zf_postFormData('studentSchoolRole')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student role');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('guardianEmailAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Guardian email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Guardian email address')
                                ->zf_validateFormData('zf_checkEmail', 'guardianEmailAddress')
        
                                ->zf_postFormData('guardianPassword')
                                ->zf_validateFormData('zf_maximumLength', 120, 'Guardian password')
                                ->zf_validateFormData('zf_minimumLength', 4, 'Guardian password')
        
                                ->zf_postFormData('guardianSchoolRole')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Guardian role');
        
        
        
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
            
            //Using the school code, pull school information
            $zvs_schoolDetails = $this->zvs_fetchSchoolDetails($systemSchoolCode);
            
            if($zvs_schoolDetails == 0){
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("student_registration", "general_form_error");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                exit();
                
            }else{
                
                foreach ($zvs_schoolDetails as $schoolValues) {
                    
                    $schoolCountry = $schoolValues['schoolCountry']; $schoolLocality = $schoolValues['schoolLocality']; 
                    $schoolBoxAddress = $schoolValues['schoolBoxAddress']; $schoolPhoneNumber = $schoolValues['schoolPhoneNumber'];
                    $schoolEmailDomain = $this->zvs_generateEmailDomain($schoolValues['schoolWebsite']);
                    
                }
                
            }
            
            
            //Prepare all variables for student form data.
                $studentFirstName = $this->_validResult['studentFirstName'];
                $studentMiddleName = $this->_validResult['studentMiddleName'];
                $studentLastName = $this->_validResult['studentLastName'];
                $studentGender = $this->_validResult['studentGender'];
                $studentDateOfBirth = $this->_validResult['studentDateOfBirth'];
                $studentReligion = $this->_validResult['studentReligion'];
                $studentCountry = (empty($this->_validResult['studentCountry'])) ? $schoolCountry : $this->_validResult['studentCountry'];
                $studentLocality = (empty($this->_validResult['studentLocality'])) ? $schoolLocality : $this->_validResult['studentLocality'];
                $studentBoxAddress = (empty($this->_validResult['studentBoxAddress'])) ? $schoolBoxAddress : $this->_validResult['studentBoxAddress'];
                $studentPhoneNumber = (empty($this->_validResult['studentPhoneNumber'])) ? $schoolPhoneNumber : $this->_validResult['studentPhoneNumber'];
                $studentLanguage = $this->_validResult['studentLanguage'];
                $studentClassCode = $this->_validResult['studentClassCode'];
                $studentStreamCode = $this->_validResult['studentStreamCode'];
                $studentYearOfStudy = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
                $studentAdmissionNumber = $this->_validResult['studentAdmissionNumber'];
                $studentEmailAddress = (empty($this->_validResult['studentEmailAddress'])) ? "stu_".$studentAdmissionNumber.$schoolEmailDomain : $this->_validResult['studentEmailAddress'];
                $studentPassword = (empty($this->_validResult['studentPassword'])) ? "zvsStudent" : $this->_validResult['studentPassword'];
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
                $guardianCountry = (empty($this->_validResult['guardianCountry'])) ? $schoolCountry : $this->_validResult['guardianCountry'];
                $guardianLocality = (empty($this->_validResult['guardianLocality'])) ? $schoolLocality : $this->_validResult['guardianLocality'];
                $guardianBoxAddress = (empty($this->_validResult['guardianBoxAddress'])) ? $schoolBoxAddress : $this->_validResult['guardianBoxAddress'];
                $guardianPhoneNumber = (empty($this->_validResult['guardianPhoneNumber'])) ? $schoolPhoneNumber : $this->_validResult['guardianPhoneNumber'];
                $guardianRelation = $this->_validResult['guardianRelation'];
                $guardianOccupation = $this->_validResult['guardianOccupation'];//not required field
                $guardianLanguage = $this->_validResult['guardianLanguage'];
                $guardianEmailAddress = (empty($this->_validResult['guardianEmailAddress'])) ? "gud_".$studentAdmissionNumber.$schoolEmailDomain : $this->_validResult['guardianEmailAddress'];
                $guardianPassword = (empty($this->_validResult['guardianPassword']))?  "zvsGuardian"  : $this->_validResult['guardianPassword'];
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
                $firstMobileNumber = $this->_validResult['firstPhysicianMobileNumber'];//not required field
                $secondMobileNumber = $this->_validResult['secondPhysicianMobileNumber'];//not required field
                $physicianEmailAddress = $this->_validResult['physicianEmailAddress'];//not required field
                $physicianBoxAddress = $this->_validResult['physicianBoxAddress'];//not required field
                $physicianCountry = $this->_validResult['physicianCountry'];//not required field
                $physicianLocality = $this->_validResult['physicianLocality'];//not required field
                $isStudentHospital = $this->_validResult['isStudentHospital'];
                $hospitalName = $this->_validResult['hospitalName'];//not required field
                $firstHospitalNumber = $this->_validResult['firstHospitalNumber'];//not required field
                $secondHospitalNumber = $this->_validResult['secondHospitalNumber'];//not required field
                $hospitalEmailAddress = $this->_validResult['hospitalEmailAddress'];//not required field
                $hospitalBoxAddress = $this->_validResult['hospitalBoxAddress'];//not required field
                $hospitalCountry = $this->_validResult['hospitalCountry'];//not required field
                $hospitalLocality = $this->_validResult['hospitalLocality'];;//not required field
                
                
                //Process Student data for insertion.
                
                //1. Check if a similar student has already been registered in the same school. 
                //Hint: Each Zilas user must have a unique email address, so check using the email address.
                $studentEmailValue['email'] = Zf_QueryGenerator::SQLValue($studentEmailAddress);
                $studentEmailColumn = array("email");

                $zvs_studentEmailSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $studentEmailValue, $studentEmailColumn);
                $zvs_executeStudentEmailSqlQuery = $this->Zf_AdoDB->Execute($zvs_studentEmailSqlQuery);

                if(!$zvs_executeStudentEmailSqlQuery){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Check if a similar user exists.
                    if($zvs_executeStudentEmailSqlQuery->RecordCount() > 0){

                        //This student 
                        Zf_SessionHandler::zf_setSessionVariable("student_registration", "existent_student_email");

                        $zf_errorData = array("zf_fieldName" => "studentEmailAddress", "zf_errorMessage" => "* This student email address is already registered!!");
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                        Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                        exit();

                    }else{

                        //Check if a similar student has already been registered in the same school
                        //Hint: Each student within the school MUST have a unique admission number: check the istudent admission number.
                        $studentAdmissionNumberValue['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                        $studentAdmissionNumberValue['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                        $studentAdmissionNumberColumn = array("studentAdmissionNumber");

                        $zvs_studentAdmissionNumberSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_students_class_details', $studentAdmissionNumberValue, $studentAdmissionNumberColumn);

                        $zvs_executeStudentAdmissionNumberSqlQuery = $this->Zf_AdoDB->Execute($zvs_studentAdmissionNumberSqlQuery); 

                        if(!$zvs_executeStudentAdmissionNumberSqlQuery){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            //Check if a similar admission number exists
                            if($zvs_executeStudentAdmissionNumberSqlQuery->RecordCount() > 0){

                                Zf_SessionHandler::zf_setSessionVariable("student_registration", "existent_admission_number");

                                $zf_errorData = array("zf_fieldName" => "studentAdmissionNumber", "zf_errorMessage" => "* This admission number is already registered!!");
                                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                                exit();

                            }else{

                                //Check if a similar guardian email address has already been registered into the school
                                $guardianEmailValue['email'] = Zf_QueryGenerator::SQLValue($guardianEmailAddress);
                                $guardianEmailColumn = array("email");

                                $zvs_guardianEmailSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $guardianEmailValue, $guardianEmailColumn);
                                $zvs_executeGuardianEmailSqlQuery = $this->Zf_AdoDB->Execute($zvs_guardianEmailSqlQuery);

                                if(!$zvs_executeGuardianEmailSqlQuery){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                }else{

                                    //Check if a similar user exists.
                                    if($zvs_executeGuardianEmailSqlQuery->RecordCount() > 0){

                                        //This student 
                                        Zf_SessionHandler::zf_setSessionVariable("student_registration", "existent_guardian_email");

                                        $zf_errorData = array("zf_fieldName" => "guardianEmailAddress", "zf_errorMessage" => "* This guardian email address is already registered!!");
                                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                        Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                                        exit();

                                    }else{

                                        //THREE VALIDATION CHECKS ACCOMPLISHED:
                                        //1. A similar student email address hasn't been registered into the system
                                        //2. A similar student admission number hasn't been registered into the system for the same school
                                        //3. A simial guardian email address hasn't been registered into the system

                                        //PREPARE ALL STUDENT  DATA FOR INSERTION

                                        //1. Application user details
                                        $studentApplicationUserDetails['email'] = Zf_QueryGenerator::SQLValue($studentEmailAddress);
                                        $studentApplicationUserDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($studentPassword));
                                        $studentApplicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $studentApplicationUserDetails['zvs_platform_role'] = Zf_QueryGenerator::SQLValue(ZVS_SCHOOL_STUDENT);
                                        $studentApplicationUserDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);


                                        $guardianApplicationUserDetails['email'] = Zf_QueryGenerator::SQLValue($guardianEmailAddress);
                                        $guardianApplicationUserDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($guardianPassword));
                                        $guardianApplicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                                        $guardianApplicationUserDetails['zvs_platform_role'] = Zf_QueryGenerator::SQLValue(ZVS_SCHOOL_PARENT);
                                        $guardianApplicationUserDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);


                                        //2. Student personal detiails
                                        $studentPersonalDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $studentPersonalDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $studentPersonalDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                                        $studentPersonalDetails['studentFirstName'] = Zf_QueryGenerator::SQLValue($studentFirstName);
                                        $studentPersonalDetails['studentMiddleName'] = Zf_QueryGenerator::SQLValue($studentMiddleName);
                                        $studentPersonalDetails['studentLastName'] = Zf_QueryGenerator::SQLValue($studentLastName);
                                        $studentPersonalDetails['studentGender'] = Zf_QueryGenerator::SQLValue($studentGender);
                                        $studentPersonalDetails['studentDateOfBirth'] = Zf_QueryGenerator::SQLValue($studentDateOfBirth);
                                        $studentPersonalDetails['studentReligion'] = Zf_QueryGenerator::SQLValue($studentReligion);
                                        $studentPersonalDetails['studentCountry'] = Zf_QueryGenerator::SQLValue($studentCountry);
                                        $studentPersonalDetails['studentLocality'] = Zf_QueryGenerator::SQLValue($studentLocality);
                                        $studentPersonalDetails['studentBoxAddress'] = Zf_QueryGenerator::SQLValue($studentBoxAddress);
                                        $studentPersonalDetails['studentPhoneNumber'] = Zf_QueryGenerator::SQLValue($studentPhoneNumber);
                                        $studentPersonalDetails['studentLanguage'] = Zf_QueryGenerator::SQLValue($studentLanguage);
                                        $studentPersonalDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                                        $studentPersonalDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                                        $studentPersonalDetails['studentStatus'] = Zf_QueryGenerator::SQLValue(1);

                                        //3. Student guardian details
                                        $studentGuardianDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $studentGuardianDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                                        $studentGuardianDetails['guardianDesignation'] = Zf_QueryGenerator::SQLValue($guardianDesignation);
                                        $studentGuardianDetails['guardianFirstName'] = Zf_QueryGenerator::SQLValue($guardianFirstName);
                                        $studentGuardianDetails['guardianMiddleName'] = Zf_QueryGenerator::SQLValue($guardianMiddleName);
                                        $studentGuardianDetails['guardianLastName'] = Zf_QueryGenerator::SQLValue($guardianLastName);
                                        $studentGuardianDetails['guardianGender'] = Zf_QueryGenerator::SQLValue($guardianGender);
                                        $studentGuardianDetails['guardianDateOfBirth'] = Zf_QueryGenerator::SQLValue($guardianDateOfBirth);
                                        $studentGuardianDetails['guardianReligion'] = Zf_QueryGenerator::SQLValue($guardianReligion);
                                        $studentGuardianDetails['guardianCountry'] = Zf_QueryGenerator::SQLValue($guardianCountry);
                                        $studentGuardianDetails['guardianLocality'] = Zf_QueryGenerator::SQLValue($guardianLocality);
                                        $studentGuardianDetails['guardianBoxAddress'] = Zf_QueryGenerator::SQLValue($guardianBoxAddress);
                                        $studentGuardianDetails['guardianPhoneNumber'] = Zf_QueryGenerator::SQLValue($guardianPhoneNumber);
                                        $studentGuardianDetails['guardianRelation'] = Zf_QueryGenerator::SQLValue($guardianRelation);
                                        $studentGuardianDetails['guardianOccupation'] = Zf_QueryGenerator::SQLValue($guardianOccupation);
                                        $studentGuardianDetails['guardianLanguage'] = Zf_QueryGenerator::SQLValue($guardianLanguage);
                                        $studentGuardianDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                                        $studentGuardianDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                                        $studentGuardianDetails['guardianStatus'] = Zf_QueryGenerator::SQLValue(1);

                                        //4. Student medical details
                                        $studentMedicalDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $studentMedicalDetails['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $studentMedicalDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                                        $studentMedicalDetails['isStudentBloodGroup'] = Zf_QueryGenerator::SQLValue($isStudentBloodGroup);
                                        $studentMedicalDetails['studentBloodGroup'] = Zf_QueryGenerator::SQLValue($studentBloodGroup);
                                        $studentMedicalDetails['isStudentDisable'] = Zf_QueryGenerator::SQLValue($isStudentDisable);
                                        $studentMedicalDetails['studentDisability'] = Zf_QueryGenerator::SQLValue($studentDisability);
                                        $studentMedicalDetails['isStudentMedicated'] = Zf_QueryGenerator::SQLValue($isStudentMedicated);
                                        $studentMedicalDetails['studentMedication'] = Zf_QueryGenerator::SQLValue($studentMedication);
                                        $studentMedicalDetails['isStudentAllergic'] = Zf_QueryGenerator::SQLValue($isStudentAllergic);
                                        $studentMedicalDetails['studentAllergic'] = Zf_QueryGenerator::SQLValue($studentAllergic);
                                        $studentMedicalDetails['isStudentTreatment'] = Zf_QueryGenerator::SQLValue($isStudentTreatment);
                                        $studentMedicalDetails['studentTreatment'] = Zf_QueryGenerator::SQLValue($studentTreatment);
                                        $studentMedicalDetails['isStudentPhysician'] = Zf_QueryGenerator::SQLValue($isStudentPhysician);
                                        $studentMedicalDetails['physicianDesignation'] = Zf_QueryGenerator::SQLValue($physicianDesignation);
                                        $studentMedicalDetails['physicianFirstName'] = Zf_QueryGenerator::SQLValue($physicianFirstName);
                                        $studentMedicalDetails['physicianLastName'] = Zf_QueryGenerator::SQLValue($physicianLastName);
                                        $studentMedicalDetails['firstPhysicianMobileNumber'] = Zf_QueryGenerator::SQLValue($firstMobileNumber);
                                        $studentMedicalDetails['secondPhysicianMobileNumber'] = Zf_QueryGenerator::SQLValue($secondMobileNumber);
                                        $studentMedicalDetails['physicianEmailAddress'] = Zf_QueryGenerator::SQLValue($physicianEmailAddress);
                                        $studentMedicalDetails['physicianBoxAddress'] = Zf_QueryGenerator::SQLValue($physicianBoxAddress);
                                        $studentMedicalDetails['physicianCountry'] = Zf_QueryGenerator::SQLValue($physicianCountry);
                                        $studentMedicalDetails['physicianLocality'] = Zf_QueryGenerator::SQLValue($physicianLocality);
                                        $studentMedicalDetails['isStudentHospital'] = Zf_QueryGenerator::SQLValue($isStudentHospital);
                                        $studentMedicalDetails['hospitalName'] = Zf_QueryGenerator::SQLValue($hospitalName);
                                        $studentMedicalDetails['firstHospitalNumber'] = Zf_QueryGenerator::SQLValue($firstHospitalNumber);
                                        $studentMedicalDetails['secondHospitalNumber'] = Zf_QueryGenerator::SQLValue($secondHospitalNumber);
                                        $studentMedicalDetails['hospitalBoxAddress'] = Zf_QueryGenerator::SQLValue($hospitalBoxAddress);
                                        $studentMedicalDetails['hospitalEmailAddress'] = Zf_QueryGenerator::SQLValue($hospitalEmailAddress);
                                        $studentMedicalDetails['hospitalCountry'] = Zf_QueryGenerator::SQLValue($hospitalCountry);
                                        $studentMedicalDetails['hospitalLocality'] = Zf_QueryGenerator::SQLValue($hospitalLocality);
                                        $studentMedicalDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                                        $studentMedicalDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                                        $studentMedicalDetails['studentStatus'] = Zf_QueryGenerator::SQLValue(1);

                                        //5. Student class details
                                        $studentClassDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $studentClassDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $studentClassDetails['studentClassCode'] = Zf_QueryGenerator::SQLValue($studentClassCode);
                                        $studentClassDetails['studentStreamCode'] = Zf_QueryGenerator::SQLValue($studentStreamCode);
                                        $studentClassDetails['studentYearOfStudy'] = Zf_QueryGenerator::SQLValue($studentYearOfStudy);
                                        $studentClassDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                                        $studentClassDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                                        $studentClassDetails['studentClassStatus'] = Zf_QueryGenerator::SQLValue(1);

                                        //6. Student-Guardian mapper
                                        $studentGuardianMapperDetails['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $studentGuardianMapperDetails['guardianIdentificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                                        $studentGuardianMapperDetails['recordStatus'] = Zf_QueryGenerator::SQLValue(1);


                                        //Since all data has been prepared for database, build the INSERTION SQL quries

                                        //1. Insert student application user details
                                        $insertStudentApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $studentApplicationUserDetails);
                                        $executeInsertStudentApplicationUserDetails = $this->Zf_AdoDB->Execute($insertStudentApplicationUserDetails);
                                        if(!$executeInsertStudentApplicationUserDetails){

                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                        }else{

                                            //2. Insert guardian application user details
                                            $insertGuardianApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_application_users", $guardianApplicationUserDetails);
                                            $executeInsertGuardianApplicationUserDetails = $this->Zf_AdoDB->Execute($insertGuardianApplicationUserDetails);
                                            if(!$executeInsertGuardianApplicationUserDetails){

                                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                            }else{

                                                //3. Insert student personal detials
                                                $insertStudentPersonalDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_personal_details", $studentPersonalDetails);
                                                $executeInsertStudentPersonalDetails = $this->Zf_AdoDB->Execute($insertStudentPersonalDetails);
                                                if(!$executeInsertStudentPersonalDetails){

                                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                }else{

                                                    //4. Insert student guardian details
                                                    $insertStudentGuardianDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_guardian_details", $studentGuardianDetails);
                                                    $executeInsertStudentGuardianDetails = $this->Zf_AdoDB->Execute($insertStudentGuardianDetails);
                                                    if(!$executeInsertStudentGuardianDetails){

                                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                    }else{

                                                        //5. Insert student medical details
                                                        $insertStudentMedicalDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_medical_details", $studentMedicalDetails);
                                                        $executeInsertStudentMedicalDetails = $this->Zf_AdoDB->Execute($insertStudentMedicalDetails);
                                                        if(!$executeInsertStudentMedicalDetails){

                                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                        }else{
                                                            
                                                            //Pull Class and stream details
                                                            $updateStreamDetails = $this->zvs_updateStreamDetails($studentClassCode, $studentStreamCode);
                                                            

                                                            //6. Insert student class details
                                                            $insertStudentClassDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_class_details", $studentClassDetails);
                                                            $executeInsertStudentClassDetails = $this->Zf_AdoDB->Execute($insertStudentClassDetails);
                                                            if(!$executeInsertStudentClassDetails){

                                                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                            }else{

                                                                //7. Insert student-guardian mapper details
                                                                $insertStudentGuardianMapper = Zf_QueryGenerator::BuildSQLInsert("zvs_students_guardians_mapper", $studentGuardianMapperDetails);
                                                                $executeInsertStudentGuardianMapper = $this->Zf_AdoDB->Execute($insertStudentGuardianMapper);
                                                                if(!$executeInsertStudentGuardianMapper){

                                                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                                }else{

                                                                    //Redirect to the platform users overview
                                                                    Zf_SessionHandler::zf_setSessionVariable("student_registration", "student_registration_success");
                                                                    Zf_GenerateLinks::zf_header_location("student_module", 'register_student', $registeredBy);
                                                                    exit();

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                        }

                                    }
                                }

                            }

                        }

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
    
    
    
    //This private method updates the stream data by adding the student to the existing occupancy.
    private function zvs_updateStreamDetails($studentClassCode, $studentStreamCode) {
        
        //Pull a stream with the specified class and stream codes.
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        
        $fetchSchoolStream = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStream = $this->Zf_AdoDB->Execute($fetchSchoolStream);

        if(!$zf_executeFetchSchoolStream){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStream->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStream->EOF){
                    
                    $results = $zf_executeFetchSchoolStream->GetRows();
                    
                }
                
                $currentOccupancy = $results[0]['schoolStreamOccupancy'];
                    
                    $newOccupancy = $currentOccupancy + 1;
                    
                    //update the database value
                    
                    $zvs_sqlValue["schoolStreamOccupancy"] = Zf_QueryGenerator::SQLValue($newOccupancy);
                    
                    $zvs_sqlColumns["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
                    $zvs_sqlColumns["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
                    
                    $updateStreamOccupancy = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_streams', $zvs_sqlValue, $zvs_sqlColumns);
                    
                    $zf_executeUpdateStreamOccupancy = $this->Zf_AdoDB->Execute($updateStreamOccupancy);
                    
                    if(!$zf_executeUpdateStreamOccupancy){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches school information for the current school
    private function zvs_fetchSchoolDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        
        $fetchSchoolDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $zvs_sqlValue);
        
        $zf_executeFetchSchoolDetails = $this->Zf_AdoDB->Execute($fetchSchoolDetails);

        if(!$zf_executeFetchSchoolDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolDetails->RecordCount() > 0){

                while(!$zf_executeFetchSchoolDetails->EOF){
                    
                    $results = $zf_executeFetchSchoolDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
  
    
    //This private method takes in school website domain and returns the school email domain
    private function zvs_generateEmailDomain($zvs_schoolWebDomain){
        
        $schoolDomain = parse_url($zvs_schoolWebDomain);
        
        //Here we create the school domain array
        $schoolDomainArray = explode(".", $schoolDomain["host"]);

        //We splice the array to remove the very first portion
        array_splice($schoolDomainArray, 0 ,1);

        //Here we piece this together to generate school email domain
        $newEmailDomain =  implode(".",$schoolDomainArray);

        return  "@".$newEmailDomain;
            
           
    }
}

?>
