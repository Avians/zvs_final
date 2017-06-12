 <?php

class process_transport_vehicles_Model extends Zf_Model {

    public function __construct() {
        
        parent::__construct();
        
    }
    
    
    //This method is responsible for building school transport vehicles
    public function zvss_getSchoolTransportVehicles($zvs_parameter) {
        
        $identificationCode = $zvs_parameter[0];
        $dataFilter = $zvs_parameter[1];
        
        if($dataFilter == "assign_categories" || $dataFilter == "assign_routes"){
            
            $this->zvs_transportVehiclesDropDown($identificationCode);
            
        }else if($dataFilter == "assign_vehicles"){
            
            $this->zvs_transportVehiclesCheckList($identificationCode);
            
        }
        
    }
    
    
    
    
    //This private method helps to generate vehicle dropdown list
    private function zvs_transportVehiclesDropDown($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zf_selectTransportVehicles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicles', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectTransportVehicles)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectTransportVehicles}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $transport_vehicle_options = '<option value="selectTransportVehicle" selected="selected">Select a transport vehicle</option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $transport_vehicle_options .= '<option value="'.$fetchRow->transportVehicleCode.'" >'.$fetchRow->vehicleName.' - '.$fetchRow->vehicleRegistrationNumber.'</option>';

                }

            }else{
                
                $transport_vehicle_options = '<option value="selectTransportVehicle" selected="selected">Select a transport vehicle</option>';
                
            }
            
            echo $transport_vehicle_options;
        }
        
    }
    
    
    
    
    //This private method helps to generate vehicle checkbox list
    private function zvs_transportVehiclesCheckList($identificationCode){
        
        //School system code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        //Check if there are transport vehicles already registered in the school
        $transportVehicles = $this->getSchoolTransportVehicles($systemSchoolCode);
        
        if($transportVehicles == 0){
            
            $zvs_transportVehicleGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <h3>Subjects Overview Warning!!</h3>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                        <span class="content-view-errors" >
                                                            &nbsp;There are no vehicles yet! Once vehicles are available, they will be populated in this section so that they can be assigned.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>';
            
        }else{
            
            foreach($transportVehicles as $vehicleValues){
                
                $transportVehicleCode = $vehicleValues['transportVehicleCode']; $vehicleName = $vehicleValues['vehicleName'];
                $cleanVehicleName = str_replace(".","",Zf_Core_Functions::Zf_CleanName($vehicleName)); $registrationNumber = $vehicleValues['vehicleRegistrationNumber'];
                
                $zvs_transportVehicleGridView .='<div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="checkbox-list">
                                                    <label class="checkbox-inline col-md-12" style="padding-left: 40px !important;">
                                                        <input type="checkbox" name="'.$cleanVehicleName.'"  value="'.$transportVehicleCode.'"> '.$vehicleName.' <i class="fa fa-minus" style="font-size: 10px; color: #21b4e2;"></i> '.$registrationNumber.'
                                                    </label>
                                                </div>
                                            </div>
                                        </div>';
                
            }
            
        }
        
        echo $zvs_transportVehicleGridView;
        
    }
    
    
    
    
    //This private method returns school transport categories
    private function getSchoolTransportVehicles($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransportVehicles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicles', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransportVehicles  = $this->Zf_AdoDB->Execute($fetchSchoolTransportVehicles);

        if(!$zf_executeFetchSchoolTransportVehicles){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolTransportVehicles->RecordCount() > 0){

                while(!$zf_executeFetchSchoolTransportVehicles->EOF){
                    
                    $results = $zf_executeFetchSchoolTransportVehicles->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
