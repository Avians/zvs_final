<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the model is responsible for fetching data about location   |
 * |  of a newly registered student.                                   |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class processDynamicFeesCharts_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
    private $userIdentificationCode;

    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
         
         $this->userIdentificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
  
    }
    
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function plotDynamicGeneralPieChart(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $selectedYear = $_POST['postedChartValues'];
        
        
         //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Pie2D",
            "ChartID" => "generalFeesDynamicPie".$selectedYear,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "generalFeesDynamicPieChart",
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
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        //Pull all general school fees items
        $zvs_generalSchoolFeesItems = $this->fetchGeneralFeeItems($systemSchoolCode, $selectedYear);
        
        //print_r($zvs_generalSchoolFeesItems); exit();
        
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
     * This method is used to select Admin localities
     */
    public function plotDynamicGeneralBarChart(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $selectedYear = $_POST['postedChartValues'];
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Column2D",
            "ChartID" => "generalFeesDynamicBar".$selectedYear,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "generalFeesDynamicBarChart",
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
                                "formatNumberScale": "0",
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
                                "maxLabelHeight": "40",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //Pull all general school fees items
        $zvs_generalSchoolFeesItems = $this->fetchGeneralFeeItems($systemSchoolCode,$selectedYear);
        
        //print_r($zvs_generalSchoolFeesItems); exit();
        
        $chartData = ' "data":[ ';
        
        foreach ($zvs_generalSchoolFeesItems as $zvs_feeItems) {
            
            $feeItem = $zvs_feeItems['feeItem']; $itemAmount = $zvs_feeItems['itemAmount'];
            
            //This is the actual chart data in JSON format
            $chartData .= '{
            
                "label":"'.$feeItem.'",
                "value":"'.$itemAmount.'",
                "tooltext": "'.$feeItem.', actual value = '.$itemAmount.'"
                        
            },';
            
        }
        
        $chartData .= ']';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    
    /**
     * This private method returns all general school fees items
     */
    private function fetchGeneralFeeItems($systemSchoolCode, $selectedYear) {
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchGeneralFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_general_school_fees', $zvs_sqlValue);
        
        //echo $fetchGeneralFeeItems; exit();
        
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
     * This method is used to plot class pie chart
     */
    public function plotDynamicClassPieChart(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $postedChartValues = $_POST['postedChartValues'];
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Pie2D",
            "ChartID" => "classFeesDynamicPie".$postedChartValues,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "classFeesDynamicPieChart",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Percentage Representation",
                                "subCaption": "of class school fees items",
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
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        //Pull all class school fees items
        $zvs_classSchoolFeesItems = $this->fetchClassFeeItems($postedChartValues);
        
        //print_r($zvs_generalSchoolFeesItems); exit();
        
        $chartData = ' "data":[ ';
        
        foreach ($zvs_classSchoolFeesItems as $zvs_feeItems) {
            
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
     * This method is used to plot class bar chart
     */
    public function plotDynamicClassBarChart(){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($this->userIdentificationCode)[2];
        
        $postedChartValues = $_POST['postedChartValues'];
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Column2D",
            "ChartID" => "classFeesDynamicBar".$postedChartValues,
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "350",
            "ChartContainer" => "classFeesDynamicBarChart",
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
                                "bgColor": "#ffffff",
                                "borderAlpha": "20",
                                "formatNumberScale": "0",
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
                                "maxLabelHeight": "40",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        
        //Pull all general school fees items
        $zvs_classSchoolFeesItems = $this->fetchClassFeeItems($postedChartValues);
        
        //print_r($zvs_generalSchoolFeesItems); exit();
        
        $chartData = ' "data":[ ';
        
        foreach ($zvs_classSchoolFeesItems as $zvs_feeItems) {
            
            $feeItem = $zvs_feeItems['feeItem']; $itemAmount = $zvs_feeItems['itemAmount'];
            
            //This is the actual chart data in JSON format
            $chartData .= '{
            
                "label":"'.$feeItem.'",
                "value":"'.$itemAmount.'",
                "tooltext": "'.$feeItem.', actual value = '.$itemAmount.'"
                        
            },';
            
        }
        
        $chartData .= ']';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    
    /**
     * This private method returns all general school fees items
     */
    private function fetchClassFeeItems($postedChartValues) {
        
        $postedChartData = explode(ZVSS_CONNECT, $postedChartValues);
        
        $selectedYear = $postedChartData[0];
        $systemSchoolCode = $postedChartData[1];
        $schoolClassCode = $postedChartData[1].ZVSS_CONNECT.$postedChartData[2];
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvs_sqlValue["feeItemYear"] = Zf_QueryGenerator::SQLValue($selectedYear);
        
        $fetchGeneralFeeItems = Zf_QueryGenerator::BuildSQLSelect('zvs_class_school_fees', $zvs_sqlValue);
        
        //echo $fetchGeneralFeeItems; exit();
        
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
    
}

?>
