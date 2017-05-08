<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ASSET MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO ASSET MODULE MODELS AND VIEWS.
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

class asset_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "asset_overview";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    
    //Executes the asset overview. Also is the default action for this controller
    public function actionAsset_overview($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('asset_overview', $zf_actionData);
        
    }
    
    
    //Executes the asset setup. Also is the default action for this controller
    public function actionAsset_setup($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('asset_setup', $zf_actionData);
        
    }
    
    
    //Executes the asset inventory. Also is the default action for this controller
    public function actionAsset_inventory($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('asset_inventory', $zf_actionData);
        
    }
    
    
    //Executes the asset items. Also is the default action for this controller
    public function actionAsset_items($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('asset_items', $zf_actionData);
        
    }
    
    
    //Executes the asset reports. Also is the default action for this controller
    public function actionAsset_reports($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('asset_reports', $zf_actionData);
        
    }
    
    

}
?>
