/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var StudentModule = function(){

    //Here we process all fee collection details javascript and ajax
    var student_profile = function ($absolute_path, $separator){
        
        $('#studentProfileContainer, #guardianProfileContainer').hide();
        
        
        //Process the streams within the selected class
        $('.studentClassCode').change(function(){

            var processStreams = $absolute_path + "student_module" + $separator + "StudentInformation" + $separator + "process_streams";
            var studentClassCode = $("#studentClassCode").val();
            
            //alert(studentClassCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStreams,
                data: {studentClassCode: studentClassCode},
                cache: false,
                success: function(html) {
                   $("#studentStreamCode").html(html);
                }
            });

        });
        
        
        
        
        //Process the streams within the selected class
        $('.studentStreamCode').change(function(){

            var processStudentsList = $absolute_path + "student_module" + $separator + "StudentInformation" + $separator + "process_students_list";
            var studentStreamCode = $("#studentStreamCode").val();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStudentsList,
                data: {studentStreamCode: studentStreamCode},
                cache: false,
                success: function(html) {
                   $("#studentsListDetails").html(html);
                }
            });

        });
        
        
        //Process the streams within the selected class
        $('.studentsListDetails').change(function(){
            
            //This process student profile data
            $('#studentProfileContainer').fadeIn(1000, function(){
                
                var identificationCode = $("#studentsListDetails").val();
                var zvs_connect = "[`^`]";
                
                $('#studentProfileDetails').show();
                
                //Process Student Details
                var processStudentDetails = $absolute_path + "student_module" + $separator + "StudentProfile" + $separator + "process_student_profile";
                var studentIdentificationCode = identificationCode;
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processStudentDetails,
                    data: {studentIdentificationCode: studentIdentificationCode},
                    cache: false,
                    success: function(html) {
                       $("#studentProfileDetails").html(html);
                    }
                });
            });
            
            
            //This process guardian profile data
            $('#guardianProfileContainer').fadeIn(1000, function(){
                
                var identificationCode = $("#studentsListDetails").val();
                var zvs_connect = "[`^`]";
                
                $('#guardianProfileDetails').show();
            
                //Process Guardian Details
                var processGuardianDetails = $absolute_path + "student_module" + $separator + "StudentProfile" + $separator + "process_student_guardian";
                var studentIdentificationCode = identificationCode;
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processGuardianDetails,
                    data: {studentIdentificationCode: studentIdentificationCode},
                    cache: false,
                    success: function(html) {
                       $("#guardianProfileDetails").html(html);
                    }
                });
                
            });
            
        });
        
        
        
    };

    
    

   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "student_guardian_profile"){
                
                student_profile($absolute_path, $separator);
                
            }

        }

    }; 


}();


