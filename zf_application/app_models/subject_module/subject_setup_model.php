<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered staff.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class subject_setup_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
    /**
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
     * This public method returns the class subject information
     */
    public function fetchClassSubjectDetails($identificationCode){


        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];

        $zvs_classGridView = '';

        //Here we fetch and return all class details.
        $zvs_classDetails = $this->zvs_fetchClassDetails($systemSchoolCode);


        if($zvs_classDetails == 0){

            $zvs_classGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                       <div class="zvs-content-titles">
                                           <h3>Class Overview Warning!!</h3>
                                       </div>
                                       <div class="portlet-body">
                                           <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                               <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                               <span class="content-view-errors" >
                                                   &nbsp;There are no classes yet! You need to add atleast one class to have a class overview.
                                               </span>
                                           </div>
                                       </div>
                                   </div>          
                               </div>';

        }else{

            foreach($zvs_classDetails as $classValues){

                $zvs_className = $classValues['schoolClassName']; $schoolClassCode =  $classValues['schoolClassCode'];

                //Here we fetch and return all subject code details.
                $fetchSubjectCodes = $this->zvs_fetchClassSubjectCodes($systemSchoolCode, $schoolClassCode);

                $zvs_classGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                      <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                           <div class="zvs-content-titles">
                                               <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                   <h3 style="padding-left: 10px !important;">'.$zvs_className.'</h3>
                                               </div>
                                               <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                   <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'subject_assignment_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolClassCode).' " title="View '.$zvs_className.' Subject Assignment" ><i class="fa fa-list"></i></a></h3>
                                               </div>
                                           </div>';

                                           if($fetchSubjectCodes == 0){

                                               $zvs_classGridView .='<div class="portlet-body">
                                                                        <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important; height: 380px !important;">
                                                                            <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                            <span class="content-view-errors" >
                                                                                &nbsp;There are no subjects assigned to '.strtolower($zvs_className).' yet! <br>You need to add atleast one subject to have an overview.
                                                                            </span>
                                                                        </div>
                                                                    </div>';

                                           }else{

                                               $zvs_classGridView .='<div class="portlet-body">
                                                                                 <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                      <div class="table-responsive">
                                                                                          <table class="table table-striped table-hover">
                                                                                              <thead>
                                                                                                  <tr>
                                                                                                      <th  style="width: 100%;">Subject Name</th>
                                                                                                  </tr>
                                                                                              </thead>
                                                                                              <tbody>';

                                                                                                foreach ($fetchSubjectCodes as $subjectCodeValues) {

                                                                                                    $schoolSubjectCode = $subjectCodeValues['schoolSubjectCode'];

                                                                                                    $fetchSubjectDetails = $this->fetchSchoolSubjectDetails($systemSchoolCode, $schoolSubjectCode);

                                                                                                    foreach ($fetchSubjectDetails as $subjectValues){

                                                                                                        $schoolSubjectName = $subjectValues['subjectName'];

                                                                                                        $zvs_classGridView .='<tr><td>'.$schoolSubjectName.'</td>';

                                                                                                    }
                                                                                                }

                                                                        $zvs_classGridView .='</tbody>
                                                                                          </table>
                                                                                      </div>
                                                                                 </div>
                                                                            </div>';

                                           }

               $zvs_classGridView .='</div>          
                                   </div>';

            }

        }

        echo $zvs_classGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchClassDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
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
     * This private method fetched all subject codes
     */
    private function zvs_fetchClassSubjectCodes($systemSchoolCode, $schoolClassCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSubjectCodes = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subject_class_assignment', $zvs_sqlValue);
        
        $zf_executeFetchSubjectCodes = $this->Zf_AdoDB->Execute($fetchSubjectCodes);

        if(!$zf_executeFetchSubjectCodes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSubjectCodes->RecordCount() > 0){

                while(!$zf_executeFetchSubjectCodes->EOF){
                    
                    $results = $zf_executeFetchSubjectCodes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This private method fetches all school subject details
     */
    private function fetchSchoolSubjectDetails($systemSchoolCode, $schoolSubjectCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["systemSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
        
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
