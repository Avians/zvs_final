<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE STORE MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO STORE MODULE MODELS AND VIEWS.
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

class store_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "store_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    
    
    //This action executes the landing page for this module
    public function actionStore_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView("store_module_introduction", $zf_actionData);
        
    }
    
    
    
    //Executes the store overview. Also is the default action for this controller
    public function actionStore_overview($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_overview', $zf_actionData);
        
    }
    
    
    //Executes the store suppliers. Also is the default action for this controller
    public function actionStore_suppliers($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_suppliers', $zf_actionData);
        
    }
    
    
    //Executes the store setup. Also is the default action for this controller
    public function actionStore_setup($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_setup', $zf_actionData);
        
    }
    
    
    //Executes the store assignment. Also is the default action for this controller
    public function actionStore_assignment($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_assignment', $zf_actionData);
        
    }
    
    
    //Executes the store items. Also is the default action for this controller
    public function actionStore_items($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_items', $zf_actionData);
        
    }
    
    
    //Executes the store receiving. Also is the default action for this controller
    public function actionStore_receiving($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_receiving', $zf_actionData);
        
    }
    
    
    //Executes the store issuing. Also is the default action for this controller
    public function actionStore_issuing($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_issuing', $zf_actionData);
        
    }
    
    
    //Executes the store reports. Also is the default action for this controller
    public function actionStore_reports($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('store_reports', $zf_actionData);
        
    }
    
    

}
?>
