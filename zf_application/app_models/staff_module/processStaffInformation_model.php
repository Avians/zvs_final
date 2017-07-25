<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered staff.                                     |
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
                
                                ->zf_postFormData('staffAdmissionNumber')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Staff number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Staff number')
                
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
        //echo "<pre>All Staff Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        
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
                        $staffIdNumberValue['staffAdmissionNumber'] = Zf_QueryGenerator::SQLValue($staffIdNumber);
                        $staffIdNumberColumn = array("staffIdNumber", "staffAdmissionNumber");

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
                                $staffPersonalDetails['staffAdmissionNumber'] = Zf_QueryGenerator::SQLValue($staffAdmissionNumber);
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
                                $staffPersonalDetails['staffSchoolStatus'] = Zf_QueryGenerator::SQLValue(1); 
                                
                                
                                //Since all data has been prepared for database, build the INSERTION SQL quries

                                //1. Insert staff application user details
                                $insertStaffApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $staffApplicationUserDetails);
                                //echo  $insertStaffApplicationUserDetails; exit();
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
    
    
    
    /**
     * This method processes all school staff that belong to a selected role
     */
    public function processStaffList(){
        
        $schoolRoleCode = $_POST['schoolRoleCode'];
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $schoolRoleCode)[0];
        
        //Here we fetch all school staff with this school role code
        $schoolStaffDetails = $this->zvs_fetchSchoolStaff($systemSchoolCode);
        
        $select_options = '';
        
        if($schoolStaffDetails == 0){
            
            $select_options .= '<option value="">No Valid Staff Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selectedDriver">Select school staff</option>';
            
            foreach ($schoolStaffDetails as $staffValue) {
                
                //Pull staff identification code
                $identificationCode = $staffValue['identificationCode'];
                
                //Pull staff school role from the identification code        
                $staffRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
                
                //Return only values for staff whose role matches current selected role
                if($schoolRoleCode == $systemSchoolCode.ZVSS_CONNECT.$staffRole){
                    
                    $firstName = (empty($staffValue['staffFirstName'])) ? "" : $staffValue['staffFirstName'];
                    $middleName = (empty($staffValue['staffMiddleName'])) ? "" : $staffValue['staffMiddleName'];
                    $lastName = (empty($staffValue['staffLastName'])) ? "" : $staffValue['staffLastName'];
                    $staffNumber = $staffValue['staffAdmissionNumber'];
                    
                    $select_options .= '<option value="'.$identificationCode.'">['.$staffNumber.'] - '.$firstName.' '.$lastName.'</option>';

                }

            }
            
        }
            
        echo $select_options;
        
    }
    
    
    
    
    /**
     * This method processes all stuff profile
     */
    public function processStaffProfile(){
        
        //This is staff identification code
        $identificationCode = $_POST['staffIdentificationCode'];
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];
        
        //Here we fetch all the staff information
        $staffDetails = $this->zvs_fetchSchoolStaff($systemSchoolCode, $identificationCode);
        
        $staffProfileView = "";
        
        if($staffDetails == 0){
            
            $staffProfileView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 310px !important;">
                                        <!--Staff Personal Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Staff Details</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 20% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                                <span class="content-view-errors" style="color: #B94A48;">
                                                    &nbsp;There is no staff details associated with the selected school staff! Contact school system administrator for more information.
                                                </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>';
            
        }else{
            
            
            foreach ($staffDetails as $staffValues){
                
                $staffDesignation = empty($staffValues['staffDesignation']) ? "" : $staffValues['staffDesignation'].".";
                $staffFirstName = $staffValues['staffFirstName']; $staffMiddleName = empty($staffValues['staffMiddleName']) ? "" : $staffValues['staffMiddleName']; $staffLastName = $staffValues['staffLastName']; 
                $staffFullName = $staffDesignation." ".$staffFirstName." ".$staffMiddleName." ".$staffLastName;
                $staffPhoneNumber = empty($staffValues['staffPhoneNumber']) ? "Not set" : $staffValues['staffPhoneNumber'];
                $staffBoxAddress = empty($staffValues['staffBoxAddress']) ? "Not set" : $staffValues['staffBoxAddress'];
                $staffGender = empty($staffValues['staffGender']) ? "Not set" : $staffValues['staffGender'];
                $staffAdmissionNumber = empty($staffValues['staffAdmissionNumber']) ? "Not set" : $staffValues['staffAdmissionNumber'];
                $staffIdNumber = empty($staffValues['staffIdNumber']) ? "Not set" : $staffValues['staffIdNumber'];
                $staffReligion = empty($staffValues['staffReligion']) ? "Not set" : $staffValues['staffReligion'];
                $staffMaritalStatus = empty($staffValues['staffMaritalStatus']) ? "Not set" : $staffValues['staffMaritalStatus'];
                $staffLanguage = empty($staffValues['staffLanguage']) ? "Not set" : $staffValues['staffLanguage'];
                
                //Pull staff email address
                $staffEmail = $this->zvs_pullApplicationUserEmail($identificationCode);
                
                //Pull student country
                $countryName = $this->zvs_pullCountryDetails($staffValues['staffCountry']);
                
                //Pull student locality
                $localityName = $this->zvs_pullLocalityDetails($staffValues['staffCountry'], $staffValues['staffLocality']);
            }
            
            $staffProfileView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Staff Personal Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Staff Details</h3>
                                        </div>
                                        <div class="col-md-12 margin-bottom-10" style="border: 0px solid #efefef; border-radius: 5px !important;">
                                            <div class="row" style="min-height: 60px;">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  margin-top-10" style="text-align: center; padding-top: 10px;">
                                                    <div class="zvs-circular">   
                                                        <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-top-10" style="border-left: 1px solid #eeeeee; min-height: 100px;">
                                                    <div class="row-fluid" style="min-height: 25px;">
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Full Name:</div>
                                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px; overflow: hidden !important; word-wrap:break-word;">'.$staffFullName.'</div>  
                                                    </div>
                                                    <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                                    <div class="row-fluid" style="min-height: 25px;">
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Email:</div>
                                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px; overflow: hidden !important; word-wrap:break-word;">'.$staffEmail.'</div>  
                                                    </div>
                                                    <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                                    <div class="row-fluid" style="min-height: 25px;">
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Mobile:</div>
                                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px; overflow: hidden !important; word-wrap:break-word;">'.$staffPhoneNumber.'</div>  
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="clearfix"><hr></div>
                                                </div>
                                            </div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Staff Number:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffAdmissionNumber.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>ID Number:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffIdNumber.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Box Address:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffBoxAddress.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Gender:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffGender.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Staff Religion:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffReligion.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Martial Status:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffMaritalStatus.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Official Language:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$staffLanguage.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Staff Country:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$countryName.'</div>  
                                            </div>
                                            <div class="clearfix margin-top-5 margin-bottom-10"></div>
                                            <div class="row-fluid" style="min-height: 25px;">
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Staff Locality:</b></div>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$localityName.'</div>  
                                            </div>
                                        </div>
                                        <div class="clearfix" style="margin-bottom: 20px !important;"></div>
                                    </div>
                                </div>';
            
        }
        
        echo $staffProfileView;
        
    }
    
    
    
    
    /**
     * This method processes all staff profile
     */
    public function processStaffDetails(){
        
        //This is staff identification code
        $identificationCode = $_POST['staffIdentificationCode'];
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];
        
        //This method pulls all staff details
        $staffDetails = $this->zvs_fetchSchoolStaff($systemSchoolCode, $identificationCode);
        
        $staffDetailsView = "";
        
            
        $staffDetailsView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                <div class="portlet box zvs-content-blocks" style="min-height: 310px !important;">
                                    <!--Staff Personal Details-->
                                    <div class="zvs-content-titles">
                                        <h3 class="" style="color: #21B4E2 !important;">Related Staff Details</h3>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 25% !important;">
                                            <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                            <span class="content-view-errors" style="color: #B94A48;">
                                                &nbsp;Information about related staff details will be populated soon!!.
                                            </span>
                                        </div>
                                    </div> 
                                </div>
                            </div>';
            
        
        echo $staffDetailsView;
        
    }
    
    
    
    //This prublic method fetcches school student statistics for a selceted year.
    public function zvs_fetchStaffInformation($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_staffDetails = "";
        
        $zvs_staffDetails .='   <!--START OF STAFF STATISTICS-->
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat purple-sharp">
                                            <div class="visual">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
        
                                                   $totalSchoolStaff = $this->zvs_getStaffAndRoleInformation($zvs_targetInformation = "Gender", $systemSchoolCode);
                                                   $zvs_staffDetails .= $totalSchoolStaff;  
                                                    
                        $zvs_staffDetails .='   </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Total Staff&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Staff Members
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat green-sharp">
                                            <div class="visual">
                                                <i class="fa fa-male"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                    $totalMaleStaff = $this->zvs_getStaffAndRoleInformation($zvs_targetInformation = "Gender", $systemSchoolCode, "Male");
                                                    $zvs_staffDetails .= $totalMaleStaff; 
                                                    
                        $zvs_staffDetails .='   </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Male Staff&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-male"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Male Staff
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat blue-madison">
                                            <div class="visual">
                                                <i class="fa fa-female"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                    $totalFemaleStaff = $this->zvs_getStaffAndRoleInformation($zvs_targetInformation = "Gender", $systemSchoolCode, "Female");
                                                    $zvs_staffDetails .= $totalFemaleStaff; 
                        
                        $zvs_staffDetails .='   </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Female Staff&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-female"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Female Staff
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat red-soft">
                                            <div class="visual">
                                                <i class="fa fa-snowflake-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                    $totalSchoolRoles = $this->zvs_getStaffAndRoleInformation($zvs_targetInformation = "Role", $systemSchoolCode);
                                                    $zvs_staffDetails .= $totalSchoolRoles;  
                        
                    $zvs_staffDetails .='       </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                   School Roles&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-snowflake-o"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total School Roles
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END OF STAFF STATISTICS-->';
        
        
        
        echo $zvs_staffDetails;
        
    }
    
    
    
    
    //This private method fetches all details of school staff
    private function zvs_fetchSchoolStaff($systemSchoolCode, $identificationCode = NULL){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if(!empty($identificationCode) && $identificationCode != "" && $identificationCode != NULL){
            
            $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
            
        }
        
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
    
    
    
    
    //This private method returns total staff count base don parameters
    private function zvs_getStaffAndRoleInformation($zvs_targetInformation, $systemSchoolCode, $staffGender = NULL){
        
        if($zvs_targetInformation == "Gender"){
            
            //This is the actual count of staff gender
            return $this->zvs_countSchoolStaff($systemSchoolCode, $staffGender);
            
        }else if($zvs_targetInformation == "Role"){
            
            //This is the actual count of school roles
            return $this->zvs_countSchoolRoles($systemSchoolCode);
            
        }
        
    }
    
    
    
    
    //This private method does the actual counting school staff
    private function zvs_countSchoolStaff($systemSchoolCode, $staffGender = NULL){
        
        $zvs_targetTable = "zvs_staff_personal_details";
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if(!empty($staffGender) && $staffGender != NULL){
            
            $sqlValues['staffGender'] = Zf_QueryGenerator::SQLValue($staffGender);
        
        }

        $zvs_selectSchoolStaff = Zf_QueryGenerator::BuildSQLSelect($zvs_targetTable, $sqlValues);
        
        //echo $zvs_selectSchoolStaff; exit();
        
        $executeSchoolStaffCount  = $this->Zf_AdoDB->Execute($zvs_selectSchoolStaff);
        
        if (!$executeSchoolStaffCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $schoolStaffCount = $executeSchoolStaffCount->RecordCount();
            
        }
        
        //return staff information count
        return $schoolStaffCount;
        
    }
    
    
    
    
    //This private method does the actual counting of school roles
    private function zvs_countSchoolRoles($systemSchoolCode){
        
        $zvs_targetTable = "zvs_school_roles";
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        

        $zvs_selectSchoolRoles= Zf_QueryGenerator::BuildSQLSelect($zvs_targetTable, $sqlValues);
        
        //echo $zvs_selectSchoolStaff; exit();
        
        $executeSchoolRolesCount  = $this->Zf_AdoDB->Execute($zvs_selectSchoolRoles);
        
        if (!$executeSchoolRolesCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $schoolRolesCount = $executeSchoolRolesCount->RecordCount();
            
        }
        
        //return staff information count
        return $schoolRolesCount;
        
    } 
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullApplicationUserEmail($identificationCode){
        
        $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $zf_selectUserDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectUserDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectUserDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $emailAddress = $fetchRow->email;

                }

            }
            
            return $emailAddress;
        }
        
    }
    
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullCountryDetails($countryCode){
        
        $zvs_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        
        $zf_selectCountryDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_country', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectCountryDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectCountryDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $countryName = $fetchRow->countryName;

                }

            }
            
            return $countryName;
        }
        
    }
    
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullLocalityDetails($countryCode, $localityCode){
        
        $zvs_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        $zvs_sqlValue["localityCode"] = Zf_QueryGenerator::SQLValue($localityCode);
        
        $zf_selectLocalityDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_locality', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocalityDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectUserDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $localityName = $fetchRow->localityName.", ".$fetchRow->localityType;

                }

            }
            
            return $localityName;
        }
        
    }
        
}

?>
