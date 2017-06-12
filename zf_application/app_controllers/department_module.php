<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE DEPARTMENT MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO DEPARTMENT MODULE MODELS AND VIEWS.
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

class department_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "department_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    //This action executes the landing page for this module
    public function actionDepartment_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView("department_module_introduction", $zf_actionData);
        
    }
    
    
    
    
    //Executes the view departments view. Also is the defaukt action for this controller
    public function actionView_departments(){
        
        Zf_View::zf_displayView('view_departments');
        
    }
    
    
    //This controller executes the department profile view
    public function actionDepartment_profile(){
        
        Zf_View::zf_displayView('department_profile');
        
    }
    
    
    //This controller executes the View Sub-department view
    public function actionView_sub_department(){
        
        Zf_View::zf_displayView('view_sub_department');
        
    }
    
    
    //This controller executes the Sub-department profile view
    public function actionSub_department_profile(){
        
        Zf_View::zf_displayView('sub_department_profile');
        
    }
    
    

}
?>
