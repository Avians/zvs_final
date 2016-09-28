<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE CLASS MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO CLASS MODULE MODELS AND VIEWS.
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

class class_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "view_classes";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    //Executes the view classes view. Also is the defaukt action for this controller
    public function actionView_classes($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_classes', $zf_actionData);
        
    }
    
    
    
    //This method is vital is processing class charts
    public function actionProcessClassChart($zvs_parameter){
        
        //Get the locality related to any student registration data
        $this->zf_targetModel->plotClassChart();
        
    }
    
    

    
    //This controller executes the class profile view.
    public function actionClass_profile($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('class_profile', $zf_actionData);
        
    }
    
    
    //This controller executes the view streams view.
    public function actionView_streams(){
        
        Zf_View::zf_displayView('view_streams');
        
    }
    
    
    //This controller executes the stream profile view.
    public function actionStream_profile(){
        
        Zf_View::zf_displayView('stream_profile');
        
    }
    
    

}
?>
