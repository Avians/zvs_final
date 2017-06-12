 <?php

class process_class_subjects_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building school class subjects
    public function zvss_getSchoolClassSubjects($zvs_parameter) {
        
        $identificationCode = $zvs_parameter[0];
        $dataFilter = $zvs_parameter[1];
        
        if($dataFilter == "assign_subjects_to_teacher"){
            
            $this->zvs_classSubjectsCheckList($identificationCode);
            
        }
        
    }
    
    
    
    
    //This private method helps to generate vehicle checkbox list
    private function zvs_classSubjectsCheckList($identificationCode){
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        //Check if there are classes already registered into this school
        $schoolClasses = $this->getSchoolClasses($systemSchoolCode);
        
        if($schoolClasses == 0){
            
            $zvs_schoolClassesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>School Classes Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no classes yet! Once classes are available, they will be populated in this section!
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
            
        }else{
            
            foreach($schoolClasses as $classValues){
                
                $schoolClassCode = $classValues['schoolClassCode']; $schoolClassName = $classValues['schoolClassName'];
                $cleanClassName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($schoolClassName));
                
                $zvs_schoolClassesGridView .='<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                    <div class="zvs-content-titles">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h3 style="padding-left: 10px !important;">'.$schoolClassName.'</h3>
                                                        </div>
                                                    </div>';

                                                        //Here we select all subject in each class
                                                        $classSubjects = $this->getClassSubjects($systemSchoolCode, $schoolClassCode);
                                                        
                                                        if($classSubjects == 0){
                                                            
                                                             $zvs_schoolClassesGridView .=' <div class="portlet-body">
                                                                                                <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 30% !important;">
                                                                                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                                                    <span class="content-view-errors" >
                                                                                                        &nbsp;There are no subjects assigned to '.strtolower($schoolClassName).' for now!!
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>';
                                                            
                                                        }else{
                                                            
                                                            
                                                            $zvs_schoolClassesGridView .='  <div class="portlet-body">
                                                                                                <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                                     <div class="table-responsive">
                                                                                                        <table class="table table-striped table-hover">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th  style="width: 100%;">Subject Name</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>';
                                                                                                                foreach ($classSubjects as $classSubjectValues){

                                                                                                                    $schoolSubjectCode = $classSubjectValues['schoolSubjectCode'];

                                                                                                                    //For each subject, fetch the actual subject name
                                                                                                                    $subjectDetails = $this->getSubjectDetails($systemSchoolCode, $schoolSubjectCode);

                                                                                                                    foreach ($subjectDetails as $subjectValues){
                                                                                                                        
                                                                                                                        //Pull the actual subject name
                                                                                                                        $subjectName = $subjectValues['subjectName'];
                                                                                                                        
                                                                                                                        $classSubjectCode = $schoolClassCode.ZVSS_CONNECT.$schoolSubjectCode;
                                                                                                                        $cleanClassSubjectCode = str_replace(".","",Zf_Core_Functions::Zf_CleanName($classSubjectCode));
                                                                                                                        
                                                                                                                        $zvs_schoolClassesGridView .='<tr><td><label class="checkbox-inline">'
                                                                                                                                                        . '<input type="checkbox" name="'.$cleanClassSubjectCode.'"  value="'.$classSubjectCode.'" id="'.$classSubjectCode.'">'.$subjectName
                                                                                                                                                    . '</td></tr>';
                                                                                                                    
                                                                                                                    }

                                                                                                                }
                                                                            $zvs_schoolClassesGridView .= '</tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>';

                                                        }
                                        
                $zvs_schoolClassesGridView .='  </div>          
                                             </div>';
                
            }
            
        }
        
        echo $zvs_schoolClassesGridView;
        
    }
    
    
    
    
    //This private method returns school classes
    private function getSchoolClasses($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolClasses  = $this->Zf_AdoDB->Execute($fetchSchoolClasses);

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
    
    
    
    //This private method returns a list of all subjects in a selected class
    private function getClassSubjects($systemSchoolCode, $schoolClassCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchClassSubjects = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subject_class_assignment', $zvs_sqlValue);
        
        $zf_executeFetchClassSubjects  = $this->Zf_AdoDB->Execute($fetchClassSubjects);

        if(!$zf_executeFetchClassSubjects){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassSubjects->RecordCount() > 0){

                while(!$zf_executeFetchClassSubjects->EOF){
                    
                    $results = $zf_executeFetchClassSubjects->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
    }
    
    
    
    //This private method returns subjects details for selected subject
    private function getSubjectDetails($systemSchoolCode, $schoolSubjectCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["systemSubjectCode"] = Zf_QueryGenerator::SQLValue($schoolSubjectCode);
        
        $fetchSubjectDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_subjects', $zvs_sqlValue);
        
        $zf_executeFetchSubjectDetails  = $this->Zf_AdoDB->Execute($fetchSubjectDetails);

        if(!$zf_executeFetchSubjectDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSubjectDetails->RecordCount() > 0){

                while(!$zf_executeFetchSubjectDetails->EOF){
                    
                    $results = $zf_executeFetchSubjectDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
    }
    
}
?>
