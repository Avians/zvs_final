 <?php

class zvs_landing_page_shortcuts_Model extends Zf_Model {
    
    
    //This is the class constructor
    public function __construct() {
        
        
        parent::__construct();
        
        
    }
    
    
    
    
    /**
     * This method is responsoble for fetching all resources that are allowed for
     * a given user role within a school.
     */
    public function zvs_fetchUserActiveResources($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
        
        $zvs_sqlValues["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValues["schoolRoleId"] = Zf_QueryGenerator::SQLValue($systemSchoolCode.ZVSS_CONNECT.$userRole);
        $zvs_sqlValues["categoryStatus"] = Zf_QueryGenerator::SQLValue(1);
        $zvs_sqlValues["resourceStatus"] = Zf_QueryGenerator::SQLValue(1);
        
        $zvs_sqlColumns = array('schoolResourceId', 'resourceCategory'); //This specifies all columns that need to be fetched
        
        
        //We select all resources from the database where school and userRole matches as above.
        
        $fetchUserResources = Zf_QueryGenerator::BuildSQLSelect("zvs_resource_role_mapper_view", $zvs_sqlValues, $zvs_sqlColumns);
        
        $zvs_executeFetchUserResources = $this->Zf_AdoDB->Execute($fetchUserResources);

        if(!$zvs_executeFetchUserResources){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchUserResources->RecordCount() > 0){

                while(!$zvs_executeFetchUserResources->EOF){
                    
                    $results = $zvs_executeFetchUserResources->GetRows();
                    
                }
                
                return $results;
                
            }else{
                
                return 0;
                
            }
            
        }

    }
    
}
?>
