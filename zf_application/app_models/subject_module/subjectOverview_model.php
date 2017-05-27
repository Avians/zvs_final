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

class subjectOverview_Model extends Zf_Model {
    

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
     * This method is used to select Admin localities
     */
    public function getSubjectDashboardInformation($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $subjectInformation = "";
        
        $subjectInformation .=' <!--START OF SUBJECT STATISTICS-->
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat purple-sharp">
                                            <div class="visual">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
        
                                                    $totalSchoolSubjects = $this->getTotalSchoolSubjects($systemSchoolCode);
                                                    $subjectInformation .= $totalSchoolSubjects;
                                                            
                        $subjectInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Total Subjects
                                                </div>
                                            </div>
                                            <div class="more" style="height: 25px;" href="#">
                                                Total Subjects In School
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat green-sharp">
                                            <div class="visual">
                                                <i class="fa fa-file-text-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                    $totalExaminableSubjects = $this->getTotalExaminableSubjects($systemSchoolCode);
                                                    $subjectInformation .= $totalExaminableSubjects;
                                                    
                        $subjectInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Examinable Subjects
                                                </div>
                                            </div>
                                            <div class="more" style="height: 25px;" href="#">
                                                Total Examinable Subjects
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat blue-madison">
                                            <div class="visual">
                                                <i class="fa fa-file-excel-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                   $totalNonExaminableSubjects = $this->getTotalNonExaminableSubjects($systemSchoolCode);
                                                   $subjectInformation .= $totalNonExaminableSubjects;
                                                   
                        $subjectInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Non Examinable Subjects
                                                </div>
                                            </div>
                                            <div class="more" style="height: 25px;" href="#">
                                                Total Non-examinable Subjects
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat red-soft">
                                            <div class="visual">
                                                <i class="fa fa-object-group"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                   $totalSubjectDepartments = $this->getTotalSubjectsDepartments($systemSchoolCode);
                                                   $subjectInformation .= $totalSubjectDepartments;
                                                   
                        $subjectInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                   Subject Departments
                                                </div>
                                            </div>
                                            <div class="more" style="height: 25px;" href="#">
                                                Total Subject Departments
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END OF SUBJECT STATISTICS-->';
        
        
        echo $subjectInformation;
        
        
    }
    
    
    
    //This private method returns total subjects in a given school
    private function getTotalSchoolSubjects($systemSchoolCode){
        
        //This method counts the total number of subjects
        return $this->zvs_countSchoolSubjects($systemSchoolCode);
        
    }




    //This private method returns all subjects that are examinable in a school
    private function getTotalExaminableSubjects($systemSchoolCode){
        
        //This method counts the total number of subjects that are examinable
        return $this->zvs_countSchoolSubjects($systemSchoolCode, "examinable");
        
    }

    
    
    
    //This private method returns all non examinable subjects in a school
    private function getTotalNonExaminableSubjects($systemSchoolCode){
        
        //This method counts the total number of subjects that are examinable
        return $this->zvs_countSchoolSubjects($systemSchoolCode, "non-examinable");
        
    }

    

    
    //This private method returns all the number of subject departments in a school
    private function getTotalSubjectsDepartments($systemSchoolCode){
        
        //This method counts the total number of subjects that are examinable
        return $this->zvs_countSchoolSubjects($systemSchoolCode, "departments");
        
    }
    
    
    
    //This private method fetches all the school subjects
    private function zvs_countSchoolSubjects($systemSchoolCode, $dataflag = NULL){
        
        $schoolSubjectTable = "zvs_school_subjects";
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if($dataflag == "examinable"){
            
           $sqlValues['examStatus'] = Zf_QueryGenerator::SQLValue(1); 
           
        }
        
        if($dataflag == "non-examinable"){
            
           $sqlValues['examStatus'] = Zf_QueryGenerator::SQLValue(0); 
           
        }
        
        $zvs_selectSubjects = Zf_QueryGenerator::BuildSQLSelect($schoolSubjectTable, $sqlValues);
        
        
        $executeSubjectCount   = $this->Zf_AdoDB->Execute($zvs_selectSubjects);
        
        if (!$executeSubjectCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $subjectCount = $executeSubjectCount->RecordCount();
            
        }
        
        //return subject count
        return $subjectCount;
        
    }

    
}

?>
