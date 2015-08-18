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
        
        $zvs_fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_platform_admin", $zvs_sqlValueUserCode);
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
     * This method fetches the user profile image
     */
    public function getUserImage($imagePath, $userName){
         
        $user_image = ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_platform_admin".DS.$imagePath;
                   
        $image = "";
        $image .= '<img src=" '.$user_image.'" title=" '.$userName.' " class="active-zvs-circular" height="80px" width="80px" >';

        echo  $image;
      
    }
   
    
}

?>
