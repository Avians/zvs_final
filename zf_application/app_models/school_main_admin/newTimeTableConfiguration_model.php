<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible for the configuration of a   |
 * |  Stream TimeTable into the school.                                      |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class newTimeTableConfiguration_Model extends Zf_Model {
    

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
    * Register a new attendance within a valid school
    */
    public function registerNewAttendance(){
        
        //In this section we chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('attendanceName')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Attendance name')
                                ->zf_validateFormData('zf_minimumLength', 1, 'Attendance name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Attendance name')

                                ->zf_postFormData('attendanceYear')
                                ->zf_validateFormData('zf_maximumLength', 5, 'Attendance year')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Attendance year')
                
                                ->zf_postFormData('attendanceStartDate')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Start date')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Start date')
                
                                ->zf_postFormData('attendanceEndDate')
                                ->zf_validateFormData('zf_maximumLength', 20, 'End date')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'End date')
                
                                ->zf_postFormData('attendanceStatus')
                
                                ->zf_postFormData('adminIdentificationCode');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>New Attendance Data<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; //exit();
        
        $identificationCode = $this->_validResult['adminIdentificationCode'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        $formatedStartDate =  Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['attendanceStartDate']);
        $formatedEndDate =  Zf_Core_Functions::Zf_FomartDate("Y-m-d", $this->_validResult['attendanceEndDate']);
        
        

        if(empty($this->_errorResult)){
            
            $attendanceYear = intval($this->_validResult['attendanceYear']);
            
            $startingYear = intval(Zf_Core_Functions::Zf_FomartDate("Y", $this->_validResult['attendanceStartDate']));
            $endingYear = intval(Zf_Core_Functions::Zf_FomartDate("Y", $this->_validResult['attendanceEndDate']));
            
            $startingMonth = intval(Zf_Core_Functions::Zf_FomartDate("m", $this->_validResult['attendanceStartDate']));
            $endingMonth = intval(Zf_Core_Functions::Zf_FomartDate("m", $this->_validResult['attendanceEndDate']));
            
            $startingDate = intval(Zf_Core_Functions::Zf_FomartDate("d", $this->_validResult['attendanceStartDate']));
            $endingDate = intval(Zf_Core_Functions::Zf_FomartDate("d", $this->_validResult['attendanceEndDate']));
            
            if($attendanceYear != $startingYear){
                
                //Attendance year error
                Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "attendance_year_error");

                $zf_errorData = array("zf_fieldName" => "attendanceYear", "zf_errorMessage" => "* This attendance year should be same as start year!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                exit();
                
                
            }else if($startingYear > $endingYear){
                
                //Starting year error
                Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "start_year_error");

                $zf_errorData = array("zf_fieldName" => "attendanceStartDate", "zf_errorMessage" => "* This start year cannot be greater than end year!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                exit();
                
                
                
            }else if(($startingYear == $endingYear) && ($startingMonth > $endingMonth)){
                
                //Starting month error
                Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "start_month_error");

                $zf_errorData = array("zf_fieldName" => "attendanceStartDate", "zf_errorMessage" => "* This start month cannot be greater than end month!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                exit();
                
            }else if(($startingYear == $endingYear) && ($startingMonth == $endingMonth) && ($startingDate > $endingDate)){
                
                //Starting date error
                Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "start_date_error");

                $zf_errorData = array("zf_fieldName" => "attendanceStartDate", "zf_errorMessage" => "* This start date cannot be greater than end date!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                exit();
                
            }else{
                
                $attendanceScheduleName = ucwords($this->_validResult['attendanceName']);
                $attendanceScheduleYear = $this->_validResult['attendanceYear'];
                $systemSchoolCode = $identificationArray[2];
                $systemAttendanceCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($attendanceScheduleName).ZVSS_CONNECT.$attendanceScheduleYear;

                //We prepare SQL values
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['systemAttendanceCode'] = Zf_QueryGenerator::SQLValue($systemAttendanceCode);

                //Here we prepare target column
                $zvs_sqlColumns = array('systemSchoolCode','systemAttendanceCode');

                //Check if a similar subject has already been registered
                $zvs_checkAttendanceSchedule = Zf_QueryGenerator::BuildSQLSelect("zvs_school_attendance_schedule", $zvs_sqlValues, $zvs_sqlColumns);
                $zvs_executeCheckAttendanceSchedule = $this->Zf_AdoDB->Execute($zvs_checkAttendanceSchedule);

                if(!$zvs_executeCheckAttendanceSchedule){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    if($zvs_executeCheckAttendanceSchedule->RecordCount() > 0){

                        //A similar grade has already been registered for the same school
                        Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "existing_attendance_error");

                        $zf_errorData = array("zf_fieldName" => "attendanceName", "zf_errorMessage" => "* This attendance schedule already exists!!.");
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                        Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                        exit();

                    }else{

                        //Prepare all database values
                        foreach ($this->_validResult as $zvs_fieldName => $zvs_fieldValue) {

                            if($zvs_fieldName != 'adminIdentificationCode' ){
                                
                                if($zvs_fieldName == 'attendanceStartDate'){
                                
                                    $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($formatedStartDate);
                               
                                }else if($zvs_fieldName == 'attendanceEndDate'){
                                
                                    $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($formatedEndDate);
                               
                                }else if($zvs_fieldName == 'attendanceName'){
                                
                                    $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($attendanceScheduleName);
                               
                                }else{
                                    
                                    $zvs_sqlValues[$zvs_fieldName] = Zf_QueryGenerator::SQLValue($zvs_fieldValue);
                                    
                                }

                            }

                        }

                        $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));

                        //Insertion sql query and execution
                        $zvs_insertNewAttendanceSchedule = Zf_QueryGenerator::BuildSQLInsert("zvs_school_attendance_schedule", $zvs_sqlValues);
                        $zvs_executeInsertNewAttendanceSchedule = $this->Zf_AdoDB->Execute($zvs_insertNewAttendanceSchedule);

                        if(!$zvs_executeInsertNewAttendanceSchedule){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            //Insertion successful
                             Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "attendance_configuration_success");
                             Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance', $identificationCode);
                             exit();

                        }

                    }

                }
                
            }
            
        }else{
            
            Zf_SessionHandler::zf_setSessionVariable("configure_attendance", "attendance_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('school_main_admin', 'configure_attendance',$identificationCode);
            exit();
            
        }
        
    }
    
    
    
    
    
    /**
     * This method returns the options for selecting year of study
     */
    public function zvs_buildYearsOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-1;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 90px !important;"  id="'.$yearsDiv.'">';
        
            for($year=$startYear; $year < $endYear+2; $year++){
                
                if(!empty($startYear) && $startYear != NULL){
                    
                    if(($year > $startYear || $year == $startYear) && $year != $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                        
                    }if($year == $endYear){
                        
                        $option .= '<option value="'.$year.'" selected >'.$year.'</option>';
                        
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
                    
                }
                
            }
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
    
    
    
    
    /**
     * This method returns the options for selecting a given class
     */
    public function zvs_buildClassOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-1;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 90px !important;"  id="'.$yearsDiv.'">';
        
            for($year=$startYear; $year < $endYear+2; $year++){
                
                if(!empty($startYear) && $startYear != NULL){
                    
                    if(($year > $startYear || $year == $startYear) && $year != $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                        
                    }if($year == $endYear){
                        
                        $option .= '<option value="'.$year.'" selected >'.$year.'</option>';
                        
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
                    
                }
                
            }
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
    
    
    
    /**
     * This method returns the options for selecting streams within the selected class
     */
    public function zvs_buildStreamOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-1;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 90px !important;"  id="'.$yearsDiv.'">';
        
            for($year=$startYear; $year < $endYear+2; $year++){
                
                if(!empty($startYear) && $startYear != NULL){
                    
                    if(($year > $startYear || $year == $startYear) && $year != $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                        
                    }if($year == $endYear){
                        
                        $option .= '<option value="'.$year.'" selected >'.$year.'</option>';
                        
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
                    
                }
                
            }
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
    
}

?>
