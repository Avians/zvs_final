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
        $zf_actionData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($zf_parameter));
        
        //This is the unique user identification code
        $userIdentificationCode = Zf_SecureData::zf_decode_data($zf_actionData[0]);
        
        //This is the user identification array
        $userIdentificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($userIdentificationCode);
        
        //This is the student admission number
        $studentAdmissionNumber = $zf_actionData[1];
        
        
        /**
         * ACCESS TO THIS METHOD CAN BE FROM TO PLATFORM PERSPECTIVES
         */
        $zf_numberOfArrayElements = count($zf_actionData);
        
        //echo $zf_numberOfArrayElements; exit();
        
        
        //1. From the resources perspective using main menu
        if($zf_numberOfArrayElements === 1){
            
            //User can be staff, parent, student
            
            $systemUserProfile = $this->Zf_GetUserSystemProfile($userIdentificationCode);
        
            //1. Staff user should be redirected to students datails action
            if($systemUserProfile == ZVS_SCHOOL_STAFF){
                
                //Here, a school staff is view parent profile
                $this->actionParent_details(Zf_SecureData::zf_encode_data(Zf_SecureData::zf_encode_data($userIdentificationCode)), "check_parent_profile");
                
            }
            //2. Parent user should be directed to their respective parent profile page
            else if($systemUserProfile == ZVS_SCHOOL_PARENT){
                
                //Here, the parent id viewing parent profile
                Zf_View::zf_displayView('parent_profile', $zf_actionData);
                
            }
            //3. Parent user should be directed to their own profile page
            else if($systemUserProfile == ZVS_SCHOOL_STUDENT){
                
                //Here the parent is viewing their own profile
                Zf_View::zf_displayView('parent_profile', $zf_actionData);
                
            }else{
                
                //Here, a school staff is view parent profile
                $this->actionParent_details(Zf_SecureData::zf_encode_data(Zf_SecureData::zf_encode_data($userIdentificationCode)), "check_parent_profile");
                
            }
        
        }else{
            
            //Here, we view the student profile form another system school resource
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
        if($parent_profile != NULL && !empty($parent_profile) && $parent_profile != ""){
          $tableData['parentProfile'] =  $parent_profile;
          $tableData['userIdentificationCode'] =  Zf_SecureData::zf_decode_data($identificationCode);
        }

        $zf_phpGridSettings = $this->actionGenerateParentsTable($tableData, $zf_subGrid = NULL);
        
        Zf_View::zf_displayView('parent_details',$zf_actionData, $zf_phpGridSettings);
        
    }
    
    
    
    
    /**
     * IN THIS SECTION, WE GENERATE ALL STUDENT RELATED TABLES FOR VISUAL PURPOSES
     *  
     */
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateParentsTable($tableData, $zf_subGrid = NULL){
        
        $parentProfile = $tableData['parentProfile'];
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
        
        
        if($parentProfile == "check_parent_profile"){
            
            //Here we process the link to the parent profile page
            $studentProfile = ZF_ROOT_PATH."parent_module".DS."parent_profile".DS.$userIdentificationCode.ZVSS_CONNECT."{studentAdmissionNumber}";
            $studentDetails = array("title"=>"Parent Profile", "name"=>"Parent Profile", "default"=>"Parent Profile", "link"=>$studentProfile, "align"=>"center", "width"=>20, "editable"=>false, "export"=>false, "style" =>"color: #21B4E2 !important;");
            $zf_gridColumns[] =  $studentDetails;
            
        }
        
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
