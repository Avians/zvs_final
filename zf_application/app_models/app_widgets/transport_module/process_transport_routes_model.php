 <?php

class process_transport_routes_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building transport routes.
    public function zvss_getSchoolTransportRoutes($identificationCode) {
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        
        //Check if there are transport zones already registered in the school
        $transportZones = $this->getSchoolTransportZones($systemSchoolCode);
        
        
        if($transportZones == 0){
            
            $zvs_transportRoutesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>Zones Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no transport zones yet! Once zones are available, they will be populated in this section so they can be assign to vehicles.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
            
        }else{
            
            foreach($transportZones as $zoneValues){
                
                $transportZoneCode = $zoneValues['transportZoneCode']; $transportZoneName = $zoneValues['transportZoneName'];
                $cleanTransportRouteName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($transportRouteName));
                
                
                //Check if there are transport routes already registered in the school
                $transportRoutes = $this->getSchoolTransportRoutes($systemSchoolCode, $transportZoneCode);
                
                if($transportRoutes == 0){
            
                    $zvs_transportRoutesGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                        <div class="zvs-content-titles">
                                                            <h3>Routes Overview Warning!!</h3>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                                <span class="content-view-errors" >
                                                                    &nbsp;There are no transport routes yet! Once routes are available, they will be populated in this section so they can be assign to vehicles.
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>          
                                                </div>';

                }else{
                    
                    foreach($transportRoutes as $routeValues){
                
                        $transportRouteCode = $routeValues['transportRouteCode']; $transportRouteName = $routeValues['transportRouteName'];
                        $cleanTransportRouteName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($transportRouteName));

                        $zvs_transportRoutesGridView .='<div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <div class="checkbox-list">
                                                        <label class="checkbox-inline col-md-12" style="padding-left: 40px !important;">
                                                            <input type="checkbox" name="'.$cleanTransportRouteName.'"  value="'.$transportRouteCode.'"> '.$transportZoneName.' <i class="fa fa-arrow-right" style="font-size: 10px; color: #21b4e2;"></i> '.$transportRouteName.'
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>';
                    }

                }
                
            }
            
        }
        
        echo $zvs_transportRoutesGridView;
        
    }
    
    
    
    
    //This private method returns school transport zones
    private function getSchoolTransportZones($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransprotZones = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_zones', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransprotZones  = $this->Zf_AdoDB->Execute($fetchSchoolTransprotZones);

        if(!$zf_executeFetchSchoolTransprotZones ){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransprotZones ->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransprotZones->EOF){
                    
                    $results = $zf_executeFetchSchoolTransprotZones ->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method returns school transport routes
    private function getSchoolTransportRoutes($systemSchoolCode, $transportZoneCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["transportZoneCode"] = Zf_QueryGenerator::SQLValue($transportZoneCode);
        
        $fetchSchoolTransprotRoutes = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_routes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransprotRoutes  = $this->Zf_AdoDB->Execute($fetchSchoolTransprotRoutes);

        if(!$zf_executeFetchSchoolTransprotRoutes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransprotRoutes->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransprotRoutes->EOF){
                    
                    $results = $zf_executeFetchSchoolTransprotRoutes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
