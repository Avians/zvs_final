<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ZVS_PLATFORM_ADMIN CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO SUPER ADMINISTRATOR MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  11th/February/2015  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class Zvs_platform_adminController extends Zf_Controller {
   
    
    public $zf_defaultAction = "main_dashboard";


    /**
     * This is the class constructor
     */
    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
   
    

    
    /**
     * This action executes the main dashboard view
     */
    public function actionMain_dashboard(){
        
        Zf_View::zf_displayView('main_dashboard');
        
    }
    
    
    
    
    /**
     * This action executes the new school view
     */
    public function actionNew_school(){
        
        Zf_View::zf_displayView('new_school');
        
    }
    
    
    
    
    /**
     * This action executes the schools directory view
     */
    public function actionSchools_directory(){
        
        Zf_View::zf_displayView('schools_directory');
        
    }
    
    
    
    
    /**
     * This action executes the confirmed schools view
     */
    public function actionConfirmed_schools(){
        
        Zf_View::zf_displayView('confirmed_schools');
        
    }
    
    
    
    
    /**
     * This action executes the suspended schools view
     */
    public function actionSuspended_schools(){
        
        Zf_View::zf_displayView('suspended_schools');
        
    }
    
    
    
    
    /**
     * This action executes the schools report view
     */
    public function actionSchools_report(){
        
        Zf_View::zf_displayView('schools_report');
        
    }
    
    
    
    
    /**
     * This action executes the scheduled tasks view
     */
    public function actionScheduled_tasks(){
        
        Zf_View::zf_displayView('scheduled_tasks');
        
    }
    
    
    
    
    /**
     * This action executes the manage resources view
     */
    public function actionManage_resources(){
        
        Zf_View::zf_displayView('manage_resources');
        
    }
    
    
   
    
    /**
     * This action executes the personal profile view
     */
    public function actionMy_profile($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_url($identificationCode);
        
        Zf_View::zf_displayView('my_profile', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the profile update view
     */
    public function actionUpdate_profile($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_url($identificationCode);
        
        Zf_View::zf_displayView('update_profile', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the calendar view
     */
    public function actionMy_calendar(){
        
        Zf_View::zf_displayView('my_calendar');
        
    }
    
    
    
    
    /**
     * This action executes the inbox view
     */
    public function actionMy_inbox(){
        
        Zf_View::zf_displayView('my_inbox');
        
    }
    
    
    
    
    /**
     * This action executes the tasks view
     */
    public function actionMy_tasks(){
        
        Zf_View::zf_displayView('my_tasks');
        
    } 
    
}
?>
