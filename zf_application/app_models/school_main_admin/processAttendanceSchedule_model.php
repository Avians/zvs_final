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

class processAttendanceSchedule_Model extends Zf_Model {
    

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
     * This method is used to select Admin localities
     */
    public function processAnnualAttendanceSchedule(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $selectedYearValues = $_POST['postedValues'];
        
        
        if(!isset($selectedYearValues)) 
        {
          $selectedYear = Zf_Core_Functions::Zf_CurrentDate("Y");
          
        }else{
            
          $selectedYear = $selectedYearValues;
            
        }
        
        //Here we fetch all attendance data a return an array of data
        $attndanceDetails = $this->zvs_fetchAttendanceData($systemSchoolCode, $selectedYear);
        
        $zvs_attendanceGridView = '';
        
        if($attndanceDetails == 0){
            
            $zvs_attendanceGridView .='<div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br/>
                                    <span class="content-view-errors" >
                                        <b>&nbsp;There is no school attendance schedule for the the year '.$selectedYear.' as of yet!</b>
                                    </span>
                                </div>';
            
        }else{
        
            $zvs_attendanceGridView .='<div class="zvs-table-blocks scroller" data-always-visible="1" data-rail-visible="0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th  style="width: 30%;">Attendance Name</th><th style="width: 20%;">Start Date</th><th style="width: 20%;">End Date</th><th style="width: 15%;">Attendance Status</th><th style="width: 15%; text-align: center !important;">Edit Attendance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
            
                                                foreach ($attndanceDetails as $attendanceValues) {
                                                    
                                                    $schoolAttendanceCode = $attendanceValues['schoolAttendanceCode'];
                                                    $attendanceName = ucwords($attendanceValues['attendanceName']);$attendanceStartDate = Zf_Core_Functions::Zf_FomartDate("d-m-Y", $attendanceValues['attendanceStartDate']);$attendanceEndDate = Zf_Core_Functions::Zf_FomartDate("d-m-Y", $attendanceValues['attendanceEndDate']);
                                                    $attendanceStatus = ($attendanceValues['attendanceStatus'] == 1 ? '<i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'<i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
                                                    
                                                    $zvs_attendanceGridView .='<tr><td>'.$attendanceName.'</td><td style="text-align:left !important;">'.$attendanceStartDate.'</td><td style="text-align:left !important;">'.$attendanceEndDate.'</td><td style="text-align:center !important;">'.$attendanceStatus.'</td><td style="text-align: center !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'edit_attendance_details'.DS.  Zf_SecureData::zf_encode_url($schoolAttendanceCode).' " title="Edit '.$attendanceName.'" ><i class="fa fa-edit"></i></a></td></tr>';

                                                }
                                                
                          $zvs_attendanceGridView .='</tbody>
                                            </table>
                                        </div>
                                   </div>';
        }
             
         
         
         echo $zvs_attendanceGridView;
        
    }
    
    
    
    
    /**
     * This private method fetches all attendance schedule data
     */
    private function zvs_fetchAttendanceData($systemSchoolCode, $selectedYear){
        
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
