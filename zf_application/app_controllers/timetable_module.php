<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE TIMETABLE MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO TIMETABLE MODULE MODELS AND VIEWS.
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

class timetable_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "timetable_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    
    
    
    //This action executes the landing page for this module
    public function actionTimetable_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView("timetable_module_introduction", $zf_actionData);
        
    }
    
    
    
    
    //This controller executes create a new timetable view
    public function actionCreate_time_table($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('create_time_table',$zf_actionData);
        
    }
    

}
?>
