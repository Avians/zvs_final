<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new financial year in |
 * |  the school                                                       |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newFinancialYearRegistration_Model extends Zf_Model {
    

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
    * Register a new financial year into the school
    */
    public function registerNewFinancialYear(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('financialYearStartDate')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Start date')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Start date')
                
                                ->zf_postFormData('financialYearEndDate')
                                ->zf_validateFormData('zf_maximumLength', 20, 'End date')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'End date')

                                ->zf_postFormData('financialYearAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Financial year alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Financial year alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Financial year alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Financial Year Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        

        if(empty($this->_errorResult)){
            
            
            $startYear = intval(Zf_Core_Functions::Zf_FomartDate("Y", $this->_validResult['financialYearStartDate']));
            $endYear = intval(Zf_Core_Functions::Zf_FomartDate("Y", $this->_validResult['financialYearEndDate']));

            if($startYear == $endYear){

                $financialYearName = $startYear." - Financial Year";

            }else if($startYear != $endYear){

                $financialYearName = $startYear."/".$endYear." - Financial Year";

            }
            
           
            //We concatinate values in order to generate a unique financial year code.
            $financialYearCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($financialYearName);
            
            
            //Check if a class with a similar registration code exists within the same school.
            $financialYearValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $financialYearValues['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
            
            $financialYearColumns = array('systemSchoolCode', 'financialYearCode');
            
            $zvs_financialYearSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_financial_years', $financialYearValues, $financialYearColumns);
            
            $zvs_executeFinancialYearSqlQuery = $this->Zf_AdoDB->Execute($zvs_financialYearSqlQuery);
            
            if (!$zvs_executeFinancialYearSqlQuery) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            } else {
                
                //Check if record count is greater than zero.
                if($zvs_executeFinancialYearSqlQuery->RecordCount() > 0){
                    
                    //A class with similar class code has already been registered onto the platform for the same school.
                    Zf_SessionHandler::zf_setSessionVariable("financial_year_setup", "existent_financial_year_error");
                    
                    $zf_errorData = array("zf_fieldName" => "financialYearStartDate", "zf_errorMessage" => "* A financial year with a similar name already exists!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                    exit();
                    
                }else{
                    
                    //There is not a class with a similar class name within the same school, therefore store the class into the DB.
                    
                    //1. application user details
                    $zvs_financialYearDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                    $zvs_financialYearDetails['financialYearCode'] = Zf_QueryGenerator::SQLValue($financialYearCode);
                    $zvs_financialYearDetails['financialYearName'] = Zf_QueryGenerator::SQLValue($financialYearName);
                    $zvs_financialYearDetails['financialYearAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['financialYearAlias']);
                    $zvs_financialYearDetails['financialYearStartDate'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['financialYearStartDate']));
                    $zvs_financialYearDetails['financialYearEndDate'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['financialYearEndDate']));
                    $zvs_financialYearDetails['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvs_financialYearDetails['financialYearStatus'] = Zf_QueryGenerator::SQLValue(0);
                    
                    //Build the insert SQL queries
                    $insertSchoolFinancialYear = Zf_QueryGenerator::BuildSQLInsert('zvs_school_financial_years', $zvs_financialYearDetails);
                    $executeInsertSchoolFinancialYear = $this->Zf_AdoDB->Execute($insertSchoolFinancialYear);
                    
                    if(!$executeInsertSchoolFinancialYear){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Redirect to the platform users overview
                        Zf_SessionHandler::zf_setSessionVariable("financial_year_setup", "financial_year_setup_success");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_budget', $this->_validResult['adminIdentificationCode']);
                        exit();
                        
                    }
                    
                    
                }
                
            }
            
            exit();
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("financial_year_setup", "financial_year_form_error");
            
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
        $this->zf_formController->zf_postFormData('budgetCategoryCode')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('subCategoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub category name')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All School Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //We concatinate value in order to generate a unique school stream code.
            $budgetSubCategoryCode = $this->_validResult['budgetCategoryCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName(ucwords($this->_validResult['subCategoryName']));
           
            //Check if a similar budget sub-category item has already been registered for the same category
            $budgetValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
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
                    $zvs_budgetSubCategoryDetails['budgetCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['budgetCategoryCode']);
                    $zvs_budgetSubCategoryDetails['budgetSubCategoryCode'] = Zf_QueryGenerator::SQLValue($budgetSubCategoryCode);
                    $zvs_budgetSubCategoryDetails['subCategoryName'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['subCategoryName']));
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
    
    
}

?>
