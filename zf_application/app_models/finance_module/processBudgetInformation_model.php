<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered student.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class processBudgetInformation_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
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
     * This method is used to select Admin localities
     */
    public function getBudgetSubCategoryDetails(){
        
        $budgetCategoryCode = $_POST['budgetCategoryCode'];
        
        
        //Here we have all related budget sub-category data
        $budgetSubCategoryDetails = $this->zvs_fetchBudgetSubCategoryDetails($budgetCategoryCode);
        
        $select_options = '';
        
        
        if($budgetSubCategoryDetails == 0){
            
            $budgetSubCategoryDetails .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            foreach ($budgetSubCategoryDetails as $subCategoryValue) {
                
                $subCategoryName = $subCategoryValue['subCategoryName']; $budgetSubCategoryCode = $subCategoryValue['budgetSubCategoryCode'];
                
                $select_options .= '<option value="'.$budgetSubCategoryCode.'">'.$subCategoryName .'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    //This private method fetches streams detials for a given selected class.
    private function zvs_fetchBudgetSubCategoryDetails($budgetCategoryCode){
        
        $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
        
        $fetchBudgetSubCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_sub_categories', $zvs_sqlValue);
        
        $zf_executeFetchBudgetSubCategories = $this->Zf_AdoDB->Execute($fetchBudgetSubCategories);

        if(!$zf_executeFetchBudgetSubCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchBudgetSubCategories->RecordCount() > 0){

                while(!$zf_executeFetchBudgetSubCategories->EOF){
                    
                    $results = $zf_executeFetchBudgetSubCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
