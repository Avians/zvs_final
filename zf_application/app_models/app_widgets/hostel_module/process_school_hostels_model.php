 <?php

class process_school_hostels_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building school library categories
    public function zvss_getSchoolHostels($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zf_selectSchoolHostels = Zf_QueryGenerator::BuildSQLSelect('zvs_school_hostels', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectSchoolHostels)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectSchoolHostels}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $school_hostel_options = '<option value="selectSchoolHostel" selected="selected">Select a school hostel</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $school_hostel_options .= '<option value="'.$fetchRow->schoolHostelCode.'" >'.$fetchRow->schoolHostelName.'</option>';

                }

            }else{
                
                $school_hostel_options = '<option value="" selected="selected">Select a school hostel</option>';
                
            }
            
            echo $school_hostel_options;
        }
        
    }
    
    
}
?>
