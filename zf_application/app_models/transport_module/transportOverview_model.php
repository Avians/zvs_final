<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for processing all transport       |
 * |  overview information                                             |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class transportOverview_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
            
    }
    
    
  
    
    
    
    /**
     * This method is used to return tranport dashlets
     */
    public function getTransportDashboardInformation($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $transportInformation = "";
        
        $transportInformation .=' <!-- BEGIN DASHBOARD CONTENT -->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="dashboard-stat purple-sharp" style="min-height: 120px;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5 dynamic-border" style="height: 100px !important;">
                                                    <div class="visual">
                                                        <i class="fa fa-snowflake-o"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">';
        
                                                        $totalTransportZones = $this->getTransportInformation($systemSchoolCode, $zvs_targetTable = "zvs_school_transport_zones" );
                                                        $transportInformation .= $totalTransportZones;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Zones
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5" style="height: 100px !important;">
                                                    <div class="visual margin-left-10">
                                                        <i class="fa fa-sliders"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">';
        
                                                        $totalTransportRoutes = $this->getTransportInformation($systemSchoolCode, $zvs_targetTable = "zvs_school_transport_routes" );
                                                        $transportInformation .= $totalTransportRoutes;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc text-center" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Routes
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Transport Zones &AMP; Routes
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="dashboard-stat green-sharp" style="min-height: 120px;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5 dynamic-border"style="height: 100px !important;">
                                                    <div class="visual">
                                                        <i class="fa fa-braille"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">';
        
                                                        $totalTransportCategories = $this->getTransportInformation($systemSchoolCode, $zvs_targetTable = "zvs_school_transport_categories" );
                                                        $transportInformation .= $totalTransportCategories;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Categories
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5"style="height: 100px !important;">
                                                    <div class="visual margin-left-10">
                                                        <i class="fa fa-bus"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">';
        
                                                        $totalTransportVehicles = $this->getTransportInformation($systemSchoolCode, $zvs_targetTable = "zvs_school_transport_vehicles" );
                                                        $transportInformation .= $totalTransportVehicles;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc text-center" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Vehicles
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Transport Categories &AMP; Vehicles
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="dashboard-stat blue-madison" style="min-height: 120px;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5 dynamic-border"style="height: 100px !important;">
                                                    <div class="visual">
                                                        <i class="fa fa-drivers-license"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">';
        
                                                        $totalTransportDrivers = $this->getTransportInformation($systemSchoolCode, $zvs_targetTable = "zvs_school_transport_vehicle_driver_mapper" );
                                                        $transportInformation .= $totalTransportDrivers;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Drivers
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 margin-top-5 margin-bottom-5"style="height: 100px !important;">
                                                    <div class="visual margin-left-10">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" style="font-size: 35px !important">0';
        
                                                        //$totalTransportStudents = $this->getTransportInformation($systemSchoolCode);
                                                        //$transportInformation .= $totalTransportStudents;
                                                    
                                $transportInformation .=' </div>
                                                        <div class="desc text-center" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Students
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Transport Drivers &AMP; Students
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END DASHBOARDCONTENT -->';
        
        
        echo $transportInformation;
        
        
    }
    
    
    
    //This private method returns total of all transport Information in the school
    private function getTransportInformation($systemSchoolCode, $zvs_targetTable){
        
        if($zvs_targetTable === "zvs_school_transport_vehicle_driver_mapper"){
            
            //This method uniquely counts the total number of drivers assigned to vehicles
            return $this->zvs_countSchoolTransportDrivers($systemSchoolCode, $zvs_targetTable);
            
        }else{
        
            //This method counts the total number of transport information
            return $this->zvs_countTransportInformation($systemSchoolCode, $zvs_targetTable);
            
        }
    }

    
    
    
    //This private method fetches all the school transport information
    private function zvs_countTransportInformation($systemSchoolCode, $zvs_targetTable){
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);

        $zvs_selectTransportInformation = Zf_QueryGenerator::BuildSQLSelect($zvs_targetTable, $sqlValues);
        
        
        $executeTransportInformationCount   = $this->Zf_AdoDB->Execute($zvs_selectTransportInformation);
        
        if (!$executeTransportInformationCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $transportInformationCount = $executeTransportInformationCount->RecordCount();
            
        }
        
        //return transport information count
        return $transportInformationCount;
        
    }
    
    
    
    
    //This private method fetches all the school transport drivers
    private function zvs_countSchoolTransportDrivers($systemSchoolCode, $zvs_targetTable){
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zvs_selectTransportDrivers = "SELECT DISTINCT driverIdentificationCode FROM `$zvs_targetTable` WHERE `systemSchoolCode` = '$systemSchoolCode' ";
        
        $executeTransportDriversCount = $this->Zf_AdoDB->Execute($zvs_selectTransportDrivers);
        
        if (!$executeTransportDriversCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $driversCount = $executeTransportDriversCount->RecordCount();
            
        }
        
        //return drivers count
        return $driversCount;
        
    }
    
    
    
    /**
     * This method is used to return transport zones and routes
     */
    public function getTransportZonesAndRoutes($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $transportZonesAndRoutes = '<div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">Transport Zones</h3>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 100%;">Zone Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            
                                                            //This method fetches all tramsport zones
                                                            $transportZones = $this->zvs_getTransportZones($systemSchoolCode);
                                                            
                                                            if($transportZones == 0){
                                                                
                                                                $transportZonesAndRoutes .='<tr><td>There are no transport zones</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($transportZones as $zoneValues){
                                                                    
                                                                    $transportZoneName = $zoneValues['transportZoneName'];
                                                                    
                                                                    $transportZonesAndRoutes .='<tr><td>'.$transportZoneName.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $transportZonesAndRoutes .='</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"><hr></div>

                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">Transport Routes</h3>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%;">Route Name</th><th style="width: 50%;">Zone Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            
                                                            //This method fetches all transport zones
                                                            $transportRoutes = $this->zvs_getTransportRoutes($systemSchoolCode);
                                                            
                                                            if($transportRoutes == 0){
                                                                
                                                                $transportZonesAndRoutes .='<tr><td>There are no transport routes</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($transportRoutes as $routeValues){
                                                                    
                                                                    $transportRouteName = $routeValues['transportRouteName']; $transportZoneCode = $routeValues['transportZoneCode']; 
                                                                    
                                                                    $transportZoneName = $this->zvs_getTransportZones($systemSchoolCode, $transportZoneCode);
                                                                    
                                                                    foreach($transportZoneName as $zoneValues){
                                                                        
                                                                        $zoneName = $zoneValues['transportZoneName'];
                                                                        
                                                                        $transportZonesAndRoutes .='<tr><td>'.$transportRouteName.'</td><td>'.$zoneName.'</td></tr>';
                                                                        
                                                                    }
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $transportZonesAndRoutes .='</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        
        echo $transportZonesAndRoutes;
        
    }
    
    
    
    
    //This private method fetches all transport zones
    private function zvs_getTransportZones($systemSchoolCode, $transportZoneCode = NULL){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if(!empty($transportZoneCode) && $transportZoneCode != NULL){
            
            $zvs_sqlValue["transportZoneCode"] = Zf_QueryGenerator::SQLValue($transportZoneCode);
            
        }
        
        $fetchTransportZones = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_zones', $zvs_sqlValue);
        
        $zf_executeFetchTransportZones = $this->Zf_AdoDB->Execute($fetchTransportZones);

        if(!$zf_executeFetchTransportZones){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportZones->RecordCount() > 0){

                while(!$zf_executeFetchTransportZones->EOF){
                    
                    $results = $zf_executeFetchTransportZones->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all transport zones
    private function zvs_getTransportRoutes($systemSchoolCode){
        
        $zvs_targetTable = "zvs_school_transport_routes";
        
        $fetchTransportRoutes = "SELECT *  FROM `$zvs_targetTable` WHERE `systemSchoolCode` = '$systemSchoolCode' ORDER BY `transportZoneCode`";
        
        $zf_executeFetchTransportRoutes = $this->Zf_AdoDB->Execute($fetchTransportRoutes);

        if(!$zf_executeFetchTransportRoutes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportRoutes->RecordCount() > 0){

                while(!$zf_executeFetchTransportRoutes->EOF){
                    
                    $results = $zf_executeFetchTransportRoutes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }

    

    /**
     * This method is used to return transport categories and vehicles
     */
    public function getTransportCategoriesAndVehicles($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $transportCategoriesAndVehicles = ' <div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                                <div class="zvs-content-titles">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h3 style="padding-left: 10px !important;">Transport Categories</h3>
                                                    </div>
                                                </div>
                                                <div class="portlet-body margin-bottom-5">
                                                    <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th  style="width: 100%;">Category Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
                                                            
                                                            //This method fetches all transport categories
                                                            $transportCategories = $this->zvs_getTransportCategories($systemSchoolCode);
                                                            
                                                            if($transportCategories == 0){
                                                                
                                $transportCategoriesAndVehicles .='<tr><td>There are no transport categories</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($transportCategories as $categoryValues){
                                                                    
                                                                    $transportCategoryName = $categoryValues['transportCategoryName'];
                                                                    
                                                                    $transportCategoriesAndVehicles .='<tr><td>'.$transportCategoryName.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $transportCategoriesAndVehicles .='</tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"><hr></div>

                                            <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                <div class="zvs-content-titles">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h3 style="padding-left: 10px !important;">Transport Vehicles</h3>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 50%;">Reg. No</th><th style="width: 50%;"> Vehicle Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
                                                            
                                                            //This method fetches all transport categories
                                                            $transportVehicles = $this->zvs_getTransportVehicles($systemSchoolCode);
                                                            
                                                            if($transportVehicles == 0){
                                                                
                                $transportCategoriesAndVehicles .='<tr><td>There are no transport vehicles</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($transportVehicles as $vehicleValues){
                                                                    
                                                                    $vehicleName = $vehicleValues['vehicleName'];
                                                                    $vehicleRegistrationNumber = $vehicleValues['vehicleRegistrationNumber'];
                                                                    
                                                                    $transportCategoriesAndVehicles .='<tr><td>'.$vehicleRegistrationNumber.'</td><td>'.$vehicleName.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $transportCategoriesAndVehicles .='</tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
        
        
        echo $transportCategoriesAndVehicles;
    }
    
    
    
    
    //This private method fetches all transport categories
    private function zvs_getTransportCategories($systemSchoolCode, $transportCategoryCode = NULL){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        if(!empty($transportCategoryCode) && $transportCategoryCode != NULL){
            
            $zvs_sqlValue["transportCategoryCode"] = Zf_QueryGenerator::SQLValue($transportCategoryCode);
            
        }
        
        $fetchTransportCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_categories', $zvs_sqlValue);
        
        $zf_executeFetchTransportCategories = $this->Zf_AdoDB->Execute($fetchTransportCategories);

        if(!$zf_executeFetchTransportCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportCategories->RecordCount() > 0){

                while(!$zf_executeFetchTransportCategories->EOF){
                    
                    $results = $zf_executeFetchTransportCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all transport vehicles
    private function zvs_getTransportVehicles($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchTransportVehicles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicles', $zvs_sqlValue);
        
        $zf_executeFetchTransportVehicles = $this->Zf_AdoDB->Execute($fetchTransportVehicles);

        if(!$zf_executeFetchTransportVehicles){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransportVehicles->RecordCount() > 0){

                while(!$zf_executeFetchTransportVehicles->EOF){
                    
                    $results = $zf_executeFetchTransportVehicles->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method is used to return transport drivers
     */
    public function getTransportDrivers($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $transportDrivers = '<div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                <div class="zvs-content-titles">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h3 style="padding-left: 10px !important;">Transport Drivers</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%;">Driver Name</th><th style="width: 40%;">Mobie No.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                            
                                                            //This method fetches all transport drivers
                                                            $getTransportDrivers = $this->zvs_getTransportDrivers($systemSchoolCode);
                                                            
                                                            if($getTransportDrivers == 0){
                                                                
                                                                $transportDrivers .='<tr><td>There are no transport driver</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($getTransportDrivers as $driverValues){
                                                                    
                                                                    //($user['permissions'] == 'admin') ? true : false;
                                                                    $staffMiddleName = (!empty($driverValues['staffMiddleName'])) ? $driverValues['staffMiddleName'] : "";
                                                                    
                                                                    $driverName = $driverValues['staffFirstName']." ".$staffMiddleName." ".$driverValues['staffLastName'];
                                                                    
                                                                    $phoneNumber = $driverValues['staffPhoneNumber'];
                                                                    
                                                                    $transportDrivers .='<tr><td>'.$driverName.'</td><td>'.$phoneNumber.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $transportDrivers .='</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"><hr></div>';
        
        
        echo $transportDrivers;
        
    }
    
    
    
    
    //This private method fetches all the school transport drivers
    private function zvs_getTransportDrivers($systemSchoolCode){
        
        //This pulls all transport driver codes
        $transportDriverCode = $this->zvs_getTransportDriversCode($systemSchoolCode);
        
        if($transportDriverCode == 0){
            
            return 0;
            
        }else{
            
            foreach ($transportDriverCode as $driverValue) {
                
                $driverIdentificationCode = $driverValue['driverIdentificationCode'];
                
                $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $sqlValues['identificationCode'] = Zf_QueryGenerator::SQLValue($driverIdentificationCode);

                $zvs_selectDriverDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_staff_personal_details', $sqlValue);;

                $executeFetchDriverDetails = $this->Zf_AdoDB->Execute($zvs_selectDriverDetails);

                if (!$executeFetchDriverDetails){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    if($executeFetchDriverDetails->RecordCount() > 0){

                        while(!$executeFetchDriverDetails->EOF){

                            $results = $executeFetchDriverDetails->GetRows();

                        }

                        return $results;


                    }else{

                        return 0;

                    }

                }
                
            }
            
        }
        
    }
    
    
    
    
    //This private method fetches all the school transport drivers
    private function zvs_getTransportDriversCode($systemSchoolCode){
        
        $zvs_targetTable = "zvs_school_transport_vehicle_driver_mapper";
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zvs_selectTransportDrivers = "SELECT DISTINCT driverIdentificationCode FROM `$zvs_targetTable` WHERE `systemSchoolCode` = '$systemSchoolCode' ";
        
        $executeFetchTransportDrivers = $this->Zf_AdoDB->Execute($zvs_selectTransportDrivers);
        
        if (!$executeFetchTransportDrivers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($executeFetchTransportDrivers->RecordCount() > 0){

                while(!$executeFetchTransportDrivers->EOF){
                    
                    $results = $executeFetchTransportDrivers->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }
        
    }

    
}

?>
