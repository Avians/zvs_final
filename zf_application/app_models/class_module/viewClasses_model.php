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

class viewClasses_Model extends Zf_Model {
    
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
     * This method returns details of a class being viewed.
     */
    public function fetchClassDetails($identificationCode){
        
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        $zvs_classGridView = '';
         
         //Here we fetch and return all class details.
         $zvs_classDetails = $this->zvs_fetchClassDetails($systemSchoolCode);
         
         
         if($zvs_classDetails == 0){
             
             $zvs_classGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>Class Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no classes yet! You need to add atleast one class to have a class overview.
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
             foreach($zvs_classDetails as $classValues){
                 
                $zvs_className = $classValues['schoolClassName']; $schoolClassCode =  $classValues['schoolClassCode'];

                $chartContainer = explode(ZVSS_CONNECT, $schoolClassCode)[1];

                $zvs_classGridView .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                             <div class="zvs-content-titles">
                                                 <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                     <h3 style="padding-left: 10px !important;">'.$zvs_className.'</h3>
                                                 </div>
                                                 <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                     <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_class_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolClassCode).' " title="View '.$zvs_className.'" ><i class="fa fa-list"></i></a></h3>
                                                 </div>
                                             </div>
                                             <div class="portlet-body">
                                                 <div class="zvs-chart-blocks" id="'.$chartContainer.'">';
                 
                                                //This is the function that generates the chart.
                                                $zvs_classGridView .= $this->zvs_drawClassChart($schoolClassCode, $zvs_className, $chartContainer);
                                                
                        $zvs_classGridView .='   </div>
                                            </div>
                                        </div>
                                    </div>';
                 
                 
                 
             }
             
             
         }
         
         
         echo $zvs_classGridView;
         
        
    }
    
    
    
    
    
    
    /**
     * This method plots the actual call graph
     */
    public function zvs_drawClassChart($schoolClassCode, $zvs_className, $chartContainer){
        
        
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
                "ChartType" => "Column2D",
                "ChartID" => $schoolClassCode,
                "ChartWidth" =>  "100%",
                "ChartHeight" =>  "270",
                "ChartContainer" => $chartContainer,
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
    
 
    
    
    /**
     * This method returns the options for selecting year of study
     */
    private function zvs_buildYearsOption(){
        
        $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
        $endYear = explode("-", $currentDate)[2]; $startYear = $endYear - 10;
        
        $option = "";
        
        $option .='<select>';

            for($year=$startYear; $year < date('Y')+1; $year++){
                
                if(!empty($endYear) && $endYear != NULL){
                    
                    if($year < $endYear || $year == $endYear){
                        
                        $option .= '<option value="'.$year.'">'.$year.'</option>';
                       
                    }
                    
                }else{
                    
                    $option .= '<option value="'.$year.'">'.$year.'</option>';
 
                    
                }
                
            }
            
            
            $option .= '<option value="all" selected>All Years</option>';
            
            
        $option .='</select>';
            
            
        return $option;
 
        
    }
  
    
    
}

?>
