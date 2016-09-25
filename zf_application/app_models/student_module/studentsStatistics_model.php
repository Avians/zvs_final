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

class studentsStatistics_Model extends Zf_Model {
    

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
    public function AllStudentsByGenderPie($systemSchoolCode = NULL){
        
        $chartSettings = ""; $chartProperties = ""; $chartData = "";
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Pie3D",
            "ChartID" => "ex1",
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "270",
            "ChartContainer" => "studentsGender",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Total Students",
                                "subCaption": "Male vs Female",
                                "showPercentValues": "1",
                                "showPercentInTooltip": "0",
                                "pieRadius": "100",
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
        
        
        //Custom SQL QUERIES can go here
        
        $zvs_table = "zvs_students_personal_details";


        $getMaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Male' "; //die();
        $getFemaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Female' "; //die();


        $executeMaleStudents   = $this->Zf_AdoDB->Execute($getMaleStudents);
        $executeFemaleStudents = $this->Zf_AdoDB->Execute($getFemaleStudents);

        if (!$executeMaleStudents|| !$executeFemaleStudents){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $maleCount = $executeMaleStudents->RecordCount();
            $femaleCount = $executeFemaleStudents->RecordCount();

        }
        
        
        //This is the actual chart data in JSON format
        $chartData = '
            
                "data":[  
                  {  
                     "label":"Male Students",
                     "value":"'.$maleCount.'",
                     "tooltext": "Quarter 1{br}Total Sale: $195K{br}Rank: 1"
                  },
                  {  
                     "label":"Female Students",
                     "value":"'.$femaleCount.'"
                  }
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function AllStudentsByClassPie($systemSchoolCode = NULL){
        
        $zvs_table = "zvs_students_personal_details";


        $getMaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Male' "; //die();
        $getFemaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Female' "; //die();


        $executeMaleStudents   = $this->Zf_AdoDB->Execute($getMaleStudents);
        $executeFemaleStudents = $this->Zf_AdoDB->Execute($getFemaleStudents);

        if (!$executeMaleStudents){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $maleCount = $executeMaleStudents->RecordCount();

        }

        if (!$executeFemaleStudents){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $femaleCount = $executeFemaleStudents->RecordCount();

        }
        
        
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='100' legendPosition='BOTTOM'
            paletteColors='0F4E74,ffb848,28b779' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Male Students' value=' ".$maleCount." ' tooltext=' Total male students: ".$maleCount.",{br}Click for a detailed{br}information '  link=' ".Zf_GenerateLinks::zf_fusionCharts_link('platform_data', 'customer_data', 'gender_data/male/'.$dataRange)." ' />";
        $strXML .= "<set label='Female Students' value=' ".$femaleCount." ' tooltext='Total female students: ".$femaleCount.",{br}Click for a detailed{br}information '  link=' ".Zf_GenerateLinks::zf_fusionCharts_link('platform_data', 'customer_data', 'gender_data/female/'.$dataRange)." ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "Pie3D",
            "chartId"           => "studentsClasses",
            "chartWidth"        => "100%",
            "chartHeight"       => 270,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline"); 
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function AllStudentsByBloodPie($systemSchoolCode = NULL){
        
        
        $chartSettings = ""; $chartProperties = ""; $chartData = "";
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Column2D",
            "ChartID" => "bloodGroups",
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "270",
            "ChartContainer" => "studentsBloodGroups",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Students Blood Groups",
                                "showPercentValues": "1",
                                "xAxisName": "Type of Blood Groups",
                                "yAxisName": "No. of Students",
                                "exportenabled": "1",
                                "paletteColors": "#0075c2",
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
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        $zvs_table = "zvs_students_medical_details";


        $getBloodGroupABpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='AB+' "; //die();
        $getBloodGroupABnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='AB-' "; //die();
        $getBloodGroupApositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='A+' "; //die();
        $getBloodGroupAnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='A-' "; //die();
        $getBloodGroupBpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='B+' "; //die();
        $getBloodGroupBnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='B-' "; //die();
        $getBloodGroupOpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='O+' "; //die();
        $getBloodGroupOnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='O-' "; //die();


        $executeBloodGroupABpositive   = $this->Zf_AdoDB->Execute($getBloodGroupABpositive);
        $executeBloodGroupABnegative   = $this->Zf_AdoDB->Execute($getBloodGroupABnegative);
        $executeBloodGroupApositive   = $this->Zf_AdoDB->Execute($getBloodGroupApositive);
        $executeBloodGroupAnegative   = $this->Zf_AdoDB->Execute($getBloodGroupAnegative);
        $executeBloodGroupBpositive   = $this->Zf_AdoDB->Execute($getBloodGroupBpositive);
        $executeBloodGroupBnegative   = $this->Zf_AdoDB->Execute($getBloodGroupBnegative);
        $executeBloodGroupOpositive   = $this->Zf_AdoDB->Execute($getBloodGroupOpositive);
        $executeBloodGroupOnegative   = $this->Zf_AdoDB->Execute($getBloodGroupOnegative);

        if (!$executeBloodGroupABpositive || !$executeBloodGroupABnegative || !$executeBloodGroupApositive || !$executeBloodGroupAnegative || !$executeBloodGroupBpositive || !$executeBloodGroupBnegative || !$executeBloodGroupOpositive || !$executeBloodGroupOnegative){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $ABpositiveCount = $executeBloodGroupABpositive->RecordCount();
            $ABnegativeCount = $executeBloodGroupABnegative->RecordCount();
            $ApositiveCount = $executeBloodGroupApositive->RecordCount();
            $AnegativeCount = $executeBloodGroupAnegative->RecordCount();
            $BpositiveCount = $executeBloodGroupBpositive->RecordCount();
            $BnegativeCount = $executeBloodGroupBnegative->RecordCount();
            $OpositiveCount = $executeBloodGroupOpositive->RecordCount();
            $OnegativeCount = $executeBloodGroupOnegative->RecordCount();

        }
        
        
        //This is the actual chart data in JSON format
        $chartData = '
            
                "data":[  
                  {  
                     "label":"AB +ve",
                     "value":"'.$ABpositiveCount.'",
                     "tooltext": "Quarter 1{br}Total Sale: $195K{br}Rank: 1"
                  },
                  {  
                     "label":"AB -ve",
                     "value":"'.$ABnegativeCount.'"
                  },
                  {  
                     "label":"A +ve",
                     "value":"'.$ApositiveCount.'",
                     "tooltext": "Quarter 1{br}Total Sale: $195K{br}Rank: 1"
                  },
                  {  
                     "label":"A -ve",
                     "value":"'.$AnegativeCount.'"
                  },
                  {  
                     "label":"B +ve",
                     "value":"'.$BpositiveCount.'",
                     "tooltext": "Quarter 1{br}Total Sale: $195K{br}Rank: 1"
                  },
                  {  
                     "label":"B -ve",
                     "value":"'.$BnegativeCount.'"
                  },
                  {  
                     "label":"O +ve",
                     "value":"'.$OpositiveCount.'",
                     "tooltext": "Quarter 1{br}Total Sale: $195K{br}Rank: 1"
                  },
                  {  
                     "label":"O -ve",
                     "value":"'.$OnegativeCount.'"
                  }
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function AllStudentsByGuardianPie($systemSchoolCode = NULL){
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "spline",
            "ChartID" => "guardians",
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "270",
            "ChartContainer" => "studentsGuardians",
            "ChartDataFormat" =>  "json",
        );

        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Student Guardians",
                                "showPercentValues": "1",
                                "xAxisName": "Type of Guardian",
                                "yAxisName": "No. of Guardians",
                                "exportenabled": "1",
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
        
        $zvs_table = "zvs_students_guardian_details";


        $getParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Parent' "; //die();
        $getAdoptiveParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Adoptive Parent' "; //die();
        $getGrandParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Grandparent' "; //die();
        $getUncleAunt = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Uncle or Aunt' "; //die();
        $getCousin = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Cousin' "; //die();
        $getNephewNiece = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Nephew or Niece' "; //die();
        $getSponsor = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Sponsor' "; //die();
        $getFamilyFriend = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Family Friend' "; //die();
        $getOthers = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Others' "; //die();


        $executeGetParent   = $this->Zf_AdoDB->Execute($getParent);
        $executeGetAdoptiveParent   = $this->Zf_AdoDB->Execute($getAdoptiveParent);
        $executeGetGrandParent   = $this->Zf_AdoDB->Execute($getGrandParent);
        $executeGetUncleAunt   = $this->Zf_AdoDB->Execute($getUncleAunt);
        $executeGetCousin   = $this->Zf_AdoDB->Execute($getCousin);
        $executeGetNephewNiece   = $this->Zf_AdoDB->Execute($getNephewNiece);
        $executeGetSponsor   = $this->Zf_AdoDB->Execute($getSponsor);
        $executeGetFamilyFriend   = $this->Zf_AdoDB->Execute($getFamilyFriend);
        $executeGetOthers   = $this->Zf_AdoDB->Execute($getOthers);
        

        if (!$executeGetParent || !$executeGetAdoptiveParent || !$executeGetGrandParent || !$executeGetUncleAunt || !$executeGetCousin || !$executeGetNephewNiece || !$executeGetSponsor || !$executeGetFamilyFriend || !$executeGetOthers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $parentCount = $executeGetParent->RecordCount();
            $adoptiveParentCount = $executeGetAdoptiveParent->RecordCount();
            $grandParentCount = $executeGetGrandParent->RecordCount();
            $uncleAuntCount = $executeGetUncleAunt->RecordCount();
            $cousinCount = $executeGetCousin->RecordCount();
            $nephewNieceCount = $executeGetNephewNiece->RecordCount();
            $sponsorCount = $executeGetSponsor->RecordCount();
            $familyFriendCount = $executeGetFamilyFriend->RecordCount();
            $othersCount = $executeGetOthers->RecordCount();
        }
        
        
        //This is the actual chart data in JSON format
        $chartData = '
            
                "data":[
                
                  {  
                     "label":"Parents",
                     "value":"'.$parentCount.'",
                     "tooltext": "Total Parents: '.$parentCount.'"
                  },
                  {  
                     "label":"Adoptive Parents",
                     "value":"'.$adoptiveParentCount.'",
                     "tooltext": "Total Parents: '.$adoptiveParentCount.'"
                  },
                  {  
                     "label":"Grandparents",
                     "value":"'.$grandParentCount.'",
                     "tooltext": "Total Parents: '.$grandParentCount.'"
                  },
                  {  
                     "label":"Uncles/Aunts",
                     "value":"'.$uncleAuntCount.'",
                     "tooltext": "Total Parents: '.$uncleAuntCount.'"
                  },
                  {  
                     "label":"Cousins",
                     "value":"'.$cousinCount.'",
                     "tooltext": "Total Parents: '.$cousinCount.'"
                  },
                  {  
                     "label":"Nephew/Nieces",
                     "value":"'.$nephewNieceCount.'",
                     "tooltext": "Total Parents: '.$nephewNieceCount.'"
                  },
                  {  
                     "label":"Sponsors",
                     "value":"'.$sponsorCount.'",
                     "tooltext": "Total Parents: '.$sponsorCount.'"
                  },
                  {  
                     "label":"Family Friends",
                     "value":"'.$familyFriendCount.'",
                     "tooltext": "Total Parents: '.$familyFriendCount.'"
                  },
                  {  
                     "label":"Others",
                     "value":"'.$othersCount.'",
                     "tooltext": "Total Parents: '.$othersCount.'"
                  },
                  
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
       
        
    }
    
    
    
    
    
}

?>


