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
     * This method counts all platform schools
     */
    public function zvs_countAllSchools($identificationCode){
        
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
      
        $zvs_table = "zvs_school_details";
        
        if($userRole == ZVS_ADMIN){ $zvs_value['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        
        
        $allPlatformSchools = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeAllPlatformSchools = $this->Zf_AdoDB->Execute($allPlatformSchools);
        
        if (!$zvs_executeAllPlatformSchools){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_allPlatformSchoolsCount = $zvs_executeAllPlatformSchools->RecordCount();
            
        }
        
        echo $zvs_allPlatformSchoolsCount;
        
    }
    
    
    
    
    /**
     * This method counts all platform active schools
     */
    public function zvs_countActiveSchools($identificationCode){
        
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
      
        $zvs_table = "zvs_school_details";
        
        if($userRole == ZVS_ADMIN){ $zvs_value['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        $zvs_value['schoolStatus'] = Zf_QueryGenerator::SQLValue(ZVS_ACTIVE_SCHOOL);
        
        
        $activePlatformSchools = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeActivePlatformSchools = $this->Zf_AdoDB->Execute($activePlatformSchools);
        
        if (!$zvs_executeActivePlatformSchools){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_activePlatformSchoolsCount = $zvs_executeActivePlatformSchools->RecordCount();
            
        }
        
        echo $zvs_activePlatformSchoolsCount;
        
    }
    
    
    
    
    /**
     * This method counts all platform suspended schools
     */
    public function zvs_countSuspendedSchools($identificationCode){
        
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
      
        $zvs_table = "zvs_school_details";
        
        if($userRole == ZVS_ADMIN){ $zvs_value['createdBy'] = Zf_QueryGenerator::SQLValue($identificationCode);}
        $zvs_value['schoolStatus'] = Zf_QueryGenerator::SQLValue(ZVS_BANNED_SCHOOL);
        
        
        $suspendedPlatformSchools = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value);
        
        $zvs_executeSuspendedPlatformSchools = $this->Zf_AdoDB->Execute($suspendedPlatformSchools);
        
        if (!$zvs_executeSuspendedPlatformSchools){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_suspendedPlatformSchoolsCount = $zvs_executeSuspendedPlatformSchools->RecordCount();
            
        }
        
        echo $zvs_suspendedPlatformSchoolsCount;
        
    }
    
    
    
    
    /**
     * This method counts all platform administrators
     */
    public function zvs_countAllAdministrators(){
      
        $zvs_super_admin = "zvs_super_admin"; $zvs_platform_admin = "zvs_platform_admin";
        
        
        $zvsSuperAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_super_admin);
        $zvsPlatformAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_platform_admin);
        
        $zvs_executeSuperAdmin = $this->Zf_AdoDB->Execute($zvsSuperAdmin);
        $zvs_executePlatformAdmin = $this->Zf_AdoDB->Execute($zvsPlatformAdmin);
        
        if (!$zvs_executeSuperAdmin || !$zvs_executePlatformAdmin){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_superAdminCount = $zvs_executeSuperAdmin->RecordCount();
            $zvs_platformAdminCount = $zvs_executePlatformAdmin->RecordCount();
            
        }
        
        echo $zvs_superAdminCount+$zvs_platformAdminCount;
        
    }
    
    
    
    
    /**
     * This method counts all platform active administrators
     */
    public function zvs_countActiveAdministrators(){
        
        $zvs_super_admin = "zvs_super_admin"; $zvs_platform_admin = "zvs_platform_admin";
        
        $zvs_value['userStatus'] = Zf_QueryGenerator::SQLValue(ZVS_ACTIVE_USER);
        
        $zvsActiveSuperAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_super_admin, $zvs_value);
        $zvsActivePlatformAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_platform_admin, $zvs_value);
        
        $zvs_executeActiveSuperAdmin = $this->Zf_AdoDB->Execute($zvsActiveSuperAdmin);
        $zvs_executeActivePlatformAdmin = $this->Zf_AdoDB->Execute($zvsActivePlatformAdmin);
        
        if (!$zvs_executeActiveSuperAdmin || !$zvs_executeActivePlatformAdmin){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_activeSuperAdminCount = $zvs_executeActiveSuperAdmin->RecordCount();
            $zvs_activePlatformAdminCount = $zvs_executeActivePlatformAdmin->RecordCount();
            
        }
        
        echo $zvs_activeSuperAdminCount+$zvs_activePlatformAdminCount;
        
    }
    
    
    
    
    /**
     * This method counts all platform suspended administrators
     */
    public function zvs_countSuspendedAdministrators($identificationCode){
        
        $zvs_super_admin = "zvs_super_admin"; $zvs_platform_admin = "zvs_platform_admin";
        
        $zvs_value['userStatus'] = Zf_QueryGenerator::SQLValue(ZVS_BANNED_USER);
        
        $zvsSuspendedSuperAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_super_admin, $zvs_value);
        $zvsSuspendedPlatformAdmin = Zf_QueryGenerator::BuildSQLSelect($zvs_platform_admin, $zvs_value);
        
        $zvs_executeSuspendedSuperAdmin = $this->Zf_AdoDB->Execute($zvsSuspendedSuperAdmin);
        $zvs_executeSuspendedPlatformAdmin = $this->Zf_AdoDB->Execute($zvsSuspendedPlatformAdmin);
        
        if (!$zvs_executeSuspendedSuperAdmin || !$zvs_executeSuspendedPlatformAdmin){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_suspendedSuperAdminCount = $zvs_executeSuspendedSuperAdmin->RecordCount();
            $zvs_suspendedPlatformAdminCount = $zvs_executeSuspendedPlatformAdmin->RecordCount();
            
        }
        
        echo $zvs_suspendedSuperAdminCount+$zvs_suspendedPlatformAdminCount;
        
    }
    
    
    
}

?>
