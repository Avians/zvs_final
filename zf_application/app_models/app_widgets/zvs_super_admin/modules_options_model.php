 <?php

class modules_options_Model extends Zf_Model {

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING ALL PLATFORM
     * MODULES.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildModulesOptions() {
        
        $modules_results = $this->fetchModulesInformation();
        $modules_options = "";
        $modules_options .='<option value=""></option>';
        
        foreach ($modules_results as $value) {
            
            $categoryName = $value['categoryName']; $categoryPrefix = $value['categoryPrefix'];
            
            $modules_options .= '<option value="'.$categoryName.ZVSS_CONNECT.$categoryPrefix.'" style="width: 100% !important;">'.$categoryName.'</option>';
            
        }
        
        echo $modules_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AVAILABLE PLATFORM MODULES
     * -------------------------------------------------------------------------
     */
    private function fetchModulesInformation(){
        
        $fetchPlatformResources = Zf_QueryGenerator::BuildSQLSelect('zvs_resource_categories');
        
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
