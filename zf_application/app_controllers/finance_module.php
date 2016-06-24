<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE FINANCE MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO FINANCE MODULE MODELS AND VIEWS.
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

class finance_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    //Executes the create fees view. Also is the defaukt action for this controller
    public function actionCreate_fees(){
        
        Zf_View::zf_displayView('create_fees');
        
    }
    
    
    //This controller executes collect fees view
    public function actionCollect_fees(){
        
        Zf_View::zf_displayView('collect_fees');
        
    }
    
    
    //This controller executes the finance status view
    public function actionFinance_status(){
        
        Zf_View::zf_displayView('finance_status');
        
    }
    
    
    //This controller executes the assign finances view
    public function actionAssign_finances(){
        
        Zf_View::zf_displayView('assign_finances');
        
    }
    
    
    //This controller executes the fee structure view
    public function actionFee_structure(){
        
        Zf_View::zf_displayView('fee_structure');
        
    }
   
    
    //This controller executes the fee defaulters view
    public function actionFee_defaulters(){
        
        Zf_View::zf_displayView('fee_defaulters');
        
    }

    
    //This controller executes the fee refunds view
    public function actionFee_refunds(){
        
        Zf_View::zf_displayView('fee_refunds');
        
    }

}
?>
