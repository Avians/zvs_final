 <?php

class designations_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsible for building designation codes.
    public function zvs_buildDesignationCode() {
        
        $zf_selectDesignations = Zf_QueryGenerator::BuildSQLSelect('zvs_platform_designations');

        if(!$this->Zf_QueryGenerator->Query($zf_selectDesignations)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectDesignations}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->designationCode."' >".$fetchRow->designationName.".</option>";

                }

            }
        }

    }
    
}
?>
