<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered staff.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class processStaffInformation_Model extends Zf_Model {
    

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
     * This method is used to select Admin localities
     */
    public function getStaffLocality(){
        
        $staffCountryCode = $_POST['staffCountryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($staffCountryCode); 
        $zf_selectLocality = Zf_QueryGenerator::BuildSQLSelect('zvs_school_locality', $zf_valueCountryCode);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocality)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectLocality}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->localityCode."' >".$fetchRow->localityName." ".$fetchRow->localityType."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This method is responsible for the registration of a new staff into the school
     */
    public function registerNewStaff(){
        
        //In this section we chain all staff personal data
        $this->zf_formController->zf_postFormData('staffFirstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Staff first name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Staff first name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff first name')
                
                                ->zf_postFormData('staffMiddleName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Staff middle name')
                                ->zf_validateFormData('zf_minimumLength', 0, 'Staff middle name')
                
                                ->zf_postFormData('staffLastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Staff last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Staff last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff last name')
                
                                ->zf_postFormData('staffIdNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Staff ID number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Staff ID number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff ID number')
                
                                ->zf_postFormData('staffGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff gender')
                
                                ->zf_postFormData('staffMaritalStatus')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff marital status')
                
                                ->zf_postFormData('staffDateOfBirth')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff date of birth')
                
                                ->zf_postFormData('staffReligion')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff religion')
                
                                ->zf_postFormData('staffCountry')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff country')
                
                                ->zf_postFormData('staffLocality')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff locality')
                
                                ->zf_postFormData('staffBoxAddress')//not required field
                                ->zf_validateFormData('zf_maximumLength', 60, 'Staff box address')
                
                                ->zf_postFormData('staffPhoneNumber')//not required field
                                ->zf_validateFormData('zf_maximumLength', 30, 'Staff phone number')
                
                                ->zf_postFormData('staffLanguage')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff language');
        
        
         //In this section we chain all staff login data
        $this->zf_formController->zf_postFormData('staffEmailAddress')
                                ->zf_validateFormData('zf_maximumLength', 120, 'Staff email address')
                                ->zf_validateFormData('zf_minimumLength', 6, 'Staff email address')
                                ->zf_validateFormData('zf_checkEmail', 'staffEmailAddress')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff email address')
                
                                ->zf_postFormData('staffPassword')
                                ->zf_validateFormData('zf_maximumLength', 120, 'Staff password')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Staff password')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff password')
        
                                ->zf_postFormData('staffSchoolRole')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff role');
        
        
        
        $this->zf_formController->zf_postFormData('registeredBy');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        
        $registeredBy = $this->_validResult['registeredBy'];
        
        
        //This of debugging purposes only.
        //echo "<pre>All Staff Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            
            //Prepare all variables for staff form data.
                $staffFirstName = $this->_validResult['staffFirstName'];
                $staffMiddleName = $this->_validResult['staffMiddleName'];
                $staffLastName = $this->_validResult['staffLastName'];
                $staffIdNumber = $this->_validResult['staffIdNumber'];
                $staffGender = $this->_validResult['staffGender'];
                $staffMaritalStatus = $this->_validResult['staffMaritalStatus'];
                $staffDateOfBirth = $this->_validResult['staffDateOfBirth'];
                $staffReligion = $this->_validResult['staffReligion'];
                $staffCountry = $this->_validResult['staffCountry'];
                $staffLocality = $this->_validResult['staffLocality'];
                $staffBoxAddress = $this->_validResult['staffBoxAddress'];//not required field
                $staffPhoneNumber = $this->_validResult['staffPhoneNumber'];//not required field
                $staffLanguage = $this->_validResult['staffLanguage'];
                $staffClassCode = $this->_validResult['staffClassCode'];
                $staffStreamCode = $this->_validResult['staffStreamCode'];
                $staffYearOfStudy = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
                $staffAdmissionNumber = $this->_validResult['staffAdmissionNumber'];
                $staffEmailAddress = $this->_validResult['staffEmailAddress'];
                $staffPassword = $this->_validResult['staffPassword'];
                $staffRole = explode(ZVSS_CONNECT, $this->_validResult['staffSchoolRole'])[1];
                
                //Generate unique staff access code.
                $staffIdentificationCode = Zf_SecureData::zf_encode_data($staffCountry.ZVSS_CONNECT.$staffLocality.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$staffRole.ZVSS_CONNECT.$staffAdmissionNumber);
            
                //1. Check if a similar staff has already been registered in the same school. 
                //Hint: Each Zilas user must have a unique email address, so check using the email address.
                $staffEmailValue['email'] = Zf_QueryGenerator::SQLValue($staffEmailAddress);
                $staffEmailColumn = array("email");

                $zvs_staffEmailSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $staffEmailValue, $staffEmailColumn);
                $zvs_executeStaffEmailSqlQuery = $this->Zf_AdoDB->Execute($zvs_staffEmailSqlQuery);

                if(!$zvs_executeStaffEmailSqlQuery){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{
                    
                    //Check if a similar user exists.
                    if($zvs_executeStaffEmailSqlQuery->RecordCount() > 0){

                        //This staff email already exists
                        Zf_SessionHandler::zf_setSessionVariable("staff_registration", "existent_staff_email");

                        $zf_errorData = array("zf_fieldName" => "staffEmailAddress", "zf_errorMessage" => "* This staff email address is already registered!!");
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                        Zf_GenerateLinks::zf_header_location("staff_module", 'register_staff', $registeredBy);
                        exit();

                    }else{
                        
                        //Check if a similar staff has already been registered in the same school
                        //Hint: Each staff within the school MUST have a unique admission number: check the istaff admission number.
                        $staffIdNumberValue['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                        $staffIdNumberValue['staffIdNumber'] = Zf_QueryGenerator::SQLValue($staffIdNumber);
                        $staffIdNumberColumn = array("staffIdNumber");

                        $zvs_staffIdNumberSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_staff_personal_details', $staffIdNumberValue, $staffIdNumberColumn);

                        $zvs_executeStaffIdNumberSqlQuery = $this->Zf_AdoDB->Execute($zvs_staffIdNumberSqlQuery); 

                        if(!$zvs_executeStaffIdNumberSqlQuery){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            //Check if a similar ID number exists
                            if($zvs_executeStaffIdNumberSqlQuery->RecordCount() > 0){

                                Zf_SessionHandler::zf_setSessionVariable("staff_registration", "existent_id_number");

                                $zf_errorData = array("zf_fieldName" => "staffIdNumber", "zf_errorMessage" => "* This ID number is already registered!!");
                                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                Zf_GenerateLinks::zf_header_location("staff_module", 'register_staff', $registeredBy);
                                exit();

                            }else{
                                
                               //THREE VALIDATION CHECKS ACCOMPLISHED:
                                //1. A similar staff email address hasn't been registered into the system
                                //2. A similar staff ID number hasn't been registered into the system for the same school

                                //PREPARE ALL STAFF DATA FOR INSERTION

                                //1. Application user details
                                $staffApplicationUserDetails['email'] = Zf_QueryGenerator::SQLValue($staffEmailAddress);
                                $staffApplicationUserDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($staffPassword));
                                $staffApplicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($staffIdentificationCode);
                                $staffApplicationUserDetails['zvs_platform_role'] = Zf_QueryGenerator::SQLValue(ZVS_SCHOOL_STAFF);
                                $staffApplicationUserDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);


                                //2. Staff personal detiails
                                $staffPersonalDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                $staffPersonalDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($staffIdentificationCode);
                                $staffPersonalDetails['staffIdNumber'] = Zf_QueryGenerator::SQLValue($staffIdNumber);
                                $staffPersonalDetails['staffFirstName'] = Zf_QueryGenerator::SQLValue($staffFirstName);
                                $staffPersonalDetails['staffMiddleName'] = Zf_QueryGenerator::SQLValue($staffMiddleName);
                                $staffPersonalDetails['staffLastName'] = Zf_QueryGenerator::SQLValue($staffLastName);
                                $staffPersonalDetails['staffGender'] = Zf_QueryGenerator::SQLValue($staffGender);
                                $staffPersonalDetails['staffMaritalStatus'] = Zf_QueryGenerator::SQLValue($staffMaritalStatus);
                                $staffPersonalDetails['staffDateOfBirth'] = Zf_QueryGenerator::SQLValue($staffDateOfBirth);
                                $staffPersonalDetails['staffReligion'] = Zf_QueryGenerator::SQLValue($staffReligion);
                                $staffPersonalDetails['staffCountry'] = Zf_QueryGenerator::SQLValue($staffCountry);
                                $staffPersonalDetails['staffLocality'] = Zf_QueryGenerator::SQLValue($staffLocality);
                                $staffPersonalDetails['staffBoxAddress'] = Zf_QueryGenerator::SQLValue($staffBoxAddress);
                                $staffPersonalDetails['staffPhoneNumber'] = Zf_QueryGenerator::SQLValue($staffPhoneNumber);
                                $staffPersonalDetails['staffLanguage'] = Zf_QueryGenerator::SQLValue($staffLanguage);
                                $staffPersonalDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                                $staffPersonalDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                                $staffPersonalDetails['staffStatus'] = Zf_QueryGenerator::SQLValue(1); 
                                
                                
                                //Since all data has been prepared for database, build the INSERTION SQL quries

                                //1. Insert staff application user details
                                $insertStaffApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $staffApplicationUserDetails);
                                $executeInsertStaffApplicationUserDetails = $this->Zf_AdoDB->Execute($insertStaffApplicationUserDetails);
                                if(!$executeInsertStaffApplicationUserDetails){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }else{

                                    //2. Insert staff personal detials
                                    $insertStaffPersonalDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_staff_personal_details", $staffPersonalDetails);
                                    $executeInsertStaffPersonalDetails = $this->Zf_AdoDB->Execute($insertStaffPersonalDetails);
                                    if(!$executeInsertStaffPersonalDetails){

                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                    }else{
                                        
                                        //Send a validation email to the registered staff
                                        
                                        //Redirect to the platform users overview
                                        Zf_SessionHandler::zf_setSessionVariable("staff_registration", "staff_registration_success");
                                        Zf_GenerateLinks::zf_header_location("staff_module", 'register_staff', $registeredBy);
                                        exit();

                                    }

                                }

                            }
                            
                        }
                        
                    }
                    
                }
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("staff_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("staff_module", 'register_staff', $registeredBy);
            exit();
            
            
        }
        
    }
    
}

?>
