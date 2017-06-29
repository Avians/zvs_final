 <?php

class process_vendor_payment_categories_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building transport routes.
    public function zvss_getSchoolVendorPaymentCategories($identificationCode) {
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zf_selectPaymentVendorCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_categories', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectPaymentVendorCategories)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectPaymentVendorCategories}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $payment_vendor_options = '<option value="selectVendorCategory" selected="selected">Select a vendor category</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $payment_vendor_options .= '<option value="'.$fetchRow->schoolVendorCategoryCode.'" >'.$fetchRow->schoolVendorCategoryName.'</option>';

                }

            }else{
                
                $payment_vendor_options = '<option value="selectedTransportZone" selected="selected">Select a transport route zone</option>';
                
            }
            
            echo $payment_vendor_options;
        }     
        
    }
    
    
}
?>
