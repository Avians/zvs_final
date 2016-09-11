 <?php

class guardians_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building language codes.
    public function zvs_buildGuardianCode() {
        
        $zf_selectGuardians = Zf_QueryGenerator::BuildSQLSelect('zvs_student_guardians');

        if(!$this->Zf_QueryGenerator->Query($zf_selectGuardians)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectGuardians}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->guardianCode."' >".$fetchRow->guardianName."</option>";

                }

            }
        }

    }
    
}
?>
