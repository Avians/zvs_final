<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new hostel onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newSubjectRegistration_Model extends Zf_Model {
    

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
    * Register a new subject within a valid school
    */
    public function registerNewSubject(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('subjectName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Subject name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Subject name')

                                ->zf_postFormData('subjectAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Subject alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject alias')
                
                                ->zf_postFormData('subjectCode')
                                ->zf_validateFormData('zf_maximumLength', 4, 'Subject Code')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Subject Code')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Subject Code')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        echo "<pre>All Subject Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];

        if(empty($this->_errorResult)){
            
           
            
        }else{
            
            
            
        }
        
    }
    
    
}

?>
