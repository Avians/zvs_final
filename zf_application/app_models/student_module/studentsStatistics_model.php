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
     * This method is used to render students gender chart
     */
    public function AllStudentsByGenderPie($systemSchoolCode){
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Pie3D",
            "ChartID" => 'gender',
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
                                "captionFontSize": "11",
                                "subcaptionFontSize": "8",
                                "showPercentValues": "1",
                                "showPercentInTooltip": "0",
                                "pieRadius": "80",
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


        $getMaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Male' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getFemaleStudents = "SELECT * FROM " . $zvs_table . " WHERE studentGender ='Female' AND systemSchoolCode = '".$systemSchoolCode."'  "; //die();


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
                    "tooltext": "Total Male Students: '.$maleCount.'"
                  },
                  {  
                    "label":"Female Students",
                    "value":"'.$femaleCount.'",
                    "tooltext": "Total Female Students: '.$femaleCount.'"
                  }
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    
    /**
     * This method is used to render students class chart
     */
    public function AllStudentsByClassPie($systemSchoolCode){
        
        //These are the initial chart settings
        $chartSettings = array(
            "ChartType" => "Line",
            "ChartID" => "class",
            "ChartWidth" =>  "100%",
            "ChartHeight" =>  "270",
            "ChartContainer" => "studentsClass",
            "ChartDataFormat" =>  "json",
        );
        
        
        //These chart properties add to the beauty of the chart
        $chartProperties .= '
            
                            "chart":{  
                                "caption": "Students Per Class",
                                "captionFontSize": "11",
                                "xAxisName": "School Classes",
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
         
        
       //Fetch class details for the school in question
        $fetchClassDetails = $this->fetchClassDetails($systemSchoolCode);
        
        
        if($fetchClassDetails == 0){
            
            echo "No Class Data!!";
            
        }else{
            
            $chartData = "";
            
            $zvs_table = "zvs_students_class_details";
            
            $chartData .= '"data":[';
            
            foreach($fetchClassDetails as $classValues){
                 
                $zvs_className = $classValues['schoolClassName']; $schoolClassCode =  $classValues['schoolClassCode']; 

                $classQuery = "SELECT * FROM " . $zvs_table . " WHERE studentClassCode ='".$schoolClassCode."' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();

                $executeClassQuery   = $this->Zf_AdoDB->Execute($classQuery);

                if (!$executeClassQuery){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    $classCount = $executeClassQuery->RecordCount();

                }
                
                $chartData .= '{  
                    "label":"'.$zvs_className.'",
                    "value":"'.$classCount.'",
                    "tooltext": "'.$classCount.' Students in '.$zvs_className.'"
                  },';
                
             
                 
            }
            
            $chartData .=']';  
            
            
            Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
            
        }
        
    }
    
    
    
    
    /**
     * This method is used render students blood group chart
     */
    public function AllStudentsByBloodPie($systemSchoolCode){
        
        
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
                                "captionFontSize": "11",
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
                                "labelDisplay": "rotate",
                                "slantLabels": "1",
                                "slicingDistance": "10",
                                "theme": "ocean"
                            }
                            
                        ';
        
        $zvs_table = "zvs_students_medical_details";


        $getBloodGroupABpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='AB+' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupABnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='AB-' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupApositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='A+' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupAnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='A-' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupBpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='B+' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupBnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='B-' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupOpositive = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='O+' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupOnegative = "SELECT * FROM " . $zvs_table . " WHERE studentBloodGroup ='O-' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getBloodGroupNotKnown = "SELECT * FROM " . $zvs_table . " WHERE isStudentBloodGroup ='No' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();


        $executeBloodGroupABpositive   = $this->Zf_AdoDB->Execute($getBloodGroupABpositive);
        $executeBloodGroupABnegative   = $this->Zf_AdoDB->Execute($getBloodGroupABnegative);
        $executeBloodGroupApositive   = $this->Zf_AdoDB->Execute($getBloodGroupApositive);
        $executeBloodGroupAnegative   = $this->Zf_AdoDB->Execute($getBloodGroupAnegative);
        $executeBloodGroupBpositive   = $this->Zf_AdoDB->Execute($getBloodGroupBpositive);
        $executeBloodGroupBnegative   = $this->Zf_AdoDB->Execute($getBloodGroupBnegative);
        $executeBloodGroupOpositive   = $this->Zf_AdoDB->Execute($getBloodGroupOpositive);
        $executeBloodGroupOnegative   = $this->Zf_AdoDB->Execute($getBloodGroupOnegative);
        $executeBloodGroupNotKnown   = $this->Zf_AdoDB->Execute($getBloodGroupNotKnown);

        if (!$executeBloodGroupABpositive || !$executeBloodGroupABnegative || !$executeBloodGroupApositive || !$executeBloodGroupAnegative || !$executeBloodGroupBpositive || !$executeBloodGroupBnegative || !$executeBloodGroupOpositive || !$executeBloodGroupOnegative || !$executeBloodGroupNotKnown){

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
            $NotKnownCount = $executeBloodGroupNotKnown->RecordCount();

        }
        
        
        //This is the actual chart data in JSON format
        $chartData = '
            
                "data":[  
                  {  
                    "label":"AB +ve",
                    "value":"'.$ABpositiveCount.'",
                    "tooltext": "Blood Group AB +ve: '.$ABpositiveCount.'"
                  },
                  {  
                    "label":"AB -ve",
                    "value":"'.$ABnegativeCount.'",
                    "tooltext": "Blood Group AB -ve: '.$ABnegativeCount.'"
                  },
                  {  
                    "label":"A +ve",
                    "value":"'.$ApositiveCount.'",
                    "tooltext": "Blood Group A +ve: '.$ApositiveCount.'"
                  },
                  {  
                    "label":"A -ve",
                    "value":"'.$AnegativeCount.'",
                    "tooltext": "Blood Group A -ve: '.$AnegativeCount.'"
                  },
                  {  
                    "label":"B +ve",
                    "value":"'.$BpositiveCount.'",
                    "tooltext": "Blood Group B +ve: '.$BpositiveCount.'"
                  },
                  {  
                    "label":"B -ve",
                    "value":"'.$BnegativeCount.'",
                    "tooltext": "Blood Group B -ve: '.$BnegativeCount.'"
                  },
                  {  
                    "label":"O +ve",
                    "value":"'.$OpositiveCount.'",
                    "tooltext": "Blood Group O +ve: '.$OpositiveCount.'"
                  },
                  {  
                    "label":"O -ve",
                    "value":"'.$OnegativeCount.'",
                    "tooltext": "Blood Group O -ve: '.$OnegativeCount.'"
                  },
                  {  
                    "label":"Not Known",
                    "value":"'.$NotKnownCount.'",
                    "tooltext": "Blood Group Not Known: '.$OnegativeCount.'"
                  },
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
        
    }
    
    
    
    
    /**
     * This method is used to render students guardian chart
     */
    public function AllStudentsByGuardianPie($systemSchoolCode){
        
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
                                "captionFontSize": "11",
                                "xAxisName": "Type of Guardians",
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


        $getParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Parent' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getAdoptiveParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Adoptive Parent' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getGrandParent = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Grandparent' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getUncleAunt = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Uncle or Aunt' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getCousin = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Cousin' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getNephewNiece = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Nephew or Niece' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getSponsor = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Sponsor' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getFamilyFriend = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Family Friend' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();
        $getOthers = "SELECT * FROM " . $zvs_table . " WHERE guardianRelation ='Others' AND systemSchoolCode = '".$systemSchoolCode."' "; //die();


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
                     "tooltext": "Total Adoptive Parents: '.$adoptiveParentCount.'"
                  },
                  {  
                     "label":"Grandparents",
                     "value":"'.$grandParentCount.'",
                     "tooltext": "Total Grandparents: '.$grandParentCount.'"
                  },
                  {  
                     "label":"Uncles/Aunts",
                     "value":"'.$uncleAuntCount.'",
                     "tooltext": "Total Uncles or Aunts: '.$uncleAuntCount.'"
                  },
                  {  
                     "label":"Cousins",
                     "value":"'.$cousinCount.'",
                     "tooltext": "Total Cousins: '.$cousinCount.'"
                  },
                  {  
                     "label":"Nephews/Nieces",
                     "value":"'.$nephewNieceCount.'",
                     "tooltext": "Total Nephews or Nieces: '.$nephewNieceCount.'"
                  },
                  {  
                     "label":"Sponsors",
                     "value":"'.$sponsorCount.'",
                     "tooltext": "Total Sponsors: '.$sponsorCount.'"
                  },
                  {  
                     "label":"Family Friends",
                     "value":"'.$familyFriendCount.'",
                     "tooltext": "Total Family Friends: '.$familyFriendCount.'"
                  },
                  {  
                     "label":"Others",
                     "value":"'.$othersCount.'",
                     "tooltext": "Total Others: '.$othersCount.'"
                  },
                  
                ]
                            
                    ';
        
        //Here we generate the actual chart
        Zf_GenerateCharts::zf_generate_chart($chartSettings, $chartProperties, $chartData);
       
        
    }
    
    
    
    
    /**
     * This method is essential in fetching all call details
     */
    private function fetchClassDetails($systemSchoolCode){
        
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
    
    
    
    
    
}

?>


