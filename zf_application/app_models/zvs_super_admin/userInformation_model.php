<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class userInformation_Model extends Zf_Model {
    

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
     * This method fetches all user information
     */
    public function getUserInformation($identificationCode){
      
        $zvs_sqlValueUserCode["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $zvs_fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_super_admin", $zvs_sqlValueUserCode);
        $zvs_executeFetchUserDetails = $this->Zf_AdoDB->Execute($zvs_fetchUserDetails);

        if(!$zvs_executeFetchUserDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchUserDetails->RecordCount() > 0){

                while(!$zvs_executeFetchUserDetails->EOF){
                    
                    $results = $zvs_executeFetchUserDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }
        
         
    }
    
    
    
    
    /**
     * This method fetches all super administrators information
     */
    public function fetchSuperAdministrators(){
        
        //Fetch all super administrators
        $superAdmins = $this->fetchAdminsInformation("zvs_superAdmin");
        
        $usersRows = '';
        
        if($superAdmins == 0){
            
            $usersRows = '<tr><td>There are not platform super administrator yet.</td></tr>';
            
        }else{
            
            foreach ($superAdmins as $values){

                $fullName = $values['firstName']." ".$values['lastName'];$identificationCode = $values['identificationCode'];
                $status = $values['userStatus']; if($status == "1"){ $userStatus = "Active"; }else{ $userStatus = "Inactive"; }
                $usersRows .= '<tr><td>'.$fullName.'</td><td>'.$userStatus.'</td><td><a href=" '.ZF_ROOT_PATH.'zvs_super_admin'.DS.'view_super_admin'.DS.$identificationCode.' " title="View '.$fullName.'" ><i class="fa fa-eye"></i></a></td></tr>';

            }

        }
        
        echo $usersRows;
        
    }
    
    
    
    
    /**
     * This method counts all super administrators information
     */
    public function countSuperAdministrators(){
        
        //Active platfrorm administrators
        $activeAdmins = $this->activePlatformAdmins("zvs_superAdmin");
        
        //Inactive platfrorm administrators
        $inactiveAdmins = $this->inactivePlatformAdmins("zvs_superAdmin");
        
        $adminsCount = '<div class="col-md-6">Count Active: '.$activeAdmins.'</div><div class="col-md-6">Count Inactive: '.$inactiveAdmins.'</div>';
        
        echo $adminsCount;
        
    }
    
    
    
    
    /**
     * This method fetches all platform administrators information
     */
    public function fetchPlatformAdministrators(){
        
        //Fetch all super administrators
        $platformAdmins = $this->fetchAdminsInformation("zvs_platformAdmin");
        
        $usersRows = '';
        
        if($platformAdmins == 0){
            
            $usersRows = '<tr><td colspan="3">There are not platform main administrator yet.</td></tr>';
            
        }else{
            
            foreach ($platformAdmins as $values){

                $fullName = $values['firstName']." ".$values['lastName'];$identificationCode = $values['identificationCode'];
                $status = $values['userStatus']; if($status == "1"){ $userStatus = "Active"; }else{ $userStatus = "Inactive"; }
                $usersRows .= '<tr><td>'.$fullName.'</td><td>'.$userStatus.'</td><td><a href=" '.ZF_ROOT_PATH.'zvs_super_admin'.DS.'view_platform_admin'.DS.$identificationCode.' "  title="View '.$fullName.'"><i class="fa fa-eye"></i></a></td></tr>';

            }

        }
        
        echo $usersRows;
    }
    
    
    
    
    /**
     * This method counts all platform administrators information
     */
    public function countPlatformAdministrators(){
        
        //Active platfrorm administrators
        $activeAdmins = $this->activePlatformAdmins("zvs_platformAdmin");
        
        //Inactive platfrorm administrators
        $inactiveAdmins = $this->inactivePlatformAdmins("zvs_platformAdmin");
        
        $adminsCount = '<div class="col-md-6">Count Active: '.$activeAdmins.'</div><div class="col-md-6">Count Inactive: '.$inactiveAdmins.'</div>';
          
        echo $adminsCount;
        
    }
    

   
    
    /**
     * This private method fetches user information
     */
    private function fetchAdminsInformation($administratorType){
        
        if($administratorType == "zvs_superAdmin"){
            
            $zvs_table = "zvs_super_admin";
            
        }else if($administratorType == "zvs_platformAdmin"){
            
            $zvs_table = "zvs_platform_admin";
            
        }
        
        $fetchPlatformAdmins = Zf_QueryGenerator::BuildSQLSelect($zvs_table);
        
        $zvs_executeFetchPlatformAdmins = $this->Zf_AdoDB->Execute($fetchPlatformAdmins);

        if(!$zvs_executeFetchPlatformAdmins){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchPlatformAdmins->RecordCount() > 0){

                while(!$zvs_executeFetchPlatformAdmins->EOF){
                    
                    $results = $zvs_executeFetchPlatformAdmins->GetRows();
                    
                }
                
                return $results;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * This private method actually counts all active administrators
     */
    private function activePlatformAdmins($administratorType){
        
        if($administratorType == "zvs_superAdmin"){
            
            $zvs_table = "zvs_super_admin";
            
        }else if($administratorType == "zvs_platformAdmin"){
            
            $zvs_table = "zvs_platform_admin";
            
        }
        
        $zvs_value['userStatus'] = Zf_QueryGenerator::SQLValue(1);
        
        $activePlatformAdmins = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeActivePlatformAdmins = $this->Zf_AdoDB->Execute($activePlatformAdmins);
        
        if (!$zvs_executeActivePlatformAdmins){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_activePlatformAdminsCount = $zvs_executeActivePlatformAdmins->RecordCount();
            
        }
        
        return $zvs_activePlatformAdminsCount;
        
    }


    
    
    /**
     * This private method actually counts all inactive administrators
     */
    private function inactivePlatformAdmins($administratorType){
        
        if($administratorType == "zvs_superAdmin"){
            
            $zvs_table = "zvs_super_admin";
            
        }else if($administratorType == "zvs_platformAdmin"){
            
            $zvs_table = "zvs_platform_admin";
            
        }
        
        $zvs_value['userStatus'] = Zf_QueryGenerator::SQLValue(0);
        
        $inactivePlatformAdmins = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeInactivePlatformAdmins = $this->Zf_AdoDB->Execute($inactivePlatformAdmins);
        
        if (!$zvs_executeInactivePlatformAdmins){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_inactivePlatformAdminsCount = $zvs_executeInactivePlatformAdmins->RecordCount();
            
        }
        
        return $zvs_inactivePlatformAdminsCount;
        
    }

    


    /**
     * This method fetches the user profile image
     */
    public function getUserImage($imagePath, $userName){
         
        $user_image = ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin".DS.$imagePath;
                   
        $image = "";
        $image .= '<img src=" '.$user_image.'" title=" '.$userName.' " class="active-zvs-circular" height="80px" width="80px" >';

        echo  $image;
      
    }
    
    
    
    
    /**
     * Register new super administrators
     */
    public function registerNewSuperAdmin(){
        
        //Chain the form's posted data
        $this->zf_formController
                ->zf_postFormData('designation')
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
                ->zf_validateFormData('zf_fieldNotEmpty', 'Password');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
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
            
            //1. check if a user with a similar email address already exits
            $emailValue['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']);
            $emailColumn = array('email');
            
            //Generate and execute the query
            $zvs_confirmEmail = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $emailValue, $emailColumn);
            $zvs_executeConfirmEmail = $this->Zf_AdoDB->Execute($zvs_confirmEmail);
            
            if(!$zvs_executeConfirmEmail){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                //Check that the count is greater than zero or 0
                if($zvs_executeConfirmEmail->RecordCount() > 0){
                    
                    //User with a similar email address error
                    Zf_SessionHandler::zf_setSessionVariable("user_setup", "email_address_error");
                    
                    $zf_errorData = array("zf_fieldName" => "email", "zf_errorMessage" => "* User with a similar email address already exist!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_user');
                    exit();
                    
                }else{
                    
                    //Create and encrypt the identification code using input data
                    $identificationCode = Zf_SecureData::zf_encode_data(str_replace("+", "", $this->_validResult['country']).ZVSS_CONNECT.$this->_validResult['locality'].ZVSS_CONNECT."zvs_platform_super_admin".ZVSS_CONNECT.ZVS_SUPER_ADMIN.ZVSS_CONNECT."zvs_psa_".$this->_validResult['idNumber']);
                    
                    //2. Check if a user with a similar identification code already exist
                    $identificationCodeValue['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                    $identificationCodeColumn = array('identificationCode');

                    //Generate and execute the query
                    $zvs_confirmIdentificationCode = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $identificationCodeValue, $identificationCodeColumn);
                    $zvs_executeIdentificationCode = $this->Zf_AdoDB->Execute($zvs_confirmIdentificationCode);
                    
                    if(!$zvs_executeIdentificationCode){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Check that the count is greater than zero or 0
                        if($zvs_executeIdentificationCode->RecordCount() > 0){
                            
                            //User with a similar identification code error
                            Zf_SessionHandler::zf_setSessionVariable("user_setup", "identification_code_error");

                            $zf_errorData = array("zf_fieldName" => "idNumber", "zf_errorMessage" => "* User with a similar identification code already exist!!");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_user');
                            exit();
                            
                        }else{
                            
                            //No error established so we store the user image if any and register this user into the database.
                            
                            foreach ($this->_validResult as $zf_fieldName => $zf_fieldValue) {
                                
                                if($zf_fieldName == "email" || $zf_fieldName == "password"){
                                    
                                    if($zf_fieldName == "password"){
                                        
                                        $zvs_userDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($this->_validResult[$zf_fieldName])); 
                                        
                                    }else{
                                        
                                        $zvs_userDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($this->_validResult[$zf_fieldName]); 
                                        
                                    }
                                    
                                }else if($zf_fieldName != "email" || $zf_fieldName != "password" || $zf_fieldName != "image_path"){
                                    
                                    if($zf_fieldName == "idNumber"){
                                        
                                        $zvs_superAdminDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue("ZVS_PSA_".$this->_validResult[$zf_fieldName]);
                                        
                                    }else{
                                        
                                        $zvs_superAdminDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($this->_validResult[$zf_fieldName]);
                                        
                                    }
                                    
                                }
                                
                            }
                            
                            //Prepare user image if any for storage
                            if(is_array($this->_validResult['imagePath']) && $this->_validResult['imagePath'][size] != 0){
                                
                                //We use the identification code to generate the corresponding image name.
                                $imageName = Zf_Core_Functions::Zf_CleanName($identificationCode);
                                $uploadDirectory = ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin";
                                $imageArray = $this->_validResult['imagePath'];

                                //Store the user image into the datastore/user_images/zvs_super_admin directory
                                $this->zvs_uploadImage($imageArray, $imageName, $uploadDirectory);
                                
                                //This is the image name stored in the database
                                $zvs_superAdminDetails['imagePath'] = Zf_QueryGenerator::SQLValue($imageName.".png");
                                
                            }
                            
                            
                            //Other database information for zvs application users
                            $zvs_userDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                            
                            //Other database information for zvs super administrators
                            $zvs_superAdminDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);        
                            $zvs_superAdminDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                            $zvs_superAdminDetails['timeCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentTime());
                            $zvs_superAdminDetails['userStatus'] = Zf_QueryGenerator::SQLValue(ZVS_INACTIVE_USER);
                            
                            
                            //Build the insert SQL queries
                            $insertApplicationUser = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $zvs_userDetails);
                            $executeInsertApplicationUser = $this->Zf_AdoDB->Execute($insertApplicationUser);
                            
                            $insertSuperAdminDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_super_admin', $zvs_superAdminDetails);
                            $executeInsertSuperAdminDetails = $this->Zf_AdoDB->Execute($insertSuperAdminDetails);
                            
                            //print_r($this->zvs_activateAccountEmailBody($this->_validResult, ZVS_SUPER_ADMIN, $identificationCode)); exit();
                            
                            if(!$executeInsertApplicationUser || !$executeInsertSuperAdminDetails){
                           
                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                            }else{
                                
                                //Compose and send an account activation email
                                $zf_mailElements = array(
                                    "zf_senderName" => "Zilas Virtual School Platform",
                                    "zf_senderEmail" => "mathew@headsafrica.com",
                                    "zf_mailAddresses" => array($this->_validResult['email']),
                                    "zf_replyAddress" => "mathew@headsafrica.com", //Can be left empty if not desired. 
                                    "zf_mailSubject" => "Account Activation",
                                    "zf_mailBody" => $this->zvs_activateAccountEmailBody($this->_validResult, ZVS_SUPER_ADMIN, $identificationCode),
                                    "zf_mailType" => "rich-html" //'rich-html' or 'plain-text'
                                );

                                //Send Email to user's provided email address
                                Zf_SendEmails::zf_sendMail($zf_mailElements);

                                //Redirect to the platform users overview
                                Zf_SessionHandler::zf_setSessionVariable("user_setup", "user_setup_success");
                                Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_user');
                                exit();

                            }
                            
                        }
                        
                    }
                    
                }
                
            }
            
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("user_setup", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('zvs_super_admin', 'new_user');
            
        }
        
    }
    
    
    
    
    /**
     * Register new platform administrators
     */
    public function registerNewPlatformAdmin(){
        
        echo "We are about to register a new platform admin."; exit();
        
        
//        TEST CASE FOR IDENTIFICATION CODE
//        $identificationCode = Zf_SecureData::zf_encode_data(str_replace("+", "", $this->_validResult['country']).ZVSS_CONNECT.$this->_validResult['locality'].ZVSS_CONNECT."zvs_platform_super_admin".ZVSS_CONNECT.ZVS_SUPER_ADMIN.ZVSS_CONNECT."zvs_psa_".$this->_validResult['idNumber']);
//                    
//        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
//        echo "<pre>"; print_r($identificationArray); echo "</pre>"; exit();
        
    }
    
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function getAdminLocality(){
        
        $countryCode = $_POST['countryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($countryCode); 
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
     * This method uploads the images to the desired folder
     */
    private function zvs_uploadImage($imageArray, $imageName, $uploadDirectory){
        
        //Generate the parameters for the file to be uploaded (school logo)
        $zf_upload_parameters = array(
            "zf_fileUploadFolder" => $uploadDirectory,
            "zf_fileFieldName" => $imageArray
        );

        //Rules for modifying the file to be uploaded (school logo)
        $zf_upload_settings = array(
            'file_new_name_body' => $imageName,
            'file_new_name_ext' => 'png',
            'image_resize' => true,
            'image_x' => 100,
            'image_y' => 100,
            'forbidden' => array('application/*')
        );

        //Process the actual upload of the user image
        Zf_File_Upload::zf_fileUpload($zf_upload_parameters, $zf_upload_settings);
        
    }

       
    
    
    /**
     * This method builds the email body for resetting a password
     */
    private function zvs_activateAccountEmailBody($zvs_emailDetails, $zvs_role, $identificationCode){
        
        $zf_controller = "initialize";
        $zf_action = "activateAccounts";
        $zf_parameter = Zf_SecureData::zf_encode_data($zvs_role.ZVSS_CONNECT.$zvs_emailDetails['email'].ZVSS_CONNECT.$identificationCode);
        
        if($zvs_role == ZVS_SUPER_ADMIN){
            
            $role = "a platform super administrator";
            
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

                                    <a href="'.ZF_ROOT_PATH .'">
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
                                                        You have successfully been registered to Zilas Virtual Schools as '.$role.' </b>.
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
