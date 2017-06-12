<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE TRANSPORT MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO TRANSPORT MODULE MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  14th/August/2013  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class transport_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "transport_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    //Executes the transport overview. Also is the default action for this controller
    public function actionTransport_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('transport_module_introduction', $zf_actionData);
        
    }

    
    
    //Executes the transport overview. Also is the default action for this controller
    public function actionTransport_overview($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('transport_overview', $zf_actionData);
        
    }

    
    
    
    //Executes the transport setup. Also is the default action for this controller
    public function actionTransport_setup($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('transport_setup', $zf_actionData);
        
    }

    
    
    
    //Executes the transport vehicles.
    public function actionTransport_vehicles($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('transport_vehicles', $zf_actionData);
        
    }

    
    
    //Executes the assign drivers. Also is the default action for this controller
    public function actionAssign_drivers($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('assign_drivers', $zf_actionData);
        
    }

    
    
    //Executes the assign students. Also is the default action for this controller
    public function actionAssign_students($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('assign_students', $zf_actionData);
        
    }

    
    
    //Executes the transport reports. Also is the default action for this controller
    public function actionTransport_reports($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('transport_reports', $zf_actionData);
        
    }
    
    
    
    //Executes the transport setup processing action
    public function actionTransport_Setup_Process($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_url($zvs_parameter);
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);


        if($filteredData == "new_transport_zone"){

           //This model method create a new transport zone
           $this->zf_targetModel->newTransportZone();

        }else if($filteredData == "new_transport_route"){

           //This model method create a new transport route
           $this->zf_targetModel->newTransportRoute();

        }else if($filteredData == "new_transport_category"){

           //This model method create a new transport category
           $this->zf_targetModel->newTransportCategory();

        }else if($filterDataVariable == "process_transport_routes"){
            
            //This model method process all transport routes related to a selected zone
            $this->zf_targetModel->processTransportRoutes();
        }
        
    }
    
    
    
    //Executes the transport vehicles processing action
    public function actionTransport_Vehicles_Process($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_url($zvs_parameter);
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);


        if($filteredData == "new_transport_vehicle"){

           //This model method create a new transport vehicle
           $this->zf_targetModel->newTransportVehicle();

        }else if($filteredData == "new_transport_cost"){

           //This model method create a new transport cost
           $this->zf_targetModel->newTransportCost();

        }else if($filteredData == "assign_categories"){
            
            //This method assigns categories to vehicles
            $this->zf_targetModel->assignCategoriesToVehicles();
           
        }else if($filteredData == "assign_routes"){
            
            //This method assigns routes to vehicles
            $this->zf_targetModel->assignRoutesToVehicles();
                
        }
        
    }
    
    
    
    
    //Executes the transport drivers processing action
    public function actionTransport_Drivers_Process($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_url($zvs_parameter);
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);


        if($filterDataVariable == "process_drivers"){
            
            //This model method process the driving staff for selected vehicles
            $this->zf_targetModel->processDrivingStaff();
            
        }else if($filteredData == "assign_vehicles"){

           //This method assigns vehicles to driver
            $this->zf_targetModel->assignVehiclesToDriver();

        }
        
    }
    

}
?>
