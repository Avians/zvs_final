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
     * This method returns all departments details for a given school
     */
    public function fetchDepartmentsDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         $zvs_departmentGridView = '<style type="text/css">.zvs-user-profile{color: #d5d5d5 !important;}</style>';
         
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

                //Fetch and return all sub-departments
                $zvs_subDepartments = $this->zvs_fetchSubDepartmentDetails($schoolDepartmentCode);
                
                
                $zvs_departmentGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                    <div class="zvs-content-titles">
                                                        <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                            <h3 style="padding-left: 10px !important;">'.$zvs_departmentName.' Department</h3>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                            <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_department_details'.DS. Zf_SecureData::zf_encode_url($schoolDepartmentCode).' " title="View '.$zvs_departmentName.' Department" ><i class="fa fa-list"></i></a></h3>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">';
                
                        if($zvs_subDepartments == 0){

                            $zvs_departmentGridView .='<div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important;">
                                                            <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                            <span class="content-view-errors" >
                                                                &nbsp;There are no sub-departments in '.$zvs_departmentName.' Department yet! Add atleast one sub-department to have an overview.
                                                            </span>
                                                        </div>';

                        }else{

                            $zvs_departmentGridView .='<div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th  style="width: 50%;">Sub-Department Name</th><th style="width: 30%;">Status</th><th style="width: 20%;">Details</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>';

                                                                      foreach ($zvs_subDepartments as $subDepartmentsValues) {

                                                                          $subDepartmentName = $subDepartmentsValues['schoolSubDepartmentName'];$schoolSubDepartmentCode = $subDepartmentsValues['schoolSubDepartmentCode']; $subDepartmentStatus = $subDepartmentsValues['subDepartmentStatus'];
                                                                          if($subDepartmentStatus == "1"){ $status = "Active"; }else{ $status = "Inactive"; }
                                                                          $zvs_departmentGridView .='<tr><td>'.$subDepartmentName.'</td><td>'.$status.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_subDepartment_details'.DS. Zf_SecureData::zf_encode_url($schoolSubDepartmentCode).' " title="View '.$subDepartmentName.'" ><i class="fa fa-list"></i></a></td></tr>';

                                                                      }

                                         $zvs_departmentGridView .='</tbody>
                                                                </table>
                                                            </div>
                                                       </div>';

                        }
                                                    
                        $zvs_departmentGridView .='</div>
                                               </div>          
                                            </div>';   
             }
             
         }
         
         echo $zvs_departmentGridView;
         
        
    }
    
    
    
    
    /**
     * This method returns check if department exist so a to show the new stream form
     */
    public function confirmDepartmentPresence($identificationCode){
        
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];

         //Here we fetch and return all class details.
         $zvs_departmentDetails = $this->zvs_fetchDepartmentDetails($systemSchoolCode);
         
         return $zvs_departmentDetails;
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns department details for all classess in the school 
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
    
    
    
    /**
     * This private method checks, counts and fetches sub-department details if there is any, else returns 0.
     */
    private function zvs_fetchSubDepartmentDetails($schoolDepartmentCode){
        
        $zvs_sqlValue["schoolDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
        
        $fetchSchoolSubDepartments = Zf_QueryGenerator::BuildSQLSelect('zvs_school_sub_departments', $zvs_sqlValue);
        
        $zf_executeFetchSchoolSubDepartments = $this->Zf_AdoDB->Execute($fetchSchoolSubDepartments);

        if(!$zf_executeFetchSchoolSubDepartments){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolSubDepartments->RecordCount() > 0){

                while(!$zf_executeFetchSchoolSubDepartments->EOF){
                    
                    $results = $zf_executeFetchSchoolSubDepartments->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * THESE METHODS ARE EXTERNAL ACCESSORS TO THE EXTERNAL VIEWS OF DEPARTMENTS AND SUB_DEPARTMENTS. THEY CAN ALSO BE USED BY OTHER METHODS
     * TO ACCESS THE SAME DETAILS
     */
    
    
    /**
     * This method checks and returns data for a specific target department. 
     */
    public function zvs_fetchDepartmentOuterDetails($schoolDepartmentCode){
        
        $zvs_sqlValue["schoolDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
        
        $fetchSchoolDepartments = Zf_QueryGenerator::BuildSQLSelect('zvs_school_departments', $zvs_sqlValue);
        
        $zf_executeFetchSchoolDepartments= $this->Zf_AdoDB->Execute($fetchSchoolDepartments);

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
    
    
    
    
    /**
     * This method checks and returns data for a specific target sub department. 
     */
    public function zvs_fetchSubDepartmentOuterDetails($schoolSubDepartmentCode){
        
        $zvs_sqlValue["schoolSubDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolSubDepartmentCode);
        
        $fetchSchoolSubDepartment = Zf_QueryGenerator::BuildSQLSelect('zvs_school_sub_departments', $zvs_sqlValue);
        
        $zf_executeFetchSchoolSubDepartment = $this->Zf_AdoDB->Execute($fetchSchoolSubDepartment);

        if(!$zf_executeFetchSchoolSubDepartment){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolSubDepartment->RecordCount() > 0){

                while(!$zf_executeFetchSchoolSubDepartment->EOF){
                    
                    $results = $zf_executeFetchSchoolSubDepartment->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
