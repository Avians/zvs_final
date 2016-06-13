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

class manageSchoolRoles_Model extends Zf_Model {
    
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
    public function fetchRolesDetails($identificationCode){
         
         $systemSchoolCode = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode)[2];
         
         
         $zvs_roleGridView = '';
         
         //Here we fetch and return all role details.
         $zvs_roleDetails = $this->zvs_fetchRolesDetails($systemSchoolCode);
         
         
         if($zvs_roleDetails == 0){
             
             $zvs_roleGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3>School Roles Overview Warning!!</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks zvs-table-blocks zvs-content-warnings" style="text-align: center !important; padding-top: 12% !important;">
                                                <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                <span class="content-view-errors" >
                                                    &nbsp;There are no school roles yet! You need to add atleast one school role to have an overview.
                                                </span>
                                            </div>
                                        </div>
                                    </div>          
                                </div>';
             
         }else{
             
            



            $zvs_roleGridView .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="zvs-content-titles">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <h3 style="padding-left: 10px !important;">Available School Roles</h3>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                     <div class="table-responsive">
                                                         <table class="table table-striped table-hover">
                                                             <thead>
                                                                 <tr>
                                                                     <th  style="width: 60%;">Role Name</th><th style="width: 15%;">Date Created</th><th style="width: 15%; text-align:center !important;">Role Status</th><th style="width: 10%;">Details</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>';
                                                               foreach($zvs_roleDetails as $roleValues){

                                                                    $zvs_roleName = $roleValues['schoolRoleName']; $schoolRoleCode =  $roleValues['schoolRoleCode'];
                                                                    $dateCreated = $roleValues['dateCreated']; $roleStatus = ($roleValues['roleStatus'] == 1 ? 'Active' : 'Inactive');



                                                                    $zvs_roleGridView .='<tr><td>'.$zvs_roleName.'</td><td>'.$dateCreated.'</td><td style="text-align:center !important;">'.$roleStatus.'</td><td><a href=" '.ZF_ROOT_PATH.$this->zvs_controller.DS.'view_role_details'.DS.Zf_SecureData::zf_encode_url($identificationCode.ZVSS_CONNECT.$schoolRoleCode).' " title="View '.$zvs_roleName.'" ><i class="fa fa-list"></i></a></td></tr>';


                                                               }

                                       $zvs_roleGridView .='</tbody>
                                                         </table>
                                                     </div>
                                                </div>
                                           </div>
                                           <div class="zvs-content-footer">
                                                <div class="row">';

                                                    //$zvs_roleGridView .= $this->zvs_fetchHostelInnerDetails($systemSchoolCode);  

                         $zvs_roleGridView .='</div>
                                           </div>
                                   ';



            $zvs_roleGridView .='     </div>          
                                   </div>';
             
         }
         
         echo $zvs_roleGridView;
         
        
    }
    
    
    
    
    /**
     * This method checks and counts, then returns hostel details for all hostels in the school 
     */
    public function zvs_fetchRolesDetails($systemSchoolCode = FALSE, $schoolRoleCode = FALSE){
        
        if($schoolRoleCode == FALSE){
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            
        }else{
            
            $zvs_sqlValue["systemSchoolCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
            $zvs_sqlValue["schoolRoleCode"] = Zf_QueryGenerator::SQLValue($schoolRoleCode);
            
        }
        
        
        $fetchSchoolRoles = Zf_QueryGenerator::BuildSQLSelect('zvs_school_roles', $zvs_sqlValue);
        
        $zf_executeFetchSchoolRoles = $this->Zf_AdoDB->Execute($fetchSchoolRoles);

        if(!$zf_executeFetchSchoolRoles){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolRoles->RecordCount() > 0){

                while(!$zf_executeFetchSchoolRoles->EOF){
                    
                    $results = $zf_executeFetchSchoolRoles->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
}

?>
