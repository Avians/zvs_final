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
    public function fetchResourceDetails(){
         
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
                                                            &nbsp;There are no active platform modules/resources yet! Once activated, they will be populated in this section.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
             
         }else{
             
             foreach($zvs_categoriesDetails as $categoryValues){
                 
                 $categoryName = $categoryValues['categoryName']; 
                 
                 
                 
                 //Here we fetch and return all resources that belong to a given category.
                 $zvs_resourceDetails = $this->zvs_fetchResourceDetails($categoryName);
             
            $zvs_resourcesGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                <h3 style="padding-left: 10px !important;">'.$categoryName.'</h3>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_class_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolClassCode).' " title="View '.$zvs_className.'" ><i class="fa fa-list"></i></a></h3>
                                            </div>
                                        </div>';

                                       if($zvs_resourceDetails == 0){

                                           $zvs_resourcesGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;There are no resources registered for '.strtolower($categoryName).' module! Once resources are added to the module, they will be populated in this section.
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
                                                                                                  <th  style="width: 40%;">Resource Name</th><th style="width: 20%; text-align: center !important;">Date</th><th style="width: 15%; text-align: center !important;">Status</th>
                                                                                              </tr>
                                                                                          </thead>
                                                                                          <tbody>';
                                                
                                                                                            foreach ($zvs_resourceDetails as $resourceValues) {

                                                                                                $resourceName = $resourceValues['resourceName']; $dateCreated = $resourceValues['dateCreated']; $resourceStatus = ($resourceValues['resourceStatus'] == 1 ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
                                                                                                
                                                                                                $zvs_resourcesGridView .='<tr><td>'.$resourceName.'</td><td style="text-align:center !important;">'.$dateCreated.'</td><td style="text-align:center !important;">'.$resourceStatus.'</td></tr>';
                                                                                                
                                                                                            }

                                                                    $zvs_resourcesGridView .='</tbody>
                                                                                      </table>
                                                                                  </div>
                                                                             </div>
                                                                        </div>
                                                                        <div class="zvs-content-footer">
                                                                            <div class="row">';
                                                                    
                                                                                $zvs_resourcesGridView .= "More data coming soon!!";  
                                                                                
                                                     $zvs_resourcesGridView .=' </div>
                                                                        </div>';

                                       }
                                        
            $zvs_resourcesGridView .='</div>          
                                </div>';
             
             }
             
         }
         
         echo $zvs_resourcesGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchCategoriesDetails(){
        
        $zvs_sqlValue["categoryStatus"] = Zf_QueryGenerator::SQLValue(1);
        
        $fetchPlatformResources = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories', $zvs_sqlValue);
        
        $zf_executeFetchPlatformResources = $this->Zf_AdoDB->Execute($fetchPlatformResources);

        if(!$zf_executeFetchPlatformResources){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchPlatformResources->RecordCount() > 0){

                while(!$zf_executeFetchPlatformResources->EOF){
                    
                    $results = $zf_executeFetchPlatformResources->GetRows();
                    
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
    private function zvs_fetchResourceDetails($categoryName, $purpose = FALSE){
        
        if($purpose == FALSE){
            
            $zvs_sqlValue["resourceCategory"] = Zf_QueryGenerator::SQLValue($categoryName);
            
        }else if($purpose == "assign"){
            
            $zvs_sqlValue["resourceId"] = Zf_QueryGenerator::SQLValue($categoryName);
            
        }
        
        
        
        $fetchCategoryResources = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources', $zvs_sqlValue);
        
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
     * This method checks for the school to which a given school admin belongs and 
     * the retrieves a list of all roles available within the school.
     */
    public function pullSchoolRoles($identificationCode){
            
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $purpose = "assign";
        
        $confirmSchoolRoles = $this->confirmSchoolRoles($systemSchoolCode , $purpose);
        
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
            Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "assign_resources_form.php", $systemSchoolCode);
            
            
        }
        
    }
    
    
    
    
    /**
     * This private method is essential in confirming school roles that can be pulled back.
     */
    private function confirmSchoolRoles($systemSchoolCode, $purpose){
        
        if($purpose == "assign"){
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["assignStatus"] = Zf_QueryGenerator::SQLValue(0);
            $zvs_sqlValue["roleStatus"] = Zf_QueryGenerator::SQLValue(1);
            
        }else if($purpose == "overview"){
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["roleStatus"] = Zf_QueryGenerator::SQLValue(1);
            
        }
        
        $fetchSchoolRoles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_roles', $zvs_sqlValue);
        
        $zf_executeFetchSchoolRoles = $this->Zf_AdoDB->Execute($fetchSchoolRoles);

        if(!$zf_executeFetchSchoolRoles){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolRoles->RecordCount() > 0){

                while(!$zf_executeFetchSchoolRoles->EOF){
                    
                    $results = $zf_executeFetchSchoolRoles->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This private method is essential in confirming school roles that can be pulled back.
     */
    private function fetchAssignedResources($roleCode){
           
        $zvs_sqlValue["schoolRoleId"] = Zf_QueryGenerator::SQLValue($roleCode);
        
        $fetchAssignedResources = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_role_mapper', $zvs_sqlValue);
        
        $zf_executeFetchAssignedResources = $this->Zf_AdoDB->Execute($fetchAssignedResources);

        if(!$zf_executeFetchAssignedResources){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAssignedResources->RecordCount() > 0){

                while(!$zf_executeFetchAssignedResources->EOF){
                    
                    $results = $zf_executeFetchAssignedResources->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method is essential in fetching all roles in a given school. This is inclusive of 
     * roles to which resources have been assigned and also to those that resources haven't been
     * assigned yet.
     */
    public function fetchRolesDetails($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $purpose = "overview";
         
        $zvs_resourcesGridView = '';

        //This method returns an array that contains all available school roles.
        $confirmSchoolRoles = $this->confirmSchoolRoles($systemSchoolCode, $purpose);


        if($confirmSchoolRoles == 0){

            $zvs_resourcesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 3% !important;">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="zvs-content-titles">
                                                <h3>Roles Overview Warning!!</h3>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 10% !important;">
                                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 35px !important;"></i><br/>
                                                    <span class="content-view-errors" >
                                                        &nbsp;There are no active roles in the school as of yet. You need to have atleast one role to have a resource assignment overview!!
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

        }else{

            foreach($confirmSchoolRoles as $roleValues){

                $roleName = $roleValues['schoolRoleName']; $roleCode = $roleValues['schoolRoleCode'];
                
                //Here we fetch and return all resources that have been assigned to a given school role.
                $zvs_assignedResources = $this->fetchAssignedResources($roleCode);

                $zvs_resourcesGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                             <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                  <div class="zvs-content-titles">
                                                      <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                          <h3 style="padding-left: 10px !important;">'.$roleName.'</h3>
                                                      </div>
                                                      <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                          <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_role_resources'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$roleCode).' " title="View '.$roleName.'" ><i class="fa fa-list"></i></a></h3>
                                                      </div>
                                                  </div>';

                                                 if($zvs_assignedResources == 0){
                                                     
                                                        $zvs_resourcesGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;Resources are not yet assigned to '.strtolower($roleName).'. Once resources are assigned to this role, you should be able to view them here!!.
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
                                                                                                            <th  style="width: 100%;">Resource Name</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>';
                                                          
                                                                                                        foreach ($zvs_assignedResources as $resourceValues) {

                                                                                                            $resourceId = $resourceValues['schoolResourceId']; 
                                                                                                            
                                                                                                            $resourceDetails = $this->zvs_fetchResourceDetails($resourceId, $purpose="assign");
                                                                                                            
                                                                                                            foreach($resourceDetails as $resourceValues){
                                                                                                                
                                                                                                                $zvs_resourcesGridView .='<tr><td>'.$resourceValues['resourceName'].'</td></tr>';
                                                                                                            
                                                                                                                
                                                                                                            }
                                                                                                            

                                                                                                        }

                                                                                $zvs_resourcesGridView .='</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                       </div>
                                                                                    </div>';

                                                 }

                      $zvs_resourcesGridView .='</div>          
                                          </div>';

            }

        }
         
         echo $zvs_resourcesGridView;
         
        
    }
    
    
    
    /**
     * This method fetches resources assigned to specific roles in the the selected school.
     */
    public function fetchRoleResources($schoolRoleCode, $roleName){
        
        //Here we fetch and return all resources that have been assigned to a given school role.
        $zvs_assignedResources = $this->fetchAssignedResources($schoolRoleCode);
        
        $zvs_resourcesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="portlet box zvs-content-blocks" style="min-height: 427px !important;">
                                                  <div class="zvs-content-titles">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                          <h3 style="padding-left: 10px !important;">Resources Assigned to '.$roleName.'</h3>
                                                      </div>
                                                  </div>';

                                                 if($zvs_assignedResources == 0){
                                                     
                                                        $zvs_resourcesGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 20% !important; min-height:340px !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;Resources are not yet assigned to '.strtolower($roleName).'. Once resources are assigned to this role, you should be able to view them here!!.
                                                                        </span>
                                                                    </div>
                                                                </div>';

                                                 }else{


                                                          $zvs_resourcesGridView .='<div class="portlet-body">
                                                                                       <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0"  style="min-height:340px !important;">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-striped table-hover">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th  style="width: 100%;">Resource Name</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>';
                                                          
                                                                                                        foreach ($zvs_assignedResources as $resourceValues) {

                                                                                                            $resourceId = $resourceValues['schoolResourceId']; 
                                                                                                            
                                                                                                            $resourceDetails = $this->zvs_fetchResourceDetails($resourceId, $purpose="assign");
                                                                                                            
                                                                                                            foreach($resourceDetails as $resourceValues){
                                                                                                                
                                                                                                                $zvs_resourcesGridView .='<tr><td>'.$resourceValues['resourceName'].'</td></tr>';
                                                                                                            
                                                                                                                
                                                                                                            }
                                                                                                            

                                                                                                        }

                                                                                $zvs_resourcesGridView .='</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                       </div>
                                                                                    </div>';

                                                 }

                      $zvs_resourcesGridView .='</div>          
                                          </div>';

            
         
         echo $zvs_resourcesGridView;
        
    }
    
    
    
    /**
     * This method is essential in adding resources to an existing school role
     */
    public function addRoleResources($urlParameter){
        
        //1. First we return all available platform resources
        Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "add_resources_form.php", $urlParameter);
        
        
        //2. We check will check resources that are already assigned to this school role and remove them from that list.
        
    }
    

    
    
    /**
     * This method is essential in adding resources to an existing school role
     */
    public function deleteRoleResources($urlParameter){
        
        //1. First we return all available platform resources
        Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "delete_resources_form.php", $urlParameter);
        
        
        //2. We check will check resources that are already assigned to this school role and remove them from that list.
        
    }
}

?>
