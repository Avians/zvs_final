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
            
            $select_options .= '<option value="" selected>Select Stream</option>';
            
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
        $studentClassDetails = $this->zvs_fetchStudentsClassDetails($studentStreamCode);
        
        $select_options = '';
        
        
        if($studentClassDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected>Select Student</option>';
            
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
        $studentClassDetails = $this->zvs_fetchStudentsClassDetails(NULL, $identificationCode);
        
        
        
        $feesHistoryDetails = "";
        
        
        foreach ($studentDetails as $studentValue) {
            
            $studentFirstName = $studentValue['studentFirstName'];$studentMiddleName = $studentValue['studentMiddleName']; 
            $studentLastName = $studentValue['studentLastName'];$studentGender = $studentValue['studentGender'];
            $studentPhoneNumber = $studentValue['studentPhoneNumber'];$studentBoxAddress = $studentValue['studentBoxAddress'];
            
        }
        
        foreach ($studentClassDetails as $classValue) {
            
            $systemSchoolCode = $classValue['systemSchoolCode']; $studentClassCode = $classValue['studentClassCode']; $studentStreamCode = $classValue['studentStreamCode'];
            $studentYearOfStudy = $classValue['studentYearOfStudy']; $studentAdmissionNumber = $classValue['studentAdmissionNumber'];
            
        }
        
        $classDetails = $this->zvs_fetchStudentClassDetails($systemSchoolCode, $studentClassCode);
        $streamDetails = $this->zvs_fetchStudentStreamDetails($systemSchoolCode, $studentClassCode, $studentStreamCode);
        $classFeesAmount = $this->zvs_generateClassFeeDetails($systemSchoolCode, $schoolClassCode, $feesHistoryYear);
        $studentPaidFees = $this->zvs_fetchFeesPaymentDetails($systemSchoolCode, $studentClassCode, $studentStreamCode, $feesHistoryYear, $identificationCode);
        
        $feesHistoryDetails .= '<div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 200px !important; height: auto !important;">
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
                                                        <tr><td><i class="fa fa-phone zvs-user-profile"></i></td><td>'.$studentPhoneNumber.'</td></tr>
                                                        <tr><td><i class="fa fa-envelope zvs-user-profile"></i></td><td>'.$studentBoxAddress.'</td></tr>
                                                        <tr><td><i class="fa fa-transgender zvs-user-profile"></i></td><td>'.$studentGender.'</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-titles">Class Details</div>
                                    <div class="row portlet-body" style="min-height: 80px !important;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-responsive table-hover">
                                                    <tbody>
                                                        <tr><td style="text-align:right; font-weight: bolder; color:#21B4E2;">Admission No:</td><td>'.$studentAdmissionNumber.'</td></tr>
                                                        <tr><td style="text-align:right; font-weight: bolder; color:#21B4E2;">Class:</td><td>'.$classDetails.'</td></tr>
                                                        <tr><td style="text-align:right; font-weight: bolder; color:#21B4E2;">Stream:</td><td>'.$streamDetails.'</td></tr>
                                                        <tr><td style="text-align:right; font-weight: bolder; color:#21B4E2;">Total Fees:</td><td>'.$classFeesAmount.'</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="portlet-titles">Fees Payment Details</div>
                                    <div class="row" style="margin-top: 20px !important;">
                                        <div class="col-md-12" id="feesPaymentDataChart">';
                          
                                        $feesHistoryDetails .= $this->plotFeesPaymentPieChart($classFeesAmount, $studentPaidFees, $feesHistoryYear);
                                        
                $feesHistoryDetails .= '</div>
                                        <div class="col-md-12" id="dividerLine"><hr></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <a href="#feesPaymentDataChart" style="text-decoration: none !important;">
                                                <button id="feesCollectionButton" type="button" class="btn zvs-buttons center-block" style="color: #ffffff !important;">
                                                    Collect School Fees
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                
                                    //A click on this button loads the fee collection form
                                    $("#feesCollectionButton").click(function(){
                                        
                                        $("#collectFeesContainer").fadeIn(2000, function(){
                                        
                                        });

                                    });
                                    

                                </script>';
        
       
        echo $feesHistoryDetails;
        
    }
    
    
    
    
    //This private method fetches student class detials for a given selected stream.
    private function zvs_fetchStudentsClassDetails($studentsStreamCode = NULL, $identificationCode = NULL){
        
        $currentYear = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
        
        if(empty($identificationCode) || $identificationCode == ""){
            
            $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentsStreamCode);
            $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($currentYear);
            
        }else{
            
            $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
            
        }
        
        
        
        $fetchStudentClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_class_details', $zvs_sqlValue);
        
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
    private function feePaymentSchedule($systemSchoolCode, $systemPaymentCode, $selectedYear){
        
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
     * This private methods works out the amount of fees paid by a selected student for a selected year
     */
    private function zvs_fetchFeesPaymentDetails($systemSchoolCode, $schoolClassCode, $studentStreamCode, $feesHistoryYear, $identificationCode, $paymentPeriod = NULL){
        
      
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($feesHistoryYear);
        if($paymentPeriod != NULL && !empty($paymentPeriod) ){
            
            $zvs_sqlValue["paymentScheduleName"] = Zf_QueryGenerator::SQLValue($paymentPeriod);
            
        }
        
        $fetchFeePaymentAmounts = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_detials', $zvs_sqlValue);
        
        $studentFeesPaymentDetails = $this->zvs_fetchFeesDetails($fetchFeePaymentAmounts);
        
        
        $totalFeesPaid;

        foreach ($studentFeesPaymentDetails as $feesPaymentValues) {

            $paymentAmount = $feesPaymentValues['paymentAmount']; $totalFeesPaid = $totalFeesPaid + $paymentAmount;

        }
        
        return number_format($totalFeesPaid, 2);
        
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
    private function plotFeesPaymentPieChart($classFeesAmount, $studentPaidFees, $feesHistoryYear){
        
        //$totalFees = filter_var($classFeesAmount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        //$paidFees = filter_var($studentPaidFees, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $totalFees = 46000.00;
        $paidFees = 23000.00;
        $dueFees = $totalFees - $paidFees;
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Doughnut2D",
            "ChartID" => "feePaymentCharts".$feesHistoryYear,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "270",
            "ChartContainer" => "feesPaymentDataChart",
            "ChartDataFormat" =>  "json",
        );
        
        
        //These chart properties add to the beauty of the chart
        $chartProperties = '
            
                            "chart":{
                                "bgColor": "#ffffff",
                                "pieRadius": "90",
                                "showBorder": "0",
                                "use3DLighting": "0",
                                "showShadow": "0",
                                "showLabels": "1", 
                                "enableSmartLabels": "1",
                                "showValues": "1",
                                "startingAngle": "0",
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
        
        $studentIdentificationCode = $_POST['studentIdentificationCode'];
        
        $studentDetails = $this->zvs_fetchStudentsPersonalDetails($studentIdentificationCode);
        $studentClassDetails = $this->zvs_fetchStudentsClassDetails(NULL, $studentIdentificationCode);
        
        
        
        $studentPrefilledForm = "";
        
        
        foreach ($studentDetails as $studentValue) {
            
            $studentFullName = $studentValue['studentFirstName']." ".$studentValue['studentMiddleName']." ".$studentValue['studentLastName'];
            
        }
        
        foreach ($studentClassDetails as $classValue) {
            
            $systemSchoolCode = $classValue['systemSchoolCode']; $studentClassCode = $classValue['studentClassCode']; $studentStreamCode = $classValue['studentStreamCode'];
            $studentYearOfStudy = $classValue['studentYearOfStudy']; $studentAdmissionNumber = $classValue['studentAdmissionNumber'];
            
        }
        
        $classDetails = $this->zvs_fetchStudentClassDetails($systemSchoolCode, $studentClassCode);
        $streamDetails = $this->zvs_fetchStudentStreamDetails($systemSchoolCode, $studentClassCode, $studentStreamCode);
        
        
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
                
                                ->zf_postFormData('paymentScheduleName')
                
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
        
        //This of debugging purposes only.
        echo "<pre>School Fees Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        
        $adminIdentificationCode = $this->_validResult['adminIdentificationCode'];
        $adminIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($adminIdentificationCode);
        
        //$formatedStartDate =  Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['attendanceStartDate']);
        //$formatedEndDate =  Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['attendanceEndDate']);
        
        if(empty($this->_errorResult)){
            
            $systemSchoolCode = $this->_validResult['systemSchoolCode'];
            $schoolClassCode = $this->_validResult['studentClassCode'];
            $systemStreamCode = $this->_validResult['studentStreamCode'];
            $paymentScheduleYear = $this->_validResult['paymentScheduleYear'];
            $paymentScheduleName = $this->_validResult['paymentScheduleName'];
            $studentIdentificationCode = $this->_validResult['studentIdentificationCode'];
            $paymentAmount = $this->_validResult['paymentAmount'];
            
            
            /**
             * We are about to record the collected fees. But before, we have to conduct a seven step logical check 
             *to ensure that the fees is paid correctly for the select year and payment period
             */
            
            //0. Get the fees payment percentage proportion for the selected year and the selected payment period
            $feePaymentProportion = ($this->feePaymentSchedule($systemSchoolCode, $paymentScheduleName, $paymentScheduleYear)/100);
            echo $feePaymentProportion."<br>";
            
            
            //1. Get the fees supposed to be paid for the selected year and the selected payment period, say X
            $totalFeesAmount = (filter_var($this->zvs_generateClassFeeDetails($systemSchoolCode, $schoolClassCode, $paymentScheduleYear), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)*$feePaymentProportion);
            echo $totalFeesAmount."<br>";
            
            //2. Get the fees already paid by the student for the selected year and the selected payment period, say Y
            $amountAlreadyPaid = filter_var($this->zvs_fetchFeesPaymentDetails($systemSchoolCode, $schoolClassCode, $studentStreamCode, $paymentScheduleYear, $studentIdentificationCode, $paymentScheduleName), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            echo $amountAlreadyPaid."<br>";
            
            
            //3. Work out the fees balance for the paying student by calculating X-Y = Z
            $feesBalance  = $totalFeesAmount - $amountAlreadyPaid;
            echo $feesBalance; exit();
            
            //4. If the balance Z is 0, return a flag about the student already having completed fees for the selected year and payment period
            if($totalFeesAmount == $amountAlreadyPaid){
                
                
            }
            
            //5. If the balance Z is more than 0, compare the balance Z and the paid amount W.
            else{
                
                //6. If the paid amount is more than the the balance i.e W > Z, return a flag about the students remaining balance for the selected year and payment period
                if($paymentAmount > $feesBalance){
                    
                    
                    
                }
                //7. If the paid amount is equal to or less than the balance i.e W == Z || W < Z, insert the record for the paid fees against the selected year and payment period.
                else if($paymentAmount == $feesBalance || $paymentAmount < $feesBalance){
                    
                    
                    
                }
                
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "attendance_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('finance_module', 'collect_fees', $adminIdentificationCode);
            exit();

        }
        
    }
    
}

?>
