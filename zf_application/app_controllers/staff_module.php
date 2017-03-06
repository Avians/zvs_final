<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE SUB-STAFF MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO SUB-STAFF MODULE MODELS AND VIEWS.
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

class staff_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    //Executes the index view. Also is the defaukt action for this controller
    public function actionRegister_staff($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('register_staff',$zf_actionData);
        
    }
    
    
    
    
    //This method process all related staff information
    public function actionProcessStaffInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'process_locality'){
            
            //Get the locality related to any student registration data
            $this->zf_targetModel->getStaffLocality();
            
        }else if($filterDataUrl == 'new_staff'){
            
            //We are about to register a new staff to the administration
            $this->zf_targetModel->registerNewStaff();
            
        }
        
    }
    
    

}
?>
