 <?php

class next_of_kin_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building marital status codes.
    public function zvs_buildNextOfKinCode() {
        
        $zf_selectNextOfKin = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_next_of_kin');

        if(!$this->Zf_QueryGenerator->Query($zf_selectNextOfKin)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectNextOfKin}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->nextOfKinCode."' >".$fetchRow->nextOfKinName."</option>";

                }

            }
        }

    }
    
}
?>
