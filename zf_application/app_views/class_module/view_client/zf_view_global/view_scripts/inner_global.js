/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var ClassModule = function(){

    //Here we process all fee collection details javascript and ajax
    var class_register = function ($absolute_path, $separator){
        
        $('#attendanceListContainer').hide();
        
        //Global Model variables
        var targetController = "class_module";
        var targetAction = "ProcessClassAttendance";
        
        //Process the streams within the selected class
        $('.schoolClassCode').change(function(){
            
            //This hides the student list every time the class changes
            $('#attendanceListContainer').hide();

            var processStreams = $absolute_path + targetController + $separator + targetAction + $separator + "process_streams";
            var schoolClassCode = $("#schoolClassCode").val();
            
            //alert(schoolClassCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStreams,
                data: {schoolClassCode: schoolClassCode},
                cache: false,
                success: function(html) {
                   $("#classStreamCode").html(html);
                }
            });

        });
        
        
        //Process the streams within the selected class
        $('.classStreamCode, .attendanceDate').change(function(){
            
            //Show the student list everytime the stream changes
            $('#attendanceListContainer').fadeIn(1500);

            var processStudents = $absolute_path + targetController + $separator + targetAction + $separator + "process_students";
            var classStreamCode = $("#classStreamCode").val();
            var attendanceDate = $("#attendanceDate").val();
            
            var attendanceSheetValues = classStreamCode+"[`^`]"+attendanceDate ;
            
            //alert(classStreamCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStudents,
                data: {attendanceSheetValues : attendanceSheetValues},
                cache: false,
                success: function(html) {
                   $("#classListDetails").html(html);
                }
            });

        });
        
        
    };

    
   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "class_register"){
                
                class_register($absolute_path, $separator);
                
            }

        }

    }; 


}();


