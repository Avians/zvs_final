<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE SUB-STAFF MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO SUB-STAFF MODULE MODELS AND VIEWS.
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

class staff_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    //Executes the staff detials action
    public function actionStaff_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        $systemSchoolCode = $this->Zf_GetUserData($zf_actionData)[2];
        
        $tableData = array();
        $tableData['tableTitle'] = "List of all school staff";
        $tableData['tableQuery'] = "SELECT * FROM zvs_staff_personal_details WHERE systemSchoolCode = '".$systemSchoolCode."' AND staffSchoolStatus = '".STAFF_CONTINUING."' ";
        
        $zf_phpGridSettings = $this->actionGenerateStaffTable($tableData);
        
        Zf_View::zf_displayView('staff_details',$zf_actionData, $zf_phpGridSettings);
        
    }

    
    //Executes the register new staff action
    public function actionRegister_staff($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('register_staff',$zf_actionData);
        
    }
    
    
    
    
    //This method process all related staff information
    public function actionProcessStaffInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'process_locality'){
            
            //Get the locality related to any student registration data
            $this->zf_targetModel->getStaffLocality();
            
        }else if($filterDataUrl == 'new_staff'){
            
            //We are about to register a new staff to the administration
            $this->zf_targetModel->registerNewStaff();
            
        }
        
    }
    
    
    
    
    /**
     * IN THIS SECTION, WE GENERATE ALL STUDENT RELATED TABLES FOR VISUAL PURPOSES
     *  
     */
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateStaffTable($tableData, $zf_subGrid = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvs_staff_personal_details'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $admissionNumber = array("title"=>"ID Number", "name"=>"staffIdNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $admissionNumber;
        
        $studentFirstName = array("title"=>"First Name", "name"=>"staffFirstName", "width"=>20, "editable"=>true); 
        $zf_gridColumns[] = $studentFirstName;
        
        $studentMiddleName = array("title"=>"Middle Name", "name"=>"staffMiddleName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $studentMiddleName;
        
        $studentLastName = array("title"=>"Last Name", "name"=>"staffLastName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $studentLastName;
        
        
        $studentPhoneNumber = array("title"=>"Mobile Number", "name"=>"staffPhoneNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $studentPhoneNumber;
        
        $studentGender = array("title"=>"Gender", "name"=>"staffGender", "width"=>15, "editable"=>false);
        $zf_gridColumns[] = $studentGender;
        
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
