<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school role onto  |
 * |  the platform.                                                    |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newResourcesRolesMapper_Model extends Zf_Model {
    

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
    * This model method help in mapping resources to roles.
    */
    public function resourcesRolesMapper($identificationCode){
        
        //School System Code
        $schoolSystemCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $this->zf_formController->zf_postFormData('schoolRoleId')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School Role');
        
        
        //Fetch all available resources from the resources table, create a loop with all the resource id
        $zvs_resourceDetails = $this->zvs_fetchResourceDetails();

        //Here we collect all the resource data  
        foreach ($zvs_resourceDetails as $resourceValues) {
            
            $categoryId = explode(ZVSS_CONNECT, $resourceValues['resourceId'])[0];
            $cleanResourceName = Zf_Core_Functions::Zf_CleanName($resourceValues['resourceName']);
            
            $this->zf_formController->zf_postFormData($cleanResourceName);
            //$this->zf_formController->zf_postFormData($categoryId);//Not useful at this stage

        }


        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Resource Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
       
        if(empty($this->_errorResult)){
            
            //since all roles outlined in the drop-down select haven't been assigned before, they don't exist in the mapper table.
            
            foreach ($this->_validResult as $roleKey=>$rolesValue) {
                
                if($roleKey === "schoolRoleId"){
                    
                    $zvs_roleDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                    $zvs_roleDetails['schoolRoleId'] = Zf_QueryGenerator::SQLValue($this->_validResult["schoolRoleId"]);
                    
                    
                }else{
                    
                    $resuorceCategory = explode(ZVSS_CONNECT, $rolesValue)[0];
                
                    $zvs_roleDetails['schoolResourceId'] = Zf_QueryGenerator::SQLValue($rolesValue);
                    $zvs_roleDetails['resourceCategory'] = Zf_QueryGenerator::SQLValue($resuorceCategory);
                    $insertMappedResourceRole = Zf_QueryGenerator::BuildSQLInsert('zvs_resource_role_mapper', $zvs_roleDetails);
                    
                    //echo $insertMappedResourceRole; exit();
                    
                    $executeInsertMappedResourceRole = $this->Zf_AdoDB->Execute($insertMappedResourceRole);
                    
                    if(!$executeInsertMappedResourceRole){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        exit();

                    }
                    
                }

            }
            
            //Update the role as having been assigned resources so that it doesn't appear in the selection form.
            
            $zvs_role_column['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
            $zvs_role_column['schoolRoleCode'] = Zf_QueryGenerator::SQLValue($this->_validResult["schoolRoleId"]);
            
            $zvs_role_value['assignStatus'] = Zf_QueryGenerator::SQLValue(1);
            
            $updateMappedRole = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_roles', $zvs_role_value, $zvs_role_column);
            $executeUpdateMappedRole = $this->Zf_AdoDB->Execute($updateMappedRole);
            
            if(!$executeUpdateMappedRole){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
            
                //Redirect to the platform users overview
                Zf_SessionHandler::zf_setSessionVariable("resources_roles_mapper", "role_mapping_success");
                Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_resources', $identificationCode);
                exit();
            
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("resources_roles_mapper", "mapper_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'manage_resources', $identificationCode);
            exit();
            
        }
        
        
    }
    
    
    /**
     * This method checks and counts, then returns all stream details for all classess in the school.
     */
    private function zvs_fetchResourceDetails(){
        
        $fetchCategoryResources = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources');
        
        $zf_executeFetchCategoryResources = $this->Zf_AdoDB->Execute($fetchCategoryResources);

        if(!$zf_executeFetchCategoryResources){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchCategoryResources->RecordCount() > 0){

                while(!$zf_executeFetchCategoryResources->EOF){
                    
                    $results = $zf_executeFetchCategoryResources->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }

}
