<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data school guardian  |
 * |  and the related student                                          |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class guardianProfile_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
    public $gurdianIdentificationCode;


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
     * This method is returns all student profile data
     */
    public function pullStudentProfile(){
        
        $identificationCode = $_POST['studentIdentificationCode'];
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];

        //Student Admission Number
        $studentAdmissionNumber = $userIdentificationArray[4];
        
        $studentProfile = $this->actualStudentProfileData($systemSchoolCode, $studentAdmissionNumber);
        
        $studentProfileView = "";
        
        $studentProfileView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Student Personal Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Student Details</h3>
                                        </div>';
                                        $studentProfileView .= $studentProfile;
            $studentProfileView .= '</div>
                                </div>';
        
        echo $studentProfileView;
        
    }
    
    
    
    
    /**
     * This method is returns all guardian profile data
     */
    public function pullGuardianProfile(){
        
        //This is the student identification code
        $identificationCode = $_POST['studentIdentificationCode'];
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];

        //Student Admission Number
        $studentAdmissionNumber = $userIdentificationArray[4];
        
        $guardianProfile = $this->actualGuardianProfileData($systemSchoolCode, $studentAdmissionNumber);
        
        
        $guardianProfileView = "";
        
        $guardianProfileView .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Student Guardian Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Guardian Details</h3>
                                        </div>';
                                        $guardianProfileView .= $guardianProfile;
            $guardianProfileView .= '</div>
                                </div>';
        
       echo $guardianProfileView;
            
        
    }
    
    
  
    
    /**
     * This method is returns all student profile data
     */
    public function fetchStudentProfile($identificationCode){
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];

        //Student Admission Number
        $studentAdmissionNumber = $userIdentificationArray[4];

        //This function fetches and returns the actual student profile data
        $studentProfile = $this->actualStudentProfileData($systemSchoolCode, $studentAdmissionNumber);
        
        echo $studentProfile;
        
    }
    
    
  
    
    /**
     * This method is returns all guardian profile data
     */
    public function fetchGuardianProfile($identificationCode){
        
        //User Identification Array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        //System School Code
        $systemSchoolCode = $userIdentificationArray[2];

        //Student Admission Number
        $studentAdmissionNumber = $userIdentificationArray[4];

        //This function fetches and returns the actual student profile data
        $guardianProfile = $this->actualGuardianProfileData($systemSchoolCode, $studentAdmissionNumber);

        echo $guardianProfile; 
    }
    
    
    
    
    /**
     * This is the method that actually fetches all the student data and creates the profile view
     */
    private function actualStudentProfileData($systemSchoolCode, $studentAdmissionNumber){
        
        //This is the method that pull student data from the database
        $studentDetails = $this->zvs_pullStudentDetails($systemSchoolCode, $studentAdmissionNumber);
        
        //This is the variable that creates guardian profile view
        $studentProfileView = "";
        
        if($studentDetails == 0){
            
            $studentProfileView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 20% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                                <span class="content-view-errors" >
                                                    &nbsp;There is no student details associated with the selected student! Contact school system administrator for more information.
                                                </span>
                                            </div>
                                        </div>         
                                    </div>';
            
        }else{
            
            foreach ($studentDetails as $studentValues) {
                
                $studentIdentificationCode = $studentValues['identificationCode']; $admissionNumber = $studentValues['studentAdmissionNumber'];
                $studentFirstName = $studentValues['studentFirstName']; $studentMiddleName = empty($studentValues['studentMiddleName']) ? "" : $studentValues['studentMiddleName']; $studentLastName = empty($studentValues['studentLastName']) ? "" : $studentValues['studentLastName']; 
                $studentGender = empty($studentValues['studentGender']) ? "Not set" : $studentValues['studentGender'];  $studentDateOfBirth = empty($studentValues['studentDateOfBirth']) ? "Not set" : $studentValues['studentDateOfBirth']; $studentReligion = $studentValues['studentReligion'];
                $studentBoxAddress = $studentValues['studentBoxAddress']; $studentPhoneNumber = $studentValues['studentPhoneNumber']; $studentLanguage = $studentValues['studentLanguage'];
                
                $studentFullName = $studentFirstName." ".$studentMiddleName." ".$studentLastName;
                
                //pull student class details
                //$studentClassDetails = $this->zvs_pullStudentClassDetails($systemSchoolCode, $studentIdentificationCode);
                
                //Pull student email address
                $studentEmailAddress = $this->zvs_pullApplicationUserEmail($studentIdentificationCode);
                
                //Pull student country
                $countryName = $this->zvs_pullCountryDetails($studentValues['studentCountry']);
                
                //Pull student locality
                $localityName = $this->zvs_pullLocalityDetails($studentValues['studentCountry'], $studentValues['studentLocality']);
                
                //Pull student medical details
                $studentMedicalDetails = $this->zvs_pullStudentMedicalDetails($systemSchoolCode, $studentIdentificationCode);
                
                foreach ($studentMedicalDetails as $medicalValues){
                    
                    $studentBloodGroup = $medicalValues['isStudentBloodGroup'] == "No" ? "Not set" : (empty($medicalValues['studentBloodGroup']) ? "Not set" : $medicalValues['studentBloodGroup']);
                    $studentDisability = $medicalValues['isStudentDisable'] == "No" ? "Not disabled" : (empty($medicalValues['studentDisability']) ? 'Not set' : $medicalValues['studentDisability']);
                    
                }
                
                $studentClassDetails = $this->zvs_pullStudentClassDetails($systemSchoolCode, $studentIdentificationCode);
                
                foreach ($studentClassDetails as $classValues) {
                    
                    //Pull student class and stream details
                    $className = explode(ZVSS_CONNECT, $this->zvs_pullClassDetails($systemSchoolCode, $classValues['studentClassCode'], $classValues['studentStreamCode']))[0];
                    $streamName = explode(ZVSS_CONNECT, $this->zvs_pullClassDetails($systemSchoolCode, $classValues['studentClassCode'], $classValues['studentStreamCode']))[1];
                    
                }
                
                //pull student guardian identification code
                $this->gurdianIdentificationCode = $this->zvs_pullGuardianIdentificationCode($studentIdentificationCode);
                
            }
        
            $studentProfileView = ' <div class="col-md-12 margin-bottom-10" style="border: 0px solid #efefef; border-radius: 5px !important;">
                                        <div class="row" style="min-height: 60px;">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  margin-top-10" style="text-align: center; padding-top: 10px;">
                                                <div class="zvs-circular">   
                                                    <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-top-10" style="border-left: 1px solid #eeeeee; min-height: 100px;">
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Full Name:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$studentFullName.'</div>  
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Email:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px;">'.$studentEmailAddress.'</div>  
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Mobile:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px;">'.$studentPhoneNumber.'</div>  
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clearfix"><hr></div>
                                            </div>
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Gender:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$studentGender.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Admission No:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$studentAdmissionNumber.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Class:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$className.'</div>  
                                        </div>';
            
                                        if($className != $streamName){
                                            
                $studentProfileView .= '<div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Stream:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$streamName.'</div>  
                                        </div>';
                
                                        }
                                        
                                        
                                        //This private function pulls school hostel details
                                        $schoolDetails = $this->zvs_pullSchoolDetails($systemSchoolCode);
                                        
                                        if($schoolDetails == "Boarding School"){
                                            
                                            //This private method pulls student hostel details
                                            $studentHostelName = $this->zvs_pullStudentHostelDetails($systemSchoolCode, $studentIdentificationCode);
            
                                            $studentProfileView .= '<div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Hostel:</b></div>
                                                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$studentHostelName.'</div>  
                                                                    </div>';
                                        
                                        }
                
                $studentProfileView .= '</div>
                                        <div class="clearfix" style="margin-bottom: 20px !important;"></div>';
            
        }

        return $studentProfileView;
        
        
    }
    
    
    
    
    /**
     * This is the method that actually fetches all the guardian data and creates the profile view
     */
    private function actualGuardianProfileData($systemSchoolCode, $studentAdmissionNumber){
        
        //Get guardian identification code
        $guardianIdentificationCode = $this->zvs_pullGuardianIdentificationCode($systemSchoolCode, $studentAdmissionNumber);
        
        //This is the method that pull guardian data from the database
        $guardianDetails = $this->zvs_pullGuardianDetails($systemSchoolCode, $guardianIdentificationCode);
        
        //This is the variable that creates guardian profile view
        $guardianProfileView = "";
        
        if($guardianDetails == 0){
            
            $guardianProfileView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 20% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                                <span class="content-view-errors" >
                                                    &nbsp;There is no student details associated with the selected student! Contact school system administrator for more information.
                                                </span>
                                            </div>
                                        </div>         
                                    </div>';
            
        }else{
            
            foreach ($guardianDetails as $guardianValues){
                
                $guardianDesignation = empty($guardianValues['guardianDesignation']) ? "" : $guardianValues['guardianDesignation'].".";
                $guardianFirstName = $guardianValues['guardianFirstName']; $guardianMiddleName = empty($guardianValues['guardianMiddleName']) ? "" : $guardianValues['guardianMiddleName']; $guardianLastName = $guardianValues['guardianLastName']; 
                $guardianFullName = $guardianDesignation." ".$guardianFirstName." ".$guardianMiddleName." ".$guardianLastName;
                $guardianPhoneNumber = empty($guardianValues['guardianPhoneNumber']) ? "Not set" : $guardianValues['guardianPhoneNumber'];
                $guardianBoxAddress = empty($guardianValues['guardianBoxAddress']) ? "Not set" : $guardianValues['guardianBoxAddress'];
                $guardianGender = empty($guardianValues['guardianGender']) ? "Not set" : $guardianValues['guardianGender'];
                $guardianRelation = empty($guardianValues['guardianRelation']) ? "Not set" : $guardianValues['guardianRelation'];
                $guardianOccupation = empty($guardianValues['guardianOccupation']) ? "Not set" : $guardianValues['guardianOccupation'];
                $guardianLanguage = empty($guardianValues['guardianLanguage']) ? "Not set" : $guardianValues['guardianLanguage'];
                
                //Pull guardian email address
                $guardianEmail = $this->zvs_pullApplicationUserEmail($guardianIdentificationCode);
                
                //Pull student country
                $countryName = $this->zvs_pullCountryDetails($guardianValues['guardianCountry']);
                
                //Pull student locality
                $localityName = $this->zvs_pullLocalityDetails($guardianValues['guardianCountry'], $guardianValues['guardianLocality']);
            }
            
            $guardianProfileView = '<div class="col-md-12 margin-bottom-10" style="border: 0px solid #efefef; border-radius: 5px !important;">
                                        <div class="row" style="min-height: 60px;">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  margin-top-10" style="text-align: center; padding-top: 10px;">
                                                <div class="zvs-circular">   
                                                    <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-top-10" style="border-left: 1px solid #eeeeee; min-height: 100px;">
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Full Name:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianFullName.'</div>  
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Email:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px;">'.$guardianEmail.'</div>  
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row-fluid margin-bottom-10" style="min-height: 25px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: right; padding: 4px;">Mobile:</div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="background-color:  #f2f3f4; padding: 5px;">'.$guardianPhoneNumber.'</div>  
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clearfix"><hr></div>
                                            </div>
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Box Address:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianBoxAddress.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Gender:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianGender.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Student Relation:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianRelation.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Occupation:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianOccupation.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Official Language:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$guardianLanguage.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Guardian Country:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$countryName.'</div>  
                                        </div>
                                        <div class="row-fluid margin-bottom-15" style="min-height: 25px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="text-align: right; padding: 5px;"><b>Guardian Locality:</b></div>
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-color: #f2f3f4; padding: 5px;">'.$localityName.'</div>  
                                        </div>
                                    </div>
                                    <div class="clearfix" style="margin-bottom: 20px !important;"></div>';
            
        }
        
            
                                  
        return $guardianProfileView;
        
    }
    
    
    
    
    /**
     * This private method pulls all the student personal data
     */
    private function zvs_pullStudentDetails($systemSchoolCode, $studentAdmissionNumber){
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentAdmissionNumber"] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);

        $fetchStudentDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_personal_details', $zvs_sqlValue);

        $zf_executeFetchStudentDetails = $this->Zf_AdoDB->Execute($fetchStudentDetails);

        if(!$zf_executeFetchStudentDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentDetails->RecordCount() > 0){

                while(!$zf_executeFetchStudentDetails->EOF){

                    $results = $zf_executeFetchStudentDetails->GetRows();

                }

                return $results;


            }else{

                return 0;

            }
        }
                    
        
    }
    
    
    
    
    /**
     * This private method pulls all the guardian personal data
     */
    private function zvs_pullGuardianDetails($systemSchoolCode, $guardianIdentificationCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
        
        $fetchGuardianDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_guardian_details', $zvs_sqlValue);
        
        $zf_executeFetchGuardianDetails = $this->Zf_AdoDB->Execute($fetchGuardianDetails);

        if(!$zf_executeFetchGuardianDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchGuardianDetails->RecordCount() > 0){

                while(!$zf_executeFetchGuardianDetails->EOF){
                    
                    $results = $zf_executeFetchGuardianDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This private method pulls all the student medical details
     */
    private function zvs_pullStudentMedicalDetails($systemSchoolCode, $studentIdentificationCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        
        $fetchStudentMedicalDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_students_medical_details', $zvs_sqlValue);
        
        $zf_executeFetchStudentMedicalDetails = $this->Zf_AdoDB->Execute($fetchStudentMedicalDetails);

        if(!$zf_executeFetchStudentMedicalDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentMedicalDetails->RecordCount() > 0){

                while(!$zf_executeFetchStudentMedicalDetails->EOF){
                    
                    $results = $zf_executeFetchStudentMedicalDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This private method pulls all the student medical details
     */
    private function zvs_pullStudentClassDetails($systemSchoolCode, $studentIdentificationCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        
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
    
    
    
    
    /**
     * This survey pulls the school boarding details
     */
    private function zvs_pullSchoolDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectSchoolDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectSchoolDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectSchoolDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $schoolCategory = $fetchRow->schoolCategory;

                }

            }
            
            if($schoolCategory == "Boarding School" || $schoolCategory == "Boarding and Day"){
                
                return "Boarding School";
                
            }
        }
        
    }
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullApplicationUserEmail($identificationCode){
        
        $zvs_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $zf_selectUserDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectUserDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectUserDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $emailAddress = $fetchRow->email;

                }

            }
            
            return $emailAddress;
        }
        
    }
    
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullCountryDetails($countryCode){
        
        $zvs_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        
        $zf_selectCountryDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_country', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectCountryDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectCountryDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $countryName = $fetchRow->countryName;

                }

            }
            
            return $countryName;
        }
        
    }
    
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullLocalityDetails($countryCode, $localityCode){
        
        $zvs_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($countryCode);
        $zvs_sqlValue["localityCode"] = Zf_QueryGenerator::SQLValue($localityCode);
        
        $zf_selectLocalityDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_locality', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocalityDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectUserDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $localityName = $fetchRow->localityName.", ".$fetchRow->localityType;

                }

            }
            
            return $localityName;
        }
        
    }
    
    
    
    
    /**
     * This private function pulls all student class details
     */
    private function zvs_pullClassDetails($systemSchoolCode, $schoolClassCode, $schoolStreamCode){
        
        $zvs_sqlClassValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlClassValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $zf_selectClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlClassValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectClassDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectClassDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $className = $fetchRow->schoolClassName;

                }

            }
        }
        
        $zvs_sqlStreamValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlStreamValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlStreamValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
        
        $zf_selectStreamDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlStreamValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectStreamDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectStreamDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $streamName = $fetchRow->schoolStreamName;

                }

            }
        }
        
        return $className.ZVSS_CONNECT.$streamName;
        
    }
    
    
    
    
    /**
     * This private function pulls all student hostel details
     */
    private function zvs_pullStudentHostelDetails($systemSchoolCode, $studentIdentificationCode){
        
        $zvs_sqlHostelValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlHostelValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
        
        $zf_selectHostelDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_student_hostel_details', $zvs_sqlHostelValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectHostelDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectHostelDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $hostelCode = $fetchRow->schoolHostelCode;

                }

            }
        }
        
        
        //Fetch hostel name from hostels table
        $zvs_sqlSchoolHostel["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlSchoolHostel["schoolHostelCode"] = Zf_QueryGenerator::SQLValue($hostelCode);
        
        $zf_selectSchoolHostel = Zf_QueryGenerator::BuildSQLSelect('zvs_school_hostels', $zvs_sqlSchoolHostel);

        if(!$this->Zf_QueryGenerator->Query($zf_selectSchoolHostel)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectSchoolHostel}.</i></b>";
            echo $message; exit();

        }else{
            
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $hostelName = $fetchRow->schoolHostelName;

                }

            }
        }
        
        
        return empty($hostelName) ? "No hostel details" : $hostelName;
        
    }
    
    
    
    /**
     * This survey pulls the users email address
     */
    private function zvs_pullGuardianIdentificationCode($systemSchoolCode, $studentAdmissionNumber){
        
        //Pull student details to get the student identification code
        $studentDetails = $this->zvs_pullStudentDetails($systemSchoolCode, $studentAdmissionNumber);
        
        if($studentDetails == 0){
            
            $guardianIdentificationCode = "No Guardian for the selected student!!";
            
        }else{
        
            foreach ($studentDetails as $studentValues) {
                
                //This is the student identification code
                $studentIdentificationCode = $studentValues['identificationCode'];
                
                
                $zvs_sqlValue["studentIdentificationCode"] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                $zf_selectGuardianIdentificationCode = Zf_QueryGenerator::BuildSQLSelect('zvs_students_guardians_mapper', $zvs_sqlValue);

                if(!$this->Zf_QueryGenerator->Query($zf_selectGuardianIdentificationCode)){

                    $message = "Query execution failed.<br><br>";
                    $message.= "The failed Query is : <b><i>{$zf_selectGuardianIdentificationCode}.</i></b>";
                    echo $message; exit();

                }else{


                    $resultCount = $this->Zf_QueryGenerator->RowCount();

                    if($resultCount > 0){

                        $this->Zf_QueryGenerator->MoveFirst();

                        while(!$this->Zf_QueryGenerator->EndOfSeek()){

                            $fetchRow = $this->Zf_QueryGenerator->Row();
                            $guardianIdentificationCode = $fetchRow->guardianIdentificationCode;

                        }

                    }

                }
                
            }
              
        }
        
        return $guardianIdentificationCode;
        
    }
    
}

?>
