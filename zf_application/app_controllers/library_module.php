<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE LIBRARY MODULE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING 
 * ALL ACTIONS THAT RELATE TO LIBRARY MODULE MODELS AND VIEWS.
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

class library_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "library_module";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    
    //This action executes the landing page for this module
    public function actionLibrary_module($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('library_module_introduction', $zf_actionData);
        
    }
    
    
    
    
    //Executes the library overview. Also is the default action for this controller
    public function actionLibrary_overview($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        $systemSchoolCode = $this->Zf_GetUserData($zf_actionData)[2];
        
        $tableData = array();
        $tableData['tableTitle'] = "List of all Library Books";
        $tableData['tableQuery'] = "SELECT * FROM zvs_school_library_books WHERE systemSchoolCode = '".$systemSchoolCode."' ";
        
        $zf_phpGridSettings = $this->actionGenerateLibraryBooksTable($tableData);
        
        
        Zf_View::zf_displayView('library_overview', $zf_actionData, $zf_phpGridSettings);
        
    }

    
    
    //Executes the library setup. Also is the default action for this controller
    public function actionLibrary_setup($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('library_setup', $zf_actionData);
        
    }

    
    
    //Executes the library issuing. Also is the default action for this controller
    public function actionLibrary_issuing($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('library_issuing', $zf_actionData);
        
    }

    
    
    //Executes the library receiving. Also is the default action for this controller
    public function actionLibrary_receiving($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('library_receiving', $zf_actionData);
        
    }
    
    
    
    //Executes the library reports. Also is the default action for this controller
    public function actionLibrary_reports($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('library_reports', $zf_actionData);
        
    }
    
    
    
    
    
    //Executes the library processing action
    public function actionLibrary_Setup_Process($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_url($zvs_parameter);
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);


        if($filteredData == "new_library_category"){

           //This model method create a new library category
           $this->zf_targetModel->newLibraryCategory();

        }else if($filteredData == "new_library_sub_category"){

           //This model method create a new library sub category
           $this->zf_targetModel->newLibrarySubCategory();

        }else if($filteredData == "new_library_book"){
            
           //This model method create a new library book
           $this->zf_targetModel->newLibraryBook();

        }else if($filterDataVariable == "process_library_sub_categories"){
            
            //This model method processes all library sub categories for the chosen category
            $this->zf_targetModel->processLibrarySubCategories();
            
        }
        
    }
    
    
    
    
    
    
    //IN THIS SECTION WE GENERATE ALL LIBRARY RELATED TABELS
   
    /**
     * This is the action that generates library books table
     */
    public function actionGenerateLibraryBooksTable($tableData, $zf_subGrid = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvs_school_library_books'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();
        
        $libraryBookNumber = array("title"=>"Book No.", "name"=>"libraryBookNumber", "width"=>20, "editable"=>false); 
        $zf_gridColumns[] = $libraryBookNumber;

        $libraryBookName = array("title"=>"Book Name", "name"=>"libraryBookName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $libraryBookName;
        
        $libraryBookAuthor = array("title"=>"Book Author", "name"=>"libraryBookAuthor", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $libraryBookAuthor;
        
        $libraryBookStatus = array("title"=>"Book Status", "name"=>"libraryBookStatus", "width"=>20, "editable"=>false, "condition"=>array('$row["libraryBookStatus"] == 1', "Available", "Not Available"));
        $zf_gridColumns[] = $libraryBookStatus;
        
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
