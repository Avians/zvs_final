<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Model which is responsible responsible for handling all |
 * |  logic that is related to registration of a new financial year in |
 * |  the school                                                       |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class mainDashboard_Model extends Zf_Model {
    

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
    * Here we load school map
    */
    public function loadSchoolLocationMap($identificationCode){
        
        //Here we load sysytem school code what is useful in getting school specific details
        $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
        
        //An instance of the ZF_MAPBUILDER CLASS.
        $zf_map = new Zf_MapBuilder();
        
        // Set API key
        $zf_map->setApiKey('AIzaSyB230QxSetZoJiM9noon7FiAQXbc-HPSLU');
        
        // Set map's center position by latitude and longitude coordinates. 
        $zf_map->setCenter(-1.3001,36.7400);

        // Set the default map type.
        $zf_map->setMapTypeId(Zf_MapBuilder::MAP_TYPE_ID_ROADMAP);

        // Set width and height of the map.
        $zf_map->setSize(940, 390);

        // Set default zoom level.
        $zf_map->setZoom(14);

        // Make zoom control compact.
        $zf_map->setZoomControlStyle(Zf_MapBuilder::ZOOM_CONTROL_STYLE_DEFAULT);

        //Add a map marker
        $zf_map->addMarker(-1.3001, 36.7278, array(
            "title" => "School in Nairobi",
            "html" => '<div style="width: 120px; height: 160px;">School Name: School in Nairobi</div><b></b>', 
            "infoCloseOthers" => true
        ));
        
        // Display the map.
        $zf_map->show();
        
    }
    
    
}

?>
