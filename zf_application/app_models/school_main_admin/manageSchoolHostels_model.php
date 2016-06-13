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

class manageSchoolHostels_Model extends Zf_Model {
    
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
    public function fetchHostelDetails($identificationCode){
        
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         $zvs_hostelGridView = '';
         
         //Here we fetch and return all class details.
         $zvs_hostelDetails = $this->zvs_fetchHostelDetails($systemSchoolCode);
         
         
         if($zvs_hostelDetails == 0){
             
             $zvs_hostelGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>Hostels / Dormitories Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no hostels/dormitories yet! You need to add atleast one hostel/dorm to have a hostel overview.
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
            



            $zvs_hostelGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="zvs-content-titles">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <h3 style="padding-left: 10px !important;">Hostels/Dormitories</h3>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                     <div class="table-responsive">
                                                         <table class="table table-striped table-hover">
                                                             <thead>
                                                                 <tr>
                                                                     <th  style="width: 35%;">Hostel Name</th><th style="width: 15%;">Hostel Gender</th><th style="width: 15%;">Hostel Capacity</th><th style="width: 15%;">Hostel Occupancy</th><th style="width: 15%;">Hostel Availability</th><th style="width: 5%;">Details</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>';

                                                               foreach($zvs_hostelDetails as $hostelValues){

                                                                    $zvs_hostelName = $hostelValues['schoolHostelName']; $schoolHostelCode =  $hostelValues['schoolHostelCode'];
                                                                    $hostelGender = $hostelValues['schoolHostelGender']; $hostelCapacity = $hostelValues['schoolHostelCapacity']; 
                                                                    $hostelOccupancy = $hostelValues['schoolHostelOccupancy']; $hostelAvailability = $hostelCapacity - $hostelOccupancy;
                                                                    
                                                                    $zvs_hostelGridView .='<tr><td>'.$zvs_hostelName.'</td><td style="text-align:center !important;">'.$hostelGender.'</td><td style="text-align:center !important;">'.$hostelCapacity.'</td><td style="text-align:center !important;">'.$hostelOccupancy.'</td><td style="text-align:center !important;">'.$hostelAvailability.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_hostel_details'.DS.  Zf_SecureData::zf_encode_url($schoolHostelCode).' " title="View '.$zvs_hostelName.'" ><i class="fa fa-list"></i></a></td></tr>';

                                                               }

                                       $zvs_hostelGridView .='</tbody>
                                                         </table>
                                                     </div>
                                                </div>
                                           </div>
                                           <div class="zvs-content-footer">
                                                <div class="row">';

                                                    $zvs_hostelGridView .= $this->zvs_fetchHostelInnerDetails($systemSchoolCode);  

                         $zvs_hostelGridView .='</div>
                                           </div>
                                   ';



            $zvs_hostelGridView .='     </div>          
                                   </div>';
             
         }
         
         echo $zvs_hostelGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns hostel details for all hostels in the school 
     */
    private function zvs_fetchHostelDetails($systemSchoolCode){
        
        $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        $fetchSchoolHostels = Zf_QueryGenerator::BuildSQLSelect('zvs_school_hostels', $zvs_sqlValue);
        
        $zf_executeFetchSchoolHostels = $this->Zf_AdoDB->Execute($fetchSchoolHostels);

        if(!$zf_executeFetchSchoolHostels){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolHostels->RecordCount() > 0){

                while(!$zf_executeFetchSchoolHostels->EOF){
                    
                    $results = $zf_executeFetchSchoolHostels->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    /**
     * This method checks and counts, then returns all inner hostel details for all hostels in the school 
     */
    private function zvs_fetchHostelInnerDetails($systemSchoolCode){
        
        $capacityCount = $this->zvs_hostelCapacityCount($systemSchoolCode); 
        $occupancyCount = $this->zvs_hostelOccupancyCount($systemSchoolCode); 
        $availabilityCount = $capacityCount - $occupancyCount;
        
        $hostelInnerDetails = '<div class="col-md-4 col-sm-4" style="text-align: center !important;">Capacity: '.$capacityCount.'</div><div class="col-md-4 col-sm-4"  style="text-align: center !important;">Occupancy: '.$occupancyCount.'</div><div class="col-md-4 col-sm-4" style="text-align: center !important;">Availability: '.$availabilityCount.'</div>';
        
        return $hostelInnerDetails;
        
    }
    
    
    
    /**
     * 
     */
    private function zvs_hostelCapacityCount($systemSchoolCode){
        
        $zvs_table = "zvs_school_hostels";
        
        $zvs_query =  "SELECT SUM(schoolHostelCapacity) AS hostelCapacity FROM ". $zvs_table . " WHERE systemSchoolCode = '$systemSchoolCode' "; //die
        
        $zf_executeFetchSchoolHostels = $this->Zf_AdoDB->Execute($zvs_query);

        if(!$zf_executeFetchSchoolHostels){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $hostelCapacity = $zf_executeFetchSchoolHostels->fields['hostelCapacity'];
            
            if($hostelCapacity > 0){
                
                return $hostelCapacity;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    
    /**
     * 
     */
    private function zvs_hostelOccupancyCount($systemSchoolCode){
        
        $zvs_table = "zvs_school_hostels";
        
        $zvs_query =  "SELECT SUM(schoolHostelOccupancy) AS hostelOccupancy FROM ". $zvs_table . " WHERE systemSchoolCode = '$systemSchoolCode' "; //die
        
        $zf_executeFetchSchoolHostels = $this->Zf_AdoDB->Execute($zvs_query);

        if(!$zf_executeFetchSchoolHostels){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            $hostelOccupancy = $zf_executeFetchSchoolHostels->fields['hostelOccupancy'];
            
            if($hostelOccupancy > 0){
                
                return $hostelOccupancy;
                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    
    
    
    /**
     * THESE METHODS ARE EXTERNAL ACCESSORS TO THE EXTERNAL VIEWS OF HOSTELS. THEY CAN ALSO BE USED BY OTHER METHODS
     * TO ACCESS THE SAME DETAILS
     */
    
    
    /**
     * This method checks and returns data for a specific target department. 
     */
    public function zvs_fetchHostelOuterDetails($schoolHostelCode){
        
        $zvs_sqlValue["schoolHostelCode"] = Zf_QueryGenerator::SQLValue($schoolHostelCode);
        
        $fetchSchoolHostels = Zf_QueryGenerator::BuildSQLSelect('zvs_school_hostels', $zvs_sqlValue);
        
        $zf_executeFetchSchoolHostels = $this->Zf_AdoDB->Execute($fetchSchoolHostels);

        if(!$zf_executeFetchSchoolHostels){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolHostels->RecordCount() > 0){

                while(!$zf_executeFetchSchoolHostels->EOF){
                    
                    $results = $zf_executeFetchSchoolHostels->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
