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
        $feeDetails = $this->zvs_fetchFeesDetails($identificationCode, $feesHistoryYear);
        
        $feesHistoryDetails = "";
        
        
        $feesHistoryDetails .= '<div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 330px !important; height: auto !important;">
                                    <div class="portlet-titles">Student Details</div>
                                    <div class="row" style="margin-top: 20px !important;">'.$identificationCode.'</div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="portlet-titles">Fees Payment Details</div>
                                    <div class="row" style="margin-top: 20px !important;">'.$feesHistoryYear.'</div>
                                </div>';
        
       
        echo $feesHistoryDetails;
        
    }
    
    
    
    
    //This private method fetches student class detials for a given selected stream.
    private function zvs_fetchStudentsClassDetails($studentsStreamCode){
        
        $currentYear = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
        
        $zvs_sqlValue["studentStreamCode"] = Zf_QueryGenerator::SQLValue($studentsStreamCode);
        $zvs_sqlValue["studentYearOfStudy"] = Zf_QueryGenerator::SQLValue($currentYear);
        
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
    
    
    
    
    //This private method fetches a student's fee payment history for a given year.
    private function zvs_fetchFeesDetails($identificationCode, $feesHistoryYear) {
        
    }
    
    
    
}

?>
