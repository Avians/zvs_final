<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE PARENT MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO PARENT MODULE MODELS AND VIEWS.
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

class parent_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "parent_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    //This action executes the landing page for this module
    public function actionParent_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView("parent_module_introduction", $zf_actionData);
        
    }

    
    
    
    //Executes the index view. Also is the defaukt action for this controller
    public function actionGuardian_profile($zf_parameter){
        
        //Zf_View::zf_displayView('index');
        echo "This is the parent";
        
    }
    
    

}
?>
