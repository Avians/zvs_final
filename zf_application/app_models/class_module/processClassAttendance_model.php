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

class processClassAttendance_Model extends Zf_Model {
    

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
    public function getStreamDetails(){
        
        $classCode = $_POST['schoolClassCode'];
        
        
        //Here we have all related stream data
        $streamDetails = $this->zvs_fetchStreamDetails($classCode);
        
        $select_options = '';
        
        
        if($streamDetails == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="selectClassStream">Select a stream</option>';
            
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
    public function getStudentsDetails(){
        
        //Student stream code
        $attendanceSheetValues = $_POST['attendanceSheetValues'];
        
        $studentStreamCode = explode(ZVSS_CONNECT, $attendanceSheetValues)[0].ZVSS_CONNECT.explode(ZVSS_CONNECT, $attendanceSheetValues)[1].ZVSS_CONNECT.explode(ZVSS_CONNECT, $attendanceSheetValues)[2];
        $attendanceDate = explode(ZVSS_CONNECT, $attendanceSheetValues)[3];
        
        //echo $attendanceSheetValues; exit();
        
        //Here we have fetch all student class details
        $studentClassDetails = $this->zvs_fetchStudentClassDetails($studentStreamCode);
        
        $studentListView = "";
        
        if($studentClassDetails == 0){
            
            $studentListView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 310px !important;">
                                        <!--Student List Details Error-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Student List Error</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 10% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                                <span class="content-view-errors" style="color: #B94A48;">
                                                    &nbsp;There is no students list associated with the selected class stream! Contact school system administrator for more information.
                                                </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>';
            
        }else{
            
            $studentListView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Student List Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Attendance Sheet as at '.$attendanceDate.'</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div style="height: auto !important; text-align: center !important; padding: 3px !important; border: 1px solid #cecece;">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 20%;">Admission Number</th>
                                                                <th style="width: 40%;">Student Full Name</th>
                                                                <th colspan="2" style style="width: 40%;">
                                                                    <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px !important;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="2" style="text-align: center !important;">Student Attendance Status</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="text-align: center !important; width: 50% !important;">Present</th>
                                                                                <th style="text-align: center !important; width: 50% !important;">Absent</th>
                                                                            </tr>
                                                                        </thead>
                                                                     </table>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                         
                                                        foreach ($studentClassDetails as $studentClassValues) {
                
                                                            $studentIdentificationCode = $studentClassValues['identificationCode'];
                                                            $studentAdmissionNumber = $studentClassValues['studentAdmissionNumber'];

                                                            $studentPersonalDetails = $this->zvs_fetchStudentsPersonalDetails($studentIdentificationCode);
                                                            
                                                            if($studentPersonalDetails == 0){
            
                                                                $studentListView .= '<div value="">No Student List Data!!</div>';

                                                            }else{

                                                                foreach ($studentPersonalDetails as $studentPersonalValue) {

                                                                    $studentFirstName = $studentPersonalValue['studentFirstName']; 
                                                                    $studentMiddleName = empty($studentPersonalValue['studentMiddleName']) ? "" : $studentPersonalValue['studentMiddleName'];
                                                                    $studentLastName = empty($studentPersonalValue['studentLastName']) ? "" : $studentPersonalValue['studentLastName'];
                                                                    $studentAdmissionNumber = $studentPersonalValue['studentAdmissionNumber']; 
                                                                    //$identificationCode = $studentPersonalValue['identificationCode'];
                                                                    $cleanStudentAdmissionNumber = Zf_Core_Functions::Zf_CleanName($studentAdmissionNumber);

                                                                    $studentFullName = $studentFirstName." ".$studentMiddleName." ".$studentLastName;

                                                                    $studentListView .='<tr><td style="text-align: left; padding-left: 10px; font-family: Ubuntu-R; font-size: 12px;">'.$studentAdmissionNumber.'</td>'
                                                                                     . '<td style="text-align: left; padding-left: 10px;  font-family: Roboto-Regular; font-size: 12px;">'.$studentFullName.'</td>'
                                                                                     . '<td style="width:20% !important;"><label><input type="radio" name="'.$cleanStudentAdmissionNumber.'"  value="1"></label></td>'
                                                                                     . '<td style="width:20% !important;"><label><input type="radio" checked name="'.$cleanStudentAdmissionNumber.'"  value="0"></label></tr>';

                                                                }

                                                            }
                                                            
                                                        }
                                                        
                                   $studentListView .= '</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            
        }
        
        echo $studentListView;
        
        
    }
    
    
    
    //This public method is responsible for recording class attendance for the selected date
    public function registerAttendanceDetails(){
        
       //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('schoolClassCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School class')
                
                                ->zf_postFormData('classStreamCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Class stream')
                
                                ->zf_postFormData('attendanceDate')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Attendance date')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        //This method fetched student details for the selected stream
        $studentClassDetails = $this->zvs_fetchStudentClassDetails($this->_validResult['classStreamCode']);
        
        
        //Get data for all the students
        foreach ($studentClassDetails as $studentClassValues) {

            //This is student identification code
            $studentAdmissionNumber = $studentClassValues['studentAdmissionNumber'];

            $cleanAdmissionNumber = Zf_Core_Functions::Zf_CleanName($studentAdmissionNumber);

            //This assigns an attendance value to each stream student
            $this->zf_formController->zf_postFormData($cleanAdmissionNumber);

        }
        
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Class Attendance Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        if(empty($this->_errorResult)){
            
            //This handles the current date i.e today's date
            $currentDate = strtotime(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
            
            //This handles the selected date i.e attendance date selected from the form
            $selectedDate = strtotime(Zf_Core_Functions::Zf_FomartDate("Y-m-d",$this->_validResult['attendanceDate']));
            
            //Constant form values
            $systemSchoolCode = explode(ZVSS_CONNECT, $this->_validResult['schoolClassCode'])[0];
            $schoolClassCode = $this->_validResult['schoolClassCode'];
            $classStreamCode = $this->_validResult['classStreamCode'];
            $adminIdentificationCode = $this->_validResult['adminIdentificationCode'];
            $attendanceDate = Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['attendanceDate']);
            $attendanceDay = date("D", $selectedDate); //Mon, Tue, Wed
            $attendanceWeek = date("W", $selectedDate); //30, 50, 42
            $attendanceMonth = date("M", $selectedDate); // Jan, Feb, Mar
            $attendanceYear = date("Y", $selectedDate); //2017
            
            //echo "Selected date: ".$selectedDate."<br> Attendance Date: ".$attendanceDate."<br> Attendance Day: ".$attendanceDay."<br> Attendance Week: ".$attendanceWeek."<br> Attendance Month: ".$attendanceMonth."<br> Attendance Year: ".$attendanceYear; exit();
            
            if($schoolClassCode == "selectClass"){
                
                $zf_errorData = array("zf_fieldName" => "schoolClassCode", "zf_errorMessage" => "* A kindly select a school class!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("class_module", 'class_register', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else if($classStreamCode == "selectClassStream"){
                
                $zf_errorData = array("zf_fieldName" => "classStreamCode", "zf_errorMessage" => "* A kindly select a class stream!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("class_module", 'class_register', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }else if($selectedDate > $currentDate){
                
                $zf_errorData = array("zf_fieldName" => "attendanceDate", "zf_errorMessage" => "* You cannot take attendance for future dates!!");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("class_module", 'class_register', $this->_validResult['adminIdentificationCode']);
                
            }else{
                
                //Formatted SQL values that are constants
                $zvs_sqlValueInsertUpdate["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValueInsertUpdate["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                $zvs_sqlValueInsertUpdate["classStreamCode"] = Zf_QueryGenerator::SQLValue($classStreamCode);
                $zvs_sqlValueInsertUpdate["createdBy"] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
                $zvs_sqlValueInsertUpdate["studentAttendanceDate"] = Zf_QueryGenerator::SQLValue($attendanceDate);
                $zvs_sqlValueInsertUpdate["studentAttendanceDay"] = Zf_QueryGenerator::SQLValue($attendanceDay);
                $zvs_sqlValueInsertUpdate["studentAttendanceWeek"] = Zf_QueryGenerator::SQLValue($attendanceWeek);
                $zvs_sqlValueInsertUpdate["studentAttendanceMonth"] = Zf_QueryGenerator::SQLValue($attendanceMonth);
                $zvs_sqlValueInsertUpdate["studentAttendanceYear"] = Zf_QueryGenerator::SQLValue($attendanceYear);
                
                $zvs_sqlValueSelect["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValueSelect["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                $zvs_sqlValueSelect["classStreamCode"] = Zf_QueryGenerator::SQLValue($classStreamCode);
                $zvs_sqlValueSelect["createdBy"] = Zf_QueryGenerator::SQLValue($adminIdentificationCode);
                $zvs_sqlValueSelect["studentAttendanceDate"] = Zf_QueryGenerator::SQLValue($attendanceDate);
                
                //Create an array that excludes all the form constant values
                foreach ($this->_validResult as $arrayKey=>$arrayValue) {
                    
                    if($arrayKey != 'schoolClassCode' && $arrayKey != 'classStreamCode' && $arrayKey != 'attendanceDate' && $arrayKey != 'adminIdentificationCode'){
                        
                        //echo $arrayKey." ===> ".$arrayValue."<br>";
                        
                        //Lets pull the class details for a each admission number
                        $classDetails = $this->zvs_fetchStudentClassDetails($classStreamCode);
                        
                        foreach ($classDetails as $classValues){
                            
                            //This is the student admission number
                            $studentAdmissionNo = $classValues['studentAdmissionNumber'];
                            $studentIdentificationCode = $classValues['identificationCode'];
                            
                            //This is the cleaned student admission number
                            $cleanedAdmissionNo = Zf_Core_Functions::Zf_CleanName($studentAdmissionNo);
                            
                            //Only return the value if the cleaned student admission number is similar to array key
                            if($arrayKey == $cleanedAdmissionNo){
                                
                                //We prepare SQL query that changes based on selected values
                                $zvs_sqlValueInsertUpdate["studentAdmissionNumber"] = Zf_QueryGenerator::SQLValue($studentAdmissionNo);
                                $zvs_sqlValueInsertUpdate["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                
                                $zvs_sqlValueSelect["studentAdmissionNumber"] = Zf_QueryGenerator::SQLValue($studentAdmissionNo);
                                $zvs_sqlValueSelect["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                
                                
                                //check if this record has already been marked for attendance for the selected date
                                $selectAttendanceRecord = Zf_QueryGenerator::BuildSQLSelect("zvs_school_class_attendance", $zvs_sqlValueSelect);
                                
                                //echo  $selectAttendanceRecord."<br><br>";
                                
                                //Execute the select query
                                $zf_executeSelectAttendanceRecord = $this->Zf_AdoDB->Execute($selectAttendanceRecord);
                                
                                //Verify this SQL query
                                if(!$zf_executeSelectAttendanceRecord){
                            
                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                }else{
                                    
                                    //If record exists, then update
                                    if($zf_executeSelectAttendanceRecord->RecordCount() > 0){
                                        
                                        $zvs_sqlValueInsertUpdate["studentAttendanceStatus"] = Zf_QueryGenerator::SQLValue($arrayValue);
                                        $zvs_sqlValueInsertUpdate["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                                        
                                        //This are the reference columns
                                        $zvs_sqlColumn['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                                        $zvs_sqlColumn['schoolClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                                        $zvs_sqlColumn['classStreamCode'] = Zf_QueryGenerator::SQLValue($classStreamCode);
                                        $zvs_sqlColumn['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                                        $zvs_sqlColumn['studentAttendanceDate'] = Zf_QueryGenerator::SQLValue($attendanceDate);

                                        //This is the SQL query for either inserting or updating records
                                        $insertUpdateAttendanceRecord = Zf_QueryGenerator::BuildSQLUpdate("zvs_school_class_attendance", $zvs_sqlValueInsertUpdate, $zvs_sqlColumn);
                                        
                                        //echo "<pre>".$insertUpdateAttendanceRecord."</pre><br><br>";
                                        
                                    }
                                    //Else insert the record afresh
                                    else{
                                        
                                        $zvs_sqlValueInsertUpdate["studentAttendanceStatus"] = Zf_QueryGenerator::SQLValue($arrayValue);
                                        $zvs_sqlValueInsertUpdate["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                                        $zvs_sqlValueInsertUpdate["dateModified"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                                        //This is the SQL query for either inserting or updating records
                                        $insertUpdateAttendanceRecord = Zf_QueryGenerator::BuildSQLInsert("zvs_school_class_attendance", $zvs_sqlValueInsertUpdate);
                                        
                                        //echo "<pre>".$insertUpdateAttendanceRecord."</pre><br><br>";
                                        
                                        
                                    }
                                    
                                    //echo "<pre>".$insertUpdateAttendanceRecord."</pre><br><br>";
                                    
                                    //Here we execute the update SQL query
                                    $zf_executeInsertUpdateAttendanceRecord = $this->Zf_AdoDB->Execute($insertUpdateAttendanceRecord);

                                    if(!$zf_executeInsertUpdateAttendanceRecord){

                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                    }
                                    
                                }
                                
                            }
                            
                        }
                        
                    }
                    
                }
                
                //Redirect to the registration form section. Also make an error indicator.
                Zf_SessionHandler::zf_setSessionVariable("class_module", "attendance_register_success");

                echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
                Zf_GenerateLinks::zf_header_location("class_module", 'class_register', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("class_module", "class_attendance_register_error");

            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("class_module", 'class_register', $this->_validResult['adminIdentificationCode']);
            exit();
            
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
        
        $zvs_sqlCoumns = array('identificationCode', 'studentFirstName', 'studentMiddleName', 'studentLastName', 'studentAdmissionNumber');
        
        $fetchStudentPersonalDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_personal_details', $zvs_sqlValue, $zvs_sqlCoumns, "studentAdmissionNumber", TRUE);
        //Zf_QueryGenerator::Bui
        
        //echo $fetchStudentPersonalDetails; exit();
        
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
