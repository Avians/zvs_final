 <?php

class edit_module_form_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    

    //Returns the module editing form
    public function zf_getEditModuleForm($urlParameter) {
        
        $moduleParameter = explode(ZVSS_CONNECT, $urlParameter);
        
        $identificationCode = $moduleParameter[0]; $moduleName = $moduleParameter[1]; $modulePrefix = $moduleParameter[2];
        
        
        $moduleInformation = $this->getModuleInformation($urlParameter);
        
        
        foreach ($moduleInformation as $value) {
            
            $moduleStatus = $value['categoryStatus'];
            
            if($moduleStatus == 1){ $activeValue = "checked";  }else if($moduleStatus == 0){ $inactiveValue = "checked"; }
        }
        
        $form_view .='<div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="form-group">
                                <label class="control-label col-md-4">Module Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input type="radio" name="categoryStatus" value="1" '.$activeValue.' data-title="Active"> Active </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="categoryStatus" value="0" '.$inactiveValue.'  data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <!--/row-->
                    <input type="hidden" name="moduleName" value="'.$moduleName.'" />
                    <input type="hidden" name="modulePrefix" value="'.$modulePrefix.'" />
                    <input type="hidden" name="identificationCode" value="'.$identificationCode.'" />';
        
        
        return $form_view.ZVSS_CONNECT.$moduleStatus;
   

    }
    
    
    
    //This method returns all module data
    public function getModuleInformation($moduleDetails){
            
        $innerDetails = explode(ZVSS_CONNECT, $moduleDetails);

        $moduleName = $innerDetails[1]; $modulePrefix = $innerDetails[2];

        $zvs_sqlValue["categoryName"] = Zf_QueryGenerator::SQLValue($moduleName);
        $zvs_sqlValue["categoryPrefix"] = Zf_QueryGenerator::SQLValue($modulePrefix);

        $fetchPlatformCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories', $zvs_sqlValue);
        
        
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
    
    
    
}
?>
