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

class processFeeStructure_Model extends Zf_Model {
    
    //This is the user identificationCode
    private $identificationCode;


    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();
        
        $this->identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
         
    }
    
    
    
    
    /**
     * This public method does fetch all class details
     */
    public function generateClassTitle(){
        
        $postedTitleValues = explode(ZVSS_CONNECT, $_POST['postedTitleValues']);
        
        $schoolClassCode = $postedTitleValues[0].ZVSS_CONNECT.$postedTitleValues[1];
        
        $fechClassDetails = $this->pullClassDetails($schoolClassCode);
        
        $classTitle = '';
        
        foreach ($fechClassDetails as $classValue) {
            
            $className = $classValue['schoolClassName'];
            
            $classTitle .= ucfirst(strtolower($className.', '.$postedTitleValues[2].' fee structure'));
            
        }
        
        echo $classTitle;
        
    }

    



    /**
     * This method is vital in loading splash screen for fee structure page
     */
    public function generateClassFeeStructure(){
        
       $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->identificationCode)[2];
        
       $postedFeeValues = $_POST['postedFeeValues'];
       
       $feeStructureView = '';
       
       $generalFeeDetails = $this->pullGeneralFeeDetails($postedFeeValues);
       
       $classFeeDetails = $this->pullClassFeeDetails($postedFeeValues);
       
       if(($generalFeeDetails == 0) && ($classFeeDetails == 0)){
           
           $feeStructureView .='<div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 20% !important;">
                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 16px !important;"></i><br/>
                                    <span class="content-view-errors" >
                                        <b>&nbsp;There is no fee structure for the selected class and year!!.</b>
                                    </span>
                                </div>';
           
       }else{
           
           $feeStructureView .='<div class="zvs-table-blocks scroller" data-always-visible="1" data-rail-visible="0">
                                     <div class="table-responsive">
                                         <table class="table table-striped table-hover">
                                             <thead>
                                                 <tr>
                                                     <th  style="width: 60%;"> Fee Item Name</th><th style="width: 35%; text-align: right; padding-right: 10px;">Amount</th>
                                                 </tr>
                                             </thead>
                                             <tbody>';

                                             $genralTotalAmount; $classTotalAmount;

                                             foreach ($generalFeeDetails as $generalFeeValues) {

                                                 $itemName = $generalFeeValues['feeItem']; $itemAmount = $generalFeeValues['itemAmount'];
                                                 $feeStructureView .='<tr><td>'.$itemName.'</td><td style="text-align: right; padding-right: 10px;">'.number_format($itemAmount, 2).'</td></tr>';

                                                 $genralTotalAmount = $genralTotalAmount + $itemAmount;

                                             }

                                             foreach ($classFeeDetails as $classFeeValues) {

                                                 $itemName = $classFeeValues['feeItem']; $itemAmount = $classFeeValues['itemAmount'];
                                                 $feeStructureView .='<tr><td>'.$itemName.'</td><td style="text-align: right; padding-right: 10px;">'.number_format($itemAmount, 2).'</td></tr>';

                                                 $classTotalAmount = $classTotalAmount + $itemAmount;

                                             }

                                             $totalAmount = $genralTotalAmount + $classTotalAmount;

                    $feeStructureView .='   <tfooter>
                                             <tr>
                                                 <th  style="width: 60%;"> Totals</th><th style="width: 35%; text-align: right; padding-right: 10px;">'.number_format($totalAmount, 2).'</th>
                                             </tr>
                                         </tfooter>
                                     </tbody>
                                 </table>
                             </div>
                         </div>';
           
       }
       
       echo $feeStructureView;
       
    }
    
    
    
    
    /**
     * This method is vital in loading splash screen for fee structure page
     */
    public function generateClassFeeSummary(){
        
       $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->identificationCode)[2];
        
       $postedFeeValues = $_POST['postedFeeValues'];
       
       $feeSummaryView = '<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="dashboard-stat blue">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                           KES: 13,700.00
                                        </div>
                                        <div class="desc">
                                            Total School Fees
                                        </div>
                                    </div>
                                    <div class="more" style="height: 40px;" href="#">
                                        Total annual school fees payable by form one students
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important;"></div>
                            <div class="col-md-6" ></div>
                        </div>';
       
       echo $feeSummaryView;
        
    }
    
    
    
    
    /**
     * This private function pulls general fee details
     */
    private function pullGeneralFeeDetails($formValues){
        
        $feeData = explode(ZVSS_CONNECT, $formValues);
        
        $systemSchoolCode = $feeData[0]; $selectedYear = $feeData[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchGeneralFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_general_school_fees', $zvs_sqlValue);
        
        //echo $fetchGeneralFeeItems;
        
        $zf_executeFetchGeneralFeeItems= $this->Zf_AdoDB->Execute($fetchGeneralFeeItems);

        if(!$zf_executeFetchGeneralFeeItems){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchGeneralFeeItems->RecordCount() > 0){

                while(!$zf_executeFetchGeneralFeeItems->EOF){
                    
                    $results = $zf_executeFetchGeneralFeeItems->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This private function pulls class fee details
     */
    private function pullClassFeeDetails($formValues){
        
        $feeData = explode(ZVSS_CONNECT, $formValues);
        
        $systemSchoolCode = $feeData[0]; $feeClass = $feeData[1]; $selectedYear = $feeData[2];
        $schoolClassCode = $systemSchoolCode.ZVSS_CONNECT.$feeClass;
        
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchClassFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_class_school_fees', $zvs_sqlValue);
        
        //echo $fetchClassFeeItems; exit();
        
        $zf_executeFetchClassFeeItems= $this->Zf_AdoDB->Execute($fetchClassFeeItems);

        if(!$zf_executeFetchClassFeeItems){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassFeeItems->RecordCount() > 0){

                while(!$zf_executeFetchClassFeeItems->EOF){
                    
                    $results = $zf_executeFetchClassFeeItems->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
    
    /**
     * This private function pulls class details
     */
    private function pullClassDetails($schoolClassCode){
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchClassDetails = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        //echo $fetchClassFeeItems; exit();
        
        $zf_executeFetchClassDetails= $this->Zf_AdoDB->Execute($fetchClassDetails);

        if(!$zf_executeFetchClassDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassDetails->RecordCount() > 0){

                while(!$zf_executeFetchClassDetails->EOF){
                    
                    $results = $zf_executeFetchClassDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
        
    }
    
    
    
}

?>
