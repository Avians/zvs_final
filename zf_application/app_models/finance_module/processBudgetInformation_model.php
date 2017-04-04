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
    
    
    
    //This method is responsible for financial years select list.
    public function zvs_buildFinancialYearsSelectCode($identificationCode, $generalOverviewFinancialYearCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectFinancialYears = Zf_QueryGenerator::BuildSQLSelect('zvs_school_financial_years', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectFinancialYears)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectFinancialYears}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            $financial_years_options = "";
            
            $financial_years_options .='<select class="select2me '.$generalOverviewFinancialYearCode.'" style="width: 150px !important;"  id="'.$generalOverviewFinancialYearCode.'">';
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $financial_years_options .= '<option value="selectFinancialYear" selected="selected">Financial years</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $financial_years_options .= '<option value="'.$fetchRow->financialYearCode.'" >'.$fetchRow->financialYearName.'</option>';

                }

            }
            
            $financial_years_options .="</select>";
            
            echo $financial_years_options;
        }

    }
    
    
    
    
    /**
     * This method is vital in loading splash screen for fee structure page
     */
    public function fetchBudgetOverviewSplashScreen(){
        
        $pageInformation = "";
        
        $pageInformation .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet box zvs-content-blocks" style="min-height: 200px !important;">
                                    <div class="zvs-content-warnings" style="text-align: center !important; padding-top: 90px !important; padding-bottom: 90px !important;">
                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br/>
                                        <span class="content-view-errors" >
                                            <b>&nbsp;You will need to select a specific financial year so as to have a view of its budget setup.</b>
                                        </span>
                                    </div>
                                </div>
                            </div>';
        
        echo $pageInformation;
        
    }
    
    
    
    
    /**
     * This public method is responsible for fetching general budget overview for a school
     */
    public function getSchoolBudgetOverview(){
        
        $financialYearCode = $_POST['financialYearCode'];
         
        $systemSchoolCode = explode(ZVSS_CONNECT, $financialYearCode)[0];
        
        $zvs_schoolBudgetDetails = $this->fetchBudgetDetails($systemSchoolCode, $financialYearCode);
        
        $financialYearName = $this->fetchFinancialYear($systemSchoolCode, $financialYearCode);
        
        $zvs_budgetOverviewGrid = "";
        
        //This is the total amount budgeted for already.
        $schoolTotalBudget = 0;
        
        if($zvs_schoolBudgetDetails  == 0){

            $zvs_budgetOverviewGrid .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                       <div class="zvs-content-titles">
                                           <h3> '.$financialYearName.' Budget Overview Warning!!</h3>
                                       </div>
                                       <div class="portlet-body">
                                           <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                               <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                               <span class="content-view-errors" >
                                                   &nbsp;There are no running budgets slated for the <b>'.$financialYearName.'</b>. You need to create atleast one running budget item!!
                                               </span>
                                           </div>
                                       </div>
                                   </div>          
                               </div>';

        }else{
            
            $zvs_budgetOverviewGrid .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="">
                                                <div class="zvs-content-titles">
                                                    <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                        <h3 style="padding-left: 10px !important;">'.$financialYearName.' Budget Overview</h3>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="scroller" data-always-visible="1" data-rail-visible="1">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 30%;">School Budget Category</th><th style="width: 30%;">Actual Budget Item</th><th style="width: 30%;">Budgeted Amount</th><th style="width: 10%;">Edit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
            
                                    foreach ($zvs_schoolBudgetDetails as $schoolBudgetValues) {
                                        
                                        $systemSchoolCode = $schoolBudgetValues['systemSchoolCode'];
                                        $financialYearCode = $schoolBudgetValues['financialYearCode'];
                                        
                                        //Fetch budget category name
                                        $budgetCategoryCode = $schoolBudgetValues['budgetCategoryCode'];
                                        $budgetCategoryName = $this->fetchBudgetCategoryName($systemSchoolCode, $financialYearCode, $budgetCategoryCode);
                                        
                                        //Fetch budget sub-category name
                                        $budgetSubCategoryCode = $schoolBudgetValues['budgetSubCategoryCode'];
                                        $budgetSubCategoryName = $this->fetchBudgetSubCategoryName($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode);
                                        
                                        $budgetedAmount = $schoolBudgetValues['budgetedAmount'];
                                        
                                        $schoolTotalBudget = $schoolTotalBudget + $budgetedAmount;
                                            
                                        $zvs_budgetOverviewGrid .=' <tr>
                                                                        <td>'.$budgetCategoryName.'</td>
                                                                        <td>'.$budgetSubCategoryName.'</td>
                                                                        <td style="text-align: right; padding-right: 17%;"><b>'.number_format($budgetedAmount, 2).'</b></td>
                                                                        <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                                                    </tr>';
                                        
                                    }       
                                    
                                    $zvs_budgetOverviewGrid .=' </tbody>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 30%;">Total Budget:</th><th style="width: 30%;"></th><th style="width: 30%; text-align: right; padding-right: 17%;"><b>'.number_format($schoolTotalBudget, 2).'</b></th><th style="width: 10%;"></th>
                                                                    </tr>
                                                                </thead>
                                                                
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
            
        }
        
        echo $zvs_budgetOverviewGrid;
        
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
    
    
    
    
    /**
     * This private method fetches streams detials for a given selected class.
     */
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
    
    
   
    
    /**
     * This public method is essential is creating a new budget
     */
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
        //echo "<pre>Budget Creation Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
       
        if(empty($this->_errorResult)){
            
            //All submitted data
            $financialYearCode = $this->_validResult['financialYearCode'];
            $budgetCategoryCode = $this->_validResult['budgetCategoryCode'];
            $budgetSubCategoryCode = $this->_validResult['budgetSubCategoryCode'];
            $budgetedAmount = (float)str_replace(',', '', $this->_validResult['budgetedAmount']);
            
            //Prepare SQL queries to check if a class with a similar registration code exists within the same school.
            $newBudgetedValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $newBudgetedValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearCode']);
            $newBudgetedValues['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['budgetCategoryCode']);
            $newBudgetedValues['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['budgetSubCategoryCode']);
            
            $newBudgetedColumns = array('systemSchoolCode', 'financialYearCode', 'budgetCategoryCode', 'budgetSubCategoryCode');
            
            $zvs_runningBudgetSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_running_budget', $newBudgetedValues, $newBudgetedColumns);
            
            $zvs_executeRunningBudgetSqlQuery = $this->Zf_AdoDB->Execute($zvs_runningBudgetSqlQuery);
            
            if (!$zvs_executeRunningBudgetSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeRunningBudgetSqlQuery->RecordCount() > 0){
                    
                    //A class with similar class code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("new_budget_setup", "existent_budget_error");
                    
                    $zf_errorData = array("zf_fieldName" => "budgetSubCategoryCode", "zf_errorMessage" => "* A budget has already been created for this item!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("finance_module", 'create_budget', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_newBudgetDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_newBudgetDetails['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
                    $zvs_newBudgetDetails['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
                    $zvs_newBudgetDetails['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
                    $zvs_newBudgetDetails['budgetedAmount'] = Zf_QueryGenerator::SQLValue($budgetedAmount);
                    $zvs_newBudgetDetails['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                    $zvs_newBudgetDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_newBudgetDetails['budgetStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertNewBudgetedDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_school_running_budget', $zvs_newBudgetDetails);
                    
                    $executeInsertNewBudgetedDetails = $this->Zf_AdoDB->Execute($insertNewBudgetedDetails);
                    
                    if(!$executeInsertNewBudgetedDetails){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("new_budget_setup", "new_budget_setup_success");
                        Zf_GenerateLinks::zf_header_location('finance_module', 'create_budget', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                }
                
                
            }
            
            
        }else{
            
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("new_budget_setup", "new_budget_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            Zf_GenerateLinks::zf_header_location('finance_module', 'create_budget', $this->_validResult['adminIdentificationCode']);
            
            exit();
             
        }
        
        
    }
    
    
    
    
    /**
     * This public method is essential is allocating finance to budget items
     */
    public function allocateFinance(){
    //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('financialYearCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Financial year')
                                
                                ->zf_postFormData('budgetCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('budgetSubCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub Category')

                                ->zf_postFormData('allocatedAmount')
                                ->zf_validateFormData('zf_maximumLength', 8, 'Allocated Amount')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Allocated Amount')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Allocated Amount')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Budget Creation Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
       
        if(empty($this->_errorResult)){
            
            //All submitted data
            $financialYearCode = $this->_validResult['financialYearCode'];
            $budgetCategoryCode = $this->_validResult['budgetCategoryCode'];
            $budgetSubCategoryCode = $this->_validResult['budgetSubCategoryCode'];
            $allocatedAmount = (float)str_replace(',', '', $this->_validResult['allocatedAmount']);
            
            //Prepare SQL queries to check if a financial year has already been registered.
            $financialYearValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $financialYearValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
            
            $financialYearColumns = array('systemSchoolCode','financialYearCode');
            
            $zvs_financialYearSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_running_budget', $financialYearValues, $financialYearColumns);
            
            $zvs_executeFinancialYearSqlQuery = $this->Zf_AdoDB->Execute($zvs_financialYearSqlQuery);
            
            if (!$zvs_executeFinancialYearSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //If there is an existing financial year, check for the budget category
                if($zvs_executeFinancialYearSqlQuery->RecordCount() > 0){
                    
                    //Prepare SQL queries to check if a budget category has already been registered.
                    $budgetCategoryValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $budgetCategoryValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
                    $budgetCategoryValues['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);

                    $budgetCategoryColumns = array('systemSchoolCode','financialYearCode', 'budgetCategoryCode');

                    $zvs_budgetCategorySqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_running_budget', $budgetCategoryValues, $budgetCategoryColumns);
                    
                    $zvs_executeBudgetCategorySqlQuery = $this->Zf_AdoDB->Execute($zvs_budgetCategorySqlQuery);
            
                    if (!$zvs_executeBudgetCategorySqlQuery) {

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    } else {
                        
                        //If there is an existing budget category, check for the budget sub category
                        if($zvs_executeBudgetCategorySqlQuery->RecordCount() > 0){
                            
                            //Prepare SQL queries to check if a budget sub-category has already been registered.
                            $budgetSubCategoryValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $budgetSubCategoryValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
                            $budgetSubCategoryValues['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
                            $budgetSubCategoryValues['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);

                            $budgetSubCategoryColumns = array('systemSchoolCode','financialYearCode', 'budgetCategoryCode', 'budgetSubCategoryCode');

                            $zvs_budgetSubCategorySqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_running_budget', $budgetSubCategoryValues, $budgetSubCategoryColumns);

                            $zvs_executeBudgetSubCategorySqlQuery = $this->Zf_AdoDB->Execute($zvs_budgetSubCategorySqlQuery);
                            
                            if(!$zvs_executeBudgetSubCategorySqlQuery){
                                
                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                                
                            }else{
                                
                                //If there is an existing budget sub category, we are ready to process allocation insertion
                                if($zvs_executeBudgetSubCategorySqlQuery->RecordCount() > 0){ 
                                    
                                    //1. Find the amount budgeted for the budget item: W
                                    $zvs_budgetRunningAmount = $this->fetchBudgetDetails($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode);
                                    
                                    foreach ($zvs_budgetRunningAmount as $runningBudgetValues) {
                                        
                                        $totalBudgetedAmount = $runningBudgetValues['budgetedAmount'];
                                        
                                    }
                                    
                                    //2. Find the amount already allocated for the budget item: X
                                    $totalAllocatedAmount = $this->zvs_budgetAllocatedAmount($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode);
                                    
                                    
                                    //3. Find the balance remaining to be allocated for this budget item: Y = W - X
                                    $totalAllocationPending = $totalBudgetedAmount - $totalAllocatedAmount;
                                    
                                    
                                    if($totalAllocationPending == 0){
                                        
                                        //This budget item has fully been allocated funds
                                        Zf_SessionHandler::zf_setSessionVariable("budget_allocation_setup", "full_allocation_error");

                                        $zf_errorData = array("zf_fieldName" => "budgetSubCategoryCode", "zf_errorMessage" => "* No budget item has fully been allocated funds!!");
                                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                        Zf_GenerateLinks::zf_header_location("finance_module", 'allocate_finances', $this->_validResult['adminIdentificationCode']);
                                        exit();
                                        
                                        
                                    }else{
                                        
                                        //4. Prepare SQL values for insertion
                                        $zvs_newAllocationDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $zvs_newAllocationDetails['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
                                        $zvs_newAllocationDetails['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
                                        $zvs_newAllocationDetails['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);

                                        //5. Allocation amount comparison logic:
                                        //5.1 If the total allocated amount Z is less than current pending amount Y, then just insert Z
                                        // Z < Y =====> Insert Z
                                        if($allocatedAmount < $totalAllocationPending){
                                            
                                           $zvs_newAllocationDetails['allocatedAmount'] = Zf_QueryGenerator::SQLValue($allocatedAmount); 

                                        }
                                        //5.2 If the current allocated amount Z is greater than the balance Y and also the balance Y is no equal to 0, then insert the balance Y
                                        // Z > Y && Y != 0 =====> Insert Y
                                        else if(($allocatedAmount > $totalAllocationPending) && ($totalAllocationPending != 0)){
                                            
                                            $zvs_newAllocationDetails['allocatedAmount'] = Zf_QueryGenerator::SQLValue($totalAllocationPending);

                                        }
                                        //IF the current allocated amount Z is equal to the current pending amount Y, then just insert the current allocated amount Z
                                        // Z == Y, =====> Insert Z
                                        else if(($allocatedAmount == $totalAllocationPending)){
                                            
                                            $zvs_newAllocationDetails['allocatedAmount'] = Zf_QueryGenerator::SQLValue($allocatedAmount);

                                        }

                                        $zvs_newAllocationDetails['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                        $zvs_newAllocationDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                                        $zvs_newAllocationDetails['allocationStatus'] = Zf_QueryGenerator::SQLValue(0);
                                        
                                        //Build the insert SQL queries
                                        $insertNewAllocationDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_school_finance_allocation', $zvs_newAllocationDetails);
                                        
                                        $executeInsertNewAllocationDetails = $this->Zf_AdoDB->Execute($insertNewAllocationDetails);

                                        if(!$executeInsertNewAllocationDetails){

                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                        }else{

                                            //Redirect to the platform users overview
                                            Zf_SessionHandler::zf_setSessionVariable("budget_allocation_setup", "new_budget_allocation_success");
                                            Zf_GenerateLinks::zf_header_location('finance_module', 'allocate_finances', $this->_validResult['adminIdentificationCode']);
                                            exit();

                                        }
                                
                                    }
                                    
                                    
                                }else{
                                    
                                    //This budget sub-category has not yet been registered
                                    Zf_SessionHandler::zf_setSessionVariable("budget_allocation_setup", "no_budget_sub_category_error");

                                    $zf_errorData = array("zf_fieldName" => "budgetSubCategoryCode", "zf_errorMessage" => "* No running budget for the selected budget sub-category");
                                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                    Zf_GenerateLinks::zf_header_location("finance_module", 'allocate_finances', $this->_validResult['adminIdentificationCode']);
                                    exit();
                                    
                                }
                                 
                            }
                            
                        }else{
                            
                            //This budget category has not yet been registered
                            Zf_SessionHandler::zf_setSessionVariable("budget_allocation_setup", "no_budget_category_error");

                            $zf_errorData = array("zf_fieldName" => "budgetCategoryCode", "zf_errorMessage" => "* No running budget for the selected budget category");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location("finance_module", 'allocate_finances', $this->_validResult['adminIdentificationCode']);
                            exit();
                           
                        }
                    }
                    
                    
                }else{
                    
                   //A class with similar class code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("budget_allocation_setup", "no_financial_year_error");
                    
                    $zf_errorData = array("zf_fieldName" => "financialYearCode", "zf_errorMessage" => "* No running budget for the selected financial year!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("finance_module", 'allocate_finances', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }
                
                
            }
            
            
        }else{
            
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("new_budget_setup", "new_budget_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            Zf_GenerateLinks::zf_header_location('finance_module', 'create_budget', $this->_validResult['adminIdentificationCode']);
            
            exit();
             
        }
        
        
    }
    
    
    
    
    /**
     * This private method fetches all the schools budget details for the selected financial year
     */
    private function fetchBudgetDetails($systemSchoolCode, $financialYearCode, $budgetCategoryCode = NULL, $budgetSubCategoryCode = NULL){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        
        if(!empty($budgetCategoryCode) && !empty($budgetSubCategoryCode) && $budgetCategoryCode != "" && $budgetSubCategoryCode != "" && $budgetCategoryCode != NULL && $budgetSubCategoryCode != NULL){
           
            $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
            $zvs_sqlValue["budgetSubCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
            
        }
        
        $fetchSchoolBudgetDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_running_budget', $zvs_sqlValue);
        
        $zf_executeFetchSchoolBudgetDetails = $this->Zf_AdoDB->Execute($fetchSchoolBudgetDetails);

        if(!$zf_executeFetchSchoolBudgetDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolBudgetDetails->RecordCount() > 0){

                while(!$zf_executeFetchSchoolBudgetDetails->EOF){
                    
                    $results = $zf_executeFetchSchoolBudgetDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This private methods returns the total amount that has already been allocated to the budget item
     */
    private function zvs_budgetAllocatedAmount($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode){
        
        //Returns an array of actual budget allocations
        $actualBudgetAllocations = $this->fetchActualBudgetAllocations($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode);
        
        $totalAllocatedAmount = 0;
        
        foreach($actualBudgetAllocations as $allocationValues){
            
            $allocatedAmount = $allocationValues['allocatedAmount'];
            
            $totalAllocatedAmount = $totalAllocatedAmount + $allocatedAmount;
            
        }
        
        return $totalAllocatedAmount;
        
    }
    
    
    
    /**
     * This private method fetches all the budget allocations
     */
    private function fetchActualBudgetAllocations($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode){
         
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
        $zvs_sqlValue["budgetSubCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
        
        $fetchFinanceAllocationDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_finance_allocation', $zvs_sqlValue);
        
        $zf_executeFetchFinanceAllocationDetails = $this->Zf_AdoDB->Execute($fetchFinanceAllocationDetails);

        if(!$zf_executeFetchFinanceAllocationDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchFinanceAllocationDetails->RecordCount() > 0){

                while(!$zf_executeFetchFinanceAllocationDetails->EOF){
                    
                    $results = $zf_executeFetchFinanceAllocationDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
         
     }

     
     
         
    /**
     * This private method fetches budget category name
     */
    private function fetchFinancialYear($systemSchoolCode, $financialYearCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        
        $zf_selectFinancialYear = Zf_QueryGenerator::BuildSQLSelect('zvs_school_financial_years', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectFinancialYear)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectFinancialYear}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            $financialYear = "";
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $financialYear .= $fetchRow->financialYearName;

                }

            }
            
            return $financialYear;
        }
        
    }
    
    
    
    
    /**
     * This private method fetches budget category name
     */
    private function fetchBudgetCategoryName($systemSchoolCode, $financialYearCode, $budgetCategoryCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
        
        $zf_selectBudgetCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectBudgetCategories)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectBudgetCategories}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            $budget_categories = "";
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $budget_categories .= $fetchRow->budgetCategoryName;

                }

            }
            
            return $budget_categories;
        }
        
    }
    
    
    
    
    /**
     * This private method fetches budget category name
     */
    private function fetchBudgetSubCategoryName($systemSchoolCode, $financialYearCode, $budgetCategoryCode, $budgetSubCategoryCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
        $zvs_sqlValue["budgetSubCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
        
        $zf_selectBudgetSubCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_sub_categories', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectBudgetSubCategories)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectBudgetSubCategories}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            $budget_sub_categories = "";
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $budget_sub_categories .= $fetchRow->subCategoryName;

                }

            }
            
            return $budget_sub_categories;
        }
        
    }
    
    
}

?>
