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
                
                                ->zf_postFormData('studentBoxAddress')//not required field
                
                                ->zf_postFormData('studentPhoneNumber')//not required field
                
                                ->zf_postFormData('studentLanguage');
        
        
        
        //In this section we chain all guardian related data
        $this->zf_formController->zf_postFormData('guardianDesignation')
                    
                                ->zf_postFormData('guardianFirstName')
                    
                                ->zf_postFormData('guardianMiddleName')//not required field
                
                                ->zf_postFormData('guardianLastName')
                
                                ->zf_postFormData('guardianGender')
                
                                ->zf_postFormData('guardianDateOfBirth')//not required field
                
                                ->zf_postFormData('guardianReligion')//not required field
                
                                ->zf_postFormData('guardianCountry')
        
                                ->zf_postFormData('guardianLocality')
                    
                                ->zf_postFormData('guardianBoxAddress')//not required field
                
                                ->zf_postFormData('guardianPhoneNumber')//not required field
                
                                ->zf_postFormData('guardianRelation')
                
                                ->zf_postFormData('guardianOccupation')//not required field
                
                                ->zf_postFormData('guardianLanguage');
        
        
        
        //In this section we chain all student medical data
        $this->zf_formController->zf_postFormData('isStudentBloodGroup')
        
                                ->zf_postFormData('studentBloodGroup')//not required field
        
                                ->zf_postFormData('isStudentDisable')
        
                                ->zf_postFormData('studentDisability')//not required field
        
                                ->zf_postFormData('isStudentMedicated')
        
                                ->zf_postFormData('studentMedication')//not required field
        
                                ->zf_postFormData('isStudentAllergic')
        
                                ->zf_postFormData('studentAllergic')//not required field
        
                                ->zf_postFormData('isStudentTreatment')
        
                                ->zf_postFormData('studentTreatment')//not required field
        
                                ->zf_postFormData('isStudentPhysician')
        
                                ->zf_postFormData('physicianDesignation')//not required field
        
                                ->zf_postFormData('physicianFirstName')//not required field
        
                                ->zf_postFormData('physicianLastName')//not required field
        
                                ->zf_postFormData('1stMobileNumber')//not required field
        
                                ->zf_postFormData('2ndMobileNumber')//not required field
        
                                ->zf_postFormData('physicianEmailAddress')//not required field
        
                                ->zf_postFormData('physicianBoxAddress')//not required field
        
                                ->zf_postFormData('physicianCountry')//not required field
        
                                ->zf_postFormData('physicianLocality')//not required field
        
                                ->zf_postFormData('isStudentHospital')
        
                                ->zf_postFormData('hospitalName')//not required field
        
                                ->zf_postFormData('1stHospitalNumber')//not required field
        
                                ->zf_postFormData('2ndHospitalNumber')//not required field
        
                                ->zf_postFormData('hospitalEmailAddress')//not required field
        
                                ->zf_postFormData('hospitalBoxAddress')//not required field
        
                                ->zf_postFormData('hospitalCountry')//not required field
        
                                ->zf_postFormData('hospitalLocality');//not required field
        
        
        
        //In this section we chain all student class data
        $this->zf_formController->zf_postFormData('studentClassCode')
        
                                ->zf_postFormData('studentStreamCode')
        
                                ->zf_postFormData('studentYearOfStudy')
        
                                ->zf_postFormData('studentAdmissionNumber');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('studentEmailAddress')
                
                                ->zf_postFormData('studentPassword')
        
                                ->zf_postFormData('studentSchoolRole');
        
        
        
        //In this section we chain all student login data
        $this->zf_formController->zf_postFormData('guardianEmailAddress')
        
                                ->zf_postFormData('guardianPassword')
        
                                ->zf_postFormData('guardianSchoolRole');
        
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        
        //This of debugging purposes only.
        echo "<pre>All Student Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
       
        
    }
    
  
    
    
}

?>
