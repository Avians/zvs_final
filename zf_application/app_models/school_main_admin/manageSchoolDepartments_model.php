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

class manageSchoolDepartments_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
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
     * This method returns all class details for a given school
     */
    public function fetchDepartmentsDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         $zvs_departmentGridView = '';
         
         //Here we fetch and return all department details.
         $zvs_departmentDetails = $this->zvs_fetchDepartmentDetails($systemSchoolCode);
         
         
         if($zvs_departmentDetails == 0){
             
             $zvs_departmentGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>Departments Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no registered school departments yet! You need to add atleast one department to have an overview.
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
             foreach($zvs_departmentDetails as $departmentValues){
                 
                 $zvs_departmentName = $departmentValues['schoolDepartmentName']; $schoolDepartmentCode =  $departmentValues['schoolDepartmentCode'];
                 
                 
                 //Here we fetch and return all stream details.
                 //$zvs_subDepartmentDetails = $this->zvs_fetchSubDepartmentDetails($schoolClassCode);
             
            $zvs_departmentGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                       <div class="zvs-content-titles">
                                           <h3 class="">'.$zvs_departmentName.' Department</h3>
                                       </div>
                                       <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">';
                                        
                    $zvs_departmentGridView .=' <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-10 margin-bottom-20">
                                                        <div class="zvs-circular" style="margin-top: -2px !important;">   
                                                           <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-top-10">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-condensed table-responsive table-hover">
                                                                <tbody>
                                                                    <tr><td><i class="fa fa-user zvs-user-profile"></i></td><td><?= $designation." ".$userName; ?></td></tr>
                                                                    <tr><td><i class="fa fa-phone zvs-user-profile"></i></td><td><?= $mobileNumber; ?></td></tr>
                                                                    <tr><td><i class="fa fa-envelope zvs-user-profile"></i></td><td><?= $address; ?></td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-10">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th  style="width: 35%;">Sub Dept. Name</th><th style="width: 35%;">Head of Sub Dept.</th><th style="width: 20%;">Mobile No.</th><th style="width: 10%;"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr><td>English</td><td>Mathew Juma</td><td>0727074108</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                    <tr><td>1</td><td>1</td><td>1</td><td><i class="fa fa-list"></i></td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
             }
             
         }
         
         echo $zvs_departmentGridView;
         
        
    }
    
    
    
    
    /**
     * This method returns check if classes exist so a to show the new stream form
     */
    public function confirmDepartmentPresence($identificationCode){
        
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];

         //Here we fetch and return all class details.
         $zvs_departmentDetails = $this->zvs_fetchDepartmentDetails($systemSchoolCode);
         
         return $zvs_departmentDetails;
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchDepartmentDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolDepartments = Zf_QueryGenerator::BuildSQLSelect('zvs_school_departments', $zvs_sqlValue);
        
        $zf_executeFetchSchoolDepartments = $this->Zf_AdoDB->Execute($fetchSchoolDepartments);

        if(!$zf_executeFetchSchoolDepartments){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolDepartments->RecordCount() > 0){

                while(!$zf_executeFetchSchoolDepartments->EOF){
                    
                    $results = $zf_executeFetchSchoolDepartments->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
