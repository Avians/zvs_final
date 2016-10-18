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
                                ->zf_validateFormData('zf_minimumLength', 2, 'Fee item')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Fee item')
                
                                ->zf_postFormData('itemAlias')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Item alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Item alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Item alias')
                
                                ->zf_postFormData('itemAmount')
                                ->zf_validateFormData('zf_maximumLength', 10, 'Fee amount')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Fee amount')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Fee amount')
                
                                ->zf_postFormData('itemStatus')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Item status')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>New Fee Item Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
       
        if(empty($this->_errorResult)){
            
            $feeCategory = $this->_validResult['feeCategory'];
            //We create a decision which table to access
            if($feeCategory == "generalFees"){
                
                $zvs_table = "zvs_general_school_fees";
                
            }else if($feeCategory == "classFees"){
                
                $zvs_table = "zvs_class_school_fees";
                
            }
            
            $feeItem = $this->_validResult['feeItem'];
            $feeItemYear = $this->_validResult['feeItemYear'];
            $systemSchoolCode = $identificationArray[2];
            $systemFeeCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($feeItem).ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($feeItemYear);
            
            
            //We prepare SQL values
            $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValues['systemFeeCode'] = Zf_QueryGenerator::SQLValue($systemFeeCode);
            $zvs_sqlValues['feeItem'] = Zf_QueryGenerator::SQLValue($feeItem);
            
            //Here we prepare target column
            $zvs_sqlColumns = array('systemFeeCode','feeItem');
            
            //Check if a similar fee item has already been registered
            $zvs_checkFeeItem = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_sqlValues, $zvs_sqlColumns);
            $zvs_executeCheckFeeItem = $this->Zf_AdoDB->Execute($zvs_checkFeeItem);
            
            
            if(!$zvs_executeCheckFeeItem){
                
                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            }else{
                
                if($zvs_executeCheckFeeItem->RecordCount() > 0){
                    
                    //A similar subject has already been registered for the same school
                    Zf_SessionHandler::zf_setSessionVariable("fee_setup", "existing_feeItem_error");
                    
                    $zf_errorData = array("zf_fieldName" => "feeItem", "zf_errorMessage" => "* This fee Item already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_fees', $identificationCode);
                    exit();
                    
                }else{
                    
                    if($feeCategory == "generalFees"){
                
                        //Prepare all database values
                        foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {

                            if($zvs_fieldName != 'feeCategory' && $zvs_fieldName != 'feeItem' && $zvs_fieldName != 'schoolClassCode' && $zvs_fieldName != 'adminIdentificationCode'){

                                $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);

                            }

                        }

                    }else if($feeCategory == "classFees"){

                        //Prepare all database values
                        foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {

                            if($zvs_fieldName != 'feeCategory' && $zvs_fieldName != 'feeItem' && $zvs_fieldName != 'adminIdentificationCode' ){

                                $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);

                            }

                        }

                    }
                    
                    $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                    
                    //Insertion sql query and execution
                    $zvs_insertNewFeeItem = Zf_QueryGenerator::BuildSQLInsert($zvs_table, $zvs_sqlValues);
                    $zvs_executeInsertNewFeeItem = $this->Zf_AdoDB->Execute($zvs_insertNewFeeItem);
                    
                    if(!$zvs_executeInsertNewFeeItem){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }else{
                        
                        //Insertion successful
                         Zf_SessionHandler::zf_setSessionVariable("fee_setup", "feeItem_setup_success");
                         Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_fees',$identificationCode);
                         exit();
                        
                    }
                    
                }
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("fee_setup", "feeItem_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_exams',$identificationCode);
            exit();
            
        }
        
    }
    
    
}

?>
