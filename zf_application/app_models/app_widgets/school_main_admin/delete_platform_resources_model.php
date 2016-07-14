 <?php

class delete_platform_resources_Model extends Zf_Model {

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
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING ALL SCHOOL
     * ROLES AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildAssignedResources($urlParameter) {
        
         
        $identicationCode = $urlParameter[0]; $systemSchoolCode = $urlParameter[1]; 
        $roleName = $urlParameter[2]; $schoolRoleCode = $systemSchoolCode.ZVSS_CONNECT.$roleName;

        //echo $identicationCode."<br>".$systemSchoolCode."<br>".$roleName."<br>".$schoolRoleCode;
        
        $zvs_resourcesGridView = '';
         
         //Here we fetch and return all class details.
        $zvs_assignedResources = $this->zvs_fetchAssignedResources($schoolRoleCode);
        
        $zvs_resourcesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                  <div class="zvs-content-titles">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                          <h3 style="padding-left: 10px !important;">'.$roleName.' Resources</h3>
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
                                                                                                            <th style="width: 50%;">Resource Name</th><th style="width: 50%;">Resource Module</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>';
                                                          
                                                                                                        foreach ($zvs_assignedResources as $resourceValues) {

                                                                                                            $resourceId = $resourceValues['schoolResourceId']; 
                                                                                                            
                                                                                                            $resourceDetails = $this->zvs_fetchResourceDetails($resourceId);
                                                                                                            
                                                                                                            
                                                                                                            foreach($resourceDetails as $resourceValues){
                                                                                                                
                                                                                                                $resourceName = $resourceValues['resourceName']; $resourceID = $resourceValues['resourceId']; 
                                                                                                                $resourceCategoryId =  explode(ZVSS_CONNECT, $resourceID)[0];

                                                                                                                $cleanName = Zf_Core_Functions::Zf_CleanName($resourceName);
                                                                                                                
                                                                                                                //$zvs_resourcesGridView .='<tr><td>'.$resourceValues['resourceName'].'</td></tr>';
                                                                                                                $zvs_resourcesGridView .='<tr><td><label class="checkbox-inline"><input type="checkbox" name="'.$cleanName.'"  value="'.$resourceID.'" id="'.$resourceID.'">'.$resourceValues['resourceName'].'</td><td>';
                                                                                                                
                                                                                                                $resourceCategory = $this->zvs_fetchCategoriesDetails($resourceCategoryId);
                                                                                                                
                                                                                                                foreach($resourceCategory as $categoryDetails){
                                                                                                                    
                                                                                                                    $categoryName = $categoryDetails['categoryName'];
                                                                                                                    
                                                                                                                }
                                                                                                                
                                                                                                                $zvs_resourcesGridView .= $categoryName.'</td></tr>';
                                                                                                            
                                                                                                                
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
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchCategoriesDetails($categoryId){
        
        $zvs_sqlValue["categoryPrefix"] = Zf_QueryGenerator::SQLValue($categoryId);
        
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
    private function zvs_fetchResourceDetails($resourceId){
         
        $zvs_sqlValue["resourceId"] = Zf_QueryGenerator::SQLValue($resourceId);

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
     * This method checks and counts, then returns all stream details for all classess in the school.
     */
    private function zvs_fetchAssignedResources($schoolRoleCode){
        
        $zvs_sqlValue["schoolRoleId"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
        
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
    
    
    
}
?>
