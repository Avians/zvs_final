<script type="text/javascript" >


    //This variable processes school locations
    var StudentFormData = function(){
        
        //This function processes all student registration form data.
        var studentData = function ($absolute_path, $separator){
            
            //Process the location of a student based on the selected country
            $('.studentCountry').change(function(){
                
                var processLocality = $absolute_path + "student_module" + $separator + "studentInformation" + $separator + "process_locality";
                var studentCountryCode = $("#studentCountry").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: studentCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#studentLocality").html(html);
                    }
                });

            });
            
            
            //Process the location of a guardian based on the selected country
            $('.guardianCountry').change(function(){
                
                var processLocality = $absolute_path + "student_module" + $separator + "studentInformation" + $separator + "process_locality";
                var guardianCountryCode = $("#guardianCountry").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: guardianCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#guardianLocality").html(html);
                    }
                });

            });
            
            
            
            //Here we hide and show explanation box for student disability.
            $(".studentDisability").hide();
            $("#studentDisableYes").click(function(){
                
                $(".studentDisability").fadeIn(1000);
                
            })
            $("#studentDisableNo").click(function(){
                
                $(".studentDisability").fadeOut(1000, function(){
                    $(".studentAllergic").hide();
                });
                
            })
            
            //Here we hide and show explanation box for student medication.
            $(".studentMedication").hide();
            $("#studentMedicatedYes").click(function(){
                
                $(".studentMedication").fadeIn(1000);
                
            })
            $("#studentMedicatedNo").click(function(){
                
                $(".studentMedication").fadeOut(1000, function(){
                    $(".studentMedication").hide();
                });
                
            })
            
            
            //Here we hide and show explanation box for student allergy conditions.
            $(".studentAllergic").hide();
            $("#studentAllergicYes").click(function(){
                
                $(".studentAllergic").fadeIn(1000);
                
            })
            $("#studentAllergicNo").click(function(){
                
                $(".studentAllergic").fadeOut(1000, function(){
                    $(".studentAllergic").hide();
                });
                
            })
            
            
            //Here we hide and show explanation box for student treatment conditions.
            $(".studentTreatment").hide();
            $("#studentTreatmentYes").click(function(){
                
                $(".studentTreatment").fadeIn(1000);
                
            })
            $("#studentTreatmentNo").click(function(){
                
                $(".studentTreatment").fadeOut(1000, function(){
                    $(".studentTreatment").hide();
                });
                
            })
               
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_student"){

                    studentData($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


