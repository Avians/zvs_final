<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school subjects .           |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class manageSchoolSubjects_Model extends Zf_Model {
    
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
     * This method returns all subjects details for a given school
     */
    public function fetchSubjectDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         $zvs_subjectGridView = '';
         
         //Here we fetch and return all subject details.
         $zvs_subjectDetails = $this->zvs_fetchSubjectDetails($systemSchoolCode);
         
         
         if($zvs_subjectDetails == 0){
             
             $zvs_subjectGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>School Subjects Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no school subjects yet! You need to add atleast one subject to have a school subject overview.'.$systemSchoolCode.'
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
            



            $zvs_subjectGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="zvs-content-titles">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <h3 style="padding-left: 10px !important;">School Subjects</h3>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="zvs-table-blocks scroller" data-always-visible="1" data-rail-visible="0">
                                                     <div class="table-responsive">
                                                         <table class="table table-striped table-hover">
                                                             <thead>
                                                                 <tr>
                                                                     <th  style="width: 30%;">Subject Name</th><th style="width: 25%;">Subject Alias</th><th style="width: 15%;">Subject Code</th><th style="width: 15%; text-align: center !important;">Subject Status</th><th style="width: 15%; text-align: center !important;">Edit Subject</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>';

                                                               foreach($zvs_subjectDetails as $subjectValues){

                                                                    $schoolSubjectCode =  $subjectValues['schoolSubjectCode'];$subjectName = $subjectValues['subjectName'];
                                                                    $subjectAlias = $subjectValues['subjectAlias']; $subjectCode = $subjectValues['subjectCode'];
                                                                    $subjectStatus = ($subjectValues['subjectStatus'] == 1 ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
                                                                    
                                                                    $zvs_subjectGridView .='<tr><td>'.$subjectName.'</td><td style="text-align:left !important;">'.$subjectAlias.'</td><td style="text-align:left !important;">'.$subjectCode.'</td><td style="text-align:center !important;">'.$subjectStatus.'</td><td style="text-align: center !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'edit_subject_details'.DS.  Zf_SecureData::zf_encode_url($schoolSubjectCode).' " title="Edit '.$subjectName.'" ><i class="fa fa-edit"></i></a></td></tr>';

                                                               }

                                       $zvs_subjectGridView .='</tbody>
                                                         </table>
                                                     </div>
                                                </div>
                                           </div>
                                        </div>          
                                    </div>';
             
         }
         
         echo $zvs_subjectGridView;
         
        
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
    
    
}

?>
