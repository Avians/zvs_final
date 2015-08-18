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
    public function fetchPlatformSchools($schoolType){
        
        
        if($schoolType == "primarySchools"){
            
            $schoolLevel = "primary schools";
            
        }else if($schoolType == "secondarySchools"){
            
            $schoolLevel = "secondary schools";
            
        }else if($schoolType == "tertiaryColleges"){
            
            $schoolLevel = "tertiary colleges";
            
        }else if($schoolType == "polytechnics"){
            
            $schoolLevel = "polytechnics";
            
        }
        
        $platformSchools = $this->fetchSchoolInformation($schoolType);
        
        $schoolRows = '';
        
        if($platformSchools == 0){
            
            $schoolRows = '<tr><td colspan="3" >There are no '.$schoolLevel.' yet.</td></tr>';
            
        }else{
            
            foreach ($platformSchools as $values){

                $schoolName = $values['schoolName']; $systemSchoolCode = $values['systemSchoolCode'];
                $status = $values['schoolStatus']; if($status == "1"){ $schoolStatus = "Active"; }else{ $schoolStatus = "Inactive"; }
                $schoolRows .= '<tr><td>'.$schoolName.'</td><td>'.$schoolStatus.'</td><td><a href=" '.ZF_ROOT_PATH.'zvs_super_admin'.DS.'view_platform_school'.DS.  Zf_SecureData::zf_encode_url($systemSchoolCode).' " title="View '.$schoolName.'" ><i class="fa fa-list"></i></a></td></tr>';

            }

        }
        
        echo $schoolRows;
        
    }
    
    
    
    
    /**
     * This private method fetches actual school information
     */
    private function fetchSchoolInformation($schoolType){
        
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
    public function countPlatformSchools($schoolType){
        
        //Active platfrorm schools
        $activeSchools = $this->activePlatformSchools($schoolType);
        
        //Inactive platfrorm schools
        $inactiveSchools = $this->inactivePlatformSchools($schoolType);
        
        $schoolsCount = '<div class="col-md-6">Count Active: '.$activeSchools.'</div><div class="col-md-6">Count Inactive: '.$inactiveSchools.'</div>';
        
        echo $schoolsCount;
        
    }
    
    
    
    
    /**
     * This private method actually counts all active platform schools
     */
    private function activePlatformSchools($schoolType){
        
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
    private function inactivePlatformSchools($schoolType){
        
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
        $image .= '<img src=" '.$user_image.'" title=" '.$schoolName.' " class="active-zvs-circular center-block" height="80px" width="80px" >';

        echo  $image;
      
    }
    
    
    
}

?>
