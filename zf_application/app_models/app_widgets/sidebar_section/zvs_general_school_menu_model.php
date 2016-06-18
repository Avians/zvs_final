 <?php

class zvs_general_school_menu_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building country codes.
    public function zvs_fetchUserResources($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        $userRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
        
        $zvs_sqlValues["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValues["schoolRoleId"] = Zf_QueryGenerator::SQLValue($systemSchoolCode.ZVSS_CONNECT.$userRole);
        
        $zvs_sqlColumns = array('schoolResourceId', 'resourceCategory'); //This specifies all columns that need to be fetched
        
        
        //We select all resources from the database where school and userRole matches as above.
        
        $fetchUserResources = Zf_QueryGenerator::BuildSQLSelect("zvs_resource_role_mapper", $zvs_sqlValues, $zvs_sqlColumns);
        
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
