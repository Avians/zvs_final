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

class platformSchoolDetails_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
    private $zvs_controller;


    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
         
         $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the active controller
        $this->zvs_controller = $activeURL[0];
         
    }
    
    
    
    /**
     * This method fetches admin information for a particular school
     */
    public function getAdminInformation($systemSchoolCode){
        
        $zvs_sqlSchoolLevel["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchPlatformSchoolAdmin = Zf_QueryGenerator::BuildSQLSelect("zvs_school_admin", $zvs_sqlSchoolLevel);
        
        $zvs_executeFetchPlatformSchoolAdmin = $this->Zf_AdoDB->Execute($fetchPlatformSchoolAdmin);

        if(!$zvs_executeFetchPlatformSchoolAdmin){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchPlatformSchoolAdmin->RecordCount() > 0){

                while(!$zvs_executeFetchPlatformSchoolAdmin->EOF){
                    
                    $results = $zvs_executeFetchPlatformSchoolAdmin->GetRows();
                    
                }
                
                return $results;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * This method fetches a particular school information
     */
    public function getSchoolInformation($systemSchoolCode){
        
        $zvs_sqlSchoolLevel["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchPlatformSchools = Zf_QueryGenerator::BuildSQLSelect("zvs_school_details", $zvs_sqlSchoolLevel);
        
        $zvs_executeFetchPlatformSchools = $this->Zf_AdoDB->Execute($fetchPlatformSchools);

        if(!$zvs_executeFetchPlatformSchools){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchPlatformSchools->RecordCount() > 0){

                while(!$zvs_executeFetchPlatformSchools->EOF){
                    
                    $results = $zvs_executeFetchPlatformSchools->GetRows();
                    
                }
                
                return $results;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    /**
     * This method fetches a particular school information
     */
    public function getPlatformAdminInformation($identificationCode, $schoolName){
        
        $zvs_sqlIdentificationCode["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
        
        //Platform Administration section
        if($userRole == ZVS_SUPER_ADMIN){

            $table = "zvs_super_admin";

        }else if($userRole == ZVS_ADMIN){

            $table = "zvs_platform_admin";

        }
        
        $fetchAdmins = Zf_QueryGenerator::BuildSQLSelect($table, $zvs_sqlIdentificationCode);
        
        $zvs_executeFetchAdmins = $this->Zf_AdoDB->Execute($fetchAdmins);

        if(!$zvs_executeFetchAdmins){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchAdmins->RecordCount() > 0){

                $userName = $zvs_executeFetchAdmins ->fields['firstName']." ".$zvs_executeFetchAdmins ->fields['lastName'];
                
                return "{$schoolName} was registered to Zilas Virtual Schools<sup style='font-size: 8px !important; font-style: normal;'>TM</sup> by {$userName}.";
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * This method fetches the actual location of a school
     */
    public function getSchoolLocation($countryCode, $localityCode){
        
        $schoolCountry = $this->fetchSchoolCountry($countryCode);
        $schoolLocality = $this->fetchSchoolLocality($countryCode, $localityCode);
        
        return $schoolCountry.", ".$schoolLocality;
        
    }
    
    
    
    /**
     * This method fetches all platform schools information
     */
    public function fetchPlatformSchools($schoolType, $identificationCode){
        
        if($schoolType == "primarySchools"){
            
            $schoolLevel = "primary schools";
            
        }else if($schoolType == "secondarySchools"){
            
            $schoolLevel = "secondary schools";
            
        }else if($schoolType == "tertiaryColleges"){
            
            $schoolLevel = "tertiary colleges";
            
        }else if($schoolType == "polytechnics"){
            
            $schoolLevel = "polytechnics";
            
        }
        
        $platformSchools = $this->fetchSchoolInformation($schoolType, $identificationCode);
        
        $schoolRows = '';
        
        if($platformSchools == 0){
            
            $schoolRows = '<tr><td colspan="3" >There are no '.$schoolLevel.' yet.</td></tr>';
            
        }else{
            
            foreach ($platformSchools as $values){
                
                //if($this->userRole == ZVS_SUPER_ADMIN){ $zvs_controller = "zvs_super_admin";}else if($this->userRole == ZVS_ADMIN){$zvs_controller = "zvs_platform_admin";}

                $schoolName = $values['schoolName']; $systemSchoolCode = $values['systemSchoolCode'];
                $status = $values['schoolStatus']; if($status == "1"){ $schoolStatus = "Active"; }else{ $schoolStatus = "Inactive"; }
                $schoolRows .= '<tr><td>'.$schoolName.'</td><td>'.$schoolStatus.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_platform_school'.DS.  Zf_SecureData::zf_encode_url($systemSchoolCode).' " title="View '.$schoolName.'" ><i class="fa fa-list"></i></a></td></tr>';

            }

        }
        
        echo $schoolRows;
        
    }
    
    
    
    
    /**
     * This private method fetches actual school information
     */
    private function fetchSchoolInformation($schoolType, $identificationCode){
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
                                            
        $userRole = $identificationArray[3];
        
        if($schoolType == "primarySchools"){
            
            $schoolLevel = "Primary School";
            
        }else if($schoolType == "secondarySchools"){
            
            $schoolLevel = "Secondary School";
            
        }else if($schoolType == "tertiaryColleges"){
            
            $schoolLevel = "Tertiary College";
            
        }else if($schoolType == "polytechnics"){
            
            $schoolLevel = "Polytechnic";
            
        }
        
        $zvs_sqlSchoolLevel["schoolLevel"] = Zf_QueryGenerator::SQLValue($schoolLevel);
        if($userRole != ZVS_SUPER_ADMIN){ $zvs_sqlSchoolLevel['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        
        $fetchPlatformSchools = Zf_QueryGenerator::BuildSQLSelect("zvs_school_details", $zvs_sqlSchoolLevel);
        
        $zvs_executeFetchPlatformSchools = $this->Zf_AdoDB->Execute($fetchPlatformSchools);

        if(!$zvs_executeFetchPlatformSchools){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchPlatformSchools->RecordCount() > 0){

                while(!$zvs_executeFetchPlatformSchools->EOF){
                    
                    $results = $zvs_executeFetchPlatformSchools->GetRows();
                    
                }
                
                return $results;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    /**
     * This private method fetches the actual school country
     */
    private function fetchSchoolCountry($countryCode){
        
        $zvs_sqlCounrtyCode["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        
        $zvs_sqlColumnCountry = array('countryName');
        
        $fetchSchoolCountry = Zf_QueryGenerator::BuildSQLSelect("zvs_school_country", $zvs_sqlCounrtyCode, $zvs_sqlColumnCountry);
        
        $zvs_executeFetchSchoolCountry  = $this->Zf_AdoDB->Execute($fetchSchoolCountry);

        if(!$zvs_executeFetchSchoolCountry ){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchSchoolCountry ->RecordCount() > 0){

                
                    
                $country = $zvs_executeFetchSchoolCountry ->fields['countryName'];
                
                return $country;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * This private method fetches the actual school location within the country
     */
    private function fetchSchoolLocality($countryCode, $localityCode){
        
        $zvs_sqlLocalityCode["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        $zvs_sqlLocalityCode["localityCode"] = Zf_QueryGenerator::SQLValue($localityCode);
        
        $zvs_sqlColumnLocality = array('localityName', 'localityType');
        
        $fetchSchoolLocality = Zf_QueryGenerator::BuildSQLSelect("zvs_school_locality", $zvs_sqlLocalityCode, $zvs_sqlColumnLocality);
        
        $zvs_executeFetchSchoolLocality  = $this->Zf_AdoDB->Execute($fetchSchoolLocality);

        if(!$zvs_executeFetchSchoolLocality ){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchSchoolLocality->RecordCount() > 0){

                
                    
                $locality = $zvs_executeFetchSchoolLocality->fields['localityName']." ".$zvs_executeFetchSchoolLocality->fields['localityType'];
                 
                
                return $locality;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }



    
    /**
     * This method counts all platform school
     */
    public function countPlatformSchools($schoolType, $identificationCode){
        
        //Active platfrorm schools
        $activeSchools = $this->activePlatformSchools($schoolType, $identificationCode);
        
        //Inactive platfrorm schools
        $inactiveSchools = $this->inactivePlatformSchools($schoolType, $identificationCode);
        
        $schoolsCount = '<div class="col-md-6">Count Active: '.$activeSchools.'</div><div class="col-md-6">Count Inactive: '.$inactiveSchools.'</div>';
        
        echo $schoolsCount;
        
    }
    
    
    
    
    /**
     * This private method actually counts all active platform schools
     */
    private function activePlatformSchools($schoolType, $identificationCode){
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
                                            
        $userRole = $identificationArray[3];
        
        if($schoolType == "primarySchools"){
            
            $schoolLevel = "Primary School";
            
        }else if($schoolType == "secondarySchools"){
            
            $schoolLevel = "Secondary School";
            
        }else if($schoolType == "tertiaryColleges"){
            
            $schoolLevel = "Tertiary College";
            
        }else if($schoolType == "polytechnics"){
            
            $schoolLevel = "Polytechnic";
            
        }
        
        $zvs_table = "zvs_school_details";
        
        $zvs_value['schoolLevel'] = Zf_QueryGenerator::SQLValue($schoolLevel);
        if($userRole != ZVS_SUPER_ADMIN){ $zvs_value['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        $zvs_value['schoolStatus'] = Zf_QueryGenerator::SQLValue(1);
        
        
        $activePlatformSchools = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeActivePlatformSchools = $this->Zf_AdoDB->Execute($activePlatformSchools);
        
        if (!$zvs_executeActivePlatformSchools){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_activePlatformSchoolsCount = $zvs_executeActivePlatformSchools->RecordCount();
            
        }
        
        return $zvs_activePlatformSchoolsCount;
        
    }


    
    
    /**
     * This private method actually counts all inactive platform schools
     */
    private function inactivePlatformSchools($schoolType, $identificationCode){
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
                                            
        $userRole = $identificationArray[3];
        
        if($schoolType == "primarySchools"){
            
            $schoolLevel = "Primary School";
            
        }else if($schoolType == "secondarySchools"){
            
            $schoolLevel = "Secondary School";
            
        }else if($schoolType == "tertiaryColleges"){
            
            $schoolLevel = "Tertiary College";
            
        }else if($schoolType == "polytechnics"){
            
            $schoolLevel = "Polytechnic";
            
        }
        
        $zvs_table = "zvs_school_details";
        
        $zvs_value['schoolLevel'] = Zf_QueryGenerator::SQLValue($schoolLevel);
        if($userRole != ZVS_SUPER_ADMIN){ $zvs_value['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        $zvs_value['schoolStatus'] = Zf_QueryGenerator::SQLValue(0);
        
        $inactivePlatformSchools = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeInactivePlatformSchools = $this->Zf_AdoDB->Execute($inactivePlatformSchools);
        
        if (!$zvs_executeInactivePlatformSchools){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_inactivePlatformSchoolsCount = $zvs_executeInactivePlatformSchools->RecordCount();
            
        }
        
        return $zvs_inactivePlatformSchoolsCount;
        
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
     * This method fetches the user profile image
     */
    public function getSchoolLogo($schoolLogo, $schoolName){
         
        $user_image = ZF_ROOT_PATH.ZF_DATASTORE."zvs_school_details".DS."zvs_school_logo".DS.$schoolLogo;
                   
        $image = "";
        $image .= '<img src=" '.$user_image.'" title=" '.$schoolName.' " class="active-zvs-square center-block" height="80px" width="80px" >';

        echo  $image;
      
    }
    
    
    
}

?>
