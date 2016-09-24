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
            paletteColors='7FC5EF, 21B4E2, 0F4E74,ffb848,28b779' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
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
            "chartType"         => "Pie2D",
            "chartId"           => "customerGender",
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
    public function AllStudentsByClassPie($systemSchoolCode = NULL){
        
        echo "We are about to show students class"; 
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function AllStudentsByBloodPie($systemSchoolCode = NULL){
        
        echo "We are about to show students blood"; 
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function AllStudentsByGuardianPie($systemSchoolCode = NULL){
        
        echo "We are about to show students guardian"; 
        
    }
    
    
    
    
    
}

?>


