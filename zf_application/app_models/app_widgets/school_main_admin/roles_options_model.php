 <?php

class roles_options_Model extends Zf_Model {

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
    public function zvss_buildRolesOptions($schoolSystemCode) {
        
        $roles_results = $this->fetchRolesInformation($schoolSystemCode);
        $roles_options = "";
        $roles_options .='<option value=""></option>';
        
        foreach ($roles_results as $value) {
            
            $schoolRoleCode = $value['schoolRoleCode']; $schoolRoleName = $value['schoolRoleName'];
            
            $roles_options .= '<option value="'.$schoolRoleCode.'" style="width: 100% !important;">'.$schoolRoleName.'</option>';
            
        }
        
        echo $roles_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * SUBJECT INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchRolesInformation($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["assignStatus"] = Zf_QueryGenerator::SQLValue(0);
        $zvs_sqlValue["roleStatus"] = Zf_QueryGenerator::SQLValue(1);
        
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
    
}
?>
