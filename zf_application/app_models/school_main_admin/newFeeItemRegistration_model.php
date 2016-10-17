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

class newFeeItemRegistration_Model extends Zf_Model {
    

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
    public function registerNewFeeItem(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('feeItemYear')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Fee item year')

                                ->zf_postFormData('feeCategory')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Fee category')

                                ->zf_postFormData('schoolClassCode')
                
                                ->zf_postFormData('feeItem')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Fee item')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Fee item')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Fee item')
                
                                ->zf_postFormData('itemAlias')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Item alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Item alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Item alias')
                
                                ->zf_postFormData('feeProportion')
                                ->zf_validateFormData('zf_maximumLength', 3, 'Percentage proportion')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Percentage proportion')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Percentage proportion')
                
                                ->zf_postFormData('itemStatus')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Item status')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        echo "<pre>New Fee Item Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            
        }else{
            
            
            
        }
        
    }
    
    
}

?>
