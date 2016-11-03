<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school grades .           |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class manageSchoolGrades_Model extends Zf_Model {
    
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
     * This method returns all grades details for a given school
     */
    public function fetchGradeDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         $zvs_gradeGridView = '';
         
         //Here we fetch and return all grade details.
         $zvs_gradeDetails = $this->zvs_fetchGradeDetails($systemSchoolCode);
         
         
         if($zvs_gradeDetails == 0){
             
             $zvs_gradeGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>School Grades Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no school grades yet! You need to add atleast one grade to have a school grade overview.'.$systemSchoolCode.'
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
            



            $zvs_gradeGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="zvs-content-titles">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <h3 style="padding-left: 10px !important;">School Grades</h3>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="zvs-table-blocks scroller" data-always-visible="1" data-rail-visible="0">
                                                     <div class="table-responsive">
                                                         <table class="table table-striped table-hover">
                                                             <thead>
                                                                 <tr>
                                                                     <th  style="width: 15%;">Grade Name</th><th style="width: 15%;">Grade Alias</th><th style="width: 15%;">Grade Points</th><th style="width: 25%;">Grade Comments</th><th style="width: 15%; text-align: center !important;">Grade Status</th><th style="width: 15%; text-align: center !important;">Edit Grade</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>';

                                                               foreach($zvs_gradeDetails as $gradeValues){

                                                                    $schoolGradeCode =  $gradeValues['schoolGradeCode'];$gradeName = $gradeValues['gradeName'];
                                                                    $gradeAlias = $gradeValues['gradeAlias']; $gradePoints = $gradeValues['gradePoints']; 
                                                                    $gradeComments = $gradeValues['gradeComments'];
                                                                    $gradeStatus = ($gradeValues['gradeStatus'] == 1 ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
                                                                    
                                                                    $zvs_gradeGridView .='<tr><td>'.$gradeName.'</td><td style="text-align:left !important;">'.$gradeAlias.'</td><td style="text-align:left !important;">'.$gradePoints.'</td><td style="text-align:left !important;">'.$gradeComments.'</td><td style="text-align:center !important;">'.$gradeStatus.'</td><td style="text-align: center !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'edit_grade_details'.DS.  Zf_SecureData::zf_encode_url($schoolGradeCode).' " title="Edit '.$gradeAlias.'" ><i class="fa fa-edit"></i></a></td></tr>';

                                                               }

                                       $zvs_gradeGridView .='</tbody>
                                                         </table>
                                                     </div>
                                                </div>
                                           </div>
                                        </div>          
                                    </div>';
             
         }
         
         echo $zvs_gradeGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns grade details for all grades in the school 
     */
    private function zvs_fetchGradeDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolGrades = Zf_QueryGenerator::BuildSQLSelect('zvs_school_grades', $zvs_sqlValue);
        
        $zf_executeFetchSchoolGrades = $this->Zf_AdoDB->Execute($fetchSchoolGrades);

        if(!$zf_executeFetchSchoolGrades){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolGrades->RecordCount() > 0){

                while(!$zf_executeFetchSchoolGrades->EOF){
                    
                    $results = $zf_executeFetchSchoolGrades->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
