<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE INITIALIZE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING ALL
 * ACTIONS THAT RELATE TO INITIALIZE MODELS AND VIEWS.
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

class InitializeController extends Zf_Controller {
   
    
    public $zf_defaultAction = "authentication";


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
     * This action executes platform authentication logic.
     */
    public function actionAuthentication($loginStatus = NULL){
        
        @$loginParameters = Zf_SecureData::zf_decode_url($loginStatus);

        if(empty($loginStatus) || $loginStatus = ""){
            
            $this->actionLogin(); exit();
            
        }else if($loginParameters == "processLogin"){
         
            $this->actionProcessLogin(); exit();
            
        }else if($loginParameters == "resetPassword"){
            
            $this->actionResetPassword(); exit();
            
        }
        
    }
    
    
    
     
    /**
     * This action executes the login view
     */
    public function actionLogin(){
        
        Zf_View::zf_displayView('login'); exit();
        
    }
    
    
    
    
    /**
     * This action executes the logout functionality 
     */
    public function actionLogout(){
        
        Zf_SessionHandler::zf_unsetSessionVariable("LoggedIn");
        Zf_SessionHandler::zf_unsetSessionVariable("zvs_identificationCode");
        Zf_SessionHandler::zf_sessionDestroy();
        Zf_GenerateLinks::zf_header_location('initialize');
        
    }
    
    
    
   
    /**
     * This action executes the forgot password view
     */
    public function actionForgot_password(){
        
        Zf_View::zf_displayView('forgotPassword'); exit();
        
    }
    
    
   
    
    /**
     * This action processes user login
     */
    public function actionProcessLogin(){
        
        $this->zf_targetModel->processLogin();
        
    }
    
    
    
    
    /**
     * This action processes user password
     */
    public function actionResetPassword(){
       
        $this->zf_targetModel->resetPassword(); exit();
        
    }
    
    
    
    
    /**
     * This action activates user accounts
     */
    public function actionActivateAccounts($activationParameters){
        
        if($activationParameters != NULL && !empty($activationParameters)){
            
            $activationDetails = Zf_SecureData::zf_decode_url($activationParameters);
            
            $this->zf_targetModel->processActivateUserAccount($activationDetails);
            exit();
            
        }
        
    }
    

}
?>
