<script type="text/javascript" >

    var SchoolOptions = function(){
        
        //Here we process subject options.
        var subject_options = function ($absolute_path, $separator){
            
            //Hide the subject activation button
            $("#subjectActivateForm").hide();
            
            $('.activateAllSubjects').click(function(){
                
                $("#selectedSubjectForm").fadeOut(1000, function(){
                
                   //Show the subject activation button.
                   $("#subjectActivateForm").fadeIn(1000);

                });
                
                $('.subjectOptions').change(function(){
                    
                   //Hide the subject activation button
                   $("#subjectActivateForm").fadeOut(1000); 
                    
                   $("#activateAllSubjects").attr("checked", false);

                    var processSubjectsOption = $absolute_path + "main_school_admin" + $separator + "processSubjectOptions" + $separator;
                    var systemSubjectCode = $("#subjectOptions").val();

                    //alert(countryCode+"-"+processLocality);

                    $.ajax({
                        type: "POST",
                        url: processSubjectsOption,
                        data: {systemSubjectCode: systemSubjectCode},
                        cache: false,
                        success: function(html) {  
                           $("#selectedSubjectForm").fadeIn(4000, function(){
                               $("#selectedSubjectForm").html(html);
                           });
                        }
                    });   

                });
                
            });
            
            
            $('.subjectOptions').change(function(){
                
                $("#activateAllSubjects").attr("checked", false);
                
                var processSubjectsOption = $absolute_path + "main_school_admin" + $separator + "processSubjectOptions" + $separator;
                var systemSubjectCode = $("#subjectOptions").val();
                
                //alert(countryCode+"-"+processLocality);

                $.ajax({
                    type: "POST",
                    url: processSubjectsOption,
                    data: {systemSubjectCode: systemSubjectCode},
                    cache: false,
                    success: function(html) {  
                       $("#selectedSubjectForm").fadeIn(4000, function(){
                           $("#selectedSubjectForm").html(html);
                       });
                    }
                });   

            });
               
        }
        
        
        
        //Here we process exams options.
        var exam_options = function ($absolute_path, $separator){
            
            //Hide all the exam editing forms
            $("#editAllExamModesForm, #editSpecificExamModesForm, .examSubjectOptionError").hide();
            
            //If edit all exam modes is selected then a series of actions will happen.
            $("#allExamRadioButton").click(function(){

                $("#editAllExamModesForm").hide();

                var allExamModesButton = $('#allExamRadioButton').val(); //contains "editAllExamModes"
                var subjectValueAllExamModes = subjectVal();//Returns the value id of the selected subject from the dropdown option.
                
                //What happens if the "subjectValueAllExamModes" returns empty or value.
                if(subjectValueAllExamModes === ""){
                    
                    $("#editAllExamModesForm").hide();

                    $(".examSubjectOptionError").fadeIn(1000, function(){

                        $("#allExamRadioButton").attr("checked", false);

                    });
                    
                }else{
                    
                    //Ensure that the form for editing a specific exam mode is still hidden.
                    $("#editSpecificExamModesForm").hide();

                    //Fade in the all exam mode activation code
                    $("#editAllExamModesForm, form#activateAllExamModesForm").fadeIn(1500, function(){
                        
                        var processSubjectsOption = $absolute_path + "main_school_admin" + $separator + "ProcessSubjectExamsOptions" + $separator + "allExamModesActivate";

                        $.ajax({
                            type: "POST",
                            url: processSubjectsOption,
                            data: {systemSubjectCode: subjectValueAllExamModes},
                            cache: false,
                            success: function(html) {  
                               $("form#activateAllExamModesForm").fadeIn(500, function(){
                                   $("form#activateAllExamModesForm").html(html); //You can use "this"
                               });
                            }
                        }); 

                    });
                    
                }
                
            });
            
            
            //If edit specific exam mode is selected then the following series of actions will happen.
            $("#specificExamRadioButton").click(function(){
                
                $("#editSpecificExamModesForm, #editAllExamModesForm").hide();

                var subjectValueSpecificExamMode = subjectVal();//Returns the value id of the selected subject from the dropdown option.
                
                if(subjectValueSpecificExamMode === ""){

                    $(".examSubjectOptionError").fadeIn(1000, function(){

                        $("#specificExamRadioButton").attr("checked", false);

                    });

                }else{
                    
                    //Ensure that all the other forms are hidden
                    $("#editAllExamModesForm, form#activateAllExamModesForm,#editSpecificExamModesForm,.specificExamModeForm").hide();
                    var subjectValueSpecificExamMode = subjectVal();
                    
                    //Fade in the specific exam mode editing form
                    $("#editSpecificExamModesForm").fadeIn(1500, function(){
                        
                        var processSubjectsOption = $absolute_path + "main_school_admin" + $separator + "ProcessSubjectExamsOptions" + $separator + "selectExamModeDropdown";

                        $.ajax({
                            type: "POST",
                            url: processSubjectsOption,
                            data: {systemSubjectCode: subjectValueSpecificExamMode},
                            cache: false,
                            success: function(html) {  
                               $("#selectExamModeOptions").fadeIn(500, function(){
                                   $("#selectExamModeOptions").html(html);
                               });
                            }
                        });
                        
                    });
                    
                    $("#selectExamModeOptions").change(function(){
                        
                        var systemExamCode = $('#selectExamModeOptions').val();
                        
                        var processExamModeOption = $absolute_path + "main_school_admin" + $separator + "ProcessSubjectExamsOptions" + $separator + "selectExamModeOptions";

                        $.ajax({
                            type: "POST",
                            url: processExamModeOption,
                            data: {systemExamCode: systemExamCode},
                            cache: false,
                            success: function(html) {  
                               $("#specificExamModeForm").fadeIn(500, function(){
                                   $("#specificExamModeForm").html(html);
                               });
                            }
                        });
                        
                    });
                    
                    
                }
                
            });
            
            //This function pick the value of the subject option form.
            function subjectVal(){

                //This is the series of events when the subject options dropdown changes its value.
                $(".examSubjectOptions").change(function(){
                    
                    $(".examSubjectOptionError, #editSpecificExamModesForm, .specificExamModeForm").hide();
                    $("#allExamRadioButton, #specificExamRadioButton").attr("checked", false);

                });

                var subjectVal = $('#examSubjectOptions').val();
                
                if(subjectVal === ""){

                    $("#editAllExamModesForm, #editSpecificExamModesForm, .examSubjectOptionError").hide();
                    $("#allExamRadioButton, #specificExamRadioButton").attr("checked", false);

                }
                
                return subjectVal;

            }
            
               
        }
        
        
        //Here we process grade options.
        var grade_options = function ($absolute_path, $separator){
            
            //Hide the subject activation button
            $("#selectedGradeForm").hide();
            
            $('.gradeOptions').change(function(){
                
                var processGradeOption = $absolute_path + "main_school_admin" + $separator + "processGradeOptions" + $separator;
                var systemGradeCode = $("#gradeOptions").val();
                
                //alert(systemGradeCode); die();

                $.ajax({
                    type: "POST",
                    url: processGradeOption,
                    data: {systemGradeCode: systemGradeCode},
                    cache: false,
                    success: function(html) {  
                       $("#selectedGradeForm").fadeIn(1500, function(){
                           $("#selectedGradeForm").html(html);
                       });
                    }
                });   

            });
               
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "manage_school_subjects"){

                    subject_options($absolute_path, $separator);

                }
                if($current_view === "manage_school_exams"){

                    exam_options($absolute_path, $separator);

                }
                if($current_view === "manage_school_marksheet"){

                    grade_options($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


