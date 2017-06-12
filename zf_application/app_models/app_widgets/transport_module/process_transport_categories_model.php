 <?php

class process_transport_categories_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building transport categories.
    public function zvss_getSchoolTransportCategories($identificationCode) {
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        
        //Check if there are transport categories already registered in the school
        $transportCategories = $this->getSchoolTransportCategories($systemSchoolCode);
        
        
        if($transportCategories == 0){
            
            $zvs_transportCategoriesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>Subjects Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no transport categories yet! Once categories are available, they will be populated in this section so they can be assigned.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
            
        }else{
            
            foreach($transportCategories as $categoryValues){
                
                $transportCategoryCode = $categoryValues['transportCategoryCode']; $transportCategoryName = $categoryValues['transportCategoryName'];
                $cleanTransportCategoryName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($transportCategoryName));
                
                $zvs_transportCategoriesGridView .='<div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="checkbox-list">
                                                    <label class="checkbox-inline col-md-12" style="padding-left: 40px !important;">
                                                        <input type="checkbox" name="'.$cleanTransportCategoryName.'"  value="'.$transportCategoryCode.'"> '.$transportCategoryName.'
                                                    </label>
                                                </div>
                                            </div>
                                        </div>';
                
            }
            
        }
        
        echo $zvs_transportCategoriesGridView;
        
    }
    
    
    
    //This private method returns school transport categories
    private function getSchoolTransportCategories($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransprotCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_categories', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransprotCategories  = $this->Zf_AdoDB->Execute($fetchSchoolTransprotCategories );

        if(!$zf_executeFetchSchoolTransprotCategories ){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransprotCategories ->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransprotCategories ->EOF){
                    
                    $results = $zf_executeFetchSchoolTransprotCategories ->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
