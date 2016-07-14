 <?php

class add_platform_resources_Model extends Zf_Model {

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
    public function zvss_buildPlatformResources($urlParameter) {
        
         
        $identicationCode = $urlParameter[0]; $systemSchoolCode = $urlParameter[1]; 
        $roleName = $urlParameter[2]; $schoolRoleCode = $systemSchoolCode.ZVSS_CONNECT.$roleName;

        //echo $identicationCode."<br>".$systemSchoolCode."<br>".$roleName."<br>".$schoolRoleCode;
        
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
                 
                 $categoryName = $categoryValues['categoryName']; $categoryCode = $categoryValues['categoryPrefix'];
                 
                 
                 
                 //Here we fetch and return all resources that belong to a given category.
                 $zvs_resourceDetails = $this->zvs_fetchResourceDetails($categoryName);
                 
                 echo "<pre>";
                 print_r($zvs_resourceDetails);
                 echo "</pre>";
                 
                 //Returns all already assigned resources
                 $assignedResources = $this->zvs_fetchAssignedResources($categoryCode, $schoolRoleCode);
                 
                 foreach ($assignedResources as $value) {
                     
                     echo $value['schoolResourceId']." Athias"; 
                     
                     $array_without_strawberries = array_diff($zvs_resourceDetails, array($value['schoolResourceId']));
                     
                        echo "<pre>";
                        print_r($zvs_resourceDetails);
                        echo "</pre>";
                 } 
                 
                
            $zvs_resourcesGridView .='<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">'.$categoryName.'</h3>
                                            </div>
                                        </div>';

                                       if($zvs_resourceDetails == 0){

                                           $zvs_resourcesGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 30% !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;There are no active resources in '.strtolower($categoryName).' module as of yet!!
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
                                                
                                                                                            foreach ($assignedResources as $assignedValues) {

                                                                                                $resourceCode = $assignedValues['schoolResourceId'];
                                                                                                
                                                                                                if (($key = array_search($resourceCode, $zvs_resourceDetails)) !== false) {
                                                                                                    
                                                                                                    unset($zvs_resourceDetails[$key]);
                                                                                                    
                                                                                                    print_r($zvs_resourceDetails);
                                                                                                    
//                                                                                                    foreach ($zvs_resourceDetails as $resourceValues) {
//
//                                                                                                        $resourceName = $resourceValues['resourceName']; $resourceID = $resourceValues['resourceId']; 
//                                                                                                        $resourceCategoryId =  explode(ZVSS_CONNECT, $resourceID)[0];
//
//                                                                                                        $cleanName = Zf_Core_Functions::Zf_CleanName($resourceName);
//
//                                                                                                        $zvs_resourcesGridView .='<tr><td><label class="checkbox-inline"><input type="checkbox" name="'.$cleanName.'"  value="'.$resourceID.'" id="'.$resourceID.'"><input type="hidden" name="'.$resourceCategoryId.'"  value="'.$resourceCategoryId.'" id="'.$resourceCategoryId.'">'.$resourceName.'</td></tr>';
//
//                                                                                                    }
                                                                                                    
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
    private function zvs_fetchResourceDetails($categoryName){
        
        $zvs_sqlValue["resourceCategory"] = Zf_QueryGenerator::SQLValue($categoryName);
        $zvs_sqlValue["resourceStatus"] = Zf_QueryGenerator::SQLValue(1);
        
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
    private function zvs_fetchAssignedResources($categoryCode, $schoolRoleCode){
        
        $zvs_sqlValue["schoolRoleId"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
        $zvs_sqlValue["resourceCategory"] = Zf_QueryGenerator::SQLValue($categoryCode);
        
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
