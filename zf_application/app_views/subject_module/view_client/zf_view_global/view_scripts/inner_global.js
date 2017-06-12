/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var SubjectModule = function(){

    //Here we process all the new budget creation details javascript and ajax
    var subjectSetup = function ($absolute_path, $separator){
        
        //Global Model variables
        var targetController = "subject_module";
        var targetAction = "subjects_Teacher_Process";
        
        //Process the staff members who belong to the selected role when the role changes
        $('#schoolRoleCode').change(function(){

            var processSchoolRoleCode = $absolute_path + targetController + $separator + targetAction + $separator + "process_subjects_teacher";
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

            if($current_view === "subject_setup"){

                subjectSetup($absolute_path, $separator);

            }

        }

    }; 


}();


