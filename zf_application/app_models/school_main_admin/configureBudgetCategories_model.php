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
     * This method returns all budget category details for a given school
     */
    public function fetchBudgetCategoryDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         $zvs_budgetCategoryGridView = '';
         
         //Here we fetch and return all budget category details.
         $zvs_budgetCategoryDetails = $this->zvs_fetchBudgetCategoryDetails($systemSchoolCode);
         
         
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
                 
                $budgetCategoryName = $budgetCategoryValues['budgetCategoryName']; $budgetCategoryCode =  $budgetCategoryValues['budgetCategoryCode'];



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
    private function zvs_fetchBudgetCategoryDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
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
    
    
    
    /**
     * THESE METHODS ARE EXTERNAL ACCESSORS TO THE EXTERNAL VIEWS OF CLASSESS AND STREAMS. THEY CAN ALSO BE USED BY OTHER METHODS
     * TO ACCESS THE SAME DETAILS
     */
    
    
    /**
     * This method checks and returns data for a specific target class. 
     */
    public function zvs_fetchClassOuterDetails($schoolClassCode){
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method checks and returns data for a specific target class. 
     */
    public function zvs_fetchStreamOuterDetails($classStreamCode){
        
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($classStreamCode);
        
        $fetchClassStream = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchClassStream = $this->Zf_AdoDB->Execute($fetchClassStream);

        if(!$zf_executeFetchClassStream){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassStream->RecordCount() > 0){

                while(!$zf_executeFetchClassStream->EOF){
                    
                    $results = $zf_executeFetchClassStream->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
