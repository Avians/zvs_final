<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newBudgetCategoriesRegistration_Model extends Zf_Model {
    

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
    * Register a budget category within the school
    */
    public function registerNewBudgetCategory(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('financialYearCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Financial year')
                                
                                ->zf_postFormData('categoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('categoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Budget Categories Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
       
        
        if(empty($this->_errorResult)){
            
           
            //We concatinate value in order to generate a unique budget category code.
            $budgetCategoryCode = $this->_validResult['financialYearCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['categoryName']);
            
            //Check if a class with a similar registration code exists within the same school.
            $budgetCategoryValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $budgetCategoryValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearCode']);
            $budgetCategoryValues['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
            
            $budgetCategoryColumns = array('systemSchoolCode', 'financialYearCode', 'budgetCategoryCode');
            
            $zvs_budgetCategorySqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $budgetCategoryValues, $budgetCategoryColumns);
            
            $zvs_executeBudgetCategorySqlQuery = $this->Zf_AdoDB->Execute($zvs_budgetCategorySqlQuery);
            
            if (!$zvs_executeBudgetCategorySqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeBudgetCategorySqlQuery->RecordCount() > 0){
                    
                    //A class with similar class code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "existent_budget_category_error");
                    
                    $zf_errorData = array("zf_fieldName" => "categoryName", "zf_errorMessage" => "* A budget category with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_budgetCategoryDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_budgetCategoryDetails['financialYearCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearCode']);
                    $zvs_budgetCategoryDetails['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
                    $zvs_budgetCategoryDetails['budgetCategoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['categoryName']);
                    $zvs_budgetCategoryDetails['budgetCategoryAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['categoryAlias']);
                    $zvs_budgetCategoryDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_budgetCategoryDetails['budgetCategoryStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolBudgetCategory = Zf_QueryGenerator::BuildSQLInsert('zvs_school_budget_categories', $zvs_budgetCategoryDetails);
                    $executeInsertSchoolBudgetCategory = $this->Zf_AdoDB->Execute($insertSchoolBudgetCategory);
                    
                    if(!$executeInsertSchoolBudgetCategory){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "budget_category_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "budget_category_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    /**
     * Register a new stream within a class which exists within a valid school.
     */
    public function registerNewBudgetSubCategory(){
       
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('financialYearCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Financial year')
                
                                ->zf_postFormData('budgetCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('subCategoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub category name')
                
                                ->zf_postFormData('subCategoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All School Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //We concatinate value in order to generate a unique school stream code.
            $budgetSubCategoryCode = $this->_validResult['budgetCategoryCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['subCategoryName']);
            
            
            //Check if a similar budget sub-category item has already been registered for the same category
            $budgetValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $budgetValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearCode']);
            $budgetValues['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['budgetCategoryCode']);
            $budgetValues['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
            
            $budgetSubCategoryColumns = array('systemSchoolCode', 'budgetCategoryCode', 'budgetSubCategoryCode');
            
            $zvs_budgetSubCategorySqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_sub_categories', $budgetValues, $budgetSubCategoryColumns);
            
            $zvs_executeBudgetSubCategorySqlQuery = $this->Zf_AdoDB->Execute($zvs_budgetSubCategorySqlQuery);
            
            if (!$zvs_executeBudgetSubCategorySqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeBudgetSubCategorySqlQuery->RecordCount() > 0){
                    
                    //A stream with similar stream code has already been registered onto the platform for the same class and school.
                    Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "existent_sub_category_error");
                    
                    $zf_errorData = array("zf_fieldName" => "subCategoryName", "zf_errorMessage" => "* A sub category with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_budgetSubCategoryDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_budgetSubCategoryDetails['financialYearCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearCode']);
                    $zvs_budgetSubCategoryDetails['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['budgetCategoryCode']);
                    $zvs_budgetSubCategoryDetails['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
                    $zvs_budgetSubCategoryDetails['subCategoryName'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['subCategoryName']));
                    $zvs_budgetSubCategoryDetails['subCategoryAlias'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['subCategoryAlias']));
                    $zvs_budgetSubCategoryDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_budgetSubCategoryDetails['subCategoryStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertBudgetSubCategory = Zf_QueryGenerator::BuildSQLInsert('zvs_school_budget_sub_categories', $zvs_budgetSubCategoryDetails);
                    $executeInsertBudgetSubCategory= $this->Zf_AdoDB->Execute($insertBudgetSubCategory);
                    
                    if(!$executeInsertBudgetSubCategory){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "sub_category_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("budget_category_setup", "sub_category_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
       
       
   }
    
   
   
   
    /**
     * This method is used to select Admin localities
     */
    public function getBudgetCategoryDetails(){
        
        $financialYearCode = $_POST['financialYearCode'];
        
        
        //Here we have all related budget category data
        $budgetCategoryDetails = $this->zvs_fetchBudgetCategoryDetails($financialYearCode);
        
        $select_options = '';
        
        
        if($budgetCategoryDetails == 0){
            
            $budgetCategoryDetails .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="selectBugdetCategory" selected >Select Budget Category</option>';
            
            foreach ($budgetCategoryDetails as $categoryValue) {
                
                $budgetCategoryName = $categoryValue['budgetCategoryName']; $budgetCategoryCode = $categoryValue['budgetCategoryCode'];
                
                $select_options .= '<option value="'.$budgetCategoryCode.'">'.$budgetCategoryName .'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    //This private method fetches all budget categories for the selected financial year
    private function zvs_fetchBudgetCategoryDetails($financialYearCode){
        
        $zvs_sqlValue["financialYearCode"] = Zf_QueryGenerator::SQLValue($financialYearCode);
        
        $fetchBudgetCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_categories', $zvs_sqlValue);
        
        $zf_executeFetchBudgetCategories = $this->Zf_AdoDB->Execute($fetchBudgetCategories);

        if(!$zf_executeFetchBudgetCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchBudgetCategories->RecordCount() > 0){

                while(!$zf_executeFetchBudgetCategories->EOF){
                    
                    $results = $zf_executeFetchBudgetCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
