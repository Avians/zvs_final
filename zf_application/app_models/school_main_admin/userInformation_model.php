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
        
        $zvs_fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_school_admin", $zvs_sqlValueUserCode);
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
         
        $user_image = ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_school_admin".DS.$imagePath;
                   
        $image = "";
        $image .= '<img src=" '.$user_image.'" title=" '.$userName.' " class="active-zvs-circular" height="80px" width="80px" >';

        echo  $image;
      
    }
    
    
    
    
    /**
     * This method fetches all school information
     */
    public function getSchoolInformation($identificationCode){
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        $schoolSystemCode = $identificationArray[2];
      
        $zvs_schoolSystemCode["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $zvs_fetchSchoolDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_school_details", $zvs_schoolSystemCode);
        $zvs_executeFetchSchoolDetails = $this->Zf_AdoDB->Execute($zvs_fetchSchoolDetails);

        if(!$zvs_executeFetchSchoolDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchSchoolDetails->RecordCount() > 0){

                while(!$zvs_executeFetchSchoolDetails->EOF){
                    
                    $results = $zvs_executeFetchSchoolDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }
        
         
    }
    
    
    //This method returns school location
    public function getSchoolLocation($countryCode, $localityCode){
        
        $countryDetails = $this->schoolCountry("+".$countryCode);
        $localityDetails = $this->schoolLocality($localityCode);
        
        return $countryDetails[0]['countryName'].", ".$localityDetails[0]['localityName']." ".$localityDetails[0]['localityType'];
        
    }






    //This method fetches the school country information
    private function schoolCountry($countryCode){
        
      
        $zvs_countryCode["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        
        $zvs_fetchCountryDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_school_country", $zvs_countryCode);
        $zvs_executeFetchCountryDetails = $this->Zf_AdoDB->Execute($zvs_fetchCountryDetails);

        if(!$zvs_executeFetchCountryDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchCountryDetails->RecordCount() > 0){

                while(!$zvs_executeFetchCountryDetails->EOF){
                    
                    $results = $zvs_executeFetchCountryDetails->GetRows();
                    
                }
                
                return $results;
   
            }else{
                
                return 0;
                
            }
            
        }
        
         
    }
    
    
    
    
    //This method fetches the school locality information
    private function schoolLocality($localityCode){
      
        $zvs_localityCode["localityCode"] = Zf_QueryGenerator::SQLValue($localityCode);
        
        $zvs_fetchLocalityDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_school_locality", $zvs_localityCode);
        $zvs_executeFetchLocalityDetails = $this->Zf_AdoDB->Execute($zvs_fetchLocalityDetails);

        if(!$zvs_executeFetchLocalityDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchLocalityDetails->RecordCount() > 0){

                while(!$zvs_executeFetchLocalityDetails->EOF){
                    
                    $results = $zvs_executeFetchLocalityDetails->GetRows();
                    
                }
                
                return $results;
   
            }else{
                
                return 0;
                
            }
            
        }
        
         
    }
    
    
    
}

?>
