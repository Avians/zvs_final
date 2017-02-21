<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to management of school hostels .          |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class manageSchoolFees_Model extends Zf_Model {
    
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
     * This method returns all general fee details for a school in a pie chart
     */
    public function fetchGeneralFeesPieChart($identificationCode){
        
         
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Pie2D",
            "ChartID" => 'generalFeesPie',
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "generalFeesStaticPieChart",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Percentage Representation",
                                "subCaption": "of school fees items",
                                "captionFontSize": "11",
                                "subcaptionFontSize": "8",
                                "showPercentValues": "1",
                                "showPercentInTooltip": "0",
                                "pieRadius": "90",
                                "exportenabled": "1",
                                "decimals": "1",
                                "enableSmartLabels": "1",
                                "use3DLighting": "1",
                                "useDataPlotColorForLabels": "1",
                                "smartLineColor": "#d11b2d",
                                "smartLineThickness": "2",
                                "smartLineAlpha": "75",
                                "isSmartLineSlanted": "0",
                                "labelDistance": "1",
                                "showLegend": "1",
                                "legendBgColor": "#ffffff",
                                "legendBorderAlpha": "0",
                                "legendShadow": "0",
                                "legendItemFontSize": "10",
                                "legendItemFontColor": "#666666",
                                "useDataPlotColorForLabels": "1",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        

        
        
        //Pull all general school fees items
        $zvs_generalSchoolFeesItems = $this->fetchGeneralFeeItems($systemSchoolCode);
        
        $chartData = ' "data":[ ';
        
        foreach ($zvs_generalSchoolFeesItems as $zvs_feeItems) {
            
            $feeItem = $zvs_feeItems['feeItem']; $itemAmount = $zvs_feeItems['itemAmount'];
            
            //This is the actual chart data in JSON format
            $chartData .= '{
            
                "label":"'.$feeItem.'",
                "value":"'.$itemAmount.'",
                "tooltext": "'.$feeItem.', percentage representation"
                        
            },';
            
        }
        
        $chartData .= ']';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    /**
     * This method returns all general fee details for a school in a bar chart
     */
    public function fetchGeneralFeesBarChart($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Column2D",
            "ChartID" => 'generalFeesBar',
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "generalFeesStaticBarChart",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Actual Amounts",
                                "subCaption": "of school fees items",
                                "captionFontSize": "11",
                                "subcaptionFontSize": "8",
                                "xAxisName": "Fee Items",
                                "yAxisName": "Amount of Money",
                                "exportenabled": "1",
                                "bgColor": "#ffffff",
                                "borderAlpha": "20",
                                "canvasBorderAlpha": "0",
                                "formatNumberScale": "0",
                                "usePlotGradientColor": "0",
                                "plotBorderAlpha": "10",
                                "placevaluesInside": "1",
                                "rotatevalues": "1",
                                "valueFontColor": "#ffffff",
                                "useDataPlotColorForLabels": "1",
                                "labelDistance": "1",
                                "labelDisplay": "rotate",
                                "slantLabels": "1",
                                "maxLabelHeight": "40",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //Pull all general school fees items
        $zvs_generalSchoolFeesItems = $this->fetchGeneralFeeItems($systemSchoolCode);
        
        $chartData = ' "data":[ ';
        
        foreach ($zvs_generalSchoolFeesItems as $zvs_feeItems) {
            
            $feeItem = $zvs_feeItems['feeItem']; $itemAmount = $zvs_feeItems['itemAmount'];
            
            //This is the actual chart data in JSON format
            $chartData .= '{
            
                "label":"'.$feeItem.'",
                "value":"'.$itemAmount.'",
                "tooltext": "'.$feeItem.', actual value = '.number_format($itemAmount).'"
                        
            },';
            
        }
        
        $chartData .= ']';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    /**
     * This method returns all class fee details for a school in a pie chart
     */
    public function fetchClassFeesPieChart($identificationCode){
       
        $zf_viewData = "";
        
        $zf_viewData .='<div class="row" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 15% !important; border: 0px !important;">
                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                    <span class="content-view-errors" >
                                        &nbsp;There are no classes yet! You need to add atleast one class to have a class overview.
                                    </span>
                                </div>
                            </div>
                        </div>';
        
        echo  $zf_viewData;
       
    }
    
    
    
    /**
     * This method returns all class fee details for a school in a bar chart
     */
    public function fetchClassFeesBarChart($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Column2D",
            "ChartID" => 'classFeesBar',
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "classFeesStaticBarChart",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Actual Amounts",
                                "subCaption": "of class school fees items",
                                "captionFontSize": "11",
                                "subcaptionFontSize": "8",
                                "xAxisName": "Fee Items",
                                "yAxisName": "Amount of Money",
                                "exportenabled": "1",
                                "formatNumberScale": "0",
                                "bgColor": "#ffffff",
                                "borderAlpha": "20",
                                "canvasBorderAlpha": "0",
                                "usePlotGradientColor": "0",
                                "plotBorderAlpha": "10",
                                "placevaluesInside": "1",
                                "rotatevalues": "1",
                                "valueFontColor": "#ffffff",
                                "useDataPlotColorForLabels": "1",
                                "labelDistance": "1",
                                "labelDisplay": "rotate",
                                "slantLabels": "1",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //Pull all general school fees items
        $zvs_generalSchoolFeesItems = $this->fetchClassFeeItems($systemSchoolCode);
        
        $chartData = ' "data":[ ';
      
        foreach ($zvs_generalSchoolFeesItems as $zvs_feeItems) {
            
            $feeItem = $zvs_feeItems['feeItem']; $itemAmount = $zvs_feeItems['itemAmount'];
            
            //This is the actual chart data in JSON format
            $chartData .= '{
            
                "label":"'.$feeItem.'",
                "value":"'.$itemAmount.'",
                "tooltext": "'.$feeItem.', percentage representation"
                        
            },';
            
        }
        
        $chartData .= ']';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    
    /**
     * This private method returns all general school fees items
     */
    private function fetchGeneralFeeItems($systemSchoolCode) {
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate(); $currentYear = explode("-", $currentDate)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($currentYear);
        
        $fetchGeneralFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_general_school_fees', $zvs_sqlValue);
        
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
     * This private method returns all class based school fees items
     */
    private function fetchClassFeeItems($systemSchoolCode) {
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate(); $currentYear = explode("-", $currentDate)[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($currentYear);
        
        $fetchClassFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_class_school_fees', $zvs_sqlValue);
        
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
     * This method returns the options for selecting year of study
     */
    public function zvs_buildYearsOption($yearsDiv){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear-2;
        
        $option = "";
        
        $option .='<select class="select2me" style="width: 87px !important;"  id="'.$yearsDiv.'">';

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
        
            $option .='<select class="select2me" style="width: 130px !important;"  id="'.$classSelectDiv.'">';
            
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
