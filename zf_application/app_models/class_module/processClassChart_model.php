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

class processClassChart_Model extends Zf_Model {
    

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
     * This method is used to select Admin localities
     */
    public function plotClassChart(){
        
        $postedClassValues = $_POST['postedClassValues'];
        
        $classValuesArray = explode(ZVSS_CONNECT, $postedClassValues);
        
        $zvs_classYear = $classValuesArray[0]; $schooClassCode = $classValuesArray[1].ZVSS_CONNECT.$classValuesArray[2];
        $zvs_className = $classValuesArray[3]; $chartContainer = $classValuesArray[2];
       
        //echo $zvs_classYear."<br>".$schooClassCode."<br>".$zvs_className."<br>".$chartContainer;
        
        $this->zvs_renderClassChart($schooClassCode, $zvs_className, $chartContainer);
        
        //echo $zvs_classChart;
        
        
    }
    
    
    
    /**
     * This method plots the actual call graph
     */
    private function zvs_renderClassChart($schoolClassCode, $zvs_className, $chartContainer){
        
        
        $zvs_streamDetails = $this->zvs_fetchStreamDetails($schoolClassCode);
        
        $classChartData = "";
        
        if($zvs_streamDetails == 0){
            
            $classChartData .= '<div  style="text-align: center !important; padding-top: 20% !important;">
                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                    <span class="content-view-errors" >
                                        &nbsp;No data to visulaize for '.strtolower($zvs_className).' yet!
                                    </span>
                                </div>';
            
            return $classChartData;
            
            
        }else{
            
            //These are the initial chart settings
            $chartSettings = array(
                "ChartType" => "Pie2D",
                "ChartID" => $schoolClassCode."Dynamic",
                "ChartWidth" =>  "100%",
                "ChartHeight" =>  "270",
                "ChartContainer" => $chartContainer."Dynamic",
                "ChartDataFormat" =>  "json",
            );
        
        
            //These chart properties add to the beauty of the chart
            $chartProperties = '

                            "chart":{  
                                "caption": "'.$zvs_className.' Students",
                                "captionFontSize": "11",
                                "xAxisName": "'.$zvs_className.' Streams",
                                "yAxisName": "No. of Students",
                                "bgColor": "#ffffff",
                                "palettecolors": "#2A5653, #40888F, #73A99B, #8AC59D, #4D871F",
                                "borderAlpha": "20",
                                "exportenabled": "1",
                                "canvasBorderAlpha": "0",
                                "usePlotGradientColor": "0",
                                "plotBorderAlpha": "10",
                                "placevaluesInside": "1",
                                "rotatevalues": "1",
                                "valueFontColor": "#ffffff",
                                "useDataPlotColorForLabels": "1",
                                "labelDisplay": "rotate",
                                "slantLabels": "1",
                                "labelDistance": "1",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }

                        ';
        
                $chartData = ' 
                    "data":[';
                
                foreach ($zvs_streamDetails as $streamValues) {
                    
                    $streamName = $streamValues['schoolStreamName']; 
                    $streamOccupancy = $streamValues['schoolStreamOccupancy'];
                    $streamCode = $streamValues['schoolStreamCode'];
                
                    $chartData .= '{  
                                "label":"'.$streamName.'",
                                "value":"'.$streamOccupancy.'",
                                "tooltext": "'.$streamOccupancy.' Students in '.strtolower($zvs_className).', '.strtolower($streamName).'"
                            },';
                
                }
                
                
                $chartData .= ']';
        
        
        
        
        
                $classChartData .= Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
                return $classChartData;
            
        }
           
    }
    
    
    
    
    
    /**
     * This method checks and counts, then returns class details for all classess in the school 
     */
    private function zvs_fetchClassDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvs_school_classes', $zvs_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns all stream details for all classess in the school.
     */
    private function zvs_fetchStreamDetails($schoolClassCode){
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSchoolStreams = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchSchoolStreams = $this->Zf_AdoDB->Execute($fetchSchoolStreams);

        if(!$zf_executeFetchSchoolStreams){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolStreams->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStreams->EOF){
                    
                    $results = $zf_executeFetchSchoolStreams->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}

?>
