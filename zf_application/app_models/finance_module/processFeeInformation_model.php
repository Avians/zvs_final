<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ----------------------------------------------------------------------------
 * |                                                                          |
 * |  This the Model which is responsible for processing all fees information |
 * |  related to a specifice student                                          |
 * |                                                                          |
 * ----------------------------------------------------------------------------
 */

class processFeeInformation_Model extends Zf_Model {
    
    private $_errorResult = array();
    private $_validResult = array();
    
    private $zvs_controller;
    
    //This is the user identification code
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

        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the active controller
        $this->zvs_controller = $activeURL[0];
         
        //Here we assign the current user's identification code
        $this->userIdentificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
        
    }
  
    
    
    
    //This public method is responsible for fetching all the stream information
    public function getStreamDetails(){
        
        $classCode = $_POST['studentClassCode'];
        
        
        //Here we have all related stream data
        $streamDetails = $this->zvs_fetchStreamDetails($classCode);
        
        $select_options = '';
        
        
        if($streamDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a stream</option>';
            
            foreach ($streamDetails as $streamValue) {
                
                $streamName = $streamValue['schoolStreamName']; $streamCode = $streamValue['schoolStreamCode'];
                $streamCapacity = $streamValue['schoolStreamCapacity']; $streamOccupancy = $streamValue['schoolStreamOccupancy'];
                
                if($streamCapacity != $streamOccupancy){
                    
                    $select_options .= '<option value="'.$streamCode.'">'.$streamName.'</option>';
                    
                }
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    //This public method is responsible for fetching all the stream information
    public function getStudentsList(){
        
        $studentStreamCode = $_POST['studentStreamCode'];
        
        
        //Here we have fetch all student class details
        $studentClassDetails = $this->zvs_fetchStudentClassHistory($studentStreamCode, NULL, NULL);
        
        $select_options = '';
        
        
        if($studentClassDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a student</option>';
            
            foreach ($studentClassDetails as $studentClassValue) {
                
                $identificationCode = $studentClassValue['identificationCode'];
                
                $studentPersonalDetails = $this->zvs_fetchStudentsPersonalDetails($identificationCode);
                
                if($studentPersonalDetails == 0){
            
                    $select_options .= '<option value="">No Valid Data!!</option>';

                }else{
                    
                    foreach ($studentPersonalDetails as $studentPersonalValue) {
                        
                        $studentFirstName = $studentPersonalValue['studentFirstName']; $studentLastName = $studentPersonalValue['studentLastName'];
                        $studentAdmissionNumber = $studentPersonalValue['studentAdmissionNumber']; $identificationCode = $studentPersonalValue['identificationCode'];

                        $select_options .= '<option value="'.$identificationCode.'">'.$studentFirstName.' '.$studentLastName.' - ['.$studentAdmissionNumber.']</option>';
                    
                    }
                    
                }
                
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    //This public function returns the entire fee history for the selected student for the selected year
    public function getFeesHistory(){
        
        $feesHistoryIdentifier = $_POST['feesHistoryIdentifier'];
        
        $identificationCode = explode(ZVSS_CONNECT, $feesHistoryIdentifier)[0];
        $feesHistoryYear = explode(ZVSS_CONNECT, $feesHistoryIdentifier)[1];
        
        $studentDetails = $this->zvs_fetchStudentsPersonalDetails($identificationCode);
        $studentClassDetails = $this->zvs_fetchStudentClassHistory(NULL, $identificationCode, $feesHistoryYear);
        
        $this->feesPaymentPeriod = $feesHistoryYear;
         
        $feesHistoryDetails = "";


        foreach ($studentDetails as $studentValue) {

            $studentFirstName = $studentValue['studentFirstName'];$studentMiddleName = $studentValue['studentMiddleName']; 
            $studentLastName = $studentValue['studentLastName'];$studentGender = $studentValue['studentGender'];
            $studentPhoneNumber = $studentValue['studentPhoneNumber'];$studentBoxAddress = $studentValue['studentBoxAddress'];
            $studentAdmissionNumber = $studentValue['studentAdmissionNumber'];

        }

        foreach ($studentClassDetails as $classValue) {

            $systemSchoolCode = $classValue['systemSchoolCode']; $studentClassCode = $classValue['studentClassCode']; $studentStreamCode = $classValue['studentStreamCode'];
            $studentYearOfStudy = $classValue['studentYearOfStudy'];

        }

        $classDetails = $this->zvs_fetchStudentClassDetails($systemSchoolCode, $studentClassCode);
        $streamDetails = $this->zvs_fetchStudentStreamDetails($systemSchoolCode, $studentClassCode, $studentStreamCode);
        $classFeesAmount = $this->zvs_generateClassFeeDetails($systemSchoolCode, $studentClassCode, $feesHistoryYear);
        $studentPaidFees = $this->zvs_fetchFeesPaymentDetails($systemSchoolCode, $studentClassCode, $studentStreamCode, $feesHistoryYear, $identificationCode);
        $reservedAmount = $this->reservedFeesPaymentDetails($systemSchoolCode, $identificationCode);
        
        $generalFeeDetails = $this->pullGeneralFeeDetails($systemSchoolCode, $feesHistoryYear);
        $classFeeDetails = $this->pullClassFeeDetails($systemSchoolCode, $studentClassCode, $feesHistoryYear);
        $pullPaymentSchedule = $this->feePaymentSchedule($systemSchoolCode, $feesHistoryYear);
        
        
        $generalTotalAmount; $classTotalAmount; $totalProportion;
        
//This is for debugging purpose only
//echo "Fees History Year: ".$feesHistoryYear."<br>";
//echo "<pre>Personal Data<br>";
//print_r($studentDetails);
//echo "</pre>";
//
//echo "<pre>Class Data for ".$feesHistoryYear." <br>";
//print_r($studentClassDetails);
//echo "</pre>";


//exit();
        
        foreach ($generalFeeDetails as $generalFeeValues) {

            $itemAmount = $generalFeeValues['itemAmount']; $generalTotalAmount = $generalTotalAmount + $itemAmount;

        }

        foreach ($classFeeDetails as $classFeeValues) {

            $itemAmount = $classFeeValues['itemAmount']; $classTotalAmount = $classTotalAmount + $itemAmount;

        }
        
        foreach ($pullPaymentSchedule as $paymentProportionValue){
            
            $paymentScheduleProportion = $paymentProportionValue['paymentScheduleProportion']; $totalProportion = $totalProportion + $paymentScheduleProportion;
         
        }
        
        $totalAmount = $generalTotalAmount + $classTotalAmount;

        $feesHistoryDetails .= '<div id="allStudentFeesData" class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 200px !important; height: auto !important;">
                                <div class="portlet-titles">Student Details</div>
                                <div class="row portlet-body" style="margin-top: 20px !important; min-height: 80px !important;">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-10 margin-bottom-20">
                                        <div class="zvs-circular">   
                                            <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-condensed table-responsive table-hover">
                                                <tbody>
                                                    <tr><td><i class="fa fa-user zvs-user-profile"></i></td><td>'.$studentFirstName.' '.$studentMiddleName.' '.$studentLastName.'</td></tr>
                                                    <tr><td><i class="fa fa-hashtag zvs-user-profile"></i></td><td>'.$studentAdmissionNumber.'</td></tr>
                                                    <tr><td><i class="fa fa-phone zvs-user-profile"></i></td><td>'.$studentPhoneNumber.'</td></tr>
                                                    <tr><td><i class="fa fa-envelope zvs-user-profile"></i></td><td>'.$studentBoxAddress.'</td></tr>
                                                    <tr><td><i class="fa fa-transgender zvs-user-profile"></i></td><td>'.$studentGender.'</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-titles">Scheduled Payment Details</div>
                                <div class="row portlet-body" style="min-height: 80px !important;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-condensed table-responsive table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 25%; text-align: right; padding-right: 5px;">Schedule Name</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 10px;">Paid Fees</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 10px;">Due Fees</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 10px;">Total Fees</th>
                                                        <th style="width: 5%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                        if($pullPaymentSchedule == 0){
                                                    
                                                            $feesHistoryDetails .= '<tr><td colspan="4" class="alert alert-danger" style="text-align: center !important; background-color: #F2DEDE !important;">No fees schedules for the year '.$feesHistoryYear.' for '.$studentFirstName.' '.$studentMiddleName.'!!</td><td style="background-color: #FFFFFF !important; border-right: 1px solid #dddddd; !important;"><a id="missingFeesSchedule" style="text-decoration: none !important;"><span class="zvs-tooltip-indicator-wrapper quiz-button-red" id="missingFeesSchedule_helper"><strong>?</strong></span></a></td></tr>'; 

                                                         }else{
                                                             
                                                             $totalPaidFees; $totalDuesFees; $totalPayableFees;

                                                             foreach ($pullPaymentSchedule as $paymentValues) {

                                                                 $paymentScheduleName = $paymentValues['paymentScheduleName']; $systemPaymentCode = $paymentValues['systemPaymentCode']; $paymentProportion = $paymentValues['paymentScheduleProportion'];
                                                                 
                                                                 
                                                                 //1. For each payment schedule find total paid
                                                                 $feesPaid = $this->zvs_fetchFeesPaymentDetails($systemSchoolCode, $studentClassCode, $studentStreamCode, $feesHistoryYear, $identificationCode, $systemPaymentCode);
                                                                 
                                                                 //2. For each payment schedule calculate total amount payable
                                                                 $totalFees = ($totalAmount * $paymentProportion)/$totalProportion; 
                                                                 
                                                                 //3. For each payment schedule calculate payment due
                                                                 $feesDue = $totalFees - $feesPaid;
                                                                 
                                                                 $totalPaidFees = $totalPaidFees + $feesPaid;
                                                                 $totalDuesFees = $totalDuesFees + $feesDue;
                                                                 $totalPayableFees = $totalPayableFees + $totalFees;
                                                                 
                                                                 $feesStatus = ($feesPaid == $totalFees  ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
                                                                 
                                                                 $feesHistoryDetails .= '<tr style="font-weight: bold !important; font-size: 10px !important;"><td style="text-align: right; padding-right: 5px; width: 25%;">'.$paymentScheduleName.':</td>'
                                                                         . '<td style="text-align: right; padding-right: 15px; width: 20%; color:#3c763d;">'.number_format($feesPaid, 2).'</td>'
                                                                         . '<td style="text-align: right; padding-right: 15px; width: 20%; color:#a94442;">'.number_format($feesDue, 2).'</td>'
                                                                         . '<td style="text-align: right; padding-right: 15px; width: 20%;">'.number_format($totalFees, 2).'</td>'
                                                                         . '<td style="width: 5%;">'.$feesStatus.'</td></tr>';
                                                             }
                                                         }
                                                
                        $feesHistoryDetails .= '</tbody>
                                                <tfoot>
                                                    <tr style="font-weight: bolder !important; font-size: 11px !important;">
                                                        <th style="width: 25%; text-align: right; padding-right: 5px;">Total Fees:</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 15px;">'.number_format($totalPaidFees, 2).'</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 15px;">'.number_format($totalDuesFees, 2).'</th>
                                                        <th style="width: 20%; text-align: right; padding-right: 15px;">'.number_format($totalPayableFees, 2).'</th>
                                                        <th style="width: 5%;"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="portlet-titles">Overall Payment Details</div>
                                <div class="row" style="margin-top: 20px !important;">
                                    <div class="col-md-12" style="text-align: right;">
                                        <style type="text/css">
                                            .all-zvs-tooltips{ width: 300px; !important;}
                                            .qtip-tipped .qtip-titlebar {color: #21B4E2;}
                                        </style>
                                        <div class="right" style="background-color:#73CBE8; width: 10% auto; float: right; padding: 5px 5px 3px 5px; text-align:right; font-weight: bolder; color:#ffffff;">
                                            <a id="reservedSchoolFees" style="text-decoration: none !important;"><span class="zvs-tooltip-indicator-wrapper quiz-button-white" id="reservedSchoolFees_helper"><strong>?</strong></span></a>&nbsp;
                                            Excess Payment:&nbsp; '.number_format($reservedAmount, 2, ".", ",").'
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="feesPaymentDataChart">';

                                    $feesHistoryDetails .= $this->plotFeesPaymentPieChart($classFeesAmount, $studentPaidFees, $feesHistoryYear, $identificationCode);

            $feesHistoryDetails .= '</div>';
            
                                if($pullPaymentSchedule != 0){
                
            $feesHistoryDetails .= '<div class="col-md-12" id="dividerLine"><hr></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a href="#feesPaymentDataChart" style="text-decoration: none !important;">
                                            <button id="feesCollectionButton" type="button" class="btn zvs-buttons center-block" style="color: #ffffff !important;">
                                                Collect School Fees
                                            </button>
                                        </a>
                                    </div>';
                                }   
        $feesHistoryDetails .= '</div>
                            </div>
                            <script type="text/javascript">

                                //A click on this button loads the fee collection form
                                $("#feesCollectionButton").click(function(){

                                    $("#collectFeesContainer").fadeIn(2000, function(){

                                    });

                                });


                                //This shows the reserved fees tool-tip
                                $("#reservedSchoolFees").qtip({

                                    content: {
                                        title: "Excess Payment",
                                        text: "<p>Excess payment is an amount of money <b><u>over-paid</u></b> by the student as school fees, and which can be allocated as school fees for subsequent fee payment periods. Money is reserved, everytime a student pays more than the existing fees balance for a selected fees payment period.</p>",
                                        button: false
                                    },
                                    hide: {
                                        event: "mouseleave",
                                        fixed: true 
                                    },
                                    position: {
                                        my: "right center", // Position my top left...
                                        at: "bottom left", // at the bottom right of...
                                        adjust: { x: 5, y: -6 },
                                        target: $("#reservedSchoolFees_helper") // my target
                                    },
                                    style: "qtip-tipped qtip-shadow qtip-rounded all-zvs-tooltips"

                                }),
                                
                                //This shows the reserved fees tool-tip
                                $("#missingFeesSchedule").qtip({

                                    content: {
                                        title: "Missing Fees Schedules",
                                        text: "<p>The student might have been out of class or didn\'t attend class for the year whose fees schedule is under review. Also, there might have not been fees schedule for the year under review. Therefore you shouldn\'t collect fees for this student for the specified period!!</p>",
                                        button: false
                                    },
                                    hide: {
                                        event: "mouseleave",
                                        fixed: true 
                                    },
                                    position: {
                                        my: "left center", // Position my top left...
                                        at: "bottom left", // at the bottom right of...
                                        adjust: { x: 13, y: -6 },
                                        target: $("#missingFeesSchedule_helper") // my target
                                    },
                                    style: "qtip-tipped qtip-shadow qtip-rounded all-zvs-tooltips"

                                });


                            </script>';


        echo $feesHistoryDetails;
        
    }
    
    
    
    
    //This private method fetches student class detials for a given selected stream.
    private function zvs_fetchStudentClassHistory($studentsStreamCode = NULL, $identificationCode = NULL, $feesHistoryYear = NULL){
        
        $currentYear = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
        
        
        //This replicates the various use-cases of this function
        //1. identificationCode and feesHistoryyear are empty
        if(($studentsStreamCode != NULL) && ($identificationCode === NULL) && ($feesHistoryYear === NULL)){
            
            $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentsStreamCode);
            $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($currentYear);
            
            $fetchStudentClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_class_details', $zvs_sqlValue);
            
        }
        //2. studentStreamCode is empty
        else if(($studentsStreamCode === NULL) && ($identificationCode != NULL) && ($feesHistoryYear != NULL)){
            
            $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
            $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($feesHistoryYear);
            
            $zvs_table = "";
            
            if($currentYear == $feesHistoryYear){
                
                $zvs_table = "zvs_students_class_details";
                
            }else if($currentYear != $feesHistoryYear){
                
                $zvs_table = "zvs_students_class_history";
                
            }
            
            $fetchStudentClassDetails = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_sqlValue);
            
        }
        //3. studentStreamCode and feesHistoryYear are empty
        else if(($studentsStreamCode === NULL) && ($identificationCode != NULL) && ($feesHistoryYear === NULL)){
            
            $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
            $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($currentYear);
            
            $fetchStudentClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_class_details', $zvs_sqlValue);
            
        }
        
        
        
        
//        if(empty($identificationCode) || $identificationCode == ""){
//            
//            $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentsStreamCode);
//            $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($currentYear);
//            
//        }else{
//            
//            $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
//            
//        }
        
        
        $zf_executeFetchStudentClassDetails = $this->Zf_AdoDB->Execute($fetchStudentClassDetails);

        if(!$zf_executeFetchStudentClassDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentClassDetails->RecordCount() > 0){

                while(!$zf_executeFetchStudentClassDetails->EOF){
                    
                    $results = $zf_executeFetchStudentClassDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches streams detials for a given selected class.
    private function zvs_fetchStreamDetails($schoolClassCode){
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSchoolStreams = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStreams = $this->Zf_AdoDB->Execute($fetchSchoolStreams);

        if(!$zf_executeFetchSchoolStreams){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStreams->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStreams->EOF){
                    
                    $results = $zf_executeFetchSchoolStreams->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
  
    
  
    
    //This private method fetches student class detials for a given selected stream.
    private function zvs_fetchStudentsPersonalDetails($identificationCode){
         
        $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $fetchStudentPersonalDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_personal_details', $zvs_sqlValue);
        
        $zf_executeFetchStudentPersonalDetails = $this->Zf_AdoDB->Execute($fetchStudentPersonalDetails);

        if(!$zf_executeFetchStudentPersonalDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentPersonalDetails->RecordCount() > 0){

                while(!$zf_executeFetchStudentPersonalDetails->EOF){
                    
                    $results = $zf_executeFetchStudentPersonalDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    private function zvs_fetchStudentClassDetails($systemSchoolCode, $studentClassCode) {
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        
        $fetchClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        //$zf_executeFetchClassDetails = $this->Zf_AdoDB->Execute($fetchClassDetails);

        if(!$this->Zf_QueryGenerator->Query($fetchClassDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$fetchClassDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $className = $this->Zf_QueryGenerator->Row()->schoolClassName;
                    
                    return $className;
                }

            }
        }
        
    }
    
    
    
    
    private function zvs_fetchStudentStreamDetails($systemSchoolCode, $studentClassCode, $studentStreamCode) {
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        
        $fetchStreamDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        //$zf_executeFetchClassDetails = $this->Zf_AdoDB->Execute($fetchClassDetails);

        if(!$this->Zf_QueryGenerator->Query($fetchStreamDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$fetchStreamDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $className = $this->Zf_QueryGenerator->Row()->schoolStreamName;
                    
                    return $className;
                }

            }
        }
        
    }
    
    
    
    
    /**
     * This method is vital in loading splash screen for fee structure page
     */
    private function zvs_generateClassFeeDetails($systemSchoolCode, $schoolClassCode, $selectedYear){

       
       $generalFeeDetails = $this->pullGeneralFeeDetails($systemSchoolCode, $selectedYear);
       
       $classFeeDetails = $this->pullClassFeeDetails($systemSchoolCode, $schoolClassCode, $selectedYear);
       
       
       $generalTotalAmount; $classTotalAmount; $totalProportion;

        foreach ($generalFeeDetails as $generalFeeValues) {

            $itemAmount = $generalFeeValues['itemAmount']; $generalTotalAmount = $generalTotalAmount + $itemAmount;

        }

        foreach ($classFeeDetails as $classFeeValues) {

            $itemAmount = $classFeeValues['itemAmount']; $classTotalAmount = $classTotalAmount + $itemAmount;

        }
        
        
        $totalAmount = $generalTotalAmount + $classTotalAmount;
        
        return number_format($totalAmount, 2);
        
    }
    
    
    
    
    /**
     * This private method pulls all fee payment schedule for a selected year
     */
    private function feePaymentSchedule($systemSchoolCode, $selectedYear, $systemPaymentCode = NULL){
        
        if(!empty($systemPaymentCode) && $systemPaymentCode != NULL && $systemPaymentCode != ""){
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["systemPaymentCode"] = Zf_QueryGenerator::SQLValue($systemPaymentCode);
            $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
            
            $fetchFeePaymentSchedule = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_schedule', $zvs_sqlValue);
        
            if(!$this->Zf_QueryGenerator->Query($fetchFeePaymentSchedule)){

                $message = "Query execution failed.<br><br>";
                $message.= "The failed Query is : <b><i>{$fetchFeePaymentSchedule}.</i></b>";
                echo $message; exit();

            }else{

                $resultCount = $this->Zf_QueryGenerator->RowCount();

                if($resultCount > 0){

                    $this->Zf_QueryGenerator->MoveFirst();

                    while(!$this->Zf_QueryGenerator->EndOfSeek()){

                        $paymentProportion = $this->Zf_QueryGenerator->Row()->paymentScheduleProportion;

                        return $paymentProportion;
                    }

                }
            }
            
        }else{

            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($selectedYear);

            $fetchFeePaymentSchedule = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_schedule', $zvs_sqlValue);

            //echo $fetchClassFeeItems; exit();

            $zf_executeFetchFeePaymentSchedule = $this->Zf_AdoDB->Execute($fetchFeePaymentSchedule);

            if(!$zf_executeFetchFeePaymentSchedule){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{

                if($zf_executeFetchFeePaymentSchedule->RecordCount() > 0){

                    while(!$zf_executeFetchFeePaymentSchedule->EOF){

                        $results = $zf_executeFetchFeePaymentSchedule->GetRows();

                    }

                    return $results;


                }else{

                    return 0;

                }
            }
            
        }
        
        
        
    }
    
    
    
    
    /**
     * This private function pulls general fee details
     */
    private function pullGeneralFeeDetails($systemSchoolCode, $selectedYear){
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchGeneralFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_general_school_fees', $zvs_sqlValue);
        
        //echo $fetchGeneralFeeItems;
        
        $zf_executeFetchGeneralFeeItems= $this->Zf_AdoDB->Execute($fetchGeneralFeeItems);

        if(!$zf_executeFetchGeneralFeeItems){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchGeneralFeeItems->RecordCount() > 0){

                while(!$zf_executeFetchGeneralFeeItems->EOF){
                    
                    $results = $zf_executeFetchGeneralFeeItems->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This private function pulls class fee details
     */
    private function pullClassFeeDetails($systemSchoolCode, $schoolClassCode, $selectedYear){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchClassFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_class_school_fees', $zvs_sqlValue);
        
        //echo $fetchClassFeeItems; exit();
        
        $zf_executeFetchClassFeeItems= $this->Zf_AdoDB->Execute($fetchClassFeeItems);

        if(!$zf_executeFetchClassFeeItems){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassFeeItems->RecordCount() > 0){

                while(!$zf_executeFetchClassFeeItems->EOF){
                    
                    $results = $zf_executeFetchClassFeeItems->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This private function pulls reserved fees details
     */
    private function pullReservedFeesDetails($systemSchoolCode, $studentIdentificationCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        
        $fetchReservedFeesItems = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_reserved', $zvs_sqlValue);
        
        //echo $fetchClassFeeItems; exit();
        
        $zf_executeFetchReservedFeesItems = $this->Zf_AdoDB->Execute($fetchReservedFeesItems);

        if(!$zf_executeFetchReservedFeesItems){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchReservedFeesItems->RecordCount() > 0){

                while(!$zf_executeFetchReservedFeesItems->EOF){
                    
                    $results = $zf_executeFetchReservedFeesItems->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This private methods works out the amount of fees paid by a selected student for a selected year
     */
    private function zvs_fetchFeesPaymentDetails($systemSchoolCode, $schoolClassCode, $studentStreamCode, $feesHistoryYear, $identificationCode, $paymentPeriod = NULL){
        
      
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($feesHistoryYear);
        
        if($paymentPeriod != NULL && !empty($paymentPeriod)){
            
            $zvs_sqlValue["paymentScheduleName"] = Zf_QueryGenerator::SQLValue($paymentPeriod);
            
        }
        
        $fetchFeePaymentAmounts = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_detials', $zvs_sqlValue);
        
        $studentFeesPaymentDetails = $this->zvs_fetchFeesDetails($fetchFeePaymentAmounts);
        
        $totalFeesPaid;

        foreach ($studentFeesPaymentDetails as $feesPaymentValues) {

            $paymentAmount = $feesPaymentValues['paymentAmount']; $totalFeesPaid = $totalFeesPaid + $paymentAmount;

        }
        
        return $totalFeesPaid;
        
    }
    
    
    
    
    /**
     * This private method fetches all the data about reserved fees payment
     */
    private function reservedFeesPaymentDetails($systemSchoolCode, $studentIdentificationCode){
        
        //Fetch all the reserved fees for the student in question
        $reservedFeesDetails = $this->pullReservedFeesDetails($systemSchoolCode, $studentIdentificationCode);
        
        $reservedAmount;
        
        foreach ($reservedFeesDetails as $reservedFeesValues) {

            $reservedFeesAmount = $reservedFeesValues['reservedAmount']; $reservedAmount = $reservedAmount + $reservedFeesAmount;

        }
        
        
        return $reservedAmount;
        
    }

    



    /**
     * This private works out pulls the actual fees payment details
     */
    private function zvs_fetchFeesDetails($studentFeesQuery){
        
        $zf_executeFetchFeesPaymentAmounts = $this->Zf_AdoDB->Execute($studentFeesQuery);

        if(!$zf_executeFetchFeesPaymentAmounts){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchFeesPaymentAmounts->RecordCount() > 0){

                while(!$zf_executeFetchFeesPaymentAmounts->EOF){
                    
                    $results = $zf_executeFetchFeesPaymentAmounts->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        } 
        
    }
    
    
    
    
    /**
     * This private method plots the pie charts that shows how the student has paid school fees.
     */
    private function plotFeesPaymentPieChart($classFeesAmount, $studentPaidFees, $feesHistoryYear, $studentIdentificationCode){
        
        $totalFees = filter_var($classFeesAmount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $paidFees = filter_var($studentPaidFees, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        //$totalFees = 46000.00;
        //$paidFees = 23000.00;
        $dueFees = $totalFees - $paidFees;
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Doughnut2D",
            "ChartID" => "feePaymentCharts".$feesHistoryYear.$studentIdentificationCode,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "280",
            "ChartContainer" => "feesPaymentDataChart",
            "ChartDataFormat" =>  "json",
        );
        
        
        //These chart properties add to the beauty of the chart
        $chartProperties = '
            
                            "chart":{
                                "bgColor": "#ffffff",
                                "pieRadius": "85",
                                "showBorder": "0",
                                "use3DLighting": "0",
                                "showShadow": "0",
                                "showLabels": "1", 
                                "enableSmartLabels": "1",
                                "showValues": "1",
                                "startingAngle": "120",
                                "slicingDistance" : "8",
                                "showPercentValues": "1",
                                "showPercentInTooltip": "0",
                                "defaultCenterLabel": "Total Fees Kshs:<br>'.number_format($totalFees, 2).'",
                                "centerLabel": "$label $value",
                                "centerLabelBold": "1",
                                "decimals": "0",
                                "captionFontSize": "14",
                                "subcaptionFontSize": "14",
                                "subcaptionFontBold": "0",
                                "toolTipColor": "#ffffff",
                                "toolTipBorderThickness": "0",
                                "toolTipBgColor": "#000000",
                                "toolTipBgAlpha": "80",
                                "toolTipBorderRadius": "10",
                                "toolTipPadding": "5",
                                "showHoverEffect": "1",
                                "showLegend": "1",
                                "legendBgColor": "#ffffff",
                                "legendBorderAlpha": "0",
                                "legendShadow": "0",
                                "legendItemFontSize": "10",
                                "legendItemFontColor": "#666666",
                                "legendPosition": "right",
                                "legendCaptionAlignment": "left",
                                "useDataPlotColorForLabels": "1",
                                "numberPrefix": " Kshs: ",
                                "formatNumberScale": "0",
                                "decimalSeparator": ".",
                                "thousandSeparator": ",",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        $chartData = '
                    "data": [
                        {
                            "label": "Fees Paid",
                            "value": "'.$paidFees.'",
                            "color": "#73A99B"
                        },
                        {
                            "label": "Fees Due",
                            "value": "'.$dueFees.'",
                            "color": "#2A5653"   
                        } 
                    ]   
                ';
        
        
        //Here we generate the actual chart
        return Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
        //return $feesHistoryYear;
    }
    
    
    
    
    /**
     * This method generates a prefilled form with student details
     */
    public function generateStudentForm() {
        
        $feesHistoryIdentifier = $_POST['feesHistoryIdentifier'];
        
        $studentIdentificationCode = explode(ZVSS_CONNECT, $feesHistoryIdentifier)[0];
        $feesHistoryYear = explode(ZVSS_CONNECT, $feesHistoryIdentifier)[1];
        
        $studentDetails = $this->zvs_fetchStudentsPersonalDetails($studentIdentificationCode);
        $studentClassDetails = $this->zvs_fetchStudentClassHistory(NULL, $studentIdentificationCode, $feesHistoryYear);
        $studentCurrentClasslassDetails = $this->zvs_fetchStudentClassHistory(NULL, $studentIdentificationCode, NULL);
        
        
        
        $studentPrefilledForm = "";
        
        
        foreach ($studentDetails as $studentValue) {
            
            $studentFullName = $studentValue['studentFirstName']." ".$studentValue['studentMiddleName']." ".$studentValue['studentLastName'];
            
        }
        
        foreach ($studentClassDetails as $classValue) {
            
            $systemSchoolCode = $classValue['systemSchoolCode']; $studentClassCode = $classValue['studentClassCode']; $studentStreamCode = $classValue['studentStreamCode'];
            $studentYearOfStudy = $classValue['studentYearOfStudy']; $studentAdmissionNumber = $classValue['studentAdmissionNumber'];
            
        }
        
        foreach ($studentCurrentClasslassDetails as $currentClassValue) {
            
            $currentSystemSchoolCode = $currentClassValue['systemSchoolCode']; $currentClassCode = $currentClassValue['studentClassCode']; $currentStreamCode = $currentClassValue['studentStreamCode'];
            
        }
        
        $classDetails = $this->zvs_fetchStudentClassDetails($currentSystemSchoolCode, $currentClassCode);
        $streamDetails = $this->zvs_fetchStudentStreamDetails($currentSystemSchoolCode, $currentClassCode, $currentStreamCode);
        
        
        $studentPrefilledForm .='
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Full Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="studentFullName" class="form-control" readonly value="'.$studentFullName.'">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Admission No:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="studentAdmissionNumber" class="form-control" readonly value="'.$studentAdmissionNumber.'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Student Class:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="studentClassName" class="form-control" readonly value="'.$classDetails.'">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Student Stream:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="studentStreamName" class="form-control" readonly value="'.$streamDetails.'">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                            <!--These are hidden fields with students class data-->
                            <input type="hidden" class="form-control" name="studentIdentificationCode" value="'.$studentIdentificationCode.'">
                            <input type="hidden" class="form-control" name="systemSchoolCode" value="'.$systemSchoolCode.'">
                            <input type="hidden" class="form-control" name="studentClassCode" value="'.$studentClassCode.'">
                            <input type="hidden" class="form-control" name="studentStreamCode" value="'.$studentStreamCode.'">
                            
                        ';
        
        echo $studentPrefilledForm;
        
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
            
            $select_options .= '<option value="">No payment periods for '.$paymentYear.'!!</option>';
            
        }else{
            
            foreach ($periodDetails as $periodValue) {
                
                $paymentScheduleName = $periodValue['paymentScheduleName']; $systemPaymentCode = $periodValue['systemPaymentCode'];
                
                $select_options .= '<option value="'.$systemPaymentCode.'">'.$paymentScheduleName.'</option>';
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    /**
     * This private method fetches all attendance schedule data
     */
    private function zvs_fetchPeriodDetails($systemSchoolCode, $selectedYear){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchAttendanceSchedule = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_schedule', $zvs_sqlValue);
        
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
    
    
    
    
    /**
     * This public method records information about the collected school fees.
     */
    public function collectSchoolFees(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('studentFullName')

                                ->zf_postFormData('studentAdmissionNumber')
                
                                ->zf_postFormData('studentClassName')
                
                                ->zf_postFormData('studentStreamName')
                
                                ->zf_postFormData('studentClassName')
                
                                ->zf_postFormData('paymentScheduleYear')
                
                                ->zf_postFormData('paymentScheduleName')
                
                                ->zf_postFormData('paymentSource')
                
                                ->zf_postFormData('paymentAmount')
                
                                //This is hidden form data    
                                ->zf_postFormData('systemSchoolCode')
                                ->zf_postFormData('studentClassCode')
                                ->zf_postFormData('studentStreamCode')
                                ->zf_postFormData('studentIdentificationCode')
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //echo $paymentAmount = (double)str_replace(',', '', $this->_validResult['paymentAmount'])."<br>";
        
        //This is for debugging purposes only.
        //echo "<pre>School Fees Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        
        $adminIdentificationCode = $this->_validResult['adminIdentificationCode'];
        $adminIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($adminIdentificationCode);
        
        
        if(empty($this->_errorResult)){
            
            $systemSchoolCode = $this->_validResult['systemSchoolCode'];
            $studentClassCode = $this->_validResult['studentClassCode'];
            $studentStreamCode = $this->_validResult['studentStreamCode'];
            $paymentScheduleYear = $this->_validResult['paymentScheduleYear'];
            $paymentScheduleName = $this->_validResult['paymentScheduleName'];
            $studentIdentificationCode = $this->_validResult['studentIdentificationCode'];
            $studentAdmissionNumber = $this->_validResult['studentAdmissionNumber'];
            $paymentAmount = (float)str_replace(',', '', $this->_validResult['paymentAmount']);
            $paymentSource = $this->_validResult['paymentSource'];
            
            
            //0. Get the fees payment percentage proportion for the selected year and the selected payment period
            $feePaymentProportion = ($this->feePaymentSchedule($systemSchoolCode, $paymentScheduleYear, $paymentScheduleName)/100);
            //echo "Payment Proportion for selected year and period:".($feePaymentProportion*100)." %<br><br>";

            //1. Get the fees supposed to be paid for the selected year and the selected payment period, say X
            $totalFeesAmount = (filter_var($this->zvs_generateClassFeeDetails($systemSchoolCode, $studentClassCode, $paymentScheduleYear), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)*$feePaymentProportion);
            //echo "Total Fees to be paid for selected year and period: ".$totalFeesAmount."<br><br>";

            //2. Get the fees already paid by the student for the selected year and the selected payment period, say Y
            $amountAlreadyPaid = filter_var($this->zvs_fetchFeesPaymentDetails($systemSchoolCode, $studentClassCode, $studentStreamCode, $paymentScheduleYear, $studentIdentificationCode, $paymentScheduleName), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            //echo "Total fees already paid for selected year and period: ".$amountAlreadyPaid."<br><br>";

            //3. Work out the fees balance for the paying student by calculating X-Y = Z
            $feesBalance  = $totalFeesAmount - $amountAlreadyPaid;
            //echo "Total current fees balance for selected year and period: ".$feesBalance."<br><br>";
            
            
            //4. Amount currently paid by the student as school fees
            //echo "Current amount of money paid by the student as fees: ".$paymentAmount."<br><br>";
            
            //5. Let check if the student has any accummulates excess payment
            $amountInReserve = $this->reservedFeesPaymentDetails($systemSchoolCode, $studentIdentificationCode);
            //echo "Excess amount for the selected student: ".$amountInReserve."<br><br>";
            
            
            //7. Total amount that can be used to settle current fees balance for the selected year and period
            $totalPayableAmount = $paymentAmount + $amountInReserve;
            //echo "Total amount available for settling school fees: ".$totalPayableAmount."<br><br>"; //exit();
            
            //8. Check if the total payment amount is 0 and return an error
            if($totalPayableAmount == 0){
                
                Zf_SessionHandler::zf_setSessionVariable("collect_fees", "less_reserved_amount");

                $zf_errorData = array("zf_fieldName" => "paymentAmount", "zf_errorMessage" => "* You don't have enough money to make any fee payment");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('finance_module', 'collect_fees', $adminIdentificationCode);
                exit();
                
            }
            //9. Check if we have fees balance to pays and process the payments
            else{
                
                //9.1 Check if the fees balance for the selected period is 0 and return a flag
                if(($feesBalance == 0) && ($amountAlreadyPaid == $totalFeesAmount)){
                    
                    Zf_SessionHandler::zf_setSessionVariable("collect_fees", "fees_already_completed");

                    $zf_errorData = array("zf_fieldName" => "paymentScheduleName", "zf_errorMessage" => "* Student already completed fees for the selected payment period.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('finance_module', 'collect_fees', $adminIdentificationCode);
                    exit();
                    
                }
                //9.2 We have fees balance to pay, so lets make the payment setpwise
                else{
                
                    //9.2.1 Check and if the total payable amount is greater than fee balance, clear the balance and send the rest into reserve
                    if($totalPayableAmount > $feesBalance){
                        
                        //This is the new amount being sent into reserve as excess payment
                        $amountToReserve = $totalPayableAmount - $feesBalance;
                        //echo "This is the current excess amount paid: ".$amountToReserve."<br><br>"; 
                        
                        //This is the actual amount for fees payment
                        $totalPayableAmount = $feesBalance;
                        //echo "This is the new payable amount as fees: ".$totalPayableAmount."<br><br>"; //exit();

                    }else if(($totalPayableAmount == $feesBalance) || ($totalPayableAmount < $feesBalance)){
                        
                        //This is the case when there is no excess amount but there was prior to this transaction
                        $amountToReserve = "0.00";
                        //echo "This is the current excess amount paid: ".$amountToReserve."<br><br>"; //exit();
                        
                    }
                    
                    //exit();
                    //9.2.1 Check and if the total payable amount is less than fee balance, make fees payment and set resrve to 0
                        
                    //This is the actual amount for fees payment
                    //echo "This is the new payable amount as fees: ".$totalPayableAmount."<br><br>"; //exit();
                    
                    //echo $totalPayableAmount."<br>".$amountToReserve."<br>"; //exit();
                    
                    $this->zvs_makeFeesPayment($this->_validResult, $totalPayableAmount, $amountToReserve);
                 
                }
                
            }
            
                   
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("collect_fees", "collect_fees_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('finance_module', 'collect_fees', $adminIdentificationCode);
            exit();

        }
          
    }
    
    
    
    
    /**
     * This private function makes the actual fees payment for the student
     * 
     */
    private function zvs_makeFeesPayment($formResult, $paymentAmount, $amountToReserve = NULL){
        
        //echo $paymentAmount."<br>".$amountToReserve."<br>"; //exit();
        
        //0. Strip all form details
        $systemSchoolCode = $formResult['systemSchoolCode'];
        $studentClassCode = $formResult['studentClassCode'];
        $studentStreamCode = $formResult['studentStreamCode'];
        $paymentScheduleYear = $formResult['paymentScheduleYear'];
        $paymentScheduleName = $formResult['paymentScheduleName'];
        $studentIdentificationCode = $formResult['studentIdentificationCode'];
        $studentAdmissionNumber = $formResult['studentAdmissionNumber'];
        $adminIdentificationCode = $formResult['adminIdentificationCode'];
        
        
        //Prepare default SQL Values
        $zvs_sqlValuesReserve['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        $zvs_sqlValuesReserve['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
        $zvs_sqlValuesReserve['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        
        //1. INSERT OR UPDATE EXCESS PAYMENT AMOUNT INTO RESERVE
        
        if(is_null($amountToReserve) == FALSE && !empty($amountToReserve)){
            
            //1.1 Check if student as an exsiting excess payment record
            $reservedPaymentRecord = $this->pullReservedFeesDetails($systemSchoolCode, $studentIdentificationCode);

            //There is no any pre-existing record, therefore insert
            if($reservedPaymentRecord == 0){
                
                $zvs_sqlValuesReserve['updatedBy'] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
                $zvs_sqlValuesReserve['createdBy'] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
                
                $zvs_sqlValuesReserve['reservedAmount'] = Zf_QueryGenerator::SQLValue($amountToReserve);
                $zvs_sqlValuesReserve['dateReserved'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d H:i:s"));

                //Insertion sql query and execution
                $zvs_insertUpdateNewReserveDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_fees_payment_reserved", $zvs_sqlValuesReserve);

            }
            //There is pre-existing record, therefore update
            else{
                
                //We have reserved amount so we update the value
                $zvs_sqlColumn["reservedAmount"] = Zf_QueryGenerator::SQLValue($amountToReserve);
                $zvs_sqlColumn['updatedBy'] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
                $zvs_sqlColumn['dateReserved'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d H:i:s"));

                //Update sql query and execution
                $zvs_insertUpdateNewReserveDetails = Zf_QueryGenerator::BuildSQLUpdate('zvs_fees_payment_reserved', $zvs_sqlColumn, $zvs_sqlValuesReserve);

            }
            
            //echo $zvs_insertUpdateNewReserveDetails."<br><br>"; exit();
            
            $zvs_executeInsertUpdateNewReserveDetails = $this->Zf_AdoDB->Execute($zvs_insertUpdateNewReserveDetails);

            if(!$zvs_executeInsertUpdateNewReserveDetails){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }
            
        }
        
        
        //2. MAKE ACTUAL SCHOOL FEES PAYMENT
        
        //Prepare SQL values for fee payment
        $zvs_sqlValues['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        $zvs_sqlValues['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
        $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValues['studentClassCode'] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValues['studentStreamCode'] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        $zvs_sqlValues['paymentScheduleName'] = Zf_QueryGenerator::SQLValue($paymentScheduleName);
        $zvs_sqlValues['paymentScheduleYear'] = Zf_QueryGenerator::SQLValue($paymentScheduleYear);
        $zvs_sqlValues['paymentAmount'] = Zf_QueryGenerator::SQLValue($paymentAmount);
        $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
        $zvs_sqlValues['paymentDate'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d H:i:s"));
        $zvs_sqlValues['feesStatus'] = Zf_QueryGenerator::SQLValue(0);
        
        //Insertion sql query and execution
        $zvs_insertNewPaymentDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_fees_payment_detials", $zvs_sqlValues);

        //echo $zvs_insertNewPaymentDetails."<br>"; exit();
        
        $zvs_executeInsertNewPaymentDetails = $this->Zf_AdoDB->Execute($zvs_insertNewPaymentDetails);

        if(!$zvs_executeInsertNewPaymentDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Insertion successful
             Zf_SessionHandler::zf_setSessionVariable("collect_fees", "fees_payment_success");
             Zf_GenerateLinks::zf_header_location('finance_module', 'collect_fees', $adminIdentificationCode);
             exit();

        }
        
        
    }

}

?>
