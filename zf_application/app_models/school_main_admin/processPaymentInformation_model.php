<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for processing all payment related |
 * |  informantion with regards to payment vendors                     |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class processPaymentInformation_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
    private $zvs_controller;
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();

        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the active controller
        $this->zvs_controller = $activeURL[0];
         
            
    }
    
    /**
     * This public method is responsible for fetching all school payment details
     */
    public function fetchSchoolPaymentDetails($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_paymentDetailsGridView = '';
        
        //Fetch all school payment vendor categories
        $zvs_paymentVendorCategories = $this->zvs_fetchSchoolVendorCategories($systemSchoolCode);
        
        if($zvs_paymentVendorCategories == 0){
             
             $zvs_paymentDetailsGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                    <div class="zvs-content-titles">
                                                        <h3>Payment Channels Overview Warning!!</h3>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                            <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                            <span class="content-view-errors" >
                                                                &nbsp;There are no vendor categories yet! You need to add atleast one vendor category to have an overview.
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>          
                                            </div>';
             
         }else{
             
             foreach($zvs_paymentVendorCategories as $paymentCategoryValues){
                 
                 $schoolVendorCategoryName = $paymentCategoryValues['schoolVendorCategoryName']; $schoolVendorCategoryCode =  $paymentCategoryValues['schoolVendorCategoryCode'];
                 
                 $zvs_paymentDetailsGridView .=' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                                        <div class="zvs-content-titles">
                                                            <div class="col-lg-12 col-md-12 col-sm-9 col-xs-9">
                                                                <h3 style="padding-left: 10px !important;">'.$schoolVendorCategoryName.'</h3>
                                                            </div>
                                                        </div>';
                 
                                                        //Fetch all actual school payment vendors
                                                        $zvs_actualSchoolVendors = $this->zvs_fetchSchoolActualVendor($schoolVendorCategoryCode);
                                                        
                                                        if($zvs_actualSchoolVendors == 0){
                                                            
                                                            $zvs_paymentDetailsGridView .=' <div class="portlet-body">
                                                                                                <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important; height: 380px !important;">
                                                                                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                                                    <span class="content-view-errors" >
                                                                                                        &nbsp;There are no actual vendors in '.strtolower($schoolVendorCategoryName).' payment channel yet! Once added, you have an overview of all vendors within '.strtolower($schoolVendorCategoryName).'.
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>';
                                                            
                                                        }else{
                                                            
                                                            $zvs_paymentDetailsGridView .=' <div class="portlet-body">
                                                                                                <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                                    <div class="table-responsive">
                                                                                                        <table class="table table-striped table-hover">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th style="width: 25%; font-size: 12px !important;">'.$schoolVendorCategoryName.' Name</th>
                                                                                                                    <th style="width: 20%; font-size: 12px !important;">Account Type</th>
                                                                                                                    <th style="width: 25%; font-size: 12px !important;">Account Name</th>
                                                                                                                    <th style="width: 25%; font-size: 12px !important;">Account Number</th>
                                                                                                                    <!--<th style="width: 5%; font-size: 12px !important;">Details</th>-->
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>';
                                                            
                                                                                                            foreach ($zvs_actualSchoolVendors as $paymentVendoValue) {

                                                                                                                $schoolPaymentVendorCode = $paymentVendoValue['schoolPaymentVendorCode']; $schoolPaymentVendorName = $paymentVendoValue['schoolPaymentVendorName'];
                                                                                                                $zvs_paymentDetailsGridView .= '<tr>'
                                                                                                                                                . '<td>'.$schoolPaymentVendorName.'</td>';
                                                                                                                
                                                                                                                //Fetch all vednor account settings related to selected vendor
                                                                                                                $zvs_vendorAccountSettings = $this->zvs_fetchSchoolVendorSettings($schoolPaymentVendorCode);
                                                                                                                
                                                                                                                if($zvs_vendorAccountSettings == 0){
                                                                                                                    
                                                                                                                    $zvs_paymentDetailsGridView .= '<td style="color: #B94A48 !important; text-align: center;" colspan = "4">No account settings for the vendor'.strtolower($schoolPaymentVendorName).'</td>';
                                                                                                                    
                                                                                                                }else{
                                                                                                                    
                                                                                                                    foreach ($zvs_vendorAccountSettings as $settingValues){
                                                                                                                        
                                                                                                                        $schoolVendorAccountLineCode = $settingValues['schoolVendorAccountLineCode']; $schoolVendorAccountLineName = $settingValues['schoolVendorAccountLineName'];
                                                                                                                        
                                                                                                                        $zvs_paymentDetailsGridView .= '<td>'.$schoolVendorAccountLineName.'</td>';
                                                                                                                        
                                                                                                                        //Here we fetch all school account details
                                                                                                                        $zvs_schoolAccountDetails = $this->zvs_fetchSchoolAccountDetails($schoolVendorAccountLineCode);
                                                                                                                        
                                                                                                                        if($zvs_schoolAccountDetails == 0){
                                                                                                                            
                                                                                                                            $zvs_paymentDetailsGridView .= '<td style="color: #B94A48 !important; text-align: center;" colspan = "3">No account details for '.strtolower($schoolPaymentVendorName).' - '.strtolower($schoolVendorAccountLineName).'</td>';
                                                                                                                            
                                                                                                                        }else{
                                                                                                                            
                                                                                                                            foreach ($zvs_schoolAccountDetails as $accountDetails) {
                                                                                                                                
                                                                                                                                $schoolPaymentAccountCode = $accountDetails['schoolPaymentAccountCode']; $schoolPaymentAccountName = $accountDetails['schoolPaymentAccountName']; $schoolPaymentAccountNumber = $accountDetails['schoolPaymentAccountNumber'];
                                                                                                                                
                                                                                                                                $zvs_paymentDetailsGridView .= '<td>'.$schoolPaymentAccountName.'</td>'
                                                                                                                                                                . '<td>'.$schoolPaymentAccountNumber.'</td>';
                                                                                                                                                                //. '<td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'payment_account_details'.DS.  Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolPaymentAccountCode).' " title="View '.$schoolPaymentVendorName.', '.$schoolVendorAccountLineName.' - '.$schoolPaymentAccountNumber.'" ><i class="fa fa-list"></i></a></td>';
                                                                                                                                
                                                                                                                            }
                                                                                                                            
                                                                                                                        }
                                                                                                                        
                                                                                                                    }
                                                                                                                    
                                                                                                                }
                                                                                                                
                                                                                                                $zvs_paymentDetailsGridView .= '</tr>';
                                                                                                                
                                                                                                            }
                                                                                                            
                                                            $zvs_paymentDetailsGridView .='                 </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>';
                                                            
                                                        }
                 
                 
                 $zvs_paymentDetailsGridView .='    </div>
                                                </div>';
                 
             }
             
         }
         
         echo $zvs_paymentDetailsGridView;
        
    }
    
    
    
    /**
     * This method processes all vendor within the school
     */
    public function processSchoolVendors(){
        
        $vendorCategoryCode = $_POST['vendorCategoryCode'];
        
        
        //Here we have all related library sub categories
        $schoolActualVendors = $this->zvs_fetchSchoolActualVendor($vendorCategoryCode);
        
        $select_options = '';
        
        
        if($schoolActualVendors == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a vendor category</option>';
            
            foreach ($schoolActualVendors as $actualVendorValue) {
                
                $schoolPaymentVendorName = $actualVendorValue['schoolPaymentVendorName']; $schoolPaymentVendorCode = $actualVendorValue['schoolPaymentVendorCode'];
                
                $select_options .= '<option value="'.$schoolPaymentVendorCode.'">'.$schoolPaymentVendorName.'</option>';
                
                
            }
            
        }
              
        echo $select_options;
        
    }
    
    
    
    /**
     * This method processes all vendor settings
     */
    public function processVendorSettings(){
        
        $vendorPaymentCode = $_POST['vendorPaymentCode'];
        
        //echo  '<option value="">'.$vendorPaymentCode.'</option>';
        
        //Here we have all related vendor settings
        $schoolVendorSettings = $this->zvs_fetchSchoolVendorSettings($vendorPaymentCode);
        
        $select_options = '';
        
        
        if($schoolVendorSettings == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a account line</option>';
            
            foreach ($schoolVendorSettings as $vendorValue) {
                
                $schoolVendorAccountLineName = $vendorValue['schoolVendorAccountLineName']; $schoolVendorAccountLineCode = $vendorValue['schoolVendorAccountLineCode'];
                
                $select_options .= '<option value="'.$schoolVendorAccountLineCode.'">'.$schoolVendorAccountLineName.'</option>';
                
                
            }
            
        }
              
        echo $select_options;
        
    }
    
    
    
    /**
     * This method is responsible for the registration of vendor payment category
     */
    public function registerNewVendorPaymentCategory(){
        
        //In this section we chain all staff personal data
        $this->zf_formController->zf_postFormData('categoryName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')
                
                                ->zf_postFormData('categoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
        
                                ->zf_postFormData('adminIdentificationCode');
                
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //Information submitted by
        $registeredBy = $this->_validResult['adminIdentificationCode'];
        
        
        
        //This of debugging purposes only.
        //echo "<pre>All payment data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            
            //Create a vendor category code
            $schoolVendorCategoryCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['categoryName']);
            
            //Check if a similar vendor has already been registered into this school
            $vendorPaymentCategoryValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $vendorPaymentCategoryValues['schoolVendorCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
            
            $vendorPaymentCategoryColumns = array("schoolVendorCategoryCode");

            $zvs_vendorPaymentCategorySqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_categories', $vendorPaymentCategoryValues, $vendorPaymentCategoryColumns);
            
            $zvs_executeVendorPaymentCategorySqlQuery = $this->Zf_AdoDB->Execute($zvs_vendorPaymentCategorySqlQuery);

            if(!$zvs_executeVendorPaymentCategorySqlQuery){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                //Check if a similar payment vendor already exists.
                if($zvs_executeVendorPaymentCategorySqlQuery->RecordCount() > 0){
                    
                    //A similar vendor has already been registered into this school
                    Zf_SessionHandler::zf_setSessionVariable("vendor_category_registration", "existent_payment_vendor_category");

                    $zf_errorData = array("zf_fieldName" => "categoryName", "zf_errorMessage" => "* This vendor category is already registered!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                    exit();

                }else{
                    
                    //Prepare database values for payment vendor registration
                    $vendorPaymentCategoryValues['schoolVendorCategoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['categoryName']);
                    $vendorPaymentCategoryValues['schoolVendorCategoryAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['categoryAlias']);
                    $vendorPaymentCategoryValues['createdBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                    $vendorPaymentCategoryValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $vendorPaymentCategoryValues['vendorCategoryStatus'] = Zf_QueryGenerator::SQLValue(1);
                    
                    //Insert query for new vendor category
                    $insertNewVendorCategorySqlQuery = Zf_QueryGenerator::BuildSQLInsert('zvs_school_payment_vendor_categories', $vendorPaymentCategoryValues);
                    
                    $executeInsertNewVendorCategorySqlQuery = $this->Zf_AdoDB->Execute($insertNewVendorCategorySqlQuery);
                    
                    if(!$executeInsertNewVendorCategorySqlQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                    }else{

                        //A new payment vendor category successfully registered
                        Zf_SessionHandler::zf_setSessionVariable("vendor_category_registration", "payment_vendor_successfully_registered");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                        exit();

                    }
                }

            }
            
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("vendor_category_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
            exit();
            
            
        }
        
    }
    
    
    
    
    /**
     * This method is responsible for the registration of an actual payment vendor
     */
    public function registerNewActualPaymentVendor(){
        
        //In this section we chain all staff personal data
        $this->zf_formController->zf_postFormData('schoolVendorCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor category')
                
                                ->zf_postFormData('vendorName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Vendor name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor name')
                
                                ->zf_postFormData('vendorAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Vendor alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor alias')
        
                                ->zf_postFormData('adminIdentificationCode');
                
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //Information submitted by
        $registeredBy = $this->_validResult['adminIdentificationCode'];
        
        
        
        //This of debugging purposes only.
        //echo "<pre>All payment data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            $schoolVendorCategoryCode = $this->_validResult['schoolVendorCategoryCode'];
            
            //Create a vendor payment code
            $schoolPaymentVendorCode = $schoolVendorCategoryCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['vendorName']);
            
            //Check if a similar vendor has already been registered into this school
            $actualVendorValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $actualVendorValues['schoolVendorCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
            $actualVendorValues['schoolPaymentVendorCode'] = Zf_QueryGenerator::SQLValue($schoolPaymentVendorCode);
            
            $actualVendorColumns = array("schoolVendorCategoryCode", "schoolPaymentVendorCode");

            $zvs_actualVendorsSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_actual_vendors', $actualVendorValues, $actualVendorColumns);
            
            $zvs_executeActualVendorsSqlQuery = $this->Zf_AdoDB->Execute($zvs_actualVendorsSqlQuery);

            if(!$zvs_executeActualVendorsSqlQuery){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                //Check if a similar payment vendor already exists.
                if($zvs_executeActualVendorsSqlQuery->RecordCount() > 0){
                    
                    //A similar vendor has already been registered into this school
                    Zf_SessionHandler::zf_setSessionVariable("actual_vendor_registration", "existent_payment_vendor");

                    $zf_errorData = array("zf_fieldName" => "vendorName", "zf_errorMessage" => "* This payment vendor is already registered!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                    exit();

                }else{
                    
                    //Prepare database values for payment vendor registration
                    $actualVendorValues['schoolPaymentVendorName'] = Zf_QueryGenerator::SQLValue($this->_validResult['vendorName']);
                    $actualVendorValues['schoolPaymentVendorAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['vendorAlias']);
                    $actualVendorValues['createdBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                    $actualVendorValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $actualVendorValues['PaymentVendorStatus'] = Zf_QueryGenerator::SQLValue(1);
                    
                    //Insert query for new vendor category
                    $insertNewVendorSqlQuery = Zf_QueryGenerator::BuildSQLInsert('zvs_school_payment_actual_vendors', $actualVendorValues);
                    
                    $executeInsertNewVendorSqlQuery = $this->Zf_AdoDB->Execute($insertNewVendorSqlQuery);
                    
                    if(!$executeInsertNewVendorSqlQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                    }else{

                        //A new payment vendor successfully registered
                        Zf_SessionHandler::zf_setSessionVariable("actual_vendor_registration", "payment_vendor_successfully_registered");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                        exit();

                    }
                }

            }
            
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("actual_vendor_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
            exit();
            
            
        }
        
    }
    
    
    
    
    /**
     * This method is responsible for the registration of a new payment vendor settings
     */
    public function registerNewPaymentVendorSettings(){
        
        //In this section we chain all staff personal data
        $this->zf_formController->zf_postFormData('schoolVendorCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor category')
                
                                ->zf_postFormData('schoolPaymentVendorCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor name')
                
                                ->zf_postFormData('accountLineName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Line name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Line name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Line name')
                
                                ->zf_postFormData('accountLineAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Line alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Line alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Line alias')
        
                                ->zf_postFormData('adminIdentificationCode');
                
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //Information submitted by
        $registeredBy = $this->_validResult['adminIdentificationCode'];
        
        
        
        //This of debugging purposes only.
        //echo "<pre>All payment data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            $schoolVendorCategoryCode = $this->_validResult['schoolVendorCategoryCode'];
            $schoolPaymentVendorCode = $this->_validResult['schoolPaymentVendorCode'];
            
            //Create a vendor account line code
            $schoolVendorAccountLineCode = $schoolPaymentVendorCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['accountLineName']);
            
            //Check if a similar account line has already been registered into this school
            $actualVendorValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $actualVendorValues['schoolVendorCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
            $actualVendorValues['schoolPaymentVendorCode'] = Zf_QueryGenerator::SQLValue($schoolPaymentVendorCode);
            $actualVendorValues['schoolVendorAccountLineCode'] = Zf_QueryGenerator::SQLValue($schoolVendorAccountLineCode);
            
            $actualVendorColumns = array("schoolPaymentVendorCode", "schoolVendorAccountLineCode");

            $zvs_actualVendorsSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_settings', $actualVendorValues, $actualVendorColumns);
             
            $zvs_executeActualVendorsSqlQuery = $this->Zf_AdoDB->Execute($zvs_actualVendorsSqlQuery);

            if(!$zvs_executeActualVendorsSqlQuery){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                //Check if a similar payment vendor account line already exists.
                if($zvs_executeActualVendorsSqlQuery->RecordCount() > 0){
                    
                    //A similar vendor has already been registered into this school
                    Zf_SessionHandler::zf_setSessionVariable("vendor_account_line_registration", "existent_account_line");

                    $zf_errorData = array("zf_fieldName" => "accountLineName", "zf_errorMessage" => "* This account line is already registered!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                    exit();

                }else{
                    
                    //Prepare database values for payment vendor registration
                    $actualVendorValues['schoolVendorAccountLineName'] = Zf_QueryGenerator::SQLValue($this->_validResult['accountLineName']);
                    $actualVendorValues['schoolVendorAccountLineAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['accountLineAlias']);
                    $actualVendorValues['createdBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                    $actualVendorValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $actualVendorValues['vendorAccountLineStatus'] = Zf_QueryGenerator::SQLValue(1);
                    
                    //Insert query for new vendor category
                    $insertNewVendorAccountLineSqlQuery = Zf_QueryGenerator::BuildSQLInsert('zvs_school_payment_vendor_settings', $actualVendorValues);
                    
                    $executeInsertNewVendorAccountLineSqlQuery = $this->Zf_AdoDB->Execute($insertNewVendorAccountLineSqlQuery);
                    
                    if(!$executeInsertNewVendorAccountLineSqlQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                    }else{

                        //A new vendor account successfully registered
                        Zf_SessionHandler::zf_setSessionVariable("vendor_account_line_registration", "account_line_successfully_registered");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                        exit();

                    }
                }

            }
            
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("vendor_account_line_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
            exit();
            
            
        }
        
    }
    
    
    
    
    /**
     * This method is responsible for the registration of a new paymentschool account
     */
    public function registerNewPaymentVendorAccount(){
        
        //In this section we chain all staff personal data
        $this->zf_formController->zf_postFormData('schoolVendorCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor category')
                                
                                ->zf_postFormData('schoolPaymentVendorCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor name')
                                
                                ->zf_postFormData('schoolVendorAccountLineCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Account line')
                
                                ->zf_postFormData('accountName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Account name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Account name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Account name')
                                
                                ->zf_postFormData('accountNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Account number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Account number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Account number')
                                
                                ->zf_postFormData('accountBranch')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Account Branch')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Account Branch')
        
                                ->zf_postFormData('adminIdentificationCode');
                
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //Information submitted by
        $registeredBy = $this->_validResult['adminIdentificationCode'];
        
        
        
        //This of debugging purposes only.
        //echo "<pre>All payment data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        if(empty($this->_errorResult)){
            
            //This is the school code for the person registering the new student.
            $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy)[2];
            $schoolVendorCategoryCode = $this->_validResult['schoolVendorCategoryCode'];
            $schoolPaymentVendorCode = $this->_validResult['schoolPaymentVendorCode'];
            $schoolVendorAccountLineCode = $this->_validResult['schoolVendorAccountLineCode'];
            
            //Create a school payment account code
            $schoolPaymentAccountCode = $schoolVendorAccountLineCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['accountName']).ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['accountNumber']);
            
            //Check if a similar account line has already been registered into this school
            $schoolAccountValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $schoolAccountValues['schoolVendorCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
            $schoolAccountValues['schoolPaymentVendorCode'] = Zf_QueryGenerator::SQLValue($schoolPaymentVendorCode);
            $schoolAccountValues['schoolVendorAccountLineCode'] = Zf_QueryGenerator::SQLValue($schoolVendorAccountLineCode);
            $schoolAccountValues['schoolPaymentAccountCode'] = Zf_QueryGenerator::SQLValue($schoolPaymentAccountCode);
            
            $schoolAccountColumns = array("schoolVendorAccountLineCode", "schoolPaymentAccountCode");

            $zvs_schoolAccountSqlQuery = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_accounts', $schoolAccountValues, $schoolAccountColumns);
             
            $zvs_executeSchoolAccountSqlQuery = $this->Zf_AdoDB->Execute($zvs_schoolAccountSqlQuery);

            if(!$zvs_executeSchoolAccountSqlQuery){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                //Check if a similar payment vendor account line already exists.
                if($zvs_executeSchoolAccountSqlQuery->RecordCount() > 0){
                    
                    //A similar account number has already been registered
                    Zf_SessionHandler::zf_setSessionVariable("school_account_registration", "existent_school_account");

                    $zf_errorData = array("zf_fieldName" => "accountNumber", "zf_errorMessage" => "* This account number is already registered!!");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                    exit();

                }else{
                    
                    //Prepare database values for account registration
                    $schoolAccountValues['schoolPaymentAccountName'] = Zf_QueryGenerator::SQLValue($this->_validResult['accountName']);
                    $schoolAccountValues['schoolPaymentAccountBranch'] = Zf_QueryGenerator::SQLValue($this->_validResult['accountBranch']);
                    $schoolAccountValues['schoolPaymentAccountNumber'] = Zf_QueryGenerator::SQLValue($this->_validResult['accountNumber']);
                    $schoolAccountValues['createdBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                    $schoolAccountValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $schoolAccountValues['paymentAccountStatus'] = Zf_QueryGenerator::SQLValue(1);
                    
                    //Insert query for new school account
                    $insertNewSchoolAccountSqlQuery = Zf_QueryGenerator::BuildSQLInsert('zvs_school_payment_vendor_accounts', $schoolAccountValues);
                    
                    $executeInsertNewSchoolAccountSqlQuery = $this->Zf_AdoDB->Execute($insertNewSchoolAccountSqlQuery);
                    
                    if(!$executeInsertNewSchoolAccountSqlQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                    }else{

                        //A new school account successfully registered
                        Zf_SessionHandler::zf_setSessionVariable("school_account_registration", "account_successfully_registered");
                        Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
                        exit();

                    }
                }

            }
            
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("school_account_registration", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("school_main_admin", 'configure_payment', $registeredBy);
            exit();
            
            
        }
        
    }
    
    
    
    
    //This private method fetches all details of school vendor categories
    private function zvs_fetchSchoolVendorCategories($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        
        $fetchSchoolVendorCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_categories', $zvs_sqlValue);
        
        $zf_executeFetchSchoolVendorCategories = $this->Zf_AdoDB->Execute($fetchSchoolVendorCategories);

        if(!$zf_executeFetchSchoolVendorCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolVendorCategories->RecordCount() > 0){

                while(!$zf_executeFetchSchoolVendorCategories->EOF){
                    
                    $results = $zf_executeFetchSchoolVendorCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of actual school vendor
    private function zvs_fetchSchoolActualVendor($vendorCategoryCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $vendorCategoryCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolVendorCategoryCode"] = Zf_QueryGenerator::SQLValue($vendorCategoryCode);
        
        
        $fetchSchoolVendors = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_actual_vendors', $zvs_sqlValue);
        
        $zf_executeFetchSchoolVendors = $this->Zf_AdoDB->Execute($fetchSchoolVendors);

        if(!$zf_executeFetchSchoolVendors){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolVendors->RecordCount() > 0){

                while(!$zf_executeFetchSchoolVendors->EOF){
                    
                    $results = $zf_executeFetchSchoolVendors->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of school vendor account lines
    private function zvs_fetchSchoolVendorSettings($vendorPaymentCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $vendorPaymentCode)[0];
        $schoolVendorCategoryCode = $systemSchoolCode.ZVSS_CONNECT.explode(ZVSS_CONNECT, $vendorPaymentCode)[1];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolVendorCategoryCode"] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
        $zvs_sqlValue["schoolPaymentVendorCode"] = Zf_QueryGenerator::SQLValue($vendorPaymentCode);
        
        
        $fetchSchoolVendorAccountLines = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_settings', $zvs_sqlValue);
        
        //echo $fetchSchoolVendorAccountLines; exit();
        
        
        $zf_executeFetchSchoolVendorAccountLines = $this->Zf_AdoDB->Execute($fetchSchoolVendorAccountLines);

        if(!$zf_executeFetchSchoolVendorAccountLines){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolVendorAccountLines->RecordCount() > 0){

                while(!$zf_executeFetchSchoolVendorAccountLines->EOF){
                    
                    $results = $zf_executeFetchSchoolVendorAccountLines->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of school account details
    private function zvs_fetchSchoolAccountDetails($schoolVendorAccountLineCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $schoolVendorAccountLineCode)[0];
        $schoolVendorCategoryCode = $systemSchoolCode.ZVSS_CONNECT.explode(ZVSS_CONNECT, $schoolVendorAccountLineCode)[1];
        $schoolPaymentVendorCode = $schoolVendorCategoryCode.ZVSS_CONNECT.explode(ZVSS_CONNECT, $schoolVendorAccountLineCode)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolVendorCategoryCode"] = Zf_QueryGenerator::SQLValue($schoolVendorCategoryCode);
        $zvs_sqlValue["schoolPaymentVendorCode"] = Zf_QueryGenerator::SQLValue($schoolPaymentVendorCode);
        $zvs_sqlValue["schoolVendorAccountLineCode"] = Zf_QueryGenerator::SQLValue($schoolVendorAccountLineCode);
        
        
        $fetchSchoolAccountDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_payment_vendor_accounts', $zvs_sqlValue);
        
        $zf_executeFetchSchoolAccountDetails = $this->Zf_AdoDB->Execute($fetchSchoolAccountDetails);

        if(!$zf_executeFetchSchoolAccountDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolAccountDetails->RecordCount() > 0){

                while(!$zf_executeFetchSchoolAccountDetails->EOF){
                    
                    $results = $zf_executeFetchSchoolAccountDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
        
        
}

?>
