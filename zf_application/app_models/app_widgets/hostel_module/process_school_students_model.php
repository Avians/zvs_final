 <?php

class process_school_students_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building school students dropdown
    public function zvss_getSchoolStudents($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zf_selectSchoolStudents = Zf_QueryGenerator::BuildSQLSelect('zvs_students_personal_details', $zvs_sqlValue, NULL, 'studentAdmissionNumber', TRUE);

        if(!$this->Zf_QueryGenerator->Query($zf_selectSchoolStudents)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectSchoolStudents}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $school_student_options = '<option value="selectStudents" selected="selected">Select a student</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $firstName = $fetchRow->studentFirstName;
                    $middelName = empty($fetchRow->studentMiddleName) ? "" : $fetchRow->studentMiddleName;
                    $lastName = empty($fetchRow->studentLastName) ? "" : $fetchRow->studentLastName;
                    
                    $studentFullName = $firstName." ".$middelName." ".$lastName;
                    
                    $school_student_options .= '<option value="'.$fetchRow->identificationCode.'" >['.$fetchRow->studentAdmissionNumber.'] '.$studentFullName.'</option>';

                }

            }else{
                
                $school_student_options = '<option value="" selected="selected">Select a library category</option>';
                
            }
            
            echo $school_student_options;
        }
        
    }
    
    
}
?>
