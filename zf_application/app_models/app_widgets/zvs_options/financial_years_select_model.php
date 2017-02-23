 <?php

class financial_years_select_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for financial years select list.
    public function zvs_buildFinancialYearsSelectCode($identificationCode) {
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectFinancialYears = Zf_QueryGenerator::BuildSQLSelect('zvs_school_financial_years', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectFinancialYears)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectFinancialYears}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $financial_years_options = '<option value="selectClass" selected="selected">Select a financial year</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $financial_years_options .= '<option value="'.$fetchRow->financialYearCode.'" >'.$fetchRow->financialYearName.'</option>';

                }

            }
            
            echo $financial_years_options;
        }

    }
    
}
?>
