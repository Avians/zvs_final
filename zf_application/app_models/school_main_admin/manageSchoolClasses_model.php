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

class manageSchoolClasses_Model extends Zf_Model {
    
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
     * This method returns all class details for a given school
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
                 
                 
                 
                 //Here we fetch and return all stream details.
                 $zvs_streamDetails = $this->zvs_fetchStreamDetails($schoolClassCode);
             
            $zvs_classGridView .='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                   <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9">
                                                <h3 style="padding-left: 10px !important;">'.$zvs_className.'</h3>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3">
                                                <h3 style="text-align: right !important; padding-right: 10px !important;"><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_class_details'.DS. Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolClassCode).' " title="View '.$zvs_className.'" ><i class="fa fa-list"></i></a></h3>
                                            </div>
                                        </div>';

                                       if($zvs_streamDetails == 0){

                                           $zvs_classGridView .='<div class="portlet-body">
                                                                    <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 13% !important; height: 380px !important;">
                                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 25px !important;"></i><br><br>
                                                                        <span class="content-view-errors" >
                                                                            &nbsp;There are no streams in '.strtolower($zvs_className).' yet! <br>You need to add atleast one stream to have an overview.
                                                                        </span>
                                                                    </div>
                                                                </div>';

                                       }else{
                                           
                                           
                                                $zvs_classGridView .='<div class="portlet-body">
                                                                             <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                                                  <div class="table-responsive">
                                                                                      <table class="table table-striped table-hover">
                                                                                          <thead>
                                                                                              <tr>
                                                                                                  <th  style="width: 50%;">Stream Name</th><th style="width: 10%;">Capacity</th><th style="width: 10%;">Occupancy</th><th style="width: 10%;">Availability</th>
                                                                                              </tr>
                                                                                          </thead>
                                                                                          <tbody>';
                                                
                                                                                            foreach ($zvs_streamDetails as $streamValues) {

                                                                                                $streamName = $streamValues['schoolStreamName']; $streamCapacity = $streamValues['schoolStreamCapacity']; $streamOccupancy = $streamValues['schoolStreamOccupancy']; $streamAvailability = $streamCapacity - $streamOccupancy;
                                                                                                $streamCode = $streamValues['schoolStreamCode'];
                                                                                                
                                                                                                $zvs_classGridView .='<tr><td>'.$streamName.'</td><td style="text-align:center !important;">'.$streamCapacity.'</td><td style="text-align:center !important;">'.$streamOccupancy.'</td><td style="text-align:center !important;">'.$streamAvailability.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_stream_details'.DS.  Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$streamCode).' " title="View '.$zvs_className.' '.$streamName.'" ><i class="fa fa-list"></i></a></td></tr>';
                                                                                                
                                                                                            }

                                                                    $zvs_classGridView .='</tbody>
                                                                                      </table>
                                                                                  </div>
                                                                             </div>
                                                                        </div>
                                                                        <div class="zvs-content-footer">
                                                                            <div class="row">';
                                                                    
                                                                                $zvs_classGridView .= $this->zvs_fetchClassInnerDetails($schoolClassCode);  
                                                                                
                                                     $zvs_classGridView .=' </div>
                                                                        </div>';

                                       }
                                        
            $zvs_classGridView .='</div>          
                                </div>';
             
             }
             
         }
         
         echo $zvs_classGridView;
         
        
    }
    
    
    
    
    /**
     * This method returns check if classes exist so a to show the new stream form
     */
    public function confirmClassPresence($identificationCode){
        
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];

         //Here we fetch and return all class details.
         $zvs_classDetails = $this->zvs_fetchClassDetails($systemSchoolCode);
         
         return $zvs_classDetails;
        
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
     * This method checks and counts, then returns all inner class details for all classess in the school 
     */
    private function zvs_fetchClassInnerDetails($schoolClassCode){
        
        $capacityCount = $this->zvs_classCapacityCount($schoolClassCode); 
        $occupancyCount = $this->zvs_classOccupancyCount($schoolClassCode); 
        $availabilityCount = $capacityCount - $occupancyCount;
        
        $classInnerDetails = '<div class="col-md-4 col-sm-4">Capacity: '.$capacityCount.'</div><div class="col-md-4 col-sm-4">Occupancy: '.$occupancyCount.'</div><div class="col-md-4 col-sm-4">Availability: '.$availabilityCount.'</div>';
        
        return $classInnerDetails;
        
    }
    
    
    
    
    /**
     * 
     */
    public function zvs_classCapacityCount($schoolClassCode){
        
        $zvs_table = "zvs_school_streams";
        
        $zvs_query =  "SELECT SUM(schoolStreamCapacity) AS streamCapacity FROM ". $zvs_table . " WHERE schoolClassCode = '$schoolClassCode' "; //die
        
        $zf_executeFetchSchoolStreams = $this->Zf_AdoDB->Execute($zvs_query);

        if(!$zf_executeFetchSchoolStreams){
            
             echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $classCapacity = $zf_executeFetchSchoolStreams->fields['streamCapacity'];
            
            if($classCapacity > 0){
                
                return $classCapacity;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * 
     */
    public function zvs_classOccupancyCount($schoolClassCode){
        
        $zvs_table = "zvs_school_streams";
        
        $zvs_query =  "SELECT SUM(schoolStreamOccupancy) AS streamOccupancy FROM ". $zvs_table . " WHERE schoolClassCode = '$schoolClassCode' "; //die
        
        $zf_executeFetchSchoolStreams = $this->Zf_AdoDB->Execute($zvs_query);

        if(!$zf_executeFetchSchoolStreams){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $classOccupancy = $zf_executeFetchSchoolStreams->fields['streamOccupancy'];
            
            if($classOccupancy > 0){
                
                return $classOccupancy;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * 
     */
    public function zvs_classStreamsCount($schoolClassCode){
      
        $zvs_table = "zvs_school_streams";
        
        $zvs_column[] = "schoolStreamCode";
        $zvs_value['schoolClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $classStreams = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_value, $zvs_column);
        
        $zvs_executeClassStreams = $this->Zf_AdoDB->Execute($classStreams);
        
        if (!$zvs_executeClassStreams){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $zvs_classStreamCount = $zvs_executeClassStreams->RecordCount();
            
        }
        
        return $zvs_classStreamCount;
        
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
     * THESE METHODS ARE EXTERNAL ACCESSORS TO THE EXTERNAL VIEWS OF CLASSESS AND STREAMS. THEY CAN ALSO BE USED BY OTHER METHODS
     * TO ACCESS THE SAME DETAILS
     */
    
    
    /**
     * This method checks and returns data for a specific target class. 
     */
    public function zvs_fetchClassOuterDetails($schoolClassCode){
        
        $zvs_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
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
     * This method checks and returns data for a specific target class. 
     */
    public function zvs_fetchStreamOuterDetails($classStreamCode){
        
        $zvs_sqlValue["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($classStreamCode);
        
        $fetchClassStream = Zf_QueryGenerator::BuildSQLSelect('zvs_school_streams', $zvs_sqlValue);
        
        $zf_executeFetchClassStream = $this->Zf_AdoDB->Execute($fetchClassStream);

        if(!$zf_executeFetchClassStream){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchClassStream->RecordCount() > 0){

                while(!$zf_executeFetchClassStream->EOF){
                    
                    $results = $zf_executeFetchClassStream->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
