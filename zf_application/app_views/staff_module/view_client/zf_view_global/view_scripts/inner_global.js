/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var StaffModule = function(){

    //Here we process all fee collection details javascript and ajax
    var staff_profile = function ($absolute_path, $separator){
        
        $('#staffProfileContainer, #relatedDetailsContainer').hide();
        
        
        //Global Model variables
        var targetController = "staff_module";
        var targetAction = "ProcessStaffInformation";
         
        $('#schoolRoleCode').change(function(){
            
            var processSchoolRoleCode = $absolute_path + targetController + $separator + targetAction + $separator + "process_staff_list";
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
        
        
        //Process the details for the selected staff
        $('.staffIdentificationCode').change(function(){
            
            //This process student profile data
            $('#staffProfileContainer, #relatedDetailsContainer').fadeIn(1000, function(){
                
                var identificationCode = $("#staffIdentificationCode").val();
                
                $('#staffProfileDetails, #relatedStaffDetails').show();
                
                //alert(identificationCode); die();
                
                //Process Student Details
                var processStaffDetails = $absolute_path + targetController + $separator + targetAction + $separator + "process_staff_profile";
                var staffIdentificationCode = identificationCode;
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processStaffDetails,
                    data: {staffIdentificationCode: staffIdentificationCode},
                    cache: false,
                    success: function(html) {
                       $("#staffProfileDetails").html(html);
                    }
                });
            });
            
        });
        
        
        
    };

    
    

   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "staff_profile"){
                
                staff_profile($absolute_path, $separator);
                
            }

        }

    }; 


}();


