 <?php

class edit_role_form_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    
    
    //Returns the role editing form
    public function zf_getEditRoleForm($urlParameter) {
        
        $identicationCode = $urlParameter[0]; $systemSchoolCode = $urlParameter[1]; 
        $roleName = $urlParameter[2]; $schoolRoleCode = $systemSchoolCode.ZVSS_CONNECT.$roleName;
        
        
        $roleInformation = $this->getRoleInformation($schoolRoleCode);
        
        
        foreach ($roleInformation as $value) {
            
            $roleStatus = $value['roleStatus']; $assignStatus = $value['assignStatus'];
            
            if($roleStatus == 1){ $activeRoleValue = "checked";  }else if($roleStatus == 0){ $inactiveRoleValue = "checked"; }
        }
        
        $form_view .='<div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="form-group">
                                <label class="control-label col-md-4">Role Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input type="radio" name="roleStatus" value="1" '.$activeRoleValue.' data-title="Active"> Active </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="roleStatus" value="0" '.$inactiveRoleValue.'  data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                         
                    <!--/row-->
                    <input type="hidden" name="schoolRoleCode" value="'.$schoolRoleCode.'" />
                    <input type="hidden" name="systemSchoolCode" value="'.$systemSchoolCode.'" />
                    <input type="hidden" name="identificationCode" value="'.$identicationCode.'" />';
        
        
        return $form_view;
   

    }
    
    
    
    //This method returns all role data
    public function getRoleInformation($schoolRoleCode){
            
        $zvs_sqlValue["schoolRoleCode"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);

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
