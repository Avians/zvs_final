<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school classes and a new  |
 * |  new streams into the classess.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newStudentRegistration_Model extends Zf_Model {
    
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
     * This method is used to register new student into the school.
     */
    public function registerNewStudent($identificationCode){
        
        
        //echo "We are here!!";
        
         //Here we chain all form data.
        
        //In this section we chain all student personal data
        $this->zf_formController->zf_postFormData('studentFirstName')
                
                                ->zf_postFormData('studentMiddleName')
                
                                ->zf_postFormData('studentLastName')
                
                                ->zf_postFormData('studentGender')
                
                                ->zf_postFormData('studentDateOfBirth')
                
                                ->zf_postFormData('studentReligion')
                
                                ->zf_postFormData('studentCountry')
                
                                ->zf_postFormData('studentLocality')
                
                                ->zf_postFormData('studentBoxAddress')
                
                                ->zf_postFormData('studentPhoneNumber')
                
                                ->zf_postFormData('studentLanguage');
        
        
        
        //In this section we chain all guardian related data
        $this->zf_formController->zf_postFormData('guardianFirstName')
                    
                                ->zf_postFormData('guardianMiddleName')
                
                                ->zf_postFormData('guardianLastName')
                
                                ->zf_postFormData('guardianGender')
                
                                ->zf_postFormData('guardianDateOfBirth')
                
                                ->zf_postFormData('guardianReligion')
                
                                ->zf_postFormData('guardianCountry')
        
                                ->zf_postFormData('guardianLocality')
                    
                                ->zf_postFormData('guardianBoxAddress')
                
                                ->zf_postFormData('guardianPhoneNumber')
                
                                ->zf_postFormData('guardianRelation')
                
                                ->zf_postFormData('guardianOccupation')
                
                                ->zf_postFormData('guardianLanguage');
        
        
        
        //In this section we chain all student medical data
        $this->zf_formController->zf_postFormData('isStudentBloodGroup')
        
                                ->zf_postFormData('studentBloodGroup')
        
                                ->zf_postFormData('isStudentDisable')
        
                                ->zf_postFormData('studentDisability')
        
                                ->zf_postFormData('isStudentMedicated')
        
                                ->zf_postFormData('studentMedication')
        
                                ->zf_postFormData('isStudentAllergic')
        
                                ->zf_postFormData('studentAllergic')
        
                                ->zf_postFormData('isStudentTreatment')
        
                                ->zf_postFormData('studentTreatment')
        
                                ->zf_postFormData('isStudentPhysician')
        
                                ->zf_postFormData('physicianDesignation')
        
                                ->zf_postFormData('physicianFirstName')
        
                                ->zf_postFormData('physicianLastName')
        
                                ->zf_postFormData('1stMobileNumber')
        
                                ->zf_postFormData('2ndMobileNumber')
        
                                ->zf_postFormData('physicianEmailAddress')
        
                                ->zf_postFormData('physicianBoxAddress')
        
                                ->zf_postFormData('physicianCountry')
        
                                ->zf_postFormData('physicianLocality')
        
                                ->zf_postFormData('isStudentHospital')
        
                                ->zf_postFormData('hospitalName')
        
                                ->zf_postFormData('1stHospitalNumber')
        
                                ->zf_postFormData('2ndHospitalNumber')
        
                                ->zf_postFormData('hospitalEmailAddress')
        
                                ->zf_postFormData('hospitalBoxAddress')
        
                                ->zf_postFormData('hospitalCountry')
        
                                ->zf_postFormData('hospitalLocality');
        
        
        
        //In this section we chain all student class data
        $this->zf_formController->zf_postFormData('studentClassCode');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('studentEmail');
        
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        
        //This of debugging purposes only.
        echo "<pre>All Student Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
       
        
    }
    
  
    
    
}

?>
