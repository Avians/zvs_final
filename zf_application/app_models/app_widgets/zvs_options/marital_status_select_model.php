 <?php

class marital_status_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building marital status codes.
    public function zvs_buildMaritalStatusCode() {
        
        $zf_selectMaritalStatus = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_marital_status');

        if(!$this->Zf_QueryGenerator->Query($zf_selectMaritalStatus)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectMaritalStatus}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->maritalStatusCode."' >".$fetchRow->maritalStatusName."</option>";

                }

            }
        }

    }
    
}
?>
