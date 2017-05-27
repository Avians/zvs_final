 <?php

class process_school_subjects_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsoble for building country codes.
    public function zvss_getSchoolSubjects($identificationCode) {
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        
        //Check if there are subjects already registered in the school
        $schoolSubjects = $this->getSchoolSubjects($systemSchoolCode);
        
        
        if($schoolSubjects == 0){
            
            $zvs_subjectsGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>Subjects Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no school subjects yet! Once subjects are available, they will be populated in this section so they can be assigne to classes.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
            
        }else{
            
            foreach($schoolSubjects as $subjectValues){
                
                $schoolSubjectCode = $subjectValues['systemSubjectCode']; $schoolSubjectName = $subjectValues['subjectName'];
                $cleanSubjectName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($schoolSubjectName));
                
                $zvs_subjectsGridView .='<div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="checkbox-list">
                                                    <label class="checkbox-inline col-md-12" style="padding-left: 40px !important;">
                                                        <input type="checkbox" name="'.$cleanSubjectName.'"  value="'.$schoolSubjectCode.'"> '.$schoolSubjectName.'
                                                    </label>
                                                </div>
                                            </div>
                                        </div>';
                
            }
            
        }
        
        echo $zvs_subjectsGridView;
        
    }
    
    
    
    //This private method returns school subjects
    private function getSchoolSubjects($systemSchoolCode){
        
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
