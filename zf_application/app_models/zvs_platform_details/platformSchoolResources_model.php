<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible for pulling out data related.|
 * |  all available platform resources that can be utilised by all     |
 * |  platform schools.                                                |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class platformSchoolResources_Model extends Zf_Model {
    
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
     * This method returns all class details for a given school
     */
    public function fetchResourceModuleDetails($identificationCode){
         
         $zvs_resourcesGridView = '';
         
         //Here we fetch and return all class details.
         $zvs_categoriesDetails = $this->zvs_fetchCategoriesDetails();
         
         
         if($zvs_categoriesDetails == 0){
             
             $zvs_resourcesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>Resources Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no platform resources yet! Once resources are available, they will be populated in this section.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
             
         }else{
             
             foreach($zvs_categoriesDetails as $categoryValues){
                 
                 $categoryName = $categoryValues['categoryName'];
                 $categoryPrefix = $categoryValues['categoryPrefix'];
                 $categoryStatus = ($categoryValues['categoryStatus'] == 1 ? '<i class="fa fa-check-circle-o" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle-o" style="color:#a94442 !important;"></i>');
                 
                 
                 
                 //Here we fetch and return all resources that belong to a given category.
                 $zvs_resourceDetails = $this->zvs_fetchResourceDetails($categoryName);
             
            $zvs_resourcesGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                <h3 style="padding-left: 10px !important;">'.$categoryName.' '.$categoryStatus.'</h3>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_module_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$categoryName.ZVSS_CONNECT.$categoryPrefix).' " title="View '.$categoryName.'" ><i class="fa fa-list"></i></a></h3>
                                            </div>
                                        </div>';

                                       if($zvs_resourceDetails == 0){

                                           $zvs_resourcesGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;There are no resources in '.strtolower($categoryName).' yet! <br>Once resources are added to the module, they will be populated here-in.
                                                                        </span>
                                                                    </div>
                                                                </div>';

                                       }else{
                                           
                                           
                                                $zvs_resourcesGridView .='<div class="portlet-body">
                                                                             <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                  <div class="table-responsive">
                                                                                      <table class="table table-striped table-hover">
                                                                                          <thead>
                                                                                              <tr>
                                                                                                  <th  style="width: 55%;">Resource Name</th><th style="width: 30%; text-align: center !important;">Status</th><th style="width: 15%;">Details</th>
                                                                                              </tr>
                                                                                          </thead>
                                                                                          <tbody>';
                                                
                                                                                            foreach ($zvs_resourceDetails as $resourceValues) {

                                                                                                $resourceName = $resourceValues['resourceName']; $resourceStatus = ($resourceValues['resourceStatus'] == 1 ? '<i class="fa fa-check-circle-o" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle-o" style="color:#a94442 !important;"></i>');
                                                                                                $resourceID = $resourceValues['resourceId'];
                                                                                                
                                                                                                $zvs_resourcesGridView .='<tr><td>'.$resourceName.'</td><td style="text-align:center !important;">'.$resourceStatus.'</td><td style="text-align:center !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_resource_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$resourceID).' " title="View '.$resourceName.'" ><i class="fa fa-list"></i></a></td></tr>';
                                                                                                
                                                                                            }

                                                                    $zvs_resourcesGridView .='</tbody>
                                                                                      </table>
                                                                                  </div>
                                                                             </div>
                                                                        </div>';

                                       }
                                        
            $zvs_resourcesGridView .='</div>          
                                </div><div class="zvs-content-footer">
                                                                            <div class="row">';
                                                                    
                                                                   $zvs_resourcesGridView .= '<div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                                                                    Total '.$categoryName.' Resources:
                                                                                                </div>';  
                                                                                
                                                     $zvs_resourcesGridView .=' </div>
                                                                        </div>';
             
             }
             
         }
         
         echo $zvs_resourcesGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    public function zvs_fetchCategoriesDetails($moduleDetails = FALSE){
        
        if($moduleDetails == FALSE){
        
            $fetchPlatformCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories');
            
        }else {
            
            $innerDetails = explode(ZVSS_CONNECT, $moduleDetails);
    
            $moduleName = $innerDetails[1]; $modulePrefix = $innerDetails[2];
            
            $zvs_sqlValue["categoryName"] = Zf_QueryGenerator::SQLValue($moduleName);
            $zvs_sqlValue["categoryPrefix"] = Zf_QueryGenerator::SQLValue($modulePrefix);
        
            $fetchPlatformCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories', $zvs_sqlValue);
        
        }
        
        
        $zf_executeFetchPlatformCategories = $this->Zf_AdoDB->Execute($fetchPlatformCategories);

        if(!$zf_executeFetchPlatformCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchPlatformCategories->RecordCount() > 0){

                while(!$zf_executeFetchPlatformCategories->EOF){
                    
                    $results = $zf_executeFetchPlatformCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
   
    
    
    
    /**
     * This method checks and counts, then returns all stream details for all classess in the school.
     */
    public function zvs_fetchResourceDetails($categoryName = FALSE, $urlParameter = FALSE){
        
        if($urlParameter == FALSE){
            
            $zvs_sqlValue["resourceCategory"] = Zf_QueryGenerator::SQLValue($categoryName);
            
            $fetchCategoryResources = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources', $zvs_sqlValue);
            
        }else if ($categoryName == FALSE){
            
            $urlData = explode(ZVSS_CONNECT, $urlParameter);
            
            $resourceID = $urlData[1].ZVSS_CONNECT.$urlData[2];
            
            $zvs_sqlValue["resourceID"] = Zf_QueryGenerator::SQLValue($resourceID);
            
            $fetchCategoryResources = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources', $zvs_sqlValue);
            
        }
        
        
        
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
    
    
    
    
    /**
     * This method checks for all existing platform resources and lists them.
     */
    public function pullResourceModules(){
            
        //$systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        
        $confirmSchoolRoles = $this->confirmPlatformModules();
        
        if($confirmSchoolRoles == 0){
            
            echo '  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 3% !important;">
                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                            <div class="zvs-content-titles">
                                <h3>Roles Overview Warning!!</h3>
                            </div>
                            <div class="portlet-body">
                                <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 10% !important;">
                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 35px !important;"></i><br/>
                                    <span class="content-view-errors" >
                                        &nbsp;There are no open roles in this school at the moment! You need to have open role(s) to be able to assign platform resources.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>';
            
        }else{
            
            //LOAD EDIT SUBJECT SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "new_resource_form.php");
            
            
        }
        
    }
    
    
    
    
    /**
     * This private method is essential in confirming all available platform resources.
     */
    private function confirmPlatformModules(){
        
       
        $fetchPlatformModules = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories');
        
        $zf_executeFetchPlatformModules = $this->Zf_AdoDB->Execute($fetchPlatformModules);

        if(!$zf_executeFetchPlatformModules){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchPlatformModules->RecordCount() > 0){

                while(!$zf_executeFetchPlatformModules->EOF){
                    
                    $results = $zf_executeFetchPlatformModules->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
