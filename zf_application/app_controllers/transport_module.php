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
   
    
    public $zf_defaultAction = "transport_overview";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
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
    
    

}
?>
