<?php


ini_set('max_execution_time', 180);  
ini_set('max_input_time', 180);	
ini_set('memory_limit','128M');

//echo ini_get("max_execution_time")."\n";
//ini_set("max_execution_time",1000);
//echo ini_get("max_execution_time")."\n";

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new school onto the   |
 * |  platform.                                                        |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class upload_data_templates_Model extends Zf_Model {
    

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
     * This public method uploads student data
     */
    public function uploadStudentData(){
        
        //place this before any script you want to calculate time
        //$time_start = microtime(true); 
        
        //In this section we chain all the data of a given school.
        $this->zf_formController->zf_postFormData('dataUploadFormError')
                
                                ->zf_postFormData('studentDataTemplate')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student data template')
                
                                ->zf_postFormData('createdBy');
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        $registeredBy = $this->_validResult['createdBy'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($registeredBy);
        
        //This of debugging purposes only.
        //echo "<pre>Student Data File<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        if(empty($this->_errorResult)){
           
            
            $systemSchoolCode = $identificationArray[2]; 
            $studentDataFile = $this->_validResult['studentDataTemplate'];
            $timeStamp = Zf_Core_Functions::Zf_CurrentTimeStamp();
            
            $temporaryFileName = Zf_Core_Functions::Zf_CleanName($timeStamp.ZVSS_CONNECT.explode("/", $studentDataFile['tmp_name'])[5]);
            
            //1. Prepare the student data file for upload.
            $fileName = $temporaryFileName;
            $uploadDirectory = ZF_DATASTORE."zvs_temporary_bulk_upload".DS."zvs_student_data_files";
            $fileArray = $this->_validResult['studentDataTemplate'];

            //2. Upload the excel file to a temporary location for storage
            Zf_Core_Functions::Zf_uploadFiles($fileArray, $fileName, $uploadDirectory);

            
            //3. Read the excel file from the temporary storage location so as to extract data
            $excelFile = ZF_DATASTORE."zvs_temporary_bulk_upload".DS."zvs_student_data_files".DS.$temporaryFileName.".xls";
            
            //4. Returns the number of sheets in the excel file.
            $numberOfSheets = Zf_ExcelReader::zf_numberOfSheets($excelFile);

            //5. First we target the student sheet to get student information
            $studentSheet = 0;
            
            //6. Returns the number of rows in the student sheet which should also be same as guardian sheet
            $studentSheetNumberOfRows = Zf_ExcelReader::zf_numberOfRows($excelFile, $studentSheet);
            
            //This array handle student admission errors
            $studentAdmissionErrors = array();
            
            //This array helps to check duplicate admission numbers
            $studentAdmissionDuplicates = array();
            
            //7. Loop through each row in the student sheet to get student data and 
            // check if any of the students' admission numbers has already been registered into the system 
            for ($row = 2; $row <= $studentSheetNumberOfRows; $row++){
                
                //7.1 While inside of each row first pull the student admission number.
                $studentAdmissionNumber = Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 1);
                
                if(!empty($studentAdmissionNumber) && $studentAdmissionNumber != "" && $studentAdmissionNumber != NULL){
                    
                    //7.2 Add admission numbers to the check duplicate array
                    $studentAdmissionDuplicates[] = $studentAdmissionNumber;

                    //7.3 Generate an SQL to Check if that admission number has already been registered into this school
                    $admissionNumberPresent = $this->zvs_validateStudentAdmissionNumber($systemSchoolCode, $studentAdmissionNumber);

                    //7.4 If the student admission number is existent, add it into an error array
                    if($admissionNumberPresent > 0){

                        //Add the student admission number into the declared error array
                        $studentAdmissionErrors[] = $studentAdmissionNumber;

                    }
                    
                }
                
            }
            
            //This holds the entire array account
            $totalArrayCount = count($studentAdmissionDuplicates);
            
            //This holds unique array count
            $uniqueArrayCount = count(array_unique($studentAdmissionDuplicates));
            
            if(($uniqueArrayCount < $totalArrayCount) && ($uniqueArrayCount != $totalArrayCount)){
                
                //This array holds all the duplicates admission numbers
                $zvs_duplicateHandle = array();
                
                foreach(array_count_values($studentAdmissionDuplicates) as $val => $c){
                    
                    if($c > 1) $zvs_duplicateHandle[] = $val;
                
                }
                
                //Some student admission numbers have already been registered, return the error to the user
                $errorStatement = "";

                for($i =0; $i < count($zvs_duplicateHandle); $i++){

                    //In this section we concatenate all student admission numbers that are alerady registered.
                    $errorStatement .= $zvs_duplicateHandle[$i].',';

                }

                //echo "Excel sheet Error: The following admission numbers have been duplicated: <b>".rtrim($errorStatement,',')."</b>"; exit();
                
                //Duplicate student admission numbers
                Zf_SessionHandler::zf_setSessionVariable("manage_student_data", "duplicate_admission_numbers");

                $zf_errorData = array("zf_fieldName" => "dataUploadFormError", "zf_errorMessage" => "Excel Sheet Error: The following admission numbers have been duplicated: <b>".rtrim($errorStatement,', ')."</b>");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location("data_module", 'manage_student_data', $registeredBy);
                exit();
                
            }else{
                
                /**
                 * IF THERE ARE ANY ERRORS, RETURN ALL FORM ERRORS, ELSE INSERT ALL VALUES TO THE DATABASE
                 */
                if(empty($studentAdmissionErrors)){

                    //Using the school code, pull school information
                    $zvs_schoolDetails = $this->zvs_fetchSchoolDetails($systemSchoolCode);


                    if($zvs_schoolDetails == 0){

                        //No existing school id
                        Zf_SessionHandler::zf_setSessionVariable("manage_student_data", "non_existent_school");

                        $zf_errorData = array("zf_fieldName" => "dataUploadFormError", "zf_errorMessage" => "The school cannot be found!!");
                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                        Zf_GenerateLinks::zf_header_location("data_module", 'manage_student_data', $registeredBy);
                        exit();

                    }else{

                        foreach ($zvs_schoolDetails as $schoolValues) {

                            $schoolCountry = $schoolValues['schoolCountry']; $schoolLocality = $schoolValues['schoolLocality']; 
                            $schoolBoxAddress = $schoolValues['schoolBoxAddress']; $schoolPhoneNumber = $schoolValues['schoolPhoneNumber'];
                            $schoolEmailDomain = $this->zvs_generateEmailDomain($schoolValues['schoolWebsite']);

                        }

                    }


                    //8.1 Loop through each row in the student sheet to get student data
                    for ($row = 2; $row <= $studentSheetNumberOfRows; $row++){

                        //8.1.1 While inside of each row first pull the student admission number.
                        $studentAdmissionNumber = Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 1);

                        //8.1.2 Check that we are only pulling data for students whose admission numbers are valid
                        if(!empty($studentAdmissionNumber) && $studentAdmissionNumber != "" && $studentAdmissionNumber != NULL){

                            //Student specific data
                            $studentFirstName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 2));
                            $studentMiddleName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 3));
                            $studentLastName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 4));
                            $studentGender = (empty(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 5))) ? "Not set" : Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 5);
                            $studentEmailAddress = (empty(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 6))) ? "stu_".Zf_Core_Functions::Zf_CleanName($studentAdmissionNumber).$schoolEmailDomain  : Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 6);
                            $studentBoxAddress = (empty(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 7))) ? $schoolBoxAddress : Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 7);
                            $studentPhoneNumber = (empty(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 8))) ? $schoolPhoneNumber: Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 8);
                            $studentClass = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 9));
                            $studentStream = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 10));
                            $studentRole = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $studentSheet, $row, 11));
                            $studentClassCode = $systemSchoolCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($studentClass);
                            $studentStreamCode = $studentClassCode.ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($studentStream);
                            $studentYearOfStudy = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
                            $studentPassword = "zvsStudent";

                            //Generate Student Identification Code
                            $studentIdentificationCode = Zf_SecureData::zf_encode_data($schoolCountry.ZVSS_CONNECT.$schoolLocality.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$studentRole.ZVSS_CONNECT.$studentAdmissionNumber);

                            //8.1.2.3 Loop through each of the rows in the guardian sheet to get guardian information relates to the student
                            $guardianSheet = 1;

                            //Guardian specific data
                            $guardianFirstName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 4));
                            $guardianMiddleName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 5));
                            $guardianLastName = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 6));
                            $guardianEmailAddress = (empty(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 7))) ? "gud_".Zf_Core_Functions::Zf_CleanName($studentAdmissionNumber).$schoolEmailDomain  : Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 7);
                            $guardianBoxAddress = (empty(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 8))) ? $schoolBoxAddress : Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 8);
                            $guardianPhoneNumber = (empty(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 9))) ? $schoolPhoneNumber: Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 9);
                            $guardianRelation = "Not set";
                            $guardianRole = ucfirst(Zf_ExcelReader::zf_cellData($excelFile, $guardianSheet, $row, 10));
                            $guardianPassword = "zvsGuardian";

                            //Generate guardian Identification Code
                            $guardianIdentificationCode = Zf_SecureData::zf_encode_data($schoolCountry.ZVSS_CONNECT.$schoolLocality.ZVSS_CONNECT.$systemSchoolCode.ZVSS_CONNECT.$guardianRole.ZVSS_CONNECT.$studentAdmissionNumber);


                            //Prepare student and guardian database values
                            //1. Application user details
                            $studentApplicationUserDetails['email'] = Zf_QueryGenerator::SQLValue($studentEmailAddress);
                            $studentApplicationUserDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($studentPassword));
                            $studentApplicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                            $studentApplicationUserDetails['zvs_platform_role'] = Zf_QueryGenerator::SQLValue(ZVS_SCHOOL_STUDENT);
                            $studentApplicationUserDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);


                            $guardianApplicationUserDetails['email'] = Zf_QueryGenerator::SQLValue($guardianEmailAddress);
                            $guardianApplicationUserDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($guardianPassword));
                            $guardianApplicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                            $guardianApplicationUserDetails['zvs_platform_role'] = Zf_QueryGenerator::SQLValue(ZVS_SCHOOL_PARENT);
                            $guardianApplicationUserDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);


                            //2. Student personal detiails
                            $studentPersonalDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $studentPersonalDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                            $studentPersonalDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                            $studentPersonalDetails['studentFirstName'] = Zf_QueryGenerator::SQLValue($studentFirstName);
                            $studentPersonalDetails['studentMiddleName'] = Zf_QueryGenerator::SQLValue($studentMiddleName);
                            $studentPersonalDetails['studentLastName'] = Zf_QueryGenerator::SQLValue($studentLastName);
                            $studentPersonalDetails['studentGender'] = Zf_QueryGenerator::SQLValue($studentGender);
                            $studentPersonalDetails['studentCountry'] = Zf_QueryGenerator::SQLValue($schoolCountry);
                            $studentPersonalDetails['studentLocality'] = Zf_QueryGenerator::SQLValue($schoolLocality);
                            $studentPersonalDetails['studentBoxAddress'] = Zf_QueryGenerator::SQLValue($studentBoxAddress);
                            $studentPersonalDetails['studentPhoneNumber'] = Zf_QueryGenerator::SQLValue($studentPhoneNumber);
                            $studentPersonalDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                            $studentPersonalDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                            $studentPersonalDetails['studentStatus'] = Zf_QueryGenerator::SQLValue(1);

                            //3. Student guardian details
                            $studentGuardianDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $studentGuardianDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                            $studentGuardianDetails['guardianDesignation'] = Zf_QueryGenerator::SQLValue($guardianDesignation);
                            $studentGuardianDetails['guardianFirstName'] = Zf_QueryGenerator::SQLValue($guardianFirstName);
                            $studentGuardianDetails['guardianMiddleName'] = Zf_QueryGenerator::SQLValue($guardianMiddleName);
                            $studentGuardianDetails['guardianLastName'] = Zf_QueryGenerator::SQLValue($guardianLastName);
                            $studentGuardianDetails['guardianCountry'] = Zf_QueryGenerator::SQLValue($schoolCountry);
                            $studentGuardianDetails['guardianLocality'] = Zf_QueryGenerator::SQLValue($schoolLocality);
                            $studentGuardianDetails['guardianBoxAddress'] = Zf_QueryGenerator::SQLValue($guardianBoxAddress);
                            $studentGuardianDetails['guardianPhoneNumber'] = Zf_QueryGenerator::SQLValue($guardianPhoneNumber);
                            $studentGuardianDetails['guardianRelation'] = Zf_QueryGenerator::SQLValue($guardianRelation);
                            $studentGuardianDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                            $studentGuardianDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                            $studentGuardianDetails['guardianStatus'] = Zf_QueryGenerator::SQLValue(1);

                            //4. Student medical details
                            $studentMedicalDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $studentMedicalDetails['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                            $studentMedicalDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                            $studentMedicalDetails['isStudentBloodGroup'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentDisable'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentMedicated'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentAllergic'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentTreatment'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentPhysician'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['isStudentHospital'] = Zf_QueryGenerator::SQLValue("No");
                            $studentMedicalDetails['studentSchoolStatus'] = Zf_QueryGenerator::SQLValue(1);
                            $studentMedicalDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                            $studentMedicalDetails['studentStatus'] = Zf_QueryGenerator::SQLValue(1);

                            //5. Student class details
                            $studentClassDetails['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                            $studentClassDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                            $studentClassDetails['studentClassCode'] = Zf_QueryGenerator::SQLValue($studentClassCode);
                            $studentClassDetails['studentStreamCode'] = Zf_QueryGenerator::SQLValue($studentStreamCode);
                            $studentClassDetails['studentYearOfStudy'] = Zf_QueryGenerator::SQLValue($studentYearOfStudy);
                            $studentClassDetails['studentAdmissionNumber'] = Zf_QueryGenerator::SQLValue($studentAdmissionNumber);
                            $studentClassDetails['registeredBy'] = Zf_QueryGenerator::SQLValue($registeredBy);
                            $studentClassDetails['studentClassStatus'] = Zf_QueryGenerator::SQLValue(1);

                            //6. Student-Guardian mapper
                            $studentGuardianMapperDetails['studentIdentificationCode'] = Zf_QueryGenerator::SQLValue($studentIdentificationCode);
                            $studentGuardianMapperDetails['guardianIdentificationCode'] = Zf_QueryGenerator::SQLValue($guardianIdentificationCode);
                            $studentGuardianMapperDetails['recordStatus'] = Zf_QueryGenerator::SQLValue(1);


                             //1. Insert student application user details
                            $insertStudentApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert('zvs_application_users', $studentApplicationUserDetails);
                            $executeInsertStudentApplicationUserDetails = $this->Zf_AdoDB->Execute($insertStudentApplicationUserDetails);
                            if(!$executeInsertStudentApplicationUserDetails){

                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                            }else{

                                //2. Insert guardian application user details
                                $insertGuardianApplicationUserDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_application_users", $guardianApplicationUserDetails);
                                $executeInsertGuardianApplicationUserDetails = $this->Zf_AdoDB->Execute($insertGuardianApplicationUserDetails);
                                if(!$executeInsertGuardianApplicationUserDetails){

                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                }else{

                                    //3. Insert student personal detials
                                    $insertStudentPersonalDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_personal_details", $studentPersonalDetails);
                                    $executeInsertStudentPersonalDetails = $this->Zf_AdoDB->Execute($insertStudentPersonalDetails);
                                    if(!$executeInsertStudentPersonalDetails){

                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                    }else{

                                        //4. Insert student guardian details
                                        $insertStudentGuardianDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_guardian_details", $studentGuardianDetails);
                                        $executeInsertStudentGuardianDetails = $this->Zf_AdoDB->Execute($insertStudentGuardianDetails);
                                        if(!$executeInsertStudentGuardianDetails){

                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                        }else{

                                            //5. Insert student medical details
                                            $insertStudentMedicalDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_medical_details", $studentMedicalDetails);
                                            $executeInsertStudentMedicalDetails = $this->Zf_AdoDB->Execute($insertStudentMedicalDetails);
                                            if(!$executeInsertStudentMedicalDetails){

                                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                            }else{

                                                //Here we update stream occupancy details by adding a student into the stream
                                                $updateStreamDetails = $this->zvs_updateStreamDetails($studentClassCode, $studentStreamCode);


                                                //6. Insert student class details
                                                $insertStudentClassDetails = Zf_QueryGenerator::BuildSQLInsert("zvs_students_class_details", $studentClassDetails);
                                                $executeInsertStudentClassDetails = $this->Zf_AdoDB->Execute($insertStudentClassDetails);
                                                if(!$executeInsertStudentClassDetails){

                                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                }else{

                                                    //7. Insert student-guardian mapper details
                                                    $insertStudentGuardianMapper = Zf_QueryGenerator::BuildSQLInsert("zvs_students_guardians_mapper", $studentGuardianMapperDetails);
                                                    $executeInsertStudentGuardianMapper = $this->Zf_AdoDB->Execute($insertStudentGuardianMapper);
                                                    if(!$executeInsertStudentGuardianMapper){

                                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>"; exit();

                                                    }

                                                }

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                    //Deletes the temporary uploaded excel 
                    unlink($excelFile);

                    //$time_end = microtime(true);

                    //dividing with 60 will give the execution time in minutes other wise seconds
                    //$execution_time = ($time_end - $time_start)/60;

                    //execution time of the script
                    //echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
                    
                    $zf_errorData = array("zf_fieldName" => "dataUploadFormError", "zf_errorMessage" => "Excel Sheet Success: Student data successfully uploaded!!");
                    //Student data inserted successfully
                    Zf_SessionHandler::zf_setSessionVariable("manage_student_data", "student_registration_success");
                    Zf_GenerateLinks::zf_header_location("data_module", "manage_student_data", $registeredBy);
                    exit();


                }else{

                    //Some student admission numbers have already been registered, return the error to the user
                    $errorStatement = "";

                    for($i =0; $i < count($studentAdmissionErrors); $i++){

                        //In this section we concatenate all student admission numbers that are alerady registered.
                        $errorStatement .= $studentAdmissionErrors[$i].',';

                    }

                    //echo "The following admission numbers have been registered: <b>".rtrim($errorStatement,', ')."</b>"; exit();
                    
                    //Existing student admission numbers
                    Zf_SessionHandler::zf_setSessionVariable("manage_student_data", "existent_admission_numbers");

                    $zf_errorData = array("zf_fieldName" => "dataUploadFormError", "zf_errorMessage" => "Excel Sheet Error: The following admission numbers have already been registered: <b>".rtrim($errorStatement,', ')."</b>");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location("data_module", "manage_student_data", $registeredBy);
                    exit();

                }
                
            }
            
                
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("manage_student_data", "general_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("data_module", 'manage_student_data', $registeredBy);
            exit();
            
        }
   
    }
    
    
    
    
    /**
     * This public method uploads staff data
     */
    public function uploadStaffData(){
        
        //place this before any script you want to calculate time
        $time_start = microtime(true); 
        
        //In this section we chain all the data of a given school.
        $this->zf_formController->zf_postFormData('staffDataTemplate')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student data template');
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Staff Data File<br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        
        $excelFile = ZF_DATASTORE."zvs_student_bulk_upload".DS."mathew_new.xls";
         
        echo "<b>Our Data File Source is: </b><i>".$excelFile."<i><br><br>";
                
        //Instantiate
        //Zf_ExcelReader::zf_launchSpreadSheetReader($excelFile);
        
        
        //Count number of sheets on the excel workbook
        //echo "Number of Sheets: ".Zf_ExcelReader::zf_numberOfSheets($excelFile)."<br>";
        
        //Count number of rows in sheet one
        //echo "Number of Rows in Sheet1: ".Zf_ExcelReader::zf_numberOfRows($excelFile, 1)."<br>"; 
        
        
        //Count number of columns in sheet one
        //echo "Number of Columns in Sheet1: ".Zf_ExcelReader::zf_numberOfColumns($excelFile, 1)."<br>"; 
        
        
        //Pull an actual record
        //echo "Actual data pulled: ".Zf_ExcelReader::zf_cellData($excelFile, $targetSheet = 1, $targetRow = 1, $targetCol = 3)."<br>"; 
        
        $numberOfSheets = Zf_ExcelReader::zf_numberOfSheets($excelFile);
        
        $excelData = "";

        for($sheetNo=0; $sheetNo < $numberOfSheets; $sheetNo++){

            $highestRow = Zf_ExcelReader::zf_numberOfRows($excelFile, $sheetNo);
            $highestColumn = Zf_ExcelReader::zf_numberOfColumns($excelFile, $sheetNo);

            $excelData .="<b>Sheet No ".$sheetNo."<br>";
            $excelData .="Highest Row is: ". $highestRow."<br>";
            $excelData .="Highest Column is: ". $highestColumn."<br></b>";

                $excelData  .="<table style='border: 1px solid #000;'>";

                for ($row = 2; $row <= $highestRow; $row++){

                    $excelData .="<tr style='border: 1px solid #000;'><td style='border: 1px solid #000;'>RW - ".$row."</td>";

                    for($column = 1; $column <= $highestColumn; $column++){

                        $excelData .="<td style='border: 1px solid #000;'>".Zf_ExcelReader::zf_cellData($excelFile, $sheetNo, $row, $column)."</td>";

                    }

                    $excelData .="</tr>";

                }

                $excelData .="</table><br><br>";
        }

        echo $excelData;
        
        
        $time_end = microtime(true);

        //dividing with 60 will give the execution time in minutes other wise seconds
        $execution_time = ($time_end - $time_start)/60;

        //execution time of the script
        echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
        
    }
    
    
    
    
    /**
     * This private function is used to validate of student admission numbers have already been registered into this school
     */
    private function zvs_validateStudentAdmissionNumber($systemSchoolCode, $studentAdmissinNumber){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["studentAdmissionNumber"] = Zf_QueryGenerator::SQLValue($studentAdmissinNumber);
        
        $fetchStudentInformation = Zf_QueryGenerator::BuildSQLSelect('zvs_students_personal_details', $zvs_sqlValue);
        
        $zf_executeFetchStudentInformation = $this->Zf_AdoDB->Execute($fetchStudentInformation);

        if(!$zf_executeFetchStudentInformation){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentInformation->RecordCount() > 0){

                while(!$zf_executeFetchStudentInformation->EOF){
                    
                    $results = $zf_executeFetchStudentInformation->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method updates the stream data by adding the student to the existing occupancy.
    private function zvs_updateStreamDetails($studentClassCode, $studentStreamCode) {
        
        //Pull a stream with the specified class and stream codes.
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
        
        $fetchSchoolStream = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStream = $this->Zf_AdoDB->Execute($fetchSchoolStream);

        if(!$zf_executeFetchSchoolStream){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStream->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStream->EOF){
                    
                    $results = $zf_executeFetchSchoolStream->GetRows();
                    
                }
                
                $currentOccupancy = $results[0]['schoolStreamOccupancy'];
                    
                    $newOccupancy = $currentOccupancy + 1;
                    
                    //update the database value
                    
                    $zvs_sqlValue["schoolStreamOccupancy"] = Zf_QueryGenerator::SQLValue($newOccupancy);
                    
                    $zvs_sqlColumns["schoolClassCode"] = Zf_QueryGenerator::SQLValue($studentClassCode);
                    $zvs_sqlColumns["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($studentStreamCode);
                    
                    $updateStreamOccupancy = Zf_QueryGenerator::BuildSQLUpdate('zvs_school_streams', $zvs_sqlValue, $zvs_sqlColumns);
                    
                    $zf_executeUpdateStreamOccupancy = $this->Zf_AdoDB->Execute($updateStreamOccupancy);
                    
                    if(!$zf_executeUpdateStreamOccupancy){
                        
                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                        
                    }
                
            }
        }
        
    }
    
    
    

    //This private method fetches school information for the current school
    private function zvs_fetchSchoolDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        
        $fetchSchoolDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $zvs_sqlValue);
        
        $zf_executeFetchSchoolDetails = $this->Zf_AdoDB->Execute($fetchSchoolDetails);

        if(!$zf_executeFetchSchoolDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolDetails->RecordCount() > 0){

                while(!$zf_executeFetchSchoolDetails->EOF){
                    
                    $results = $zf_executeFetchSchoolDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
  
    
    //This private method takes in school website domain and returns the school email domain
    private function zvs_generateEmailDomain($zvs_schoolWebDomain){
        
        $schoolDomain = parse_url($zvs_schoolWebDomain);
        
        //Here we create the school domain array
        $schoolDomainArray = explode(".", $schoolDomain["host"]);

        //We splice the array to remove the very first portion
        array_splice($schoolDomainArray, 0 ,1);

        //Here we piece this together to generate school email domain
        $newEmailDomain =  implode(".",$schoolDomainArray);

        return  "@".$newEmailDomain;
            
           
    }
    
    
    
    
}

?>
