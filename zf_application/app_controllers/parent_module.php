<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE PARENT MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO PARENT MODULE MODELS AND VIEWS.
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

class parent_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "parent_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    
    //This action executes the landing page for this module
    public function actionParent_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView("parent_module_introduction", $zf_actionData);
        
    }

    
    
    
    //Executes the guardian profile view
    public function actionParent_profile($zf_parameter){
        
        //This is the incoming data parameter
        $zf_actionData = Zf_SecureData::zf_decode_data($zf_parameter);
          
        //User can be staff, parent, student
        $systemUserProfile = $this->Zf_GetUserSystemProfile(Zf_SecureData::zf_decode_data($zf_actionData));

        //echo $systemUserProfile; exit();

        //1. Staff user should be redirected to students datails action
        if($systemUserProfile == ZVS_SCHOOL_STAFF){
            
            //Here, the parent id viewing student profile
            Zf_View::zf_displayView('student_guardian_profile', $zf_actionData);

        }
        //2. Parent user should be directed to their respective student profile page
        else if($systemUserProfile == ZVS_SCHOOL_PARENT){
            
            //Here, the parent id viewing student profile
            Zf_View::zf_displayView('parent_profile', $zf_actionData);

        }
        //3. Student user should be directed to their own profile page
        else if($systemUserProfile == ZVS_SCHOOL_STUDENT){
            
            //Here the student is viewing their own profile
            Zf_View::zf_displayView('parent_profile', $zf_actionData);

        }
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE METHOD FOR PULLING THE USER PROFILE OF THE ACCESSING SYSTEM
     * USER
     * -------------------------------------------------------------------------
     */
    private function Zf_GetUserSystemProfile($identificationCode){
        
        //Allows us to loosely access the database from the controller.
        $zf_model = new Zf_Model();
        
        $applicationUserDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $userSelectedColumn = array("zvs_platform_role");
        
        $selectApplicationUserDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $applicationUserDetails, $userSelectedColumn);
        

        if(!$zf_model->Zf_LooseQueryGenerator->Query($selectApplicationUserDetails)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$selectApplicationUserDetails}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $zf_model->Zf_LooseQueryGenerator->RowCount();
            if($resultCount > 0){

                $zf_model->Zf_LooseQueryGenerator->MoveFirst();
                
                while(!$zf_model->Zf_LooseQueryGenerator->EndOfSeek()){

                    $fetchRow = $zf_model->Zf_LooseQueryGenerator->Row();
                    
                    $platformUserProfile = $fetchRow->zvs_platform_role;

                }

            }
            
            return $platformUserProfile;
        }
        
    }
    
    
    
    
    
    //Executes the parent detials action
    public function actionParent_details($identificationCode, $parent_profile = NULL){
        
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        $systemSchoolCode = $this->Zf_GetUserData($zf_actionData)[2];
        
        $tableData = array();
        $tableData['tableTitle'] = "List of all school students";
        $tableData['tableQuery'] = "SELECT * FROM zvs_students_personal_details WHERE systemSchoolCode = '".$systemSchoolCode."' AND studentSchoolStatus = '".STUDENT_CONTINUING."' ";
        $tableData['userIdentificationCode'] =  Zf_SecureData::zf_decode_data($identificationCode);

        $zf_phpGridSettings = $this->actionGenerateParentsTable($tableData, $zf_subGrid = NULL);
        
        Zf_View::zf_displayView('parent_details',$zf_actionData, $zf_phpGridSettings);
        
    }
    
    
    
    
    /**
     * This action sends the user information to the model for processing
     */
    public function actionGuardianProfile($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'process_student_profile'){
            
            //Get the student related to a selected class
            $this->zf_targetModel->pullStudentProfile();
            
        }else if($filterDataVariable == 'process_student_guardian'){
            
            //Get the guardian related to a selected class
            $this->zf_targetModel->pullGuardianProfile();
            
        }
        
    }
    
    
    
    
    /**
     * IN THIS SECTION, WE GENERATE ALL STUDENT RELATED TABLES FOR VISUAL PURPOSES
     *  
     */
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateParentsTable($tableData, $zf_subGrid = NULL){
        
        $userIdentificationCode = $tableData['userIdentificationCode'];
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvs_students_personal_details'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $admissionNumber = array("title"=>"Adm Number", "name"=>"studentAdmissionNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $admissionNumber;
        
        $studentFirstName = array("title"=>"First Name", "name"=>"studentFirstName", "width"=>20, "editable"=>true); 
        $zf_gridColumns[] = $studentFirstName;
        
        $studentMiddleName = array("title"=>"Middle Name", "name"=>"studentMiddleName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $studentMiddleName;
        
        $studentLastName = array("title"=>"Last Name", "name"=>"studentLastName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $studentLastName;
        
        
        $studentPhoneNumber = array("title"=>"Mobile Number", "name"=>"studentPhoneNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentPhoneNumber;
        
        $studentGender = array("title"=>"Gender", "name"=>"studentGender", "width"=>15, "editable"=>false);
        $zf_gridColumns[] = $studentGender;
        
//        $studentProfile = ZF_ROOT_PATH."parent_module".DS."parent_profile".DS.$userIdentificationCode.ZVSS_CONNECT."{studentAdmissionNumber}";
//        $studentDetails = array("title"=>"Parent Profile", "name"=>"Parent Profile", "default"=>"Parent Profile", "link"=>$studentProfile, "align"=>"center", "width"=>20, "editable"=>false, "export"=>false, "style" =>"color: #21B4E2 !important;");
//        $zf_gridColumns[] =  $studentDetails;
        
        //This action column of the table 
        $action = array("title"=>"Actions", "name"=>"act", "align"=>"center", "width"=>20, "export"=>false, "hidden"=>true);
        $zf_gridColumns[] = $action;

        $zf_phpGridSettings['zf_gridColumns'] = $zf_gridColumns;
        
        //echo $tableQuery; exit();

        $zf_phpGridSettings['zf_gridQuery'] = $tableData['tableQuery'];
        
        return $zf_phpGridSettings;
        
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE METHOD FOR DECODING THE IDENIFICATION CODE INTO AN 
     * ARRAY
     * -------------------------------------------------------------------------
     */
    public function Zf_GetUserData($identificationCode){
        
        $zf_idenificationArray = explode(ZVSS_CONNECT , Zf_SecureData::zf_decode_data(Zf_SecureData::zf_decode_data($identificationCode)));
        
        return $zf_idenificationArray;
        
    }

}
?>
