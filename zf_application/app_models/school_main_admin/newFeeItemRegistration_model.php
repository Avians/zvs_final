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
    
    private $userIdentificationCode;
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
         
         $this->userIdentificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
            
    }
    
    
    
    
   /**
    * Register a new fee item for the school
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
            if($feeCategory == "classFees"){
                $zvs_sqlValues['schoolClassCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolClassCode']);
            }
            
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
    
    
    
    
    /**
     * Register a new fee payment schedule
     */
    public function registerFeePaymentSchedule(){
        
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('paymentYear')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Payment year')

                                ->zf_postFormData('paymentPeriod')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Payment period')
                
                                ->zf_postFormData('paymentProportion')
                                ->zf_validateFormData('zf_maximumLength', 3, 'Payment proportion')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Payment proportion')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Payment proportion')
                
                                ->zf_postFormData('paymentStatus')
                
                                ->zf_postFormData('adminIdentificationCode');
        
         //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>New Payment Schedule Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if(empty($this->_errorResult)){
            
            $paymentPeriod = explode(ZVSS_CONNECT, $this->_validResult['paymentPeriod']);
            $paymentScheduleCode = $paymentPeriod[0].ZVSS_CONNECT.$paymentPeriod[1].ZVSS_CONNECT.$paymentPeriod[2];
            $paymentScheduleName = $paymentPeriod[3];
            $systemSchoolCode = $identificationArray[2];
            
            //check is a similar payment schedule has been registered.
            //We prepare SQL values
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['systemPaymentCode'] = Zf_QueryGenerator::SQLValue($paymentScheduleCode);

                //Here we prepare target column
                $zvs_sqlColumns = array('systemSchoolCode','systemPaymentCode');

                //Check if a similar subject has already been registered
                $zvs_checkPaymentSchedule = Zf_QueryGenerator::BuildSQLSelect("zvs_fees_payment_schedule", $zvs_sqlValues, $zvs_sqlColumns);
                $zvs_executeCheckPaymentSchedule = $this->Zf_AdoDB->Execute($zvs_checkPaymentSchedule);

                if(!$zvs_executeCheckPaymentSchedule){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{
                    
                    
                    if($zvs_executeCheckPaymentSchedule->RecordCount() > 0){

                        //A similar grade has already been registered for the same school
                        Zf_SessionHandler::zf_setSessionVariable("fee_payment_schedule", "existing_payment_schedule_error");

                        $zf_errorData = array("zf_fieldName" => "paymentPeriod", "zf_errorMessage" => "* This fee payment schedule already exists!!.");
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                        Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_fees', $identificationCode);
                        exit();

                    }else{
                        
                        $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                        $zvs_sqlValues['systemPaymentCode'] = Zf_QueryGenerator::SQLValue($paymentScheduleCode);
                        $zvs_sqlValues['paymentScheduleName'] = Zf_QueryGenerator::SQLValue($paymentScheduleName);
                        $zvs_sqlValues['paymentScheduleYear'] = Zf_QueryGenerator::SQLValue($this->_validResult['paymentYear']);
                        $zvs_sqlValues['paymentScheduleProportion'] = Zf_QueryGenerator::SQLValue($this->_validResult['paymentProportion']);
                        $zvs_sqlValues['paymentScheduleStatus'] = Zf_QueryGenerator::SQLValue($this->_validResult['paymentStatus']);
                        $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                        
                        //Insertion sql query and execution
                        $zvs_insertNewPaymentSchedule = Zf_QueryGenerator::BuildSQLInsert("zvs_fees_payment_schedule", $zvs_sqlValues);
                        //echo $zvs_insertNewPaymentSchedule; exit();
                        $zvs_executeInsertNewPaymentSchedule = $this->Zf_AdoDB->Execute($zvs_insertNewPaymentSchedule);

                        if(!$zvs_executeInsertNewPaymentSchedule){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            //Insertion successful
                             Zf_SessionHandler::zf_setSessionVariable("fee_payment_schedule", "fee_payment_schedule_success");
                             Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_fees', $identificationCode);
                             exit();

                        }
                         
                    }
                    
                }
            
            
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("fee_payment_schedule", "fee_payment_schedule_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'manage_fees',$identificationCode);
            exit();
            
        }
        
    }






    /**
     * This method is used to select Admin localities
     */
    public function getPeriodDetails(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $paymentYear = $_POST['paymentYear'];
        
        
        //Here we have all related stream data
        $periodDetails = $this->zvs_fetchPeriodDetails($systemSchoolCode, $paymentYear);
        
        $select_options = '';
        
        
        if($periodDetails == 0){
            
            $select_options .= '<option value="">No periods for '.$paymentYear.'!!</option>';
            
        }else{
            
            foreach ($periodDetails as $periodValue) {
                
                $attendanceName = $periodValue['attendanceName']; $systemAttendanceCode = $periodValue['systemAttendanceCode'];
                
                $select_options .= '<option value="'.$systemAttendanceCode.ZVSS_CONNECT.$attendanceName.'">'.$attendanceName.'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    /**
     * This private method fetches all attendance schedule data
     */
    private function zvs_fetchPeriodDetails($systemSchoolCode, $selectedYear){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["attendanceYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchAttendanceSchedule = Zf_QueryGenerator::BuildSQLSelect('zvs_school_attendance_schedule', $zvs_sqlValue);
        
        $zf_executeFetchAttendanceSchedule = $this->Zf_AdoDB->Execute($fetchAttendanceSchedule);

        if(!$zf_executeFetchAttendanceSchedule){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAttendanceSchedule->RecordCount() > 0){

                while(!$zf_executeFetchAttendanceSchedule->EOF){
                    
                    $results = $zf_executeFetchAttendanceSchedule->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
