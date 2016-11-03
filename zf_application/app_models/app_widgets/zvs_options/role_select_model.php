 <?php

class role_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building country codes.
    public function zvs_buildRoleSelectCode($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["roleStatus"] = Zf_QueryGenerator::SQLValue(1);
        
        $zf_selectRoles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_roles', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectRoles)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectRoles}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->schoolRoleCode."' >".$fetchRow->schoolRoleName."</option>";

                }

            }
        }

    }
    
}
?>
