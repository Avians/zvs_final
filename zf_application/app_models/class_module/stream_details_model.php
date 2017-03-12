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

class stream_details_Model extends Zf_Model {
    
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
    
    
    
    
    //This public method returns the class name
    public function getClassName($systemSchoolCode, $studentClassCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        
        $zf_selectClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectClasses)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectClasses}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    return $fetchRow->schoolClassName;

                }

            }
        }
        
    }
    
    
    
    
    //This public method returns the stream name
    public function getStreamName($systemSchoolCode, $studentClassCode, $studentStreamCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        
        $zf_selectClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectClasses)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectClasses}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    return $fetchRow->schoolStreamName;

                }

            }
        }
        
    }
    
    
    
    
    //This public method returns all the related stream details
    public function zvs_getStreamDetails($streamParameters){
        
        //Get a parameter array
        $zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($streamParameters));
        
        //$zvs_currentYear = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
        
        $identificationCode = Zf_SecureData::zf_encode_url($zvs_parameter[0]);
        $systemSchoolCode = $zvs_parameter[1];
        $studentClassCode = $zvs_parameter[1].ZVSS_CONNECT.$zvs_parameter[2];
        $studentStreamCode = $zvs_parameter[1].ZVSS_CONNECT.$zvs_parameter[2].ZVSS_CONNECT.$zvs_parameter[3];
        $studentYearOfStudy = $zvs_parameter[4];
        
        
        //echo $identificationCode."<br>".$systemSchoolCode."<br>".$studentClassCode."<br>".$studentStreamCode."<br>".$studentYearOfStudy;
        
        
        //1. Get the expected amount of money to be paif by the stream for the selected year
        
        
        //2. Get the total amount of money already paid by the selected stream for the slected year.
        
        
        //3. Calculate the pending amount by the selected class for the selected year
        
        
        //4. Get the gender segementation of the selected stream for the selected year
        
        
        //5. Get the blood group segementation of the selected stream for the selected year
        
        
        //6. Get the disability segmentation of the selected stream for the selected year
        
        
        //7. Get the guardian segmentation of the selected stream for the selected year
        
        $streamData .= ' <!--START OF FINANCIAL ALLOCATIONS-->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
                                    <div class="row" style="margin-bottom: -30px !important;">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="dashboard-stat purple-sharp">
                                                <div class="visual">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        KES: '.$this->totalAmountExpected($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy).'
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
                                                        KES: '.$this->totalAmountPaid($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy).'
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
                                                        KES: '.$this->totalAmountPending($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy).'
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
                                 </div>
                             </div>    
                        <!--END OF FINANCIAL STATUS-->';
        
        echo $streamData;
        
        
    }
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountExpected($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy){
        
        //Here we returns all the expected amount to be paid by all stream students in the selected year
        $totalAmountExpected = $this->zvs_generateExpectedSchoolFees($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy);
        
        return number_format($totalAmountExpected, 2);
        
    } 
    
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountPaid($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy){
        
        //Here we return all the amount already paid by the stream students for the selected year 
        $totalAmountPaid = $this->zvs_generatePaidSchoolFees($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy);
        
        return number_format($totalAmountPaid, 2);
        
    }
    
    
    
    /**
     * This method processes total amount expected for collection from school 
     * fees
     */
    public function totalAmountPending($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy){
        
        $totalAmountPending = $this->zvs_generateExpectedSchoolFees($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy) - $this->zvs_generatePaidSchoolFees($systemSchoolCode, $studentClassCode, $studentStreamCode, $studentYearOfStudy);
        
        return number_format($totalAmountPending, 2);
        
    }
    
    
   
    
    /**
     * This method generates fees that is expected for the entire school 
     */
    private function zvs_generateExpectedSchoolFees($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $schoolYearOfStudy){
        
        //Count the number of students in the stream
        $zvs_numberOfStreamStudent = $this->zvs_countStreamStudents($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $schoolYearOfStudy);
        
        //Get the amount of fees to be paid per student for the selected stream class and the academic year
        $zvs_getFeesPerStudent = $this->zvs_getFeesPerStudent($systemSchoolCode, $schoolClassCode, $schoolYearOfStudy);
        
        //This is the total expected fees for the selected class
        $totalExpectedFees = $zvs_numberOfStreamStudent * $zvs_getFeesPerStudent;
        
        return $totalExpectedFees;
        
    }
    
    
    
    
    /**
     * This public method counts the number of students in the selected stream for the selected year
     */
    private function zvs_countStreamStudents($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $schoolYearOfStudy){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $currentYear = explode("-", $currentDate)[2];
        
        if($schoolYearOfStudy == $currentYear){
            
            $zvs_table = "zvs_students_class_details";
            
        }else{
            
            $zvs_table = "zvs_students_class_history";
            
        }
        
        
        
        $zvs_column[] = "systemSchoolCode";
        $zvs_column[] = "studentClassCode";
        $zvs_column[] = "studentStreamCode";
        
        $zvs_value['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_value['studentClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_value['studentStreamCode'] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
        $zvs_value['studentYearOfStudy'] = Zf_QueryGenerator::SQLValue($schoolYearOfStudy);
        
        $streamStudents = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value, $zvs_column);
        
        $zvs_executeStreamStudents = $this->Zf_AdoDB->Execute($streamStudents);
        
        if (!$zvs_executeStreamStudents){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_streamStudentsCount = $zvs_executeStreamStudents->RecordCount();
            
        }
        
        return $zvs_streamStudentsCount;
        
    }
    
    
    
    
    /**
     * This private method returns the amount of fees to be paid per student for the selected class and year
     */
    private function zvs_getFeesPerStudent($systemSchoolCode, $schoolClassCode, $schoolYearOfStudy){
        
        //Fetches general schools fees for the selected year for the selected school
        $get_generalSchoolFees = $this->zvs_getGeneralSchoolFees($systemSchoolCode, $schoolYearOfStudy);
        
        foreach ($get_generalSchoolFees as $generalFeeValues) {
                
            //This variable holds general amount per student for a given class
            $GeneralAmountPerStudent;

            //Return each fee item
            $generalItemAmount = $generalFeeValues['itemAmount']; 

            //Sum all the general fees items per student for the class 
            $GeneralAmountPerStudent = $GeneralAmountPerStudent + $generalItemAmount;

        }
        
        
        //Fetches class specific schools fees for the selected year for the selected school
        $get_classSchoolFees = $this->zvs_getClassSchoolFees($systemSchoolCode, $schoolClassCode, $schoolYearOfStudy);
        
        foreach ($get_classSchoolFees as $classFeeValues) {
                
            //This variable holds class specific amount per student for a given class
            $classAmountPerStudent;

            //Return each fee item for the class
            $classItemAmount = $classFeeValues['itemAmount']; 

            //Sum all class fees items per student for the class
            $classAmountPerStudent = $classAmountPerStudent + $classItemAmount;

        }
        
        $schoolFeesPerStudent = $GeneralAmountPerStudent+$classAmountPerStudent;
        
        //Reset the values to 0
        $GeneralAmountPerStudent = 0; $classAmountPerStudent = 0;
        
        return $schoolFeesPerStudent;
        
    }
    
    
    
    
    /**
     * This private method computes the general school fees per student for the selected year
     */
    private function zvs_getGeneralSchoolFees($systemSchoolCode, $financialYear){
        
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
     * This private method computes the class school fees per student for the selected year
     */
    private function zvs_getClassSchoolFees($systemSchoolCode, $schoolClassCode, $financialYear){
        
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
     * This private method pulls all paid schools fees for the selected period and stream
     */
    private function zvs_generatePaidSchoolFees($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $schoolYearOfStudy){
        
        $paidAmountsDetails = $this->pullAllPaidAmounts($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $schoolYearOfStudy);
            
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
        
        return $totalPaidFees;
        
    }
    
    
    
    /**
     * This private function pulls paid amounts details
     */
    private function pullAllPaidAmounts($systemSchoolCode, $schoolClassCode, $schoolStreamCode, $financialYear){
     
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
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
    
}

?>
