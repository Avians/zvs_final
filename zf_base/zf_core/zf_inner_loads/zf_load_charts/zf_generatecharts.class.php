<?php

/**
 * -----------------------------------------------------------------------------
 * THIS CLASS FILE IS ESSENTIAL FOR LOADING THE CHARTS THAT HAVE BEEN GENERATED
 * USING THE FUSIONCHARTS PLUGIN.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  25th/December/2013  Time: 21:40 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */

class Zf_GenerateCharts{
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS THE CLASS CONSTRUCTOR, IT RUNS BY DEFAULT WHENEVER THE CLASS IS
     * INITIALISED.
     * -------------------------------------------------------------------------
     * 
     */
    public function __construct() {
        
        parent::__construct();
            
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR GENERATING A CHART GIVEN A FEW 
     * PARAMETORS.
     * -------------------------------------------------------------------------
     */
    public static function zf_generate_chart($chartSettings, $chartProperties, $chartData){
        
        $chartType = $chartSettings["ChartType"];
        $chartId = $chartSettings["ChartID"];
        $chartWidth = $chartSettings["ChartWidth"];
        $chartHeight = $chartSettings["ChartHeight"];
        $chartContainer = $chartSettings["ChartContainer"];
        $chartDataFormat = $chartSettings["ChartDataFormat"];
     


        
        @require_once ZF_PLUGINS.'zf_fusion_charts'.DS.'fusioncharts_php'.DS.'fusioncharts.php';
       
        //$zf_charts = new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data");
        $zf_charts = new FusionCharts($chartType, $chartId, $chartWidth, $chartHeight, $chartContainer, $chartDataFormat, "{".$chartProperties." ,".$chartData."}");
       
        // Render the chart
        $zf_charts->render();

    }

    
}

?>