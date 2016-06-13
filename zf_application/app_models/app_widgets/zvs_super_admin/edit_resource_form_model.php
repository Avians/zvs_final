 <?php

class edit_resource_form_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    
    
    //Returns the module editing form
    public function zf_getEditResourceForm($urlParameter) {
        
        $resourceParameter = explode(ZVSS_CONNECT, $urlParameter);
        
        $identificationCode = $resourceParameter[0]; $modulePrefix = $resourceParameter[1]; $resourceName = $resourceParameter[2];
        
        $resourceIDs = $modulePrefix.ZVSS_CONNECT.$resourceName;
        
        
        $resourceInformation = $this->getResourceInformation($resourceIDs);
        
        
        foreach ($resourceInformation as $value) {
            
            $resourceStatus = $value['resourceStatus'];
            
            if($resourceStatus == 1){ $activeValue = "checked";  }else if($resourceStatus == 0){ $inactiveValue = "checked"; }
        }
        
        $form_view .='<div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="form-group">
                                <label class="control-label col-md-5">Resource Status:</label>
                                <div class="col-md-7">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input type="radio" name="resourceStatus" value="1" '.$activeValue.' data-title="Active"> Active </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="resourceStatus" value="0" '.$inactiveValue.'  data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <!--/row-->
                    <input type="hidden" name="modulePrefix" value="'.$modulePrefix.'" />
                    <input type="hidden" name="resourceName" value="'.$resourceName.'" />
                    <input type="hidden" name="identificationCode" value="'.$identificationCode.'" />';
        
        
        return $form_view.ZVSS_CONNECT.$resourceStatus;
   

    }
    
    
    
    //This method returns all module data
    public function getResourceInformation($resourceId){
            
        $zvs_sqlValue["resourceId"] = Zf_QueryGenerator::SQLValue($resourceId);

        $fetchPlatformResources = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_resources', $zvs_sqlValue);
        
        
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
    
    
}
?>
