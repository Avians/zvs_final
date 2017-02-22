 <?php

class selectList_budget_categories_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building country codes.
    public function zvs_buildBudgetCategoriesSelectCode($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectClasses)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectClasses}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $class_options = '<option value="selectBudgetCategoy" selected="selected">Select a budget category</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $class_options .= '<option value="'.$fetchRow->budgetCategoryCode.'" >'.$fetchRow->budgetCategoryName.'</option>';

                }

            }
            
            echo $class_options;
        }

    }
    
}
?>
