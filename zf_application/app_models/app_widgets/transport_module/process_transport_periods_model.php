 <?php

class process_transport_periods_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building school attendance periods
    public function zvss_getSchoolAttendancePeriods($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
        $currentYear = explode("-", $currentDate)[2]; 
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["attendanceYear"] = Zf_QueryGenerator::SQLValue($currentYear);
        $zf_selectAttendancePeriods = Zf_QueryGenerator::BuildSQLSelect('zvs_school_attendance_schedule', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectAttendancePeriods)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectAttendancePeriods}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $transport_zone_options = '<option value="selectedPeriod" selected="selected">Select a transport period</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $transport_zone_options .= '<option value="'.$fetchRow->systemAttendanceCode.'" >'.$fetchRow->attendanceName.'</option>';

                }

            }else{
                
                $transport_zone_options = '<option value="selectedPeriod" selected="selected">Select a transport period</option>';
                
            }
            
            echo $transport_zone_options;
        }
        
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
