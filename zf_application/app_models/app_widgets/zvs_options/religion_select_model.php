 <?php

class religion_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building religion codes.
    public function zvs_buildReligionCode() {
        
        $zf_selectReligion = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_religions');

        if(!$this->Zf_QueryGenerator->Query($zf_selectReligion)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectReligion}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->religionCode."' >".$fetchRow->religionName."</option>";

                }

            }
        }

    }
    
}
?>
