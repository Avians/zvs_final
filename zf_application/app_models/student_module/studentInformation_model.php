<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered student.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class studentInformation_Model extends Zf_Model {
    

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
     * This method is used to select Admin localities
     */
    public function getStudentLocality(){
        
        $countryCode = $_POST['countryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($countryCode); 
        $zf_selectLocality = Zf_QueryGenerator::BuildSQLSelect('zvs_school_locality', $zf_valueCountryCode);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocality)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectLocality}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->localityCode."' >".$fetchRow->localityName." ".$fetchRow->localityType."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
            }
        }
        
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function getStreamDetails(){
        
        $classCode = $_POST['studentClassCode'];
        
        
        //Here we have all related stream data
        $streamDetails = $this->zvs_fetchStreamDetails($classCode);
        
        $select_options = '';
        
        
        if($streamDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="">Select a stream</option>';
            
            foreach ($streamDetails as $streamValue) {
                
                $streamName = $streamValue['schoolStreamName']; $streamCode = $streamValue['schoolStreamCode'];
                $streamCapacity = $streamValue['schoolStreamCapacity']; $streamOccupancy = $streamValue['schoolStreamOccupancy'];
                
                if($streamCapacity != $streamOccupancy){
                    
                    $select_options .= '<option value="'.$streamCode.'">'.$streamName.'</option>';;
                    
                }
                
            }
            
        }
        
               
        echo $select_options;
        
        
    }
    
    
    
    
    //This public method is responsible for fetching all the student list for a given stream
    public function getStudentsList(){
        
        //Student stream code
        $studentStreamCode = $_POST['studentStreamCode'];
        
        //Here we have fetch all student class details
        $studentClassDetails = $this->zvs_fetchStudentClassDetails($studentStreamCode);
        
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
                        
                        $studentFirstName = $studentPersonalValue['studentFirstName']; 
                        $studentMiddleName = empty($studentPersonalValue['studentMiddleName']) ? "" : $studentPersonalValue['studentMiddleName'];
                        $studentLastName = empty($studentPersonalValue['studentLastName']) ? "" : $studentPersonalValue['studentLastName'];
                        $studentAdmissionNumber = $studentPersonalValue['studentAdmissionNumber']; $identificationCode = $studentPersonalValue['identificationCode'];
                        
                        $studentFullName = $studentFirstName." ".$studentMiddleName." ".$studentLastName;

                        $select_options .= '<option value="'.$identificationCode.'">['.$studentAdmissionNumber.'] - '.$studentFullName.'</option>';
                    
                    }
                    
                }
                
                
            }
            
        }
        
               
        echo $select_options;
        
        
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
    
    
    
    //This prublic method fetcches school student statistics for a selceted year.
    public function zvs_fetchStudentInformation($identificationCode){
        
        $identificationArray = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($identificationCode));
        
        $systemSchoolCode = $identificationArray[2];
        
        $zvs_studentDetails = "";
        
        $zvs_studentDetails .=' <!--START OF STUDENT INFORMATION STATISTICS-->
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat purple-sharp">
                                            <div class="visual">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                                                    $zvs_studentDetails .= $this->getTotalStudents($systemSchoolCode); 
                        $zvs_studentDetails .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Total Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Students
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat green-sharp">
                                            <div class="visual">
                                                <i class="fa fa-male"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                                                   $zvs_studentDetails .= $this->countStudentGender($systemSchoolCode, "Male"); 
                        $zvs_studentDetails .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Male Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-male"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Male Students
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat blue-madison">
                                            <div class="visual">
                                                <i class="fa fa-female"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                                                   $zvs_studentDetails .= $this->countStudentGender($systemSchoolCode, "Female");
                        $zvs_studentDetails .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Female Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-female"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Female Students
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat red-soft">
                                            <div class="visual">
                                                <i class="fa fa-wheelchair-alt"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                                                   $zvs_studentDetails .= $this->countDisabledStudents("Yes");
                        $zvs_studentDetails .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                   Disabled Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-wheelchair-alt"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total Disabled Students
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END OF STUDENT INFORMATION STATISTICS-->';
        
        
        echo $zvs_studentDetails;
        
    }
    
    
    
    
    //This private method pulls data for all students in school
    private function getTotalStudents($systemSchoolCode){
        
        $studentPersonalDetailsTable = "zvs_students_personal_details";
        $studentClassDetailsTable = "zvs_students_class_details";
        
        //The counts SQL query goes here
        $zvsStudentsCount = 'SELECT * FROM `'.$studentPersonalDetailsTable.'` INNER JOIN `'.$studentClassDetailsTable.'` on `'.$studentPersonalDetailsTable.'`.`identificationCode` = `'.$studentClassDetailsTable.'`.`identificationCode`  WHERE  `'.$studentPersonalDetailsTable.'`.`systemSchoolCode` = "'.$systemSchoolCode.'" ';
        
        $executeStudentCount   = $this->Zf_AdoDB->Execute($zvsStudentsCount);
        
        if (!$executeStudentCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $studentCount = $executeStudentCount->RecordCount();
        }
        
        //return student count
        return $studentCount;
        
    }
    
    
    
    
    //This private method pulls data for all students based on gender
    private function countStudentGender($systemSchoolCode, $gender){
        
        $studentPersonalDetailsTable = "zvs_students_personal_details";
        $studentClassDetailsTable = "zvs_students_class_details";
        $studentsGender = $gender;
        
        //The counts SQL query goes here
        $zvsStudentsCount = 'SELECT * FROM `'.$studentPersonalDetailsTable.'` INNER JOIN `'.$studentClassDetailsTable.'` on `'.$studentPersonalDetailsTable.'`.`identificationCode` = `'.$studentClassDetailsTable.'`.`identificationCode`  WHERE  `'.$studentPersonalDetailsTable.'`.`systemSchoolCode` = "'.$systemSchoolCode.'" AND `'.$studentPersonalDetailsTable.'`.`studentGender` = "'.$studentsGender.'" ';
        
        $executeStudentCount   = $this->Zf_AdoDB->Execute($zvsStudentsCount);
        
        if (!$executeStudentCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $studentCount = $executeStudentCount->RecordCount();
        }
        
        //return student count
        return $studentCount;
        
    }
    
    
    
    
    //This private method pulls data for all dusabled students
    private function countDisabledStudents($disabilityStatus){
        
        $studentMedicalDetailsTable = "zvs_students_medical_details";
        $studentClassDetailsTable = "zvs_students_class_details";
        $studentsDisabilityStatus = $disabilityStatus;
        
        //The counts SQL query goes here
        $zvsStudentsCount = 'SELECT * FROM `'.$studentMedicalDetailsTable.'` INNER JOIN `'.$studentClassDetailsTable.'` on `'.$studentMedicalDetailsTable.'`.`studentIdentificationCode` = `'.$studentClassDetailsTable.'`.`identificationCode`  WHERE `'.$studentMedicalDetailsTable.'`.`isStudentDisable` = "'.$studentsDisabilityStatus.'" ';
        
        $executeStudentCount   = $this->Zf_AdoDB->Execute($zvsStudentsCount);
        
        if (!$executeStudentCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $studentCount = $executeStudentCount->RecordCount();
        }
        
        //return student count
        return $studentCount;
        
    }
    
    
    
    
    //This private method fetches student class detials for a given selected stream.
    private function zvs_fetchStudentClassDetails($studentsStreamCode){
        
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
    
    
}

?>
