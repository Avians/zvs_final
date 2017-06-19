<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * | This the model is responsible for processing all library overview |
 * | information                                                       |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class libraryOverview_Model extends Zf_Model {
    

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
     * This method is used to return tranport dashlets
     */
    public function getLibraryDashboardInformation($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $libraryInformation = "";
        
        $libraryInformation .=' <!--START OF SUBJECT STATISTICS-->
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat purple-sharp">
                                            <div class="visual">
                                                <i class="fa fa-building-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
        
                                                    $totalLibraryCategories = $this->getSchoolLibraryInformation($systemSchoolCode, "library_categories");
                                                    $libraryInformation .= $totalLibraryCategories;
                                                            
                        $libraryInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Total Categories&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-building-o"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total library categories
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat green-sharp">
                                            <div class="visual">
                                                <i class="fa fa-sliders"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                    $totalLibrarySubCategories = $this->getSchoolLibraryInformation($systemSchoolCode, "library_sub_categories");
                                                    $libraryInformation .= $totalLibrarySubCategories;
                                                    
                        $libraryInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Sub Categories&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-sliders"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Library sub-categories
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat blue-madison">
                                            <div class="visual">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                   $totalLibraryBooks = $this->getSchoolLibraryInformation($systemSchoolCode,  "library_books");
                                                   $libraryInformation .= $totalLibraryBooks;
                                                   
                        $libraryInformation .=' </div>
                                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                    Library Books&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-book"></i>
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total library books
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="dashboard-stat red-soft">
                                            <div class="visual">
                                                <i class="fa fa-id-badge"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number" style="font-size: 35px !important">';
                        
                                                   $totalBooksIssued = $this->getSchoolLibraryInformation($systemSchoolCode,  "books_issued");
                                                   $libraryInformation .= $totalBooksIssued;
                                                   
                        $libraryInformation .=' </div>
                                                <div class="desc text-center" style="padding-top: 15px; font-family: Ubuntu-B;">
                                                   Library Book Issues<br>Coming Soon
                                                </div>
                                            </div>
                                            <div class="more text-center" style="height: 25px;" href="#">
                                                Total books issued
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END OF SUBJECT STATISTICS-->';
        
        
        echo $libraryInformation;
        
        
    }
    
    
    
    //This private method returns total of all transport Information in the school
    private function getSchoolLibraryInformation($systemSchoolCode, $zvs_targetAction){
        
        if($zvs_targetAction === "library_categories"){
            
            //This method uniquely counts all the library categories
            return $this->zvs_countSchoolLibraryInformation($systemSchoolCode,"zvs_school_library_category");
            
        }else if($zvs_targetAction === "library_sub_categories"){
        
            //This method uniquely counts all the library sub-categories
            return $this->zvs_countSchoolLibraryInformation($systemSchoolCode, "zvs_school_library_sub_category");
            
        }else if($zvs_targetAction === "library_books"){
        
            //This method uniquely counts all library book
            return $this->zvs_countSchoolLibraryInformation($systemSchoolCode, "zvs_school_library_books");
            
        }else if($zvs_targetAction === "books_issues"){
        
            //This method uniquely counts all books issued
            //return $this->zvs_countSchoolLibraryBooksIssued($systemSchoolCode);
            
        }
    }
    
    
    
    
    //This private method counts actual library information
    private function zvs_countSchoolLibraryInformation($systemSchoolCode, $zvs_targetTable){
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);

        $zvs_selectLibraryInformation = Zf_QueryGenerator::BuildSQLSelect($zvs_targetTable, $sqlValues);
        
        $executeLibraryInformationCount   = $this->Zf_AdoDB->Execute($zvs_selectLibraryInformation);
        
        if (!$executeLibraryInformationCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $libraryInformationCount = $executeLibraryInformationCount->RecordCount();
            
        }
        
        //return library information count
        return $libraryInformationCount;
        
    }
    
    
    
    
    /**
     * This method is used to return all school library categories
     */
    public function getSchoolLibaryCategories($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $libraryCategoriesGrid = '<div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">Library Categories</h3>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">Category Name</th><th style="width: 30%;">Book Count</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            
                                                            //This method fetches all library categories
                                                            $libraryCategories = $this->zvs_getLibraryCategories($systemSchoolCode);
                                                            
                                                            if($libraryCategories == 0){
                                                                
                                                                $libraryCategoriesGrid .='<tr><td>There are no library categories</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($libraryCategories as $categoryValues){
                                                                    
                                                                    $libraryCategoryName = $categoryValues['libraryCategoryName'];
                                                                    
                                                                    $libraryCategoriesGrid .='<tr><td>'.$libraryCategoryName.'</td>';
                                                                    
                                                                    //Count books per category
                                                                    $libraryCategoryCode = $categoryValues['libraryCategoryCode'];
                                                                    $categoryBookCount = $this->zvs_schoolLibraryBookCount($systemSchoolCode, $libraryCategoryCode);
                                                                    
                                                                    $libraryCategoriesGrid .='<td>'.$categoryBookCount.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $libraryCategoriesGrid .='</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        
        echo $libraryCategoriesGrid;
        
    }
    
    
    
    
    //This private method fetches all library categories
    private function zvs_getLibraryCategories($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchLibraryCategories = Zf_QueryGenerator::BuildSQLSelect('zvs_school_library_category', $zvs_sqlValue);
        
        $zf_executeFetchLibraryCategories = $this->Zf_AdoDB->Execute($fetchLibraryCategories);

        if(!$zf_executeFetchLibraryCategories){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchLibraryCategories->RecordCount() > 0){

                while(!$zf_executeFetchLibraryCategories->EOF){
                    
                    $results = $zf_executeFetchLibraryCategories->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method is used to return all school library categories
     */
    public function getSchoolLibarySubCategories($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $librarySubCategoriesGrid = '<div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 style="padding-left: 10px !important;">Library Sub-Categories</h3>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">Sub-Category Name</th><th>Book Count</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            
                                                            //This method fetches all library sub categories
                                                            $librarySubCategories = $this->zvs_getLibrarySubCategories($systemSchoolCode);
                                                            
                                                            if($librarySubCategories == 0){
                                                                
                                                                $librarySubCategoriesGrid .='<tr><td colspan="2">There are no library categories</td></tr>';
                                                                
                                                            }else{
                                                                
                                                                foreach($librarySubCategories as $subCategoryValues){
                                                                    
                                                                    $librarySubCategoryName = $subCategoryValues['librarySubCategoryName'];
                                                                    $librarySubCategoriesGrid .='<tr><td>'.$librarySubCategoryName.'</td>';
                                                                    
                                                                    //Count books per sub category
                                                                    $librarySubCategoryCode = $subCategoryValues['librarySubCategoryCode'];
                                                                    $subCategoryBookCount = $this->zvs_schoolLibraryBookCount($systemSchoolCode, NULL,  $librarySubCategoryCode);
                                                                    
                                                                    $librarySubCategoriesGrid .='<td>'.$subCategoryBookCount.'</td></tr>';
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                            $librarySubCategoriesGrid .='</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        
        echo $librarySubCategoriesGrid;
        
    }
    
    
    
    
    //This private method fetches all library sub categories
    private function zvs_getLibrarySubCategories($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
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
    
    
    //This private method counts actual books in the library based on category, sub-category or both
    private function zvs_schoolLibraryBookCount($systemSchoolCode, $libraryCategoryCode = NULL, $librarySubCategoryCode = NULL){
        
        $zvs_targetTable = "zvs_school_library_books";
        
        $sqlValues['systemSchoolCode'] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        //This includes library category code
        if(!empty($libraryCategoryCode) && $libraryCategoryCode != NULL){
            
            $sqlValues['libraryCategoryCode'] = Zf_QueryGenerator::SQLValue($libraryCategoryCode);
            
        }
        
        //This include library sub category code
        if(!empty($librarySubCategoryCode) && $librarySubCategoryCode != NULL){
            
            $sqlValues['librarySubCategoryCode'] = Zf_QueryGenerator::SQLValue($librarySubCategoryCode);
            
        }

        $zvs_selectLibraryBooks = Zf_QueryGenerator::BuildSQLSelect($zvs_targetTable, $sqlValues);
        
        
        $executeLibraryBookCount   = $this->Zf_AdoDB->Execute($zvs_selectLibraryBooks);
        
        if (!$executeLibraryBookCount){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $libraryBookCount = $executeLibraryBookCount->RecordCount();
            
        }
        
        //return library book count
        return $libraryBookCount;
        
    }
    
    
    
}

?>
