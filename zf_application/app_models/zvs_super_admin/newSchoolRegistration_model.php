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

class newSchoolRegistration_Model extends Zf_Model {
    

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
     * Register new super administrators
     */
    public function registerNewPlatformSchool(){
        
        //Chain the form's posted data
        
        //In this section we chain all the data of a given school.
        $this->zf_formController->zf_postFormData('schoolCode')
                                ->zf_validateFormData('zf_maximumLength', 100, 'School code')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School code')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School code')
                
                                ->zf_postFormData('registrationNumber')
                                ->zf_validateFormData('zf_maximumLength', 100, 'Registration No.')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Registration No.')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Registration No.')
                
                                ->zf_postFormData('schoolName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'School name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'School name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School name')
                
                                ->zf_postFormData('dateOfEstablishment')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Date of est.')
                
                                ->zf_postFormData('schoolEmail')
                                ->zf_validateFormData('zf_maximumLength', 120, 'School email')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School email')
                                ->zf_validateFormData('zf_checkEmail', 'schoolEmail')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School email')
                
                                ->zf_postFormData('schoolWebsite')
                                ->zf_validateFormData('zf_maximumLength', 120, 'School website')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School website')
                                ->zf_validateFormData('zf_checkUrl', 'schoolWebsite')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School Website')
                
                                ->zf_postFormData('schoolPhoneNumber')
                                ->zf_validateFormData('zf_maximumLength', 25, 'Phone number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Phone number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Phone number')
                
                                ->zf_postFormData('schoolMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 15, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('schoolBoxAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School address')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School address')
                
                                ->zf_postFormData('schoolMotto')
                                ->zf_validateFormData('zf_maximumLength', 200, 'School motto')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School motto')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School motto')
                
                                ->zf_postFormData('schoolLevel')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School level')
                
                                ->zf_postFormData('schoolCategory')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School category')
                
                                ->zf_postFormData('schoolGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School gender')
        
                                ->zf_postFormData('schoolType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School type')
                                
                                ->zf_postFormData('schoolCountry')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School country')
        
                                ->zf_postFormData('schoolLocality')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School locality')
                
                                ->zf_postFormData('schoolLogoPath')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School logo');
        
        
        //In this section we chain the data of a main school administrator.
        $this->zf_formController->zf_postFormData('designation')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Designation')

                                ->zf_postFormData('firstName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'First name')

                                ->zf_postFormData('middleName')

                                ->zf_postFormData('lastName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Last name')

                                ->zf_postFormData('idNumber')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Id Number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Id Number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Id Number')

                                ->zf_postFormData('mobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 15, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')

                                ->zf_postFormData('boxAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Box address')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Box address')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Box address')

                                ->zf_postFormData('gender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Admin gender')

                                ->zf_postFormData('country')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Country')

                                ->zf_postFormData('locality')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Locality')

                                ->zf_postFormData('imagePath')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Profile Image')

                                ->zf_postFormData('email')
                                ->zf_validateFormData('zf_maximumLength', 120, 'Email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Email address')
                                ->zf_validateFormData('zf_checkEmail', 'email')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Email Address')

                                ->zf_postFormData('password')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Your password')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Your password')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Password')
                
                                ->zf_postFormData('createdBy');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All School Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        /**
         * 
        identificationArray = 
        {
            [0] => 254 ---> country
            [1] => 30 --->locality
            [2] => zvs_platform_super_admin --->plaform user type
            [3] => 510 ---> platform user role
            [4] => zvs_psa_0001 ---> plaform user id (always perfixed by zvs_psa_idnumber)
        }
         */
        
        if(empty($this->_errorResult)){
            
           
            //We concatinate value in order to generate a unique user identification code.
            $countryCode = ltrim($this->_validResult['schoolCountry'], "+");
            $localityCode = $this->_validResult['schoolLocality'];
            $systemSchoolCode = $this->zvss_generateSystemSchoolCode();
            $userRole = SCHOOL_MAIN_ADMIN;
            $userId = $this->_validResult['idNumber'];
            
            //This is the main school administrator identification code.
            $identificationCode = Zf_SecureData::zf_encode_data($countryCode.ZVSS_CONNECT.$localityCode.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$userRole.ZVSS_CONNECT.$userId);
            
            //Check if a school with a similar registration number exists within the same country.
            $schoolValues['schoolCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolCode']); 
            $schoolValues['registrationNumber'] = Zf_QueryGenerator::SQLValue($this->_validResult['registrationNumber']); 
            $schoolValues['schoolCountry'] = Zf_QueryGenerator::SQLValue($countryCode);
            $schoolValues['schoolLocality'] = Zf_QueryGenerator::SQLValue($localityCode);
            
            $schoolColumns = array('schoolCode', 'registrationNumber', 'schoolCountry', 'schoolLocality');
            
            $zvs_schoolSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $schoolValues, $schoolColumns);
            $zvs_executeSchoolSqlQuery = $this->Zf_AdoDB->Execute($zvs_schoolSqlQuery);
            
            if (!$zvs_executeSchoolSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than one.
                if($zvs_executeSchoolSqlQuery->RecordCount() > 0){
                    
                    //A school with similar school code, registration number and locality information, has already been registered onto the platform.
                    Zf_SessionHandler::zf_setSessionVariable("school_setup", "school_setup_error");
                    
                    $zf_errorData = array("zf_fieldName" => "schoolCode", "zf_errorMessage" => "* A school with a similar school code or registration number already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_school');
                    exit();
                    
                }else{
                    
                    //There is not a school with a similar registration number or locality information.
                    
                    //1. Confirm User information to realize this user is not already registered for another school.
                    $userValues['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']);
                    $userColumns = array("email");
                    
                    $zvs_userSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $userValues, $userColumns);
                    $zvs_executeUserSqlQuery = $this->Zf_AdoDB->Execute($zvs_userSqlQuery);
                    
                    if(!$zvs_executeUserSqlQuery){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Check if a similar user exists.
                        if($zvs_executeUserSqlQuery->RecordCount() > 0){
                            
                            //A school with similar school code, registration number and locality information, has already been registered onto the platform.
                            Zf_SessionHandler::zf_setSessionVariable("school_setup", "school_setup_error");

                            $zf_errorData = array("zf_fieldName" => "email", "zf_errorMessage" => "* This email address is already registered!!");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_school');
                            exit();
                        
                        }else{
                            
                            //User not yet registered so register user as main school admin.
                            
                            foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {
                                
                                //1. Store the first batch to the zvs_application_users table
                                if($zvs_fieldName == "password" || $zvs_fieldName == "email"){
                                    
                                    if($zvs_fieldName == "password"){
                                        
                                        $zvs_userDetails[$zvs_fieldName] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($this->_validResult[$zvs_fieldName])); 
                                        
                                    }else{
                                        
                                        $zvs_userDetails[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($this->_validResult[$zvs_fieldName]); 
                                        
                                    }
                                }
                                //2. Store the second batch to the zvs_school_admin table
                                else if($zvs_fieldName == "designation" || $zvs_fieldName == "firstName" || $zvs_fieldName == "middleName" || $zvs_fieldName == "lastName" || $zvs_fieldName == "idNumber" || $zvs_fieldName == "mobileNumber" || $zvs_fieldName == "boxAddress" || $zvs_fieldName == "gender" || $zvs_fieldName == "country" || $zvs_fieldName == "locality" ){
                                    
                                    if($zvs_fieldName == "idNumber" ){
                                        
                                        $zvs_adminDetails[$zvs_fieldName] = Zf_QueryGenerator::SQLValue("ZVS_SA_".$this->_validResult[$zvs_fieldName]);
                                        
                                        
                                    }else{
                                        
                                        $zvs_adminDetails[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                                    
                                    }
                                    
                                }
                                //3. Store the third batch to zvs_school_details table
                                else if($zvs_fieldName == "schoolCode" || $zvs_fieldName == "registrationNumber" || $zvs_fieldName == "schoolName" || $zvs_fieldName == "dateOfEstablishment" || $zvs_fieldName == "schoolEmail" || $zvs_fieldName == "schoolWebsite" || $zvs_fieldName == "schoolPhoneNumber" || $zvs_fieldName == "schoolMobileNumber" || $zvs_fieldName == "schoolBoxAddress" || $zvs_fieldName == "schoolMotto" || $zvs_fieldName == "schoolLevel" || $zvs_fieldName == "schoolCategory" || $zvs_fieldName == "schoolGender" || $zvs_fieldName == "schoolType" || $zvs_fieldName == "schoolCountry" || $zvs_fieldName == "schoolLocality"){
                                
                                    $zvs_schoolDetails[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                                        
                                }
                               
                            }
                            
                            //Prepare Other Database Values for registering a new school.
                            
                            //1. application user details
                            $zvs_userDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                            $zvs_userDetails['userStatus'] = Zf_QueryGenerator::SQLValue(ZVS_INACTIVE_USER);
                            
                            //2. school main admin details
                            $zvs_adminDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $zvs_adminDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                            $zvs_adminDetails['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['createdBy']);
                            $zvs_adminDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                            $zvs_adminDetails['timeCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentTime());
                            $zvs_adminDetails['userStatus'] = Zf_QueryGenerator::SQLValue(ZVS_INACTIVE_USER);
                            //Prepare school admin image for storage
                            if(is_array($this->_validResult['imagePath']) && $this->_validResult['imagePath'][size] != 0){
                                
                                //We use the identification code to generate the corresponding image name.
                                $imageName = Zf_Core_Functions::Zf_CleanName($identificationCode);
                                $uploadDirectory = ZF_DATASTORE."zvs_user_images".DS."zvs_school_admin";
                                $imageArray = $this->_validResult['imagePath'];

                                //Store the user image into the datastore/user_images/zvs_super_admin directory
                                Zf_Core_Functions::Zf_uploadImages($imageArray, $imageName, $uploadDirectory);
                                
                                //This is the image name stored in the database
                                $zvs_adminDetails['imagePath'] = Zf_QueryGenerator::SQLValue($imageName.".png");
                                
                            }
                            
                            //3. actuals school details
                            $zvs_schoolDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $zvs_schoolDetails['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['createdBy']);
                            $zvs_schoolDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                            $zvs_schoolDetails['timeCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentTime());
                            $zvs_schoolDetails['schoolStatus'] = Zf_QueryGenerator::SQLValue(ZVS_INACTIVE_USER);
                            //Prepare school logo for storage
                            if(is_array($this->_validResult['schoolLogoPath']) && $this->_validResult['schoolLogoPath'][size] != 0){
                                
                                //We use the identification code to generate the corresponding logo name.
                                $schoolLogoPath = Zf_Core_Functions::Zf_CleanName( $this->_validResult['schoolName']."_".$systemSchoolCode);
                                $uploadDirectory = ZF_DATASTORE."zvs_school_details".DS."zvs_school_logo";
                                $imageArray = $this->_validResult['schoolLogoPath'];

                                //Store the user image into the datastore/user_images/zvs_super_admin directory
                                Zf_Core_Functions::Zf_uploadImages($imageArray, $schoolLogoPath, $uploadDirectory);
                                
                                //This is the image name stored in the database
                                $zvs_schoolDetails['schoolLogoPath'] = Zf_QueryGenerator::SQLValue($schoolLogoPath.".png");
                                
                            }
                            
                            //Build the insert SQL queries
                            $insertApplicationUser = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $zvs_userDetails);
                            $executeInsertApplicationUser = $this->Zf_AdoDB->Execute($insertApplicationUser);
                            
                            $insertAdminDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_school_admin', $zvs_adminDetails);
                            $executeInsertAdminDetails = $this->Zf_AdoDB->Execute($insertAdminDetails);
                            
                            $insertSchoolDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_school_details', $zvs_schoolDetails);
                            $executeInsertSchoolDetails = $this->Zf_AdoDB->Execute($insertSchoolDetails);
                            
                            if(!$executeInsertApplicationUser || !$executeInsertAdminDetails || !$executeInsertSchoolDetails){
                           
                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                            }else{
                                
                                //Get details of the registrar using the registrar's identificationCode.
                                
                                //Compose and send an account activation email
                                $zf_mailElements = array(
                                    "zf_senderName" => "Zilas Virtual School Platform",
                                    "zf_senderEmail" => "mathew@headsafrica.com",
                                    "zf_mailAddresses" => array($this->_validResult['email']),
                                    "zf_replyAddress" => "mathew@headsafrica.com", //Can be left empty if not desired. 
                                    "zf_mailSubject" => "Account Activation",
                                    "zf_mailBody" => $this->zvs_activateAccountEmailBody($this->_validResult, SCHOOL_MAIN_ADMIN, $identificationCode),
                                    "zf_mailType" => "rich-html" //'rich-html' or 'plain-text'
                                );

                                //Send Email to user's provided email address
                                Zf_SendEmails::zf_sendMail($zf_mailElements);

                                //Redirect to the platform users overview
                                Zf_SessionHandler::zf_setSessionVariable("school_setup", "school_setup_success");
                                Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_school');
                                exit();
                                
                            }

                        }
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("school_setup", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_school');
            
        }
        
    }
    
    
    
   /**
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for the generation of a school system generated code       |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function zvss_generateSystemSchoolCode(){
        
            //Generate a random string.
            $systemSchoolCode = Zf_Core_Functions::Zf_GenerateRandomString(30);

            //Prepare the field values for SQL querying
            $zf_value["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);

            //Generate the SQL Query
            $zf_selectSystemSchoolCode = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $zf_value);

            //Execute the SQL Query
            $zf_executeSelectSystemSchoolCode = $this->Zf_AdoDB->Execute($zf_selectSystemSchoolCode);

            //Get the execution results
            if (!$zf_executeSelectSystemSchoolCode) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            } else {

                //The the result count
                if ($zf_executeSelectSystemSchoolCode->RecordCount() > 0) {
                    
                    //Re-generate the system code.
                    $this->zvss_generateSystemSchoolCode();

                }else{

                    return $systemSchoolCode;

                }
            }
        
    } 
    
    
    
    /**
     * This method builds the email body for resetting a password
     */
    private function zvs_activateAccountEmailBody($zvs_emailDetails, $zvs_role, $identificationCode){
        
        $zf_controller = "initialize";
        $zf_action = "activateAccounts";
        $zf_parameter = Zf_SecureData::zf_encode_data($zvs_role.ZVSS_CONNECT.$zvs_emailDetails['email'].ZVSS_CONNECT.$identificationCode);
        
        if($zvs_role == SCHOOL_MAIN_ADMIN){
            
            $role = "a school main administrator";
            
        }
        
        $emailbody = '';
        $emailbody .='<html>
                        <head>
                                <title>Zilas Virtual Schools: Account Activation</title>
                        </head>
                        <body>

                            <div style="
                                width:100%; min-height: 430px !important; background-color: #0E4686 !important; color: #fff !important;
                                -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset; -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                                box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset; border: 1px solid #0E4686;
                                margin-top: 10px; height: auto; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; border-radius: 5px 5px 5px 5px;
                            ">
                                <!--This is the start of the header bar-->
                                <div style="
                                    height: 90px; background-color: #003366; width: 100%; width: 100%; border: 0px solid #ffff33 !important;
                                    border-bottom: 5px solid #ffffff !important;
                                    -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; border-radius: 5px 5px 0px 0px;
                                ">

                                    <a href="'.ZF_ROOT_PATH.'">
                                        <img src="'.ZF_ROOT_PATH.'/zf_client/zf_app_global/app_global_files/app_global_images/logo.png" width=" 60px " height=" 55px" style="margin: 20px auto auto 20px; border: 1px solid #0F6199; border-radius: 3px !important;" alt="HeadsAfrica Solutions Limited - Logo" >
                                    </a>

                                </div>
                                <!--This is the end of the header bar-->

                                <!--This is the start of the content section-->
                                        <div style="
                                            border: 0px solid #0E4686; width: 96% !important; margin: 25px auto 10px auto !important; min-height: 280px; background-color: #ffffff;-moz-border-radius: 5px 5px 5px 5px; 
                                            -webkit-border-radius: 5px 5px 5px 5px; border-radius: 5px 5px 5px 5px; font-family: Verdana,PTSansRegular,sans-serif; font-size: 13px; color: #575757;
                                        ">
                                            <div style="border: 0px solid #fff;margin: 0px auto 10px auto !important; width: 98% !important;color: #575757 !important; font-family: Verdana,PTSansRegular,sans-serif; font-size: 13px; line-height: 24px;">
                                                <h2 style="padding-top: 20px !important; padding-left: 10px !important; font-size: 20px; font-weight: light;">Welcome to Zilas Virtual Schools</h2>
                                                <p style="padding-left:10px !important;">
                                                    Dear '.ucfirst($zvs_emailDetails['firstName']).' '.ucfirst($zvs_emailDetails['lastName']).',<br>
                                                </p>
                                                <div style="color: #787878 !important; padding-top: 3px !important; padding-left: 10px !important;  padding-right: 10px !important; ">
                                                    <p>
                                                        You have successfully been registered to Zilas Virtual Schools as '.$role.'.
                                                    </p>
                                                    <p>
                                                        To get started, <a href="'. ZF_ROOT_PATH . $zf_controller . DS . $zf_action . DS . $zf_parameter . '" target="_blank" style="color:#21B4E2 !important; text-decoration: none !important;"><strong>activate your account</strong></a> and sign in with your email address and password as below;</br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>Email: </strong><span style="color:#21B4E2 !important; text-decoration: none !important;">' . $zvs_emailDetails['email'] . '</span><br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>Password: </strong><style="color:#21B4E2 !important; text-decoration: none !important;">' . $zvs_emailDetails['password'] . '</span><br>
                                                    </p>
                                                    <p>
                                                        In your profile section, you may choose to edit your password as you wish. Always remember your login details.
                                                    </p>
                                                    <p>
                                                        If you run into any problems, reach us at <span style="color:#21B4E2; text-decoration: none;">support@zilavirtualschools.com</span>
                                                    </p>
                                                    <p>Thank you.<br>Zilas Virtual Schools Team</br></br></p>
                                                </div>
                                            </div>
                                        </div>
                                <!--This is the end of the content section-->

                                <!-- This is the start of the mail footer section -->
                                        <div style="
                                            text-align:center !important;font-family: Verdana, Cuprum,Arial,Helvetica,Sans-Serif; line-height: 18px; letter-spacing: 0.04em;
                                            font-size: 10px !important; color: #ffffff !important; padding: 10px; padding-top: 0px !important;
                                        ">
                                            EMAIL: support@zilasvirtualschools.com | PHONE: +254 (0) 737 06 5781 | POSTAL ADDRESS: 73619-00100 Nairobi (Kenya)<br>
                                            &copy; 2015, Zilas Virtual Schools. All Rights Reserved.
                                        </div>
                                <!-- This is the end of the mail footer section -->

                            </div>

                        </body>
                    </html>';
        
        return $emailbody;
        
    }
    
    
}

?>
