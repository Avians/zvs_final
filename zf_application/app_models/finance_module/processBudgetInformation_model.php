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
    public function getBudgetCategoryDetails(){
        
        $financialYearCode = $_POST['financialYearCode'];
         
        $systemSchoolCode = explode(ZVSS_CONNECT, $financialYearCode)[0];
        
        //Here we fetch and return all budget category details.
        $zvs_budgetCategoryDetails = $this->zvs_fetchBudgetCategoryDetails($systemSchoolCode, $financialYearCode);
     
        $select_options = '';
        
        
        if($zvs_budgetCategoryDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="selectBudgetCategory" selected>Select Budget Category</option>';
            
            foreach ($zvs_budgetCategoryDetails as $budgetCategoryValue) {
                
                $budgetCategoryName = $budgetCategoryValue['budgetCategoryName']; $budgetCategoryCode = $budgetCategoryValue['budgetCategoryCode'];
                
                $select_options .= '<option value="'.$budgetCategoryCode.'">'.$budgetCategoryName .'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchBudgetCategoryDetails($systemSchoolCode, $financialYearCode = NULL){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if(!empty($financialYearCode) && $financialYearCode != NULL){
            
            $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
            
        }
        
        $fetchSchoolBudgetCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $zvs_sqlValue);
        
        $zf_executeFetchSchoolBudgetCategories = $this->Zf_AdoDB->Execute($fetchSchoolBudgetCategories);

        if(!$zf_executeFetchSchoolBudgetCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolBudgetCategories->RecordCount() > 0){

                while(!$zf_executeFetchSchoolBudgetCategories->EOF){
                    
                    $results = $zf_executeFetchSchoolBudgetCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function getBudgetSubCategoryDetails(){
        
        $budgetCategoryCode = $_POST['budgetCategoryCode'];
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $budgetCategoryCode)[0];
        
        //Here we have all related budget sub-category data
        $budgetSubCategoryDetails = $this->zvs_fetchBudgetSubCategoryDetails($systemSchoolCode, $budgetCategoryCode);
        
        $select_options = '';
        
        
        if($budgetSubCategoryDetails == 0){
            
            $budgetSubCategoryDetails .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="selectBudgetCategory" selected>Select Sub Category</option>';
            
            foreach ($budgetSubCategoryDetails as $subCategoryValue) {
                
                $subCategoryName = $subCategoryValue['subCategoryName']; $budgetSubCategoryCode = $subCategoryValue['budgetSubCategoryCode'];
                
                $select_options .= '<option value="'.$budgetSubCategoryCode.'">'.$subCategoryName .'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    //This private method fetches streams detials for a given selected class.
    private function zvs_fetchBudgetSubCategoryDetails($systemSchoolCode, $budgetCategoryCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
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
    
    
    
    //This public method is essential is creating a new budget
    public function createNewBudget(){
    //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('financialYearCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Financial year')
                                
                                ->zf_postFormData('budgetCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('budgetSubCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub Category')

                                ->zf_postFormData('budgetedAmount')
                                ->zf_validateFormData('zf_maximumLength', 8, 'Budgeted Amount')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Budgeted Amount')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Budgeted Amount')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        echo "<pre>Budget Categories Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
       
        if(empty($this->_errorResult)){
            
            $financialYearCode = $this->_validResult['financialYearCode'];
            $budgetCategoryCode = $this->_validResult['budgetCategoryCode'];
            $budgetSubCategoryCode = $this->_validResult['budgetSubCategoryCode'];
            $budgetedAmount = $this->_validResult['budgetedAmount'];
            
            
            //1. Check if budget amount has been created for this item
            
            
            //1.1 If yes, then throw an error showing an amount has already been allocated
            
            //1.2 If No, Add the budgeted amount into the database.
            
            
            
            
            
        }else{
            
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("create_budget_setup", "budget_category_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            Zf_GenerateLinks::zf_header_location('finance_module', 'create_budget', $this->_validResult['adminIdentificationCode']);
            
            exit();
             
        }
        
        
    }
    
}

?>
