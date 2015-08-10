<?php

//THIS CODE IS WRITTEN BY:
          //1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.
          //2. ALLAN KIBET, DEVELOPMENT AND IMPLEMENTATION HEAD AT ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class ActivateAccounts_Model extends Zf_Model {
    

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
     * This method is useful for activation of user accounts.
     * @param type $confirm_email
     */
    public function processActivateUserAccount($activationDetails){
        
        $activationDetailsArray = explode(ZVSS_CONNECT, $activationDetails);
        
        $userRole = $activationDetailsArray[0]; $userEmail = $activationDetailsArray[1]; $identificationCode = $activationDetailsArray[2];
        
        if($userRole == ZVS_SUPER_ADMIN){
            
            $table = "zvs_super_admin";
            
        }else if($userRole == ZVS_ADMIN){
            
            $table = "zvs_platform_admin";
            
        }else if($userRole == SCHOOL_MAIN_ADMIN){
            
            $table = "zvs_school_admin";
            
        }
        
        $zf_valueUserStatus['userStatus'] = Zf_QueryGenerator::SQLValue(1); 
        $zf_columnEmail['email'] = Zf_QueryGenerator::SQLValue($userEmail);
        $zf_columnEmail['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
        $zf_sqlConfirmUser = Zf_QueryGenerator::BuildSQLUpdate('zvs_application_users', $zf_valueUserStatus, $zf_columnEmail);
        $zf_executeConfirmUser = $this->Zf_AdoDB->Execute($zf_sqlConfirmUser);
        
       // print "<pre>";print_r($zf_executeQuery->GetRows()); print "</pre>"; //This is strictly for debugging purpose.

        if(!$zf_executeConfirmUser){
                
            echo "<strong>Query Execution Failed:</strong> <code>".$this->Zf_AdoDB->ErrorMsg()."</code>";

        }else{
            
            $zf_valueUserStatus['userStatus'] = Zf_QueryGenerator::SQLValue(1); 
            $zf_columnIdentificationCode['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
            $zf_sqlConfirmUserDetails = Zf_QueryGenerator::BuildSQLUpdate($table, $zf_valueUserStatus, $zf_columnIdentificationCode);
            $zf_executeConfirmUserDetails = $this->Zf_AdoDB->Execute($zf_sqlConfirmUserDetails);
            
            if(!$zf_executeConfirmUser){
                
                echo "<strong>Query Execution Failed:</strong> <code>".$this->Zf_AdoDB->ErrorMsg()."</code>";

            }else{

                Zf_SessionHandler::zf_setSessionVariable("Account_Sign_Up", "confirmed_email");
                Zf_GenerateLinks::zf_header_location("initialize", "authentication");
                exit();
            }

        } 
       
        
    }

}

?>
