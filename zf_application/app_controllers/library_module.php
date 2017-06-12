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
        
        Zf_View::zf_displayView('library_overview', $zf_actionData);
        
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
    

}
?>
