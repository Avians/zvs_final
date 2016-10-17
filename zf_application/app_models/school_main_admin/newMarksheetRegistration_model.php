<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible for registration of a new    |
 * |  Marksheet into the school.                                       |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newMarksheetRegistration_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
            
    }
    
    
    
    
   /**
    * Register a new hostel within a valid school
    */
    public function registerNewMarksheet(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('gradeLabel')
                                ->zf_validateFormData('zf_maximumLength', 2, 'Grade label')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Grade label')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade label')

                                ->zf_postFormData('gradeAlias')
                                ->zf_validateFormData('zf_maximumLength', 10, 'Grade alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade alias')
                
                                ->zf_postFormData('gradePoints')
                                ->zf_validateFormData('zf_maximumLength', 2, 'Grade points')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Grade points')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade points')
                
                                ->zf_postFormData('gradeComments')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Grade comments')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Grade comments')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Grade comments')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        echo "<pre>New Grade Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            
        }else{
            
            
            
        }
        
    }
    
    
}

?>
