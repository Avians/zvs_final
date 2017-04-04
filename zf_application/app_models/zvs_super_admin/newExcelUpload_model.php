<?php

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

class newExcelUpload_Model extends Zf_Model {
    

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
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for the generation of a school system generated code       |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function zvs_generateSystemSchoolCode(){
        
            //Generate a random string.
            $systemSchoolCode = Zf_Core_Functions::Zf_GenerateRandomString(30);

            //Prepare the field values for SQL querying
            $zf_value["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);

            //Generate the SQL Query
            $zf_selectSystemSchoolCode = Zf_QueryGenerator::BuildSQLSelect('zvs_school_details', $zf_value);

            //Execute the SQL Query
            $zf_executeSelectSystemSchoolCode = $this->Zf_AdoDB->Execute($zf_selectSystemSchoolCode);

            //Get the execution results
            if (!$zf_executeSelectSystemSchoolCode) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            } else {

                //The the result count
                if ($zf_executeSelectSystemSchoolCode->RecordCount() > 0) {
                    
                    //Re-generate the system code.
                    $this->zvss_generateSystemSchoolCode();

                }else{

                    return $systemSchoolCode;

                }
            }
        
    } 
    
    
    
    
   /**
    * This method builds the email body for resetting a password
    */
    private function zvs_activateAccountEmailBody($zvs_emailDetails, $zvs_role, $identificationCode){
        
        $zf_controller = "initialize";
        $zf_action = "activateAccounts";
        $zf_parameter = Zf_SecureData::zf_encode_data($zvs_role.ZVSS_CONNECT.$zvs_emailDetails['email'].ZVSS_CONNECT.$identificationCode);
        
        if($zvs_role == SCHOOL_MAIN_ADMIN){
            
            $role = "a school main administrator";
            
        }
        
        $emailbody = '';
        $emailbody .='<html>
                        <head>
                                <title>Zilas Virtual Schools: Account Activation</title>
                        </head>
                        <body>

                            <div style="
                                width:100%; min-height: 430px !important; background-color: #0E4686 !important; color: #fff !important;
                                -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset; -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                                box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset; border: 1px solid #0E4686;
                                margin-top: 10px; height: auto; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; border-radius: 5px 5px 5px 5px;
                            ">
                                <!--This is the start of the header bar-->
                                <div style="
                                    height: 90px; background-color: #003366; width: 100%; width: 100%; border: 0px solid #ffff33 !important;
                                    border-bottom: 5px solid #ffffff !important;
                                    -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; border-radius: 5px 5px 0px 0px;
                                ">

                                    <a href="'.ZF_ROOT_PATH.'">
                                        <img src="'.ZF_ROOT_PATH.'/zf_client/zf_app_global/app_global_files/app_global_images/logo.png" width=" 60px " height=" 55px" style="margin: 20px auto auto 20px; border: 1px solid #0F6199; border-radius: 3px !important;" alt="HeadsAfrica Solutions Limited - Logo" >
                                    </a>

                                </div>
                                <!--This is the end of the header bar-->

                                <!--This is the start of the content section-->
                                        <div style="
                                            border: 0px solid #0E4686; width: 96% !important; margin: 25px auto 10px auto !important; min-height: 280px; background-color: #ffffff;-moz-border-radius: 5px 5px 5px 5px; 
                                            -webkit-border-radius: 5px 5px 5px 5px; border-radius: 5px 5px 5px 5px; font-family: Verdana,PTSansRegular,sans-serif; font-size: 13px; color: #575757;
                                        ">
                                            <div style="border: 0px solid #fff;margin: 0px auto 10px auto !important; width: 98% !important;color: #575757 !important; font-family: Verdana,PTSansRegular,sans-serif; font-size: 13px; line-height: 24px;">
                                                <h2 style="padding-top: 20px !important; padding-left: 10px !important; font-size: 20px; font-weight: light;">Welcome to Zilas Virtual Schools</h2>
                                                <p style="padding-left:10px !important;">
                                                    Dear '.ucfirst($zvs_emailDetails['firstName']).' '.ucfirst($zvs_emailDetails['lastName']).',<br>
                                                </p>
                                                <div style="color: #787878 !important; padding-top: 3px !important; padding-left: 10px !important;  padding-right: 10px !important; ">
                                                    <p>
                                                        You have successfully been registered to Zilas Virtual Schools as '.$role.'.
                                                    </p>
                                                    <p>
                                                        To get started, <a href="'. ZF_ROOT_PATH . $zf_controller . DS . $zf_action . DS . $zf_parameter . '" target="_blank" style="color:#21B4E2 !important; text-decoration: none !important;"><strong>activate your account</strong></a> and sign in with your email address and password as below;</br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>Email: </strong><span style="color:#21B4E2 !important; text-decoration: none !important;">' . $zvs_emailDetails['email'] . '</span><br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>Password: </strong><style="color:#21B4E2 !important; text-decoration: none !important;">' . $zvs_emailDetails['password'] . '</span><br>
                                                    </p>
                                                    <p>
                                                        In your profile section, you may choose to edit your password as you wish. Always remember your login details.
                                                    </p>
                                                    <p>
                                                        If you run into any problems, reach us at <span style="color:#21B4E2; text-decoration: none;">support@zilavirtualschools.com</span>
                                                    </p>
                                                    <p>Thank you.<br>Zilas Virtual Schools Team</br></br></p>
                                                </div>
                                            </div>
                                        </div>
                                <!--This is the end of the content section-->

                                <!-- This is the start of the mail footer section -->
                                        <div style="
                                            text-align:center !important;font-family: Verdana, Cuprum,Arial,Helvetica,Sans-Serif; line-height: 18px; letter-spacing: 0.04em;
                                            font-size: 10px !important; color: #ffffff !important; padding: 10px; padding-top: 0px !important;
                                        ">
                                            EMAIL: support@zilasvirtualschools.com | PHONE: +254 (0) 737 06 5781 | POSTAL ADDRESS: 73619-00100 Nairobi (Kenya)<br>
                                            &copy; 2015, Zilas Virtual Schools. All Rights Reserved.
                                        </div>
                                <!-- This is the end of the mail footer section -->

                            </div>

                        </body>
                    </html>';
        
        return $emailbody;
        
    }
    
    
}

?>
