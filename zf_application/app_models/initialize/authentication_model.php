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

class Authentication_Model extends Zf_Model {
    
   
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
     * This method logs in platform users
     */
    public function processLogin(){
      
        //Chain the form's posted data
        $this->zf_formController
                ->zf_postFormData('email')
                ->zf_validateFormData('zf_maximumLength', 120, 'Your email')
                ->zf_validateFormData('zf_minimumLength', 5, 'Your email')
                ->zf_validateFormData('zf_checkEmail')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Email')
                
                ->zf_postFormData('password')
                ->zf_validateFormData('zf_maximumLength', 120, 'Your password')
                ->zf_validateFormData('zf_minimumLength', 5, 'Your password')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Password');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        if(empty($this->_errorResult)){
            
            //Value fields
            foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {
              
                if($zvs_fieldName == 'email'){

                    $zvs_sqlValue[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue); 

                }

            }
            
            //Status column against which we compare.
            $zvs_sqlColumnStatus = array('userStatus');
            
            //Generate the SQL Query
            $zvs_selectUserStatus = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlValue, $zvs_sqlColumnStatus);
          
            //Execute the SQL Query
            $zvs_executeUserStatus = $this->Zf_AdoDB->Execute($zvs_selectUserStatus);
            
            if(!$zvs_executeUserStatus){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeUserStatus->RecordCount() > 0){
                    
                    $zvs_userStatus = $zvs_executeUserStatus->fields['userStatus'];
                    
                    if($zvs_userStatus != 1){
                        
                        //Account not yet confirmed
                        
                        //Alert indicator
                        Zf_SessionHandler::zf_setSessionVariable("initialize_indicator", "confirm_account");
                        
                        //Form error
                        $zvss_errorData = array( "zf_fieldName" => "email", "zf_errorMessage" => "* Account not yet confirmed" );
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                        
                        //Redirect to login page
                        Zf_GenerateLinks::zf_header_location('initialize'); exit();
                        
                        
                    }else{
                        
                        //Password column against which we compare.
                        $zvs_sqlColumnPassword = array('password');
                        
                        //Generate the SQL Query
                        $zvs_selectUserPassword = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlValue, $zvs_sqlColumnPassword);

                        //Execute the SQL Query
                        $zvs_executeUserPassword = $this->Zf_AdoDB->Execute($zvs_selectUserPassword);
                        
                        if(!$zvs_executeUserPassword){
                            
                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                            
                        }else{
                            
                            //Result count
                            if($zvs_executeUserPassword->RecordCount() > 0){
                                
                                while(!$zvs_executeUserPassword->EOF){
                                    
                                    if($zvs_executeUserPassword->fields['password'] === Zf_SecureData::zf_data_encode($this->_validResult['password'])){
                                        
                                        //Password matching.
                                        
                                        //Set a session variable to hold login success
                                        Zf_SessionHandler::zf_setSessionVariable("LoggedIn", TRUE);
                                        
                                        //Retrieve idenfication code
                                        
                                        //comparison field
                                        $zvs_valueEmail['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']); 
                                        
                                        //Fetch field
                                        $zvs_columnIdentificationCode = array('identificationCode');
                                        
                                        //Generate the SQL Query
                                        $zvs_sqlSelectIdentificationCode = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_valueEmail, $zvs_columnIdentificationCode);
                                        
                                        //Execute the SQL Query
                                        $zvs_executeSelectIdentificationCode = $this->Zf_AdoDB->Execute($zvs_sqlSelectIdentificationCode);
                                        
                                        if(!$zvs_executeSelectIdentificationCode){
                                            
                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                                            
                                        }else{
                                            
                                            //Encrypted identification code
                                            $identificationCode = $zvs_executeSelectIdentificationCode->fields['identificationCode'];
                                            
                                            //Store the identification code in a session variable
                                            Zf_SessionHandler::zf_setSessionVariable("zvs_identificationCode", $identificationCode);
                                            
                                            //echo $identificationCode."<br>";
                                            
                                            //When decoded, the idefication code looks like this
                                            /**
                                             * 
                                                Array
                                                (
                                                    [0] => 254                              //Is the country code
                                                    [1] => 027                              //Is the locality code
                                                    [2] => p2eiNfFAvcd3CsUXLV579%BW8oj1SO   //Is the school's system code
                                                    [3] => 7                                //Is the user role in the school
                                                    [4] => 0001                             //Is the user code in the school
                                                )
                                             * 
                                             */
                                            
                                            
                                            //Here we decode the identification code into an identification Array.
                                            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
                                            
                                            /**
                                                $countryCode = "254"; 
                                                $localityCode = "30"; 
                                                $schoolSystemCode = "6*09deg;R^EBWVM]CFhLTJ15QXw`H4"; 
                                                $userRole = "209"; $userId = "zvs_sma_001";
                                                $identificationCode1 = Zf_SecureData::zf_encode_data($countryCode.ZVSS_CONNECT.$localityCode.ZVSS_CONNECT.$schoolSystemCode.ZVSS_CONNECT.$userRole.ZVSS_CONNECT.$userId);

                                                echo "<pre>".$identificationCode1."</pre>";
                                             * 
                                             */
                                            
                                            //echo "<pre>"; print_r($identificationArray); echo "</pre>"; exit();
                                            
                                            //User role
                                            $userRole = $identificationArray[3];
                                            
                                            
                                            //Platform Administration section
                                            if($userRole == ZVS_SUPER_ADMIN){
                                                
                                                //Dashboard for super administrator
                                                Zf_GenerateLinks::zf_header_location("zvs_super_admin", "main_dashboard", $identificationCode);
                                                exit();
                                                
                                            }else if($userRole == ZVS_ADMIN){
                                                
                                                //Dashboard for platform administrator
                                                Zf_GenerateLinks::zf_header_location("zvs_platform_admin", "main_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            else if($userRole == SCHOOL_MAIN_ADMIN){
                                                
                                                //Dashboard for main school administrator
                                                Zf_GenerateLinks::zf_header_location("school_main_admin", "main_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            
                                            //Restricted users section
                                            else if($userRole == ZVS_GUEST_USER){
                                                
                                                //Dashboard for platform guest user
                                                Zf_GenerateLinks::zf_header_location("zvs_guest_user", "main_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            else if($userRole == ZVS_BANNED_USER){
                                                
                                                //Dashboard for platform banned user
                                                Zf_GenerateLinks::zf_header_location("zvs_banned_user", "main_dashboard", $identificationCode);
                                                exit();
                                                
                                            }else {
                                                
                                                if(!empty($userRole) && $userRole != ""){
                                                    
                                                    //Redirect to the general dashboard for any school user.
                                                    Zf_GenerateLinks::zf_header_location("zvs_general_school", "main_dashboard", $identificationCode);
                                                    exit();
                                                    
                                                }else{
                                                    
                                                    //Form error
                                                    $zvss_errorData = array( "zf_fieldName" => "email", "zf_errorMessage" => "* Information is invalid. Contact school " );
                                                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);

                                                    //Redirect to login page
                                                    Zf_GenerateLinks::zf_header_location('initialize');
                                                    exit();
                                                    
                                                }
                                                
                                            }   
                                           
                                            
                                        }
                                        
                                        exit();
                                        
                                    }else{
                                        
                                        //Form error
                                        $zvss_errorData = array( "zf_fieldName" => "password", "zf_errorMessage" => "* Password entered is invalid." );
                                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);

                                        //Redirect to login page
                                        Zf_GenerateLinks::zf_header_location('initialize');
                                        exit();
                                        
                                    }
                                    
                                }
                                
                            }else{
                                
                                //Form error
                                $zvss_errorData = array( "zf_fieldName" => "password", "zf_errorMessage" => "* Password cannot be empty." );
                                Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                                
                                //Redirect to login page
                                Zf_GenerateLinks::zf_header_location('initialize');
                                exit();
                                
                            }
                            
                        }
                        
                    }
                    
                }else{
                    
                    //Form error
                    $zvss_errorData = array( "zf_fieldName" => "email", "zf_errorMessage" => "* The email entered is invalid" );
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                    
                    //Redirect to login page
                    Zf_GenerateLinks::zf_header_location('initialize');
                    exit();
                    
                }
                
            }
                
        }else{
          
            //Form errors
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            //Redirect to login page
            Zf_GenerateLinks::zf_header_location('initialize');
            exit();

        }
               
    }
    
    
    
    
    /**
     * This method resets user passwords
     */
    public function resetPassword(){
      
        //Chain the form's posted data
        $this->zf_formController
                ->zf_postFormData('email')
                ->zf_validateFormData('zf_maximumLength', 120, 'Your email')
                ->zf_validateFormData('zf_minimumLength', 5, 'Your email')
                ->zf_validateFormData('zf_checkEmail')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Email');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        if(empty($this->_errorResult)){

            //Email column is selected
            $zvs_sqlValue['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']); 
            
            //Generate the SQL Query
            $zvs_selectUserEmail = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlValue);
  
            //Execute the SQL Query
            $zvs_executeUserEmail = $this->Zf_AdoDB->Execute($zvs_selectUserEmail);
            
            if(!$zvs_executeUserEmail){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeUserEmail->RecordCount() > 0){
                    
                    //Random user password
                    $zvs_userPassword = $this->zvs_generateUserPassword(5);
                    
                    //Actual update column
                    $updateColumns['password'] = Zf_QueryGenerator::SQLValue($zvs_userPassword);
  
                    //Update reference column        
                    $refColumns['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']);

                    //Generate the SQL Query
                    $zvs_updateUserPassword = Zf_QueryGenerator::BuildSQLUpdate('zvs_application_users', $updateColumns, $refColumns);
 
                    //Execute the SQL Query
                    $zvs_executeUpdateUserPassword = $this->Zf_AdoDB->Execute($zvs_updateUserPassword);

                    if(!$zvs_executeUpdateUserPassword){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Vital are email elements
                        $zf_mailElements = array(
                            "zf_senderName" => "Zilas Virtual School Platform",
                            "zf_senderEmail" => "mathew@headsafrica.com",
                            "zf_mailAddresses" => array($this->_validResult['email']),
                            "zf_replyAddress" => "mathew@headsafrica.com", //Can be left empty if not desired. 
                            "zf_mailSubject" => "Platform password reset",
                            "zf_mailBody" => $this->zvs_resetPasswordEmailBody($zvs_userPassword),
                            "zf_mailType" => "rich-html" //'rich-html' or 'plain-text'
                        );

                        //Send Email to user's provided email address
                        Zf_SendEmails::zf_sendMail($zf_mailElements);

                        //Set a session variable to indicate the success
                        Zf_SessionHandler::zf_setSessionVariable("initialize_indicator", "email_reset_success");
                        
                        //Redirect to login page
                        Zf_GenerateLinks::zf_header_location('initialize'); exit();

                    }
                    
                    
                }else{
                    
                    //Form error
                    $zvss_errorData = array( "zf_fieldName" => "email", "zf_errorMessage" => "* The email entered does not exist" );
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                    
                    //Redirect to forgot password page
                    Zf_GenerateLinks::zf_header_location('initialize', 'forgot_password');
                    exit();
                    
                }
                
            }
            
        }else{
            
            //Get hold of form error, the redirect to the initialize controller.
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('initialize', 'forgot_password');
            exit();
            
        }
         
    }
    
    
    
    
    /**
     * This method generates a random password
     */
    private function zvs_generateUserPassword($passwordLength){
        
        //Generate a random string.
        $randomPassword = Zf_Core_Functions::Zf_GenerateRandomString($passwordLength);

        return Zf_SecureData::zf_data_encode($randomPassword);//encoded password
 
    }
    
    
    
    
    /**
     * This method builds the email body for resetting a password
     */
    public function zvs_resetPasswordEmailBody($zvs_userPassword){
        
        $emailbody = '';
        $emailbody .='<html>
                        <head>
                                <title>Zilas Virtual Schools:Password Reset</title>
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
                                            -webkit-border-radius: 5px 5px 5px 5px; border-radius: 5px 5px 5px 5px; font-family: PTSansRegular,sans-serif;font-size: 13px; color: #575757;
                                        ">
                                            <div style="border: 0px solid #fff;margin: 0px auto 10px auto !important; width: 98% !important;color: #575757 !important;">
                                                <h2 style="padding-top: 20px !important; padding-left: 10px !important;">Successful Password Reset</h2>
                                                <p style="padding-left:10px !important;">
                                                    Dear platform user,<br>
                                                </p>
                                                <div style="color: #787878 !important; padding-top: 5px !important; padding-left: 10px !important;  padding-right: 10px !important; ">
                                                    <p>
                                                        Your Zilas Virtual Schools login password has successfully been reset.</b>.
                                                    </p>
                                                    <p>
                                                       To access your school account, use this email address and the below provided password.
                                                    </p>
                                                    <p>
                                                        <b>Password: </b><span style="font-size: 14px; color: #0F6199;">' . Zf_SecureData::zf_data_decode($zvs_userPassword) . '</span><br>
                                                    </p>
                                                    <p>
                                                        In your profile section, you may choose to edit your password as you wish.
                                                    </p>
                                                    <p>Thank you.<br><br></p>
                                                    <p>Zilas Virtual School Reporting</p>
                                                    <p><br></p>
                                                </div>
                                            </div>
                                        </div>
                                <!--This is the end of the content section-->

                                <!-- This is the start of the mail footer section -->
                                        <div style="
                                            text-align:center !important;font-family: Cuprum,Arial,Helvetica,Sans-Serif;
                                            font-size: 11px !important; color: #ffffff; padding: 10px; padding-top: 0px !important;
                                        ">
                                            EMAIL: support@zilasvirtualschool.com | PHONE: +254 (0) 737 06 5781 | POSTAL ADDRESS: 73619-00100 Nairobi (Kenya)<br>
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
