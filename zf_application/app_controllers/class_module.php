<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE CLASS MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO CLASS MODULE MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  14th/August/2013  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class class_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "view_classes";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    //Executes the view classes view. Also is the defaukt action for this controller
    public function actionView_classes($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_classes', $zf_actionData);
        
    }
    
    
    
    
    //This controller executes the stream profile view.
    public function actionClass_details(){
        
        Zf_View::zf_displayView('class_details');
        
    }
    
    
    
    
    //This method is vital is processing class charts
    public function actionProcessClassChart($zvs_parameter){
        
        //Get the locality related to any student registration data
        $this->zf_targetModel->plotClassChart();
        
    }
    
    
    
    
    //This controller executes the view streams view.
    public function actionView_streams(){
        
        Zf_View::zf_displayView('view_streams');
        
    }
    
    

    
    //This controller executes the class details view.
    public function actionStream_details($zvs_parameter){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($zvs_parameter);
        
        
        //Get a parameter array
        $zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($zvs_parameter));
        
        $zvs_currentYear = explode("-", Zf_Core_Functions::Zf_CurrentDate())[2];
        
        $identificationCode = Zf_SecureData::zf_encode_url($zvs_parameter[0]);
        $systemSchoolCode = $zvs_parameter[1];
        $studentClassCode = $zvs_parameter[1].ZVSS_CONNECT.$zvs_parameter[2];
        $studentStreamCode = $zvs_parameter[1].ZVSS_CONNECT.$zvs_parameter[2].ZVSS_CONNECT.$zvs_parameter[3];
        $studentYearOfStudy = $zvs_parameter[4];
        
        $getClassName = $this->zf_targetModel->getClassName($systemSchoolCode, $studentClassCode);
        $getStreamName = $this->zf_targetModel->getStreamName($systemSchoolCode, $studentClassCode, $studentStreamCode);
        
        $tableData = array();
        
        $tableData['tableTitle'] = $getClassName." ".$getStreamName." Student List - ".$studentYearOfStudy ;
        
        if($studentYearOfStudy == $zvs_currentYear){
            
            $zf_studentClassDetails = "zvs_students_class_details";
            
        }else if($studentYearOfStudy != $zvs_currentYear){
            
            $zf_studentClassDetails = "zvs_students_class_history";
            
        }
        
        $zf_studentPersonalDetails = "zvs_students_personal_details";
        
        //Student Class Details Columns
        $studentAdmissionNumer = $zf_studentClassDetails.".studentAdmissionNumber";
        
        
        //Student Personal Details Columns
        $studentFirstName = $zf_studentPersonalDetails.".studentFirstName";
        $studentMiddleName = $zf_studentPersonalDetails.".studentMiddleName";
        $studentLastName = $zf_studentPersonalDetails.".studentLastName";
        $studentGender = $zf_studentPersonalDetails.".studentGender";
        
        
        
        //$tableData['tableQuery'] = "SELECT * FROM ".$zf_table." WHERE systemSchoolCode = '".$systemSchoolCode."' AND studentClassCode = '".$studentClassCode."' AND studentStreamCode = '".$studentStreamCode."' AND studentYearOfStudy = '".$studentYearOfStudy."' AND studentClassStatus = '".STUDENT_CONTINUING."' ";
        $tableData['tableQuery'] = "SELECT ".$studentAdmissionNumer." , ".$studentFirstName." , ".$studentMiddleName." , ".$studentLastName." , ".$studentGender." FROM ".$zf_studentClassDetails." INNER JOIN ".$zf_studentPersonalDetails." on ".$zf_studentClassDetails.".identificationCode = ".$zf_studentPersonalDetails.".identificationCode WHERE ".$zf_studentClassDetails.".systemSchoolCode = '".$systemSchoolCode."' AND ".$zf_studentClassDetails.".studentClassCode = '".$studentClassCode."' AND ".$zf_studentClassDetails.".studentStreamCode = '".$studentStreamCode."' AND ".$zf_studentClassDetails.".studentYearOfStudy = '".$studentYearOfStudy."' AND ".$zf_studentClassDetails.".studentClassStatus = '".STUDENT_CONTINUING."' ";
        
        
        //echo "<pre>".$tableData['tableQuery']."</pre>"; exit();
        
        $zf_phpGridSettings = $this->actionGenerateStudentsStreamTable($tableData, $zf_studentClassDetails);
        
        Zf_View::zf_displayView('stream_details', $zf_actionData, $zf_phpGridSettings);
        
    }
    
    
    
    
    
    
    /**
     *==================================================================================================
     * IN THIS SECTION WE PROCESS ALL STUDENT RELATED TABLES 
     *================================================================================================== 
     * 
     */
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateStudentsStreamTable($tableData, $zf_studentClassDetails, $zf_subGrid = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = $zf_studentClassDetails; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $admissionNumber = array("title"=>"Adm No.", "name"=>"studentAdmissionNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $admissionNumber;

        $studentFirstName = array("title"=>"First Name", "name"=>"studentFirstName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentFirstName;
        
        $studentMiddleName = array("title"=>"Middle Name", "name"=>"studentMiddleName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentMiddleName;
        
        $studentLastName = array("title"=>"Last Name", "name"=>"studentLastName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentLastName;
        
        $studentGender = array("title"=>"Gender", "name"=>"studentGender", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentGender;
        
        
        //Here we process the link to the student profile page
        $studentIdentificationCode = "1234";
        $studentProfile = ZF_ROOT_PATH."student_module".DS."student_profile".DS.$studentIdentificationCode;
        $studentDetails = array("title"=>"Student Details", "name"=>"Student Profile", "default"=>"Student Profile", "link"=>$studentProfile, "align"=>"center", "width"=>20, "editable"=>false, "export"=>false);
        $zf_gridColumns[] =  $studentDetails;
        
        
        //Here we process the link to the guardian profile page
        $guardianIdentificationCode = "1234";
        $guardianProfile = ZF_ROOT_PATH."parent_module".DS."guardian_profile".DS.$guardianIdentificationCode;
        $guardianDetails = array("title"=>"Guardian Details", "name"=>"Guardian Profile", "default"=>"Guardian Profile", "link"=>$guardianProfile,  "align"=>"center", "width"=>20, "editable"=>false, "export"=>false);
        $zf_gridColumns[] =  $guardianDetails;
        
        //This action column of the table 
        $action = array("title"=>"Actions", "name"=>"act", "align"=>"center", "width"=>20, "export"=>false, "hidden"=>true);
        $zf_gridColumns[] = $action;

        $zf_phpGridSettings['zf_gridColumns'] = $zf_gridColumns;
        
        //echo $tableQuery; exit();
        $zf_phpGridSettings['zf_gridQuery'] = $tableData['tableQuery'];
        
        return $zf_phpGridSettings;
        
    }

}
?>
