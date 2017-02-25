<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school classes and a new  |
 * |  new streams into the classess.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class configureBudgetCategories_Model extends Zf_Model {
    
    private $zvs_controller;


    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();

        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the active controller
        $this->zvs_controller = $activeURL[0];
         
    }
    
    
    
    
    /**
     * This method is vital in loading splash screen for fee structure page
     */
    public function fetchBudgetCategorySplashScreen(){
        
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
    
    
    
    //This method is responsible for financial years select list.
    public function zvs_buildFinancialYearsSelectCode($identificationCode, $financialYearsDiv) {
        
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
            
            $financial_years_options .='<select class="select2me" style="width: 150px !important;"  id="'.$financialYearsDiv.'">';
            
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
     * This method returns all budget category details for a given school
     */
    public function zvs_budgetCategoryOverview(){
        
        $financialYearCode = $_POST['financialYearCode'];
         
        $systemSchoolCode = explode(ZVSS_CONNECT, $financialYearCode)[0];
         
        $zvs_budgetCategoryGridView = '';
         
        //Here we fetch and return all budget category details.
        $zvs_budgetCategoryDetails = $this->zvs_fetchBudgetCategoryDetails($systemSchoolCode, $financialYearCode);
         
         
        if($zvs_budgetCategoryDetails == 0){

            $zvs_budgetCategoryGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                       <div class="zvs-content-titles">
                                           <h3>Budget Categories Overview Warning!!</h3>
                                       </div>
                                       <div class="portlet-body">
                                           <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                               <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                               <span class="content-view-errors" >
                                                   &nbsp;There are no budget categories yet! You need to add atleast one budget category to have an overview.
                                               </span>
                                           </div>
                                       </div>
                                   </div>          
                               </div>';

        }else{

            foreach($zvs_budgetCategoryDetails as $budgetCategoryValues){

               $budgetCategoryName = $budgetCategoryValues['budgetCategoryName']; 
               $budgetCategoryCode =  $budgetCategoryValues['budgetCategoryCode'];


               //Here we fetch and return all budget sub-category details.
               $zvs_budegetSubCategoryDetails = $this->zvs_fetchBudgetSubCategoryDetails($budgetCategoryCode);

               //print_r($zvs_budegetSubCategoryDetails); exit();


               $zvs_budgetCategoryGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                      <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                           <div class="zvs-content-titles">
                                               <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                   <h3 style="padding-left: 10px !important;">'.$budgetCategoryName.'</h3>
                                               </div>
                                               <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                   <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_budget_category_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolClassCode).' " title="View '.$zvs_className.'" ><i class="fa fa-list"></i></a></h3>
                                               </div>
                                           </div>';

                                          if($zvs_budegetSubCategoryDetails == 0){

                                              $zvs_budgetCategoryGridView .='<div class="portlet-body">
                                                                       <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important; height: 380px !important;">
                                                                           <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                           <span class="content-view-errors" >
                                                                               &nbsp;There are no sub-categories in '.strtolower($budgetCategoryName).' yet! <br>You need to add atleast one sub category to have an overview.
                                                                           </span>
                                                                       </div>
                                                                   </div>';

                                          }else{


                                                   $zvs_budgetCategoryGridView .='<div class="portlet-body">
                                                                                <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                     <div class="table-responsive">
                                                                                         <table class="table table-striped table-hover">
                                                                                             <thead>
                                                                                                 <tr>
                                                                                                     <th style="width: 80%;">Budget Sub-Category Name</th style="width: 20%;"><th>Details</th>
                                                                                                 </tr>
                                                                                             </thead>
                                                                                             <tbody>';

                                                                                               foreach ($zvs_budegetSubCategoryDetails as $subCategoryValues) {

                                                                                                   $budgetSubCategoryName = $subCategoryValues['subCategoryName']; $bugdetSubCategoryCode = $subCategoryValues['bugdetSubCategoryCode'];

                                                                                                   $zvs_budgetCategoryGridView .='<tr><td>'.$budgetSubCategoryName.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_budget_sub_category_details'.DS.  Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$budgetSubCategoryCode).' " title="View '.$zvs_className.' '.$streamName.'" ><i class="fa fa-list"></i></a></td></tr>';

                                                                                               }

                                                                       $zvs_budgetCategoryGridView .='</tbody>
                                                                                         </table>
                                                                                     </div>
                                                                                </div>
                                                                           </div>';

                                          }

           $zvs_budgetCategoryGridView .='</div>          
                               </div>';

            }

        }

        echo $zvs_budgetCategoryGridView;
         
        
    }
    
    
    
    
    /**
     * This method returns check if classes exist so a to show the new stream form
     */
    public function confirmBudgetCategoryPresence($identificationCode){
        
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];

         //Here we fetch and return all budget category details.
         $zvs_budgetCategoryDetails = $this->zvs_fetchBudgetCategoryDetails($systemSchoolCode);
         
         return $zvs_budgetCategoryDetails;
        
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
     * This method checks fetches all budget sub-categories that are aligned to a given budget category.
     */
    private function zvs_fetchBudgetSubCategoryDetails($budgetCategoryCode){
        
        $zvs_sqlValue["budgetCategoryCode"] = Zf_QueryGenerator::SQLValue($budgetCategoryCode);
        
        $fetchSchoolBudgetSubCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_budget_sub_categories', $zvs_sqlValue);
        
        $zf_executeFetchSchoolBudgetSubCategories = $this->Zf_AdoDB->Execute($fetchSchoolBudgetSubCategories);

        if(!$zf_executeFetchSchoolBudgetSubCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolBudgetSubCategories->RecordCount() > 0){

                while(!$zf_executeFetchSchoolBudgetSubCategories->EOF){
                    
                    $results = $zf_executeFetchSchoolBudgetSubCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    
    
}

?>
