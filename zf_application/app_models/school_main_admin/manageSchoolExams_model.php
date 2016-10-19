<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible for handling all logic that  |
 * |  is related to management of school examinations.                 |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class manageSchoolExams_Model extends Zf_Model {
    
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
    public function fetchExamDetails($identificationCode){
        
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         $zvs_examGridView = '';
         
         //Here we fetch and return all class details.
         $zvs_subjectsDetails = $this->zvs_fetchSubjectDetails($systemSchoolCode);
         
         
         if($zvs_subjectsDetails == 0){
             
             $zvs_examGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>Exam Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no subjects yet! You need to add atleast one subject and exams to it, so as to have a exam overview.
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
             foreach($zvs_subjectsDetails as $subjectValues){
                 
                 $zvs_subjectName = $subjectValues['subjectName']; $schoolSubjectCode =  $subjectValues['systemSubjectCode'];
                 
                 //We fetch exam details related to each subject.
                 $zvs_examDetails = $this->zvs_fetchExamDetails($schoolSubjectCode);
                 
                 
                 $zvs_examGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">'.$zvs_subjectName.'</h3>
                                            </div>
                                        </div>';
                 
                                    if($zvs_examDetails == 0){

                                        $zvs_examGridView .='<div class="portlet-body">
                                                                 <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important; height: 380px !important;">
                                                                     <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                     <span class="content-view-errors" >
                                                                         &nbsp;There are no exams for '.strtolower($zvs_subjectName).' as a subject yet! <br>You need to add atleast one exam to have an overview.
                                                                     </span>
                                                                 </div>
                                                             </div>';

                                    }else{
                                        
                                        $zvs_examGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                         <div class="table-responsive">
                                                                             <table class="table table-striped table-hover">
                                                                                 <thead>
                                                                                     <tr>
                                                                                         <th style="width: 50%;">Exam Name</th><th style="width: 25%; text-align:left!important;">% Proportion</th><th style="width: 15%;">Status</th><th></th>
                                                                                     </tr>
                                                                                 </thead>
                                                                                 <tbody>';

                                                                                   foreach ($zvs_examDetails as $examValues) {
                                                                                       
                                                                                       $systemExamCode = $examValues['systemExamCode'];
                                                                                       $examName = $examValues['examName']; $examAlias = $examValues['examAlias']; $percentageProportion = $examValues['percentageProportion']; 
                                                                                       $examStatus = ($examValues['examStatus'] == 1 ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');

                                                                                       $zvs_examGridView .='<tr><td style="text-align:left!important;">'.$examName.'</td><td style="text-align:left!important; padding-left: 20px !important;">'.$percentageProportion.'%</td><td style="text-align:center !important;">'.$examStatus.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'edit_exam_details'.DS.  Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$systemExamCode).' " title="Edit '.$zvs_subjectName.' - '.$examName.'" ><i class="fa fa-edit"></i></a></td></tr>';

                                                                                   }

                                                           $zvs_examGridView .='</tbody>
                                                                             </table>
                                                                         </div>
                                                                    </div>
                                                               </div>';
                                        
                                        
                                    }
                                            
                 
                $zvs_examGridView .='</div>          
                               </div>';
                 
             }
             
         }
         
         echo $zvs_examGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns subject details for all subjects in the school 
     */
    private function zvs_fetchSubjectDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolSubjects = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subjects', $zvs_sqlValue);
        
        $zf_executeFetchSchoolSubjects = $this->Zf_AdoDB->Execute($fetchSchoolSubjects);

        if(!$zf_executeFetchSchoolSubjects){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolSubjects->RecordCount() > 0){

                while(!$zf_executeFetchSchoolSubjects->EOF){
                    
                    $results = $zf_executeFetchSchoolSubjects->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    /**
     * This private method checks, counts and returns school exam details, if any is found.
     */
    private function zvs_fetchExamDetails($schoolSubjectCode){
        
        $zvs_sqlValue["schoolSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
        
        $fetchSubjectExams = Zf_QueryGenerator::BuildSQLSelect('zvs_school_examinations', $zvs_sqlValue);
        
        $zf_executeFetchSubjectExams = $this->Zf_AdoDB->Execute($fetchSubjectExams);

        if(!$zf_executeFetchSubjectExams){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSubjectExams->RecordCount() > 0){

                while(!$zf_executeFetchSubjectExams->EOF){
                    
                    $results = $zf_executeFetchSubjectExams->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
