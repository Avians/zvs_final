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
        
//        ini_set('max_execution_time', 1000);  
//        ini_set('max_input_time', 1000);	
//        ini_set('memory_limit','256M');
        
         parent::__construct();
            
    }
    
    
    
    
   /**
    * Register a new platform school
    */
    public function uploadExcelFile(){
        
        //Chain the form's posted data
        
        //In this section we chain all the data of a given school.
        $this->zf_formController->zf_postFormData('newExcelFile')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School logo');
        

        //1. Get the submitted excel file and store it into a directory in the server using the document upload class
        
        //2. Using the spreadsheet reader class, access the files from the storage location and read its content.
        
        //3. Loop through the content and send the data into the database
        
        //4. Optionally, delete the file from the server.
        
        
        
        $excelFile = ZF_DATASTORE."zvs_student_bulk_upload".DS."mathew.xlsx";
         
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

                    $excelData .="<tr style='border: 1px solid #000;'><td style='border: 1px solid #000;'>1xxxxxxxx".$row."</td>";

                    for($column = 1; $column <= $highestColumn; $column++){

                        $excelData .="<td style='border: 1px solid #000;'>".Zf_ExcelReader::zf_cellData($excelFile, $sheetNo, $row, $column)."</td>";

                    }

                    $excelData .="</tr>";

                }

                $excelData .="</table><br><br>";
        }

        echo $excelData;
        
        
    }
    
    
    
    
    /**
     * This public method uploads student data
     */
    public function uploadStudentData(){
        
        //place this before any script you want to calculate time
        $time_start = microtime(true); 
        
        //In this section we chain all the data of a given school.
        $this->zf_formController->zf_postFormData('studentDataTemplate')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Student data template')
                
                                ->zf_postFormData('createdBy');
        
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        $identificationCode = $this->_validResult['createdBy'];
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
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
            
                //3.1 Returns the number of sheets in the excel file.
                $numberOfSheets = Zf_ExcelReader::zf_numberOfSheets($excelFile);
                
                
                //3.2 Loop through the sheets to get the data in rows and columns
                for($sheetNo=0; $sheetNo < $numberOfSheets; $sheetNo++){
                    
                    //3.2.1 Returns the number of rows in the sheet
                    $numberOfRows = Zf_ExcelReader::zf_numberOfRows($excelFile, $sheetNo);
                    
                    //3.2.2 Returns the number of columns in the sheet
                    $numberOfColumns = Zf_ExcelReader::zf_numberOfColumns($excelFile, $sheetNo);
                    
                    //3.2.3 Loop through a row of the sheet to collect data from all the data cells within the row
                    for ($row = 2; $row <= $numberOfRows; $row++){
  
                        
                        
                    }
                    
                    
                }

            

            
          
            
            //Deletes the temporary uploaded excel 
            unlink($excelFile);

            echo $excelData;
            
            $time_end = microtime(true);

            //dividing with 60 will give the execution time in minutes other wise seconds
            $execution_time = ($time_end - $time_start)/60;

            //execution time of the script
            echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
            
            exit();


            //3. Loop through the spreadsheet and check if any of the student admission numbers already exists in the database


            //3.1 If yes, return an error message showing that there is duplication of admission numbers, and delete the file from the temporary storage location


            //3.2 If no, enter the student data into the database, then delete the file from the temporary storage location
        
        }else{
            
            
            
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
    
}

?>
