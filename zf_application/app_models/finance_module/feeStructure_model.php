<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school classes and a new  |
 * |  new streams into the classess.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class feeStructure_Model extends Zf_Model {
    
    private $zvs_controller;


    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();

        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the active controller
        $this->zvs_controller = $activeURL[0];
         
    }
    
    
    
    
    /**
     * This method is vital in loading splash screen for fee structure page
     */
    public function feeStructureSplashScreen(){
        
        $pageInformation = "";
        
        $pageInformation .='<div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 90px !important; padding-bottom: 90px !important;">
                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br/>
                                <span class="content-view-errors" >
                                    <b>&nbsp;You will need to select a class and a related year so as to have a view of its fee structure.</b>
                                </span>
                            </div>';
        
        echo $pageInformation;
        
    }
    
    
    /**
     * This method returns the options for selecting year of study
     */
    public function zvs_buildYearsOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-2;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 115px !important;"  id="'.$yearsDiv.'">';

            for($year=$startYear; $year < $endYear+2; $year++){
                
                if(!empty($startYear) && $startYear != NULL){
                    
                    if(($year > $startYear || $year == $startYear) && $year != $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                        
                    }if($year == $endYear){
                        
                        $option .= '<option value="'.$year.'" selected>'.$year.'</option>';
                        
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
                    
                }
                
            }
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
    
    
    
    
    /**
     * This method returns the options for selecting year of study
     */
    public function zvs_buildClassOption($identificationCode, $classSelectDiv){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $zf_selectClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectClasses)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectClasses}.</i></b>";
            echo $message; exit();

        }else{
            
            $option = "";
        
            $option .='<select class="select2me" style="width: 115px !important;"  id="'.$classSelectDiv.'">';
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                $option .='<option value=""></option>';
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $option .='<option value="'.$fetchRow->schoolClassCode.'" >'.$fetchRow->schoolClassName.'</option>';

                }

            }
            
            $option .='</select>';
            
            echo $option;
        }
 
    }
    
    
    
    
}

?>
