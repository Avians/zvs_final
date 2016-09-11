<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered student.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class studentInformation_Model extends Zf_Model {
    

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
    public function getStudentLocality(){
        
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
     * This method is used to select Admin localities
     */
    public function getStreamDetails(){
        
        $classCode = $_POST['studentClassCode'];
        
        $zf_valueClassCode['schoolClassCode'] = Zf_QueryGenerator::SQLValue($classCode); 
        //$zf_valueStreamStatus['streamStatus'] = Zf_QueryGenerator::SQLValue(0);
        $zf_selectStreams = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zf_valueClassCode);
        
        if(!$this->Zf_QueryGenerator->Query($zf_selectStreams)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectStreams}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->schoolStreamCode."' >".$fetchRow->schoolStreamName."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
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
