 <?php

class budget_category_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    //This method is responsoble for building country codes.
    public function zvs_buildBudgetCategorySelectCode($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectBudgetCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectBudgetCategories)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectBudgetCategories}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $budget_category_options = '<option value="selectBudgetCategory" selected="selected">Select a budget category</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $budget_category_options .= '<option value="'.$fetchRow->budgetCategoryCode.'" >'.$fetchRow->budgetCategoryName.'</option>';

                }

            }
            
            echo $budget_category_options;
        }

    }
    
}
?>
