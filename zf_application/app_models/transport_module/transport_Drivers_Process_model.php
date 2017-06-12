<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class transport_Drivers_Process_Model extends Zf_Model {
    

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
     * This method processes all transport driving staff that belong to a selected role
     */
    public function processDrivingStaff(){
        
        $schoolRoleCode = $_POST['schoolRoleCode'];
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $schoolRoleCode)[0];
        
        //Here we fetch all school staff with this school role code
        $schoolStaffDetails = $this->zvs_fetchSchoolStaff($systemSchoolCode);
        
        $select_options = '';
        
        if($schoolStaffDetails == 0){
            
            $select_options .= '<option value="">No Valid Driver Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selectedDriver">Select a vehicle driver</option>';
            
            foreach ($schoolStaffDetails as $staffValue) {
                
                //Pull staff identification code
                $identificationCode = $staffValue['identificationCode'];
                
                //Pull staff school role from the identification code        
                $staffRole = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[3];
                
                //Return only values for staff whose role matches current selected role
                if($schoolRoleCode == $systemSchoolCode.ZVSS_CONNECT.$staffRole){
                    
                    $firstName = $staffValue['staffFirstName']; $lastName = $staffValue['staffLastName'];
                
                    $select_options .= '<option value="'.$identificationCode.'">'.$firstName.' '.$lastName.'</option>';

                }

            }
            
        }
            
        echo $select_options;
        
    }
    
    
    
    
    /**
     * This method inserts a new driver-vehicle assignment record
     */
    public function assignVehiclesToDriver(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolRoleCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School role')
                
                                ->zf_postFormData('staffIdentificationCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vehicle driver')
                
                                ->zf_postFormData('adminIdentificationCode');
       

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        //We use this function to pull transport vehicles that are currently registered in the school
        $schoolTransportVehicles = $this->zvs_fetchTransportVehicles($systemSchoolCode);
        
        
        if($schoolTransportVehicles == 0){
            
            echo "There are no transport vehicles in this school yet!!"; exit();
            
        }else{
            
            foreach($schoolTransportVehicles as $vehicleValues){
                
                $transportVehicleCode = $vehicleValues['transportVehicleCode']; $vehicleName = $vehicleValues['vehicleName'];
                $cleanVehicleName  = str_replace(".","",Zf_Core_Functions::Zf_CleanName($vehicleName));
                
                $this->zf_formController->zf_postFormData($cleanVehicleName);
                
            }
            
        }
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>All Transport Drivers Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        if(empty($this->_errorResult)){
            
            $schoolRoleCode = $this->_validResult['schoolRoleCode'];
            $staffIdentificationCode = $this->_validResult['staffIdentificationCode'];
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["schoolRoleCode"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
            $zvs_sqlValue["driverIdentificationCode"] = Zf_QueryGenerator::SQLValue($staffIdentificationCode);
            
            if($schoolRoleCode == "selectSchoolRole"){
                
                $zf_errorData = array("zf_fieldName" => "schoolRoleCode", "zf_errorMessage" => "* A kindly select a school role first!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("transport_module", 'assign_drivers', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else if($staffIdentificationCode == "selectVehicleDriver"){
                
                $zf_errorData = array("zf_fieldName" => "staffIdentificationCode", "zf_errorMessage" => "* A kindly select a driver to assign vehicles to!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("transport_module", 'assign_drivers', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else{
                
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {

                    if($arrayKey != "schoolRoleCode" && $arrayKey != "staffIdentificationCode" && $arrayKey != "adminIdentificationCode"){

                        //Check if the vehicle has already been assigned to the selected vehicle
                        $vehicleName = $arrayKey;  $transportVehicleCode = $arrayValue; 
                        
                        //Check if this role and driver has already been assigned vehicles
                        $zvs_sqlValue["schoolRoleCode"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
                        $zvs_sqlValue["driverIdentificationCode"] = Zf_QueryGenerator::SQLValue($staffIdentificationCode);
                        $zvs_sqlValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);

                        $checkTransportDriverIfAssigned = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicle_driver_mapper', $zvs_sqlValue);
                        
                        $zf_executeCheckTransportDriverIfAssigned= $this->Zf_AdoDB->Execute($checkTransportDriverIfAssigned);

                        if(!$zf_executeCheckTransportDriverIfAssigned){
                            
                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            if($zf_executeCheckTransportDriverIfAssigned->RecordCount() > 0){

                                //Update records
                                $zvs_updateValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
                                $zvs_updateValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_updateValue["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $updateAssignedDriver = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_transport_vehicle_driver_mapper', $zvs_updateValue, $zvs_sqlValue);
                                
                                $executeUpdateAssignedDriver = $this->Zf_AdoDB->Execute($updateAssignedDriver);
                            
                                if(!$executeUpdateAssignedDriver){
                                    
                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }

                            }else{

                                //Insert new records
                                $zvs_sqlValue["transportVehicleCode"] = Zf_QueryGenerator::SQLValue($transportVehicleCode);
                                $zvs_sqlValue["createdBy"] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                                $zvs_sqlValue["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                $insertAssignedDriver = Zf_QueryGenerator::BuildSQLInsert('zvs_school_transport_vehicle_driver_mapper', $zvs_sqlValue);
                                
                                $executeInsertAssignedDriver = $this->Zf_AdoDB->Execute($insertAssignedDriver);
                            
                                if(!$executeInsertAssignedDriver){
                                    
                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }
                                
                            }
                        }
                        
                    }

                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("transport_module", "driver_assignment_success");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("transport_module", 'assign_drivers', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
                      
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("transport_module", "driver_assignment_error");

            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("transport_module", 'assign_drivers', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }




    //This private method fetches all details of school staff
    private function zvs_fetchSchoolStaff($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolStaff = Zf_QueryGenerator::BuildSQLSelect('zvs_staff_personal_details', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStaff = $this->Zf_AdoDB->Execute($fetchSchoolStaff);

        if(!$zf_executeFetchSchoolStaff){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStaff->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStaff->EOF){
                    
                    $results = $zf_executeFetchSchoolStaff->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method returns school transport vehicles
    private function zvs_fetchTransportVehicles($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolTransportVehicles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_transport_vehicles', $zvs_sqlValue);
        
        $zf_executeFetchSchoolTransportVehicles = $this->Zf_AdoDB->Execute($fetchSchoolTransportVehicles);

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
