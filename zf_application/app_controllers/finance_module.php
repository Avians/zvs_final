<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE FINANCE MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO FINANCE MODULE MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  14th/August/2013  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class finance_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "finance_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    
    
    
    //This action executes the landing page for this module
    public function actionFinance_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('finance_module_introduction', $zf_actionData);
        
    }
    

    
    //Executes the create fees view. Also is the defaukt action for this controller
    public function actionCreate_fees(){
        
        Zf_View::zf_displayView('create_fees');
        
    }
    
    
    
    
    //This controller executes collect fees view
    public function actionCollect_fees($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('collect_fees',$zf_actionData);
        
    }
    
    
    
    
    //This controller executes the finance status view
    public function actionFinance_status($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('finance_status', $zf_actionData);
        
    }
    
    
    
    
    //This controller executes the create budget view
    public function actionCreate_budget($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('create_budget', $zf_actionData);
        
    }
    
    
    
    
    //This controller executes the allocate finances view
    public function actionAllocate_finances($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('allocate_finances', $zf_actionData);
        
    }
    
    
    
    
    //This controller executes the fee structure view
    public function actionFee_structure($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('fee_structure', $zf_actionData);
        
    }
   
    
    
    
    //This controller executes the fee defaulters view
    public function actionFee_defaulters(){
        
        Zf_View::zf_displayView('fee_defaulters');
        
    }

    
    
    
    //This controller executes the fee refunds view
    public function actionFee_refunds(){
        
        Zf_View::zf_displayView('fee_refunds');
        
    }
    
    
    
    
    //This method process dynamic fee charts
    public function actionProcessFeeStructure($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_data($zvs_parameter);
        
        if($filteredData == "classFeeStructure"){
            
            //This method generates a class fee structure
            $this->zf_targetModel->generateClassFeeStructure();
            
        }else if($filteredData == "classFeeSummary"){
            
            //This method generates a class fee summary
            $this->zf_targetModel->generateClassFeeSummary();
            
        }else if($filteredData == "feeClassTitle"){
            
            //This method generates class title
            $this->zf_targetModel->generateClassTitle();
            
        }
        
    }
    
    
   
    
    //This method processes fees information for fee collection purpose
    public function actionProcessFeeInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
         
        if($filterDataVariable == 'process_streams'){

            //Gets the streams related a selected class
            $this->zf_targetModel->getStreamDetails();
            
        }else if($filterDataVariable == 'process_students_list'){

            //Gets the students related a selected stream
            $this->zf_targetModel->getStudentsList();
            
        }else if($filterDataVariable == 'process_fee_history'){

            //Get fee history for the selected student and the selected year
            $this->zf_targetModel->getFeesHistory();
            
        }else if($filterDataVariable == 'collect_school_fees'){
            
            //Generates a prefilled form for the selected student
            $this->zf_targetModel->generateStudentForm();
            
        }else if($filterDataVariable == 'process_payment_period'){
            
            //Get the periods related to the selected year for the school
            $this->zf_targetModel->getPeriodDetails();
            
        }else if($filterDataUrl == 'collect_fees'){
            
            //Posts the collected fees data for storage
            $this->zf_targetModel->collectSchoolFees();
            
        }
        
    }
    
    
    
    
    //This method processes Finance Status of the school
    public function actionProcessFinanceStatus($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'feesFinancialStatus'){

            //Gets the financial data for the selected year
            $this->zf_targetModel->processFinancialData();
            
        }else if($filterDataVariable == 'budgetFinancialYearName'){
            
            //Gets the financial year name for the selected financial year
            $this->zf_targetModel->zvs_getBudgetFinancialYear();
            
        }else if($filterDataVariable == 'budgetFinancialStatus'){
            
            //Gets the financial status for the selected financial year
            $this->zf_targetModel->zvs_getBugdetFinancialStatus();
            
        }
        
    }
    
    
    
    
    //This method process all budget information for budget creation purpose
    public function actionProcessBudgetInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == "process_budget_categories"){
            
            //Get the budget categories related to the selected financial year
            $this->zf_targetModel->getBudgetCategoryDetails();
            
        }else if($filterDataVariable == "process_budget_sub_categories"){
            
            //Get the budget sub categories related to a selected category
            $this->zf_targetModel->getBudgetSubCategoryDetails();
            
        }else if($filterDataVariable == "process_budget_overview"){
            
            //Get the budget sub categories related to a selected category
            $this->zf_targetModel->getSchoolBudgetOverview();
            
        }else if($filterDataUrl == "create_new_budget"){
            
            //Here we register a new budgeted item amount
            $this->zf_targetModel->createNewBudget();
            
        }else if($filterDataUrl == "allocate_finance"){
            
            //Here we register an amount allocated to a budget item
            $this->zf_targetModel->allocateFinance();
            
        }
        
        
        
    }
    
}
?>
