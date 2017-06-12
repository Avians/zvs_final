/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var Transport_Module = function(){

    //Here we process all transport zones javascript and ajax
    var schoolTransportVehicles = function($absolute_path, $separator){
        
        //Global Model variables
        var targetController = "transport_module";
        var targetAction = "transport_Setup_Process";
         
        $('#transportZoneCodeTransportCost').change(function(){
            
            var processTransportRoutes = $absolute_path + targetController + $separator + targetAction + $separator + "process_transport_routes";
            var transportZoneCode = $('#transportZoneCodeTransportCost').val();
            
            //alert(transportZoneCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processTransportRoutes ,
                data: {transportZoneCode: transportZoneCode},
                cache: false,
                success: function(html) {
                   $("#transportRouteCodeTransportCost").html(html);
                }
            });

        });
        
    };

    //Here we process all transport drivers javascript and ajax
    var schoolTransportDrivers = function($absolute_path, $separator){
        
        //Global Model variables
        var targetController = "transport_module";
        var targetAction = "transport_Drivers_Process";
         
        $('#schoolRoleCode').change(function(){
            
            var processSchoolRoleCode = $absolute_path + targetController + $separator + targetAction + $separator + "process_drivers";
            var schoolRoleCode = $('#schoolRoleCode').val();
            
            //alert(schoolRoleCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processSchoolRoleCode ,
                data: {schoolRoleCode: schoolRoleCode},
                cache: false,
                success: function(html) {
                   $("#staffIdentificationCode").html(html);
                }
            });

        });
        
    };


   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "transport_vehicles"){
                
                schoolTransportVehicles($absolute_path, $separator);
                
            }else if($current_view === "assign_drivers"){
                
                schoolTransportDrivers($absolute_path, $separator);
                
            }

        }

    }; 


}();


