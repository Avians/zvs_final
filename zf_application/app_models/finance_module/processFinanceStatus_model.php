<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * | This the Model which is responsible processing all school finance |
 * | Status. This model process all finance allocations.               |                
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class processFinanceStatus_Model extends Zf_Model {
    
    private $zvs_controller;
    
    public $identificationCode;


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
        
        $this->identificationCode = Zf_SessionHandler::zf_getSessionVariable("financialStatusIdentificationCode");
         
    }
  
    
    /**
     * This method returns the options for selecting year of study
     */
    public function zvs_buildYearsOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-3;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 90px !important;"  id="'.$yearsDiv.'">';

            for($year=$startYear; $year < $endYear+2; $year++){
                
                if(!empty($startYear) && $startYear != NULL){
                    
                    if(($year > $startYear || $year == $startYear) && $year != $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                        
                    }if($year == $endYear){
                        
                        $option .= '<option value="'.$year.'" selected>'.$year.'</option>';
                        
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
                    
                }
                
            }
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
    
    
    
    
    /**
     * This method processes all financial data for the selected year
     */
    public function processFinancialData(){
        
        $postedFinancialYear = $_POST['postedFinancialYear'];
        $identificationCode = $this->identificationCode;
        
        $financialData = '';
        
        $financialData .= '  <!--START OF FINANCIAL STATUS-->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="dashboard-stat purple-sharp">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                KES: '.$this->totalAmountExpected($identificationCode, $postedFinancialYear).'
                                            </div>
                                            <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                Total Amount Expected
                                            </div>
                                        </div>
                                        <div class="more" style="height: 40px;" href="#">
                                            Total amount expected for the year '.$postedFinancialYear.'
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="dashboard-stat green-sharp">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                KES: '.$this->totalAmountPaid($identificationCode, $postedFinancialYear).'
                                            </div>
                                            <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                Total Amount Paid
                                            </div>
                                        </div>
                                        <div class="more" style="height: 40px;" href="#">
                                            Total amount Paid for the year '.$postedFinancialYear.'
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="dashboard-stat blue-madison">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                KES: '.$this->totalAmountPending($identificationCode, $postedFinancialYear).'
                                            </div>
                                            <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                Total Amount Pending
                                            </div>
                                        </div>
                                        <div class="more" style="height: 40px;" href="#">
                                            Total amount pending for the year '.$postedFinancialYear.'
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF FINANCIAL STATUS-->

                            <div class="clearfix margin-top-10"><hr></div>

                            <!--START OF FINANCIAL STATUS CHARTS-->
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12 margin-top-10 margin-bottom-10" style="border-right: 1px solid #efefef; min-height: 350px !important; height: auto !important;">
                                    <div class="portlet-titles">'.$postedFinancialYear.' - Finance Status Proportion</div>
                                    <div id="financeStatusPie">'.$this->financialStatusPieChart($identificationCode, $postedFinancialYear).'</div>
                                </div> 
                                <div class="col-md-7 col-sm-12 col-xs-12 margin-top-10 margin-bottom-10">
                                    <div class="portlet-titles">'.$postedFinancialYear.' - Class Finance Status</div>
                                    <div id="financeStatusBarGraph">'.$this->financialStatusBarGraph($identificationCode, $postedFinancialYear).'</div>
                                </div>
                            </div>
                            <!--END OF FINANCIAL STATUS CHARTS-->';
        
        echo $financialData;
        
    }






    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountExpected($identificationCode, $postedFinancialYear){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $totalAmountExpected = $this->zvs_generateExpectedSchoolFees($systemSchoolCode, $postedFinancialYear);
        
        return number_format($totalAmountExpected, 2);
        
    }
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountPaid($identificationCode, $postedFinancialYear){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $totalAmountPaid = $this->zvs_generatePaidSchoolFees($systemSchoolCode, $postedFinancialYear);
        
        return number_format($totalAmountPaid, 2);
        
    }
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountPending($identificationCode,$postedFinancialYear){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $totalAmountPending = $this->zvs_generateExpectedSchoolFees($systemSchoolCode, $postedFinancialYear) - $this->zvs_generatePaidSchoolFees($systemSchoolCode, $postedFinancialYear);
        
        return number_format($totalAmountPending, 2);
        
    }
    
    
    
    
    /**
     * This method plots the chat for the finance status for the selected year
     * While showing what had been paid against what is pending.
     */
    public function financialStatusPieChart($identificationCode, $postedFinancialYear){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $amountExpected = $this->zvs_generateExpectedSchoolFees($systemSchoolCode, $postedFinancialYear);
        $amountPaid = $this->zvs_generatePaidSchoolFees($systemSchoolCode, $postedFinancialYear);
        $amountPending = ($amountExpected - $amountPaid);
        
        return $this->zvs_plotFinancialStatusPieChart($amountExpected, $amountPaid, $amountPending, $postedFinancialYear);
        
    }
    
    
    
    
    /**
     * This method plots the chat for the finance status for the selected year
     * While showing what had been paid against what is pending.
     */
    public function financialStatusBarGraph($identificationCode, $postedFinancialYear){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        return $this->zvs_plotFinancialStatusBarGraph($systemSchoolCode, $postedFinancialYear);
        
    }
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function estimatedRunningBudget($identificationCode){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $estimatedRunningBudget = 300000;
        
        return number_format($estimatedRunningBudget, 2);
        
    }
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountAllocated($identificationCode){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $totalAmountAllocated = 210000;
        
        return number_format($totalAmountAllocated, 2);
        
    }
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAllocationBalance($identificationCode){
        
        //This is the system school code
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $totalAllocationBalance = 70000;
        
        return number_format($totalAllocationBalance, 2);
        
    }
    
    
    
    /**
    * This method checks and counts, then returns class details for all classess in the school 
    */
    private function zvs_fetchClassDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method counts and returns the number of students in each class
     */
    private function countClassStudents($systemSchoolCode, $schoolClassCode, $financialYear){
        
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $currentYear = explode("-", $currentDate)[2];
        
        if($financialYear == $currentYear){
            
            $zvs_table = "zvs_students_class_details";
            
        }else{
            
            $zvs_table = "zvs_students_class_history";
            
        }
        
        
        
        $zvs_column[] = "systemSchoolCode";
        $zvs_column[] = "studentClassCode";
        
        $zvs_value['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_value['studentClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $classStudents = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value, $zvs_column);
        
        $zvs_executeClassStudents = $this->Zf_AdoDB->Execute($classStudents);
        
        if (!$zvs_executeClassStudents){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_classStudentsCount = $zvs_executeClassStudents->RecordCount();
            
        }
        
        return $zvs_classStudentsCount;
        
    }

    


    /**
     * This private function pulls general fee details
     */
    private function pullGeneralFeeDetails($systemSchoolCode, $financialYear){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($financialYear);
        
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
    private function pullClassFeeDetails($systemSchoolCode, $schoolClassCode, $financialYear){
     
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($financialYear);
        
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
     * This private function pulls paid amounts details
     */
    private function pullAllPaidAmounts($systemSchoolCode, $studentClassCode, $financialYear){
     
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValue["paymentScheduleYear"] = Zf_QueryGenerator::SQLValue($financialYear);
        
        $fetchPaymentDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_fees_payment_detials', $zvs_sqlValue);
        
        //echo $fetchPaymentDetails; exit();
        
        $zf_executeFetchPaymentDetails = $this->Zf_AdoDB->Execute($fetchPaymentDetails);

        if(!$zf_executeFetchPaymentDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchPaymentDetails->RecordCount() > 0){

                while(!$zf_executeFetchPaymentDetails->EOF){
                    
                    $results = $zf_executeFetchPaymentDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
   
    
    
   
    /**
     * This method generates fees that is expected for the entire school 
     */
    private function zvs_generateExpectedSchoolFees($systemSchoolCode, $postedFinancialYear){
        
        $financialYear = $postedFinancialYear;
        
        //Here we pull all school classes
        $zvs_classDetails = $this->zvs_fetchClassDetails($systemSchoolCode);
        
        //This variable holds total expected school fees
        $totalExpectedFees;
        
        foreach($zvs_classDetails as $classValues){
            
            //Here we return class code
            $schoolClassCode =  $classValues['schoolClassCode'];
            
            //Here we count number of student per class
            $numberOfClassStudent = $this->countClassStudents($systemSchoolCode, $schoolClassCode, $financialYear);
            
            //Here we fetch general school fees
            $generalFeeDetails = $this->pullGeneralFeeDetails($systemSchoolCode, $financialYear);
            
            foreach ($generalFeeDetails as $generalFeeValues) {
                
                //This variable holds general amount per student for a given class
                $GeneralAmountPerStudent;
                
                //Return each fee item
                $generalItemAmount = $generalFeeValues['itemAmount']; 
                
                //Sum all the general fees items per student for the class 
                $GeneralAmountPerStudent = $GeneralAmountPerStudent + $generalItemAmount;
                
            }
       
            //Here we fetch class specific school fees
            $classFeeDetails = $this->pullClassFeeDetails($systemSchoolCode, $schoolClassCode, $financialYear);
            
            foreach ($classFeeDetails as $classFeeValues) {
                
                //This variable holds class specific amount per student for a given class
                $classAmountPerStudent;

                //Return each fee item for the class
                $classItemAmount = $classFeeValues['itemAmount']; 
                
                //Sum all class fees items per student for the class
                $classAmountPerStudent = $classAmountPerStudent + $classItemAmount;

            }
            
            //This returns total amount to be paid by each student in a given class
            $totalAmountPerStudent = $GeneralAmountPerStudent+$classAmountPerStudent;
            
            //Total fees expected per class
            $totalClassFees = $totalAmountPerStudent * $numberOfClassStudent;
           
            //Total Expected School Fees
            $totalExpectedFees = $totalExpectedFees + $totalClassFees;
            
            //Reset the values to 0
            $GeneralAmountPerStudent = 0; $classAmountPerStudent = 0;
            
        }
        
        return $totalExpectedFees;
    }
   
    
    
    
    /**
     * This method generates fees that has already been paid for the entire school
     */
    private function zvs_generatePaidSchoolFees($systemSchoolCode, $postedFinancialYear){
        
        $financialYear = $postedFinancialYear;
        
        //Here we pull all school classes
        $zvs_classDetails = $this->zvs_fetchClassDetails($systemSchoolCode, $financialYear);
        
        //This variable holds the value for the total paid school fees.
        $totalPaidFees;
        
        foreach ($zvs_classDetails as $classValues) {
            
            //Here we return class code
            $schoolClassCode =  $classValues['schoolClassCode'];
            
            //echo "Class Code: ".$schoolClassCode."<br>";
            
            //Here we pull all amounts by students
            $paidAmountsDetails = $this->pullAllPaidAmounts($systemSchoolCode, $schoolClassCode, $financialYear);
            
            $studentsPaidAmounts;
            
            foreach ($paidAmountsDetails as $paymentValues) {
                
                //This variable holds amounts paid by students
                
                
                //Returns each paid amount
                $paymentAmount = $paymentValues['paymentAmount']; 
                
                //echo "Each Amount Paid: ".$paymentAmount."<br>";
                
                //Sum all the amounts paid by student 
                $studentsPaidAmounts = $studentsPaidAmounts + $paymentAmount;
                
            }
            
            //echo "<br>Total Amount Paid: ".$studentsPaidAmounts."<br><br>";
            
            
            $totalPaidFees = $totalPaidFees + $studentsPaidAmounts;
            
            $studentsPaidAmounts = 0;
            
        }
        
        //echo "<br><br>Total Amount Paid: ".$totalPaidFees."<br><br>";
        
        
        //return the paid fees
        return $totalPaidFees;
        
    }
    
    
    
    
    /**
     * This private method plots the financial status pie chart for the school
     */
    private function zvs_plotFinancialStatusPieChart($amountExpected, $amountPaid, $amountPending, $postedFinancialYear){
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Doughnut2D",
            "ChartID" => "financialStatusProportion".$postedFinancialYear,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "financeStatusPie",
            "ChartDataFormat" =>  "json",
        );
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{
                                "bgColor": "#ffffff",
                                "pieRadius": "100",
                                "showBorder": "0",
                                "use3DLighting": "0",
                                "showShadow": "0",
                                "showLabels": "1", 
                                "enableSmartLabels": "1",
                                "exportenabled": "1",
                                "showValues": "1",
                                "exportFileName": "2017 - School Finance Proportions",
                                "startingAngle": "120",
                                "slicingDistance" : "8",
                                "showPercentValues": "1",
                                "showPercentInTooltip": "0",
                                "defaultCenterLabel": "Total Expected Kshs:<br>'.number_format($amountExpected, 2).'</span>",
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
                                "legendPosition": "bottom",
                                "legendCaptionAlignment": "left",
                                "useDataPlotColorForLabels": "1",
                                "numberPrefix": " Kshs: ",
                                "formatNumberScale": "0",
                                "decimalSeparator": ".",
                                "thousandSeparator": ",",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //This is the actual chart data in JSON format
        $chartData = '
            
                "data":[ 
                  {  
                    "label":"Pending Amount",
                    "value":"'.$amountPending.'",
                    "tooltext": "Total Amount Pending, <br> KES: '.number_format($amountPending, 2).'"
                  },
                  {  
                    "label":"Paid Amount",
                    "value":"'.$amountPaid.'",
                    "tooltext": "Total Amount Paid, <br> KES: '.number_format($amountPaid, 2).'"
                  }
                  
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
        
    }
    
    
    
    
    
    /**
     * This private method plots the financial status pie chart for the school
     */
    private function zvs_plotFinancialStatusBarGraph($systemSchoolCode, $postedFinancialYear){
        
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "MSColumn2D",
            "ChartID" => "financialStatusBarGraph".$postedFinancialYear,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "financeStatusBarGraph",
            "ChartDataFormat" =>  "json",
        );

                                
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Financial Status by Classes",
                                "captionFontSize": "11",
                                "xAxisName": "School Classes",
                                "yAxisName": "Amount of Money",
                                "bgColor": "#ffffff",
                                "palettecolors": "#4D998D, #04476C",
                                "showHoverEffect": "1",
                                "borderAlpha": "20",
                                "exportenabled": "1",
                                "exportFileName": "2017 - Class Finance Status",
                                "canvasBorderAlpha": "0",
                                "usePlotGradientColor": "0",
                                "plotBorderAlpha": "10",
                                "placevaluesInside": "0",
                                "rotatevalues": "1",
                                "valueFontColor": "#0F4E74",
                                "useDataPlotColorForLabels": "1",
                                "labelDisplay": "rotate",
                                "slantLabels": "1",
                                "labelDistance": "1",
                                "plotSpacePercent" : "30",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //Here we return all classes within the school
        $zvs_fetchClassDetails = $this->zvs_fetchClassDetails($systemSchoolCode);
        
        if($zvs_fetchClassDetails == 0){
            
            echo "There is no class data!!";
            
        }else{
            
            //Here we process the class loop
            $chartData = "";
            
            $chartData .='
                        
                            "categories" : [
                                {
                                    "category" : [';
                                        
                                        foreach($zvs_fetchClassDetails as $classValues){

                                            $zvs_className = $classValues['schoolClassName'];
                                            
                                            $chartData .='{
                                                
                                                            "label": "'.$zvs_className.'"
                                                            
                                                          },';

                                        }
                                            
                        $chartData .=']
                                }
                            ],

                        ';
            
            $chartData .='
                        
                            "dataset" : [
                                {
                                    
                                    "seriesname" : "Total Paid Amount",
                                    "data" : [';

                                        foreach($zvs_fetchClassDetails as $classValues){
                                            
                                            $schoolClassCode =  $classValues['schoolClassCode'];
                                            
                                            //Calculate total amount paid by students in the selected class
                                            
                                            $totalAmountPaid = $this->zvs_classTotalAmountPaid($systemSchoolCode, $schoolClassCode, $postedFinancialYear);
                                            
                                            $chartData .='{
                                                
                                                            "value": "'.$totalAmountPaid.'",
                                                            "tooltext": "Total '.$zvs_className.' Paid Amount, <br> KES: '.number_format($totalAmountPaid, 2).'"    
                                                            
                                                          },';
                                            
                                        }

                        $chartData .=']
                            
                                },
                                {
                                    "seriesname" : "Total Pending Amount",
                                    "data" : [';

                                        foreach($zvs_fetchClassDetails as $classValues){
                                            
                                            $schoolClassCode =  $classValues['schoolClassCode'];
                                            
                                            //Calculate total amount pending by students in the selected class
                                            
                                            $totalAmountPending = $this->zvs_classTotalAmountPending($systemSchoolCode, $schoolClassCode, $postedFinancialYear);
                                            
                                            $chartData .='{
                                                
                                                            "value": "'.$totalAmountPending.'",
                                                            "tooltext": "Total '.$zvs_className.' Pending Amount, <br> KES: '.number_format($totalAmountPending, 2).'"     
                                                            
                                                          },';
                                            
                                        }

                        $chartData .=']
                                }
                            ]

                        ';
            
        }
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
        
    }
    
   
    
    
    /**
     * This method generates fees that is expected for the entire school 
     */
    private function zvs_classExpectedSchoolFees($systemSchoolCode, $schoolClassCode, $postedFinancialYear){
        
        $financialYear = $postedFinancialYear;
        
        //This variable holds total expected school fees
        $totalExpectedFees;
            
        //Here we count number of student per class
        $numberOfClassStudent = $this->countClassStudents($systemSchoolCode, $schoolClassCode, $financialYear);

        //Here we fetch general school fees
        $generalFeeDetails = $this->pullGeneralFeeDetails($systemSchoolCode, $financialYear);

        foreach ($generalFeeDetails as $generalFeeValues) {

            //This variable holds general amount per student for a given class
            $GeneralAmountPerStudent;

            //Return each fee item
            $generalItemAmount = $generalFeeValues['itemAmount']; 

            //Sum all the general fees items per student for the class 
            $GeneralAmountPerStudent = $GeneralAmountPerStudent + $generalItemAmount;

        }

        //Here we fetch class specific school fees
        $classFeeDetails = $this->pullClassFeeDetails($systemSchoolCode, $schoolClassCode, $financialYear);

        foreach ($classFeeDetails as $classFeeValues) {

            //This variable holds class specific amount per student for a given class
            $classAmountPerStudent;

            //Return each fee item for the class
            $classItemAmount = $classFeeValues['itemAmount']; 

            //Sum all class fees items per student for the class
            $classAmountPerStudent = $classAmountPerStudent + $classItemAmount;

        }

        //This returns total amount to be paid by each student in a given class
        $totalAmountPerStudent = $GeneralAmountPerStudent+$classAmountPerStudent;

        //Total fees expected per class
        $totalClassFees = $totalAmountPerStudent * $numberOfClassStudent;

        //Total Expected School Fees
        $totalExpectedFees = $totalExpectedFees + $totalClassFees;

        //Reset the values to 0
        $GeneralAmountPerStudent = 0; $classAmountPerStudent = 0;
        
        return $totalExpectedFees;
    }
    
    
    
    
    //This private method pulls the amount of money paid by a given class in a given year
    private function zvs_classTotalAmountPaid($systemSchoolCode, $schoolClassCode, $postedFinancialYear){
        
        $paidAmountsDetails = $this->pullAllPaidAmounts($systemSchoolCode, $schoolClassCode, $postedFinancialYear);
        
        $studentsPaidAmounts;
            
        foreach ($paidAmountsDetails as $paymentValues) {
            
            //Returns each paid amount
            $paymentAmount = $paymentValues['paymentAmount']; 

            //echo "Each Amount Paid: ".$paymentAmount."<br>";

            //Sum all the amounts paid by student 
            $studentsPaidAmounts = $studentsPaidAmounts + $paymentAmount;

        }
        
        //This ensures that 0 is returned incase a empty data set is returned
        if(empty($studentsPaidAmounts) || $studentsPaidAmounts == ""){
                
                $studentsPaidAmounts = "0";
        }
        
        return $studentsPaidAmounts;
        
    }
    
    
    
    
    //This private method pulls the amount of money pending by a given class in a given year
    private function zvs_classTotalAmountPending($systemSchoolCode, $schoolClassCode, $postedFinancialYear){
        
        //This is the total amount of money that should be paid by the selected class
        $classExpectedAmount = $this->zvs_classExpectedSchoolFees($systemSchoolCode, $schoolClassCode, $postedFinancialYear);
        
        
        //This is the total amount of money paid by the selected class
        $classAmountPaid = $this->zvs_classTotalAmountPaid($systemSchoolCode, $schoolClassCode, $postedFinancialYear);
        
        //This is the amount of money pending for the selected class
        $classPendingAmount = $classExpectedAmount - $classAmountPaid;
        
        return $classPendingAmount;
        
    }
    
}

?>
