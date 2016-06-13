<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ZVS_SUPER_ADMIN CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
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

class Zvs_super_adminController extends Zf_Controller {
   
    
    public $zf_defaultAction = "main_dashboard";
    
    private $identificationCode;


    /**
     * This is the class constructor
     */
    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
        $this->identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
        
    }
   
    

    
    /**
     * This action executes the main dashboard view
     */
    public function actionMain_dashboard(){
        
        Zf_View::zf_displayView('main_dashboard');
        
    }
   
    

    
    /**
     * This action executes the new user view
     */
    public function actionNew_user(){
        
        Zf_View::zf_displayView('new_user');
        
    }
    
    
    
    
    /**
     * This action executes the view super admin view
     */
    public function actionView_super_admin($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_super_admin', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the view super admin view
     */
    public function actionView_platform_admin($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_platform_admin', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the admin directory view
     */
    public function actionAdmin_directory(){
        
        Zf_View::zf_displayView('admin_directory');
        
    }
   
    

    
    /**
     * This action executes the Administrative reports view
     */
    public function actionAdmin_reports(){
        
        Zf_View::zf_displayView('admin_reports');
        
    }
   
    

    
    /**
     * This action executes the new school view
     */
    public function actionNew_school($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('new_school', $zf_actionData);
        
    }
    
    
    
    /**
     * This action executes the view super admin view
     */
    public function actionView_platform_school($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_platform_school', $zf_actionData);
        
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
     * This action executes the resources view
     */
    public function actionManage_resources($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_resources', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes view_modules view
     */
    public function actionView_module_details($moduleDetails){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($moduleDetails);
        
        Zf_View::zf_displayView('view_module_details', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes view_resources view
     */
    public function actionView_resource_details($resourceId){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($resourceId);
        
        Zf_View::zf_displayView('view_resource_details', $zf_actionData);
        
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
    
    
    
    //Methods in this section are for processing data within models
    
    /**
     * This action send the user information to the model for processing
     */
    public function actionUserInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'process_locality'){
            
            //Get the locality of any platform administrator
            $this->zf_targetModel->getAdminLocality();
            
        }else if($filterDataUrl === 'new_super_admin'){
            
            //Register a new platform super administrator 
            $this->zf_targetModel->registerNewSuperAdmin();
            
        }else if($filterDataUrl === 'new_platform_admin'){
            
            //Register a new platform main administrator
            $this->zf_targetModel->registerNewPlatformAdmin();
            
        }
        
    }
    
    
    
    /**
     * This action sends new school data to the model for processing
     */
    public function actionNewSchoolRegistration($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl === 'new_school_form'){
            
            //Register a new school to Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewPlatformSchool();
            
        }
        
    }
    
    
    
    
    /**
     * This action sends new module data to the model for processing
     */
    public function actionNewResourcesRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_module"){
            
            //Register a module to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewModule();
            
        }
        if($filterDataUrl == "new_resource"){
            
            //Register a module to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewResource();
            
        }
        if($filterDataUrl == "edit_module"){
            
            //This action activates or de-actives an existing module. 
            $this->zf_targetModel->editExistingModule();
            
        }
        if($filterDataUrl == "edit_resource"){
            
            //This action activates or de-actives an existing module. 
            $this->zf_targetModel->editExistingResource();
            
        }
        
    }
    

}
?>
