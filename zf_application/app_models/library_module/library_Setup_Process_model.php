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

class library_Setup_Process_Model extends Zf_Model {
    

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
     * Register a new library category into a school library
     */
    public function newLibraryCategory(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('libraryCategoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('libraryCategoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Library Categories Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
       
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. This is the school library category code
            $schoolLibraryCategoryCode = $systemSchoolCode.ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['libraryCategoryName']));
            
            //2. Check if a library category with a similar library category code already exists
            $libraryCategoryExisting  = $this->zvs_fetchLibaryCategories($schoolLibraryCategoryCode);
            
            
            //3. If one already exists, throw and error, else register as new
            if($libraryCategoryExisting == 0){
                
                //3.1 library category variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['libraryCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolLibraryCategoryCode);
                $zvs_sqlValues['libraryCategoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['libraryCategoryName']);
                $zvs_sqlValues['libraryCategoryAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['libraryCategoryAlias']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['categoryStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewLibraryCategory = Zf_QueryGenerator::BuildSQLInsert("zvs_school_library_category", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewLibraryCategory = $this->Zf_AdoDB->Execute($zvs_insertNewLibraryCategory);
                    
                if(!$zvs_executeInsertNewLibraryCategory){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("library_setup", "category_setup_success");
                     Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar subject has already been registered for the same school
                Zf_SessionHandler::zf_setSessionVariable("library_setup", "existing_category_error");

                $zf_errorData = array("zf_fieldName" => "libraryCategoryName", "zf_errorMessage" => "* This category already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("library_setup", "category_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("library_module", 'library_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }
        
    }
    
    
    
    
    /**
     * Register a new library category into a school library
     */
    public function newLibrarySubCategory(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('libraryCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')

                                ->zf_postFormData('librarySubCategoryName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub-category name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub-category name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub-category name')

                                ->zf_postFormData('librarySubCategoryAlias')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Sub-category alias')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Sub-category alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category alias')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Library Sub Categories Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1. This is the school library sub-category code
            $schoolLibrarySubCategoryCode = $this->_validResult['libraryCategoryCode'].ZVSS_CONNECT.str_replace(".","",Zf_Core_Functions::Zf_CleanName($this->_validResult['librarySubCategoryName']));
            
            //2. Check if a library sub category with a similar library sub category code already exists
            $librarySubCategoryExisting  = $this->zvs_fetchLibarySubCategories($this->_validResult['libraryCategoryCode'], $schoolLibrarySubCategoryCode);
            
            //3. If one already exists, throw and error, else register as new sub category
            if($librarySubCategoryExisting == 0){
                
                //3.1 library sub category variables ready for database
                $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
                $zvs_sqlValues['libraryCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['libraryCategoryCode']);
                $zvs_sqlValues['librarySubCategoryCode'] = Zf_QueryGenerator::SQLValue($schoolLibrarySubCategoryCode);
                $zvs_sqlValues['librarySubCategoryName'] = Zf_QueryGenerator::SQLValue($this->_validResult['librarySubCategoryName']);
                $zvs_sqlValues['librarySubCategoryAlias'] = Zf_QueryGenerator::SQLValue($this->_validResult['librarySubCategoryAlias']);
                $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
                $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
                $zvs_sqlValues['subCategoryStatus'] = Zf_QueryGenerator::SQLValue(1);
                
                //Generate SQL Insert query
                $zvs_insertNewLibrarySubCategory = Zf_QueryGenerator::BuildSQLInsert("zvs_school_library_sub_category", $zvs_sqlValues);
                
                //Execute the query
                $zvs_executeInsertNewLibrarySubCategory = $this->Zf_AdoDB->Execute($zvs_insertNewLibrarySubCategory);
                    
                if(!$zvs_executeInsertNewLibrarySubCategory){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Insertion successful
                     Zf_SessionHandler::zf_setSessionVariable("library_setup", "sub_category_setup_success");
                     Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                     exit();

                }
                
            }else{
                
                //A similar subject has already been registered for the same school
                Zf_SessionHandler::zf_setSessionVariable("library_setup", "existing_sub_category_error");

                $zf_errorData = array("zf_fieldName" => "librarySubCategoryName", "zf_errorMessage" => "* This sub-category already exists!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
            
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("library_setup", "sub_category_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("library_module", 'library_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }

    }
    
    
    
    
    /**
     * Register a new library category into a school library
     */
    public function newLibraryBook(){

        //Here we receive and chain class data, posted from the form.
        $this->zf_formController->zf_postFormData('libraryCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Category name')
                                
                                ->zf_postFormData('librarySubCategoryCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub-category name')

                                ->zf_postFormData('libraryBookName')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Book name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Book name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Book name')

                                ->zf_postFormData('libraryBookAuthor')
                                ->zf_validateFormData('zf_maximumLength', 45, 'Book Author')
                                
                                ->zf_postFormData('bookNoOfCopies')
                                ->zf_validateFormData('zf_integerData', 'Book Author')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Number of copies')
                
                                ->zf_postFormData('adminIdentificationCode');
        
        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //This of debugging purposes only.
        //echo "<pre>Library Book Data: <br>"; print_r($this->_errorResult); echo "</pre>"; echo "<pre>"; print_r($this->_validResult); echo "</pre>"; exit();
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->_validResult['adminIdentificationCode']);
        
        //Here we get the system school code from the identification code.
        $systemSchoolCode = $identificationArray[2];
        
        if(empty($this->_errorResult)){
            
            //1.Count the number of books within this subcategory and with similar book name
            $currentBookCount = $this->zvs_countLibraryBooks($this->_validResult['librarySubCategoryCode'], ucwords($this->_validResult['libraryBookName']));
            
            //2. Prepare variables for insertion
            $zvs_sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValues['libraryCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['libraryCategoryCode']);
            $zvs_sqlValues['librarySubCategoryCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['librarySubCategoryCode']);
            $zvs_sqlValues['libraryBookName'] = Zf_QueryGenerator::SQLValue(ucwords($this->_validResult['libraryBookName']));
            $zvs_sqlValues['libraryBookAuthor'] = Zf_QueryGenerator::SQLValue($this->_validResult['libraryBookAuthor']);
            $zvs_sqlValues['createdBy'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminIdentificationCode']);
            $zvs_sqlValues['dateCreated'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentDate("Y-m-d"));
            $zvs_sqlValues['libraryBookStatus'] = Zf_QueryGenerator::SQLValue(1);
            
            //Number of books copies to be inserted to the database
            $numberOfCopies = $this->_validResult['bookNoOfCopies'];
            
            if($numberOfCopies > 0){
                
                for ($currentBookNumber = 1; $currentBookNumber <= $numberOfCopies; $currentBookNumber++) {
                    
                    //Create a dynamic book count
                    $bookCount = $currentBookCount + $currentBookNumber; 
                    
                    $zvs_sqlValues['libraryBookNumber'] = Zf_QueryGenerator::SQLValue($bookCount);
                    
                    //Generate SQL Insert query
                    $zvs_insertNewLibraryBook = Zf_QueryGenerator::BuildSQLInsert("zvs_school_library_books", $zvs_sqlValues);
                    
                    //Execute the query
                    $zvs_executeInsertNewLibraryBook = $this->Zf_AdoDB->Execute($zvs_insertNewLibraryBook);

                    if(!$zvs_executeInsertNewLibraryBook){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }
                    
                    //Increament book count
                    $bookCount = $bookCount + 1;
                    
                }
                

                //Insertion successful
                Zf_SessionHandler::zf_setSessionVariable("library_setup", "books_insertion_success");
                Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                 
            }else{
               
                //You must insert atleast one book
                Zf_SessionHandler::zf_setSessionVariable("library_setup", "no_book_inserted_error");

                $zf_errorData = array("zf_fieldName" => "bookNoOfCopies", "zf_errorMessage" => "* Number of copies must be atleast one!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('library_module', 'library_setup', $this->_validResult['adminIdentificationCode']);
                exit();
                
            }
            
             
        }else{
            
            //Redirect to the registration form section. Also make an error indicator.
            Zf_SessionHandler::zf_setSessionVariable("library_setup", "library_setup_form_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location("library_module", 'library_setup', $this->_validResult['adminIdentificationCode']);
            exit();
            
        }

    }
    
    
    
    
    /**
     * This method processes all library sub-categories that belong to a selected category
     */
    public function processLibrarySubCategories(){
        
        $libraryCategoryCode = $_POST['libraryCategoryCode'];
        
        
        //Here we have all related library sub categories
        $librarySubCategories = $this->zvs_fetchLibarySubCategories($libraryCategoryCode);
        
        $select_options = '';
        
        
        if($librarySubCategories == 0){
            
            $select_options .= '<option value="">No Valid Data!!</option>';
            
        }else{
            
            $select_options .= '<option value="" selected="selected">Select a sub category</option>';
            
            foreach ($librarySubCategories as $subCategoryValue) {
                
                $librarySubCategoryName = $subCategoryValue['librarySubCategoryName']; $librarySubCategoryCode = $subCategoryValue['librarySubCategoryCode'];
                
                $select_options .= '<option value="'.$librarySubCategoryCode.'">'.$librarySubCategoryName.'</option>';
                
                
            }
            
        }
              
        echo $select_options;
        
    }
    
    
    
    
    //This private method fetches all details of library sub categories
    private function zvs_fetchLibaryCategories($libraryCategoryCode){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $libraryCategoryCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["libraryCategoryCode"] = Zf_QueryGenerator::SQLValue($libraryCategoryCode);
        
        $fetchLibrarySubCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_library_category', $zvs_sqlValue);
        
        $zf_executeFetchLibrarySubCategories = $this->Zf_AdoDB->Execute($fetchLibrarySubCategories);

        if(!$zf_executeFetchLibrarySubCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchLibrarySubCategories->RecordCount() > 0){

                while(!$zf_executeFetchLibrarySubCategories->EOF){
                    
                    $results = $zf_executeFetchLibrarySubCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method fetches all details of library sub categories
    private function zvs_fetchLibarySubCategories($libraryCategoryCode, $librarySubCategoryCode = NULL){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $libraryCategoryCode)[0];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["libraryCategoryCode"] = Zf_QueryGenerator::SQLValue($libraryCategoryCode);
        if($librarySubCategoryCode != NULL && !empty($librarySubCategoryCode) && $librarySubCategoryCode != ''){
            
           $zvs_sqlValue["librarySubCategoryCode"] = Zf_QueryGenerator::SQLValue($librarySubCategoryCode); 
           
        }
        
        $fetchLibrarySubCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_library_sub_category', $zvs_sqlValue);
        
        $zf_executeFetchLibrarySubCategories = $this->Zf_AdoDB->Execute($fetchLibrarySubCategories);

        if(!$zf_executeFetchLibrarySubCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchLibrarySubCategories->RecordCount() > 0){

                while(!$zf_executeFetchLibrarySubCategories->EOF){
                    
                    $results = $zf_executeFetchLibrarySubCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    //This private method counts and returns the number of books within a given sub category and with similar name
    private function zvs_countLibraryBooks($librarySubCategoryCode, $libraryBookName){
        
        $systemSchoolCode = explode(ZVSS_CONNECT, $librarySubCategoryCode)[0];
        $libraryCategoryCode = explode(ZVSS_CONNECT, $librarySubCategoryCode)[0].ZVSS_CONNECT.explode(ZVSS_CONNECT, $librarySubCategoryCode)[1];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["libraryCategoryCode"] = Zf_QueryGenerator::SQLValue($libraryCategoryCode);
        $zvs_sqlValue["librarySubCategoryCode"] = Zf_QueryGenerator::SQLValue($librarySubCategoryCode);
        $zvs_sqlValue["libraryBookName"] = Zf_QueryGenerator::SQLValue($libraryBookName);
        
        //Select all the books in the category
        $booksCount = Zf_QueryGenerator::BuildSQLSelect('zvs_school_library_books', $zvs_sqlValue);
        
        //Execute the query
        $executeBooksCount   = $this->Zf_AdoDB->Execute($booksCount);
        
        if (!$executeBooksCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $booksCount = $executeBooksCount->RecordCount();
        }
        
        //return books count
        return $booksCount;
        
    }

    
}

?>
