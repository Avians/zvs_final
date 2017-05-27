<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE SUBJECT MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO SUBJECT MODULE MODELS AND VIEWS.
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

class subject_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "subject_overview";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    
    //This action executes the subject overview view
    public function actionSubject_overview($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        $systemSchoolCode = $this->Zf_GetUserData($zf_actionData)[2];
        
        $tableData = array();
        $tableData['tableTitle'] = "List of all school subjects";
        $tableData['tableQuery'] = "SELECT * FROM zvs_school_subjects WHERE systemSchoolCode = '".$systemSchoolCode."' AND subjectStatus = '1' ";
        
        $zf_phpGridSettings = $this->actionGenerateSubjectsTable($tableData);
        
        Zf_View::zf_displayView('subject_overview',$zf_actionData, $zf_phpGridSettings);
        
    }
    
    
    
    
    
    //This action executes the subject setup view
    public function actionSubject_setup($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('subject_setup',$zf_actionData);
        
    }
    
    
    
    
    
    //This action executes the subject reports view
    public function actionSubject_reports($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('subject_reports',$zf_actionData);
        
    }
    
    
    
    
    //This action process the assignment of subjects to classes
    public function actionProcessSubjectAssignment($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_url($zvs_parameter);
       
        
        if($filteredData == "assign_subjects"){
            
            //This method assigns subjects to classes
            $this->zf_targetModel->assignSubjectsToClasses();
            
        }
        
    }














    /**
     * IN THIS SECTION, WE GENERATE ALL STUDENT RELATED TABLES FOR VISUAL PURPOSES
     *  
     */
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateSubjectsTable($tableData, $zf_subGrid = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvs_school_subjects'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $subjectCode = array("title"=>"Subject Code", "name"=>"subjectCode", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $subjectCode;
        
        $subjectName = array("title"=>"Subject Name", "name"=>"subjectName", "width"=>20, "editable"=>false); 
        $zf_gridColumns[] = $subjectName;
        
        $subjectAbbreviation = array("title"=>"Subject Abbreviation", "name"=>"subjectAlias", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $subjectAbbreviation;
        
        $examStatus = array("title"=>"Exam Status", "name"=>"examStatus", "width"=>20, "editable"=>false, "condition"=>array('$row["examStatus"] == 1', "Examinable", "Not Examinable"));
        $zf_gridColumns[] = $examStatus;
        
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
