<script type="text/javascript" >


    //This variable processes school locations
    var StaffFormData = function(){
        
        //This function processes all staff registration form data.
        var staffData = function ($absolute_path, $separator){
            
            //Process the location of a staff based on the selected country
            $('.staffCountry').change(function(){
                
                var processLocality = $absolute_path + "staff_module" + $separator + "processStaffInformation" + $separator + "process_locality";
                var staffCountryCode = $("#staffCountry").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {staffCountryCode: staffCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#staffLocality").html(html);
                    }
                });

            });
            
            
            //Process the location of a guardian based on the selected country
            $('.guardianCountry').change(function(){
                
                var processLocality = $absolute_path + "staff_module" + $separator + "staffInformation" + $separator + "process_locality";
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
            
            
            //Process the location of a physician based on the selected country
            $('.physicianCountry').change(function(){
                
                var processLocality = $absolute_path + "staff_module" + $separator + "staffInformation" + $separator + "process_locality";
                var physicianCountryCode = $("#physicianCountry").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: physicianCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#physicianLocality").html(html);
                    }
                });

            });
            
            
            //Process the location of a physician based on the selected country
            $('.hospitalCountry').change(function(){
                
                var processLocality = $absolute_path + "staff_module" + $separator + "staffInformation" + $separator + "process_locality";
                var hospitalCountryCode = $("#hospitalCountry").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: hospitalCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#hospitalLocality").html(html);
                    }
                });

            });
            
            
            
            //Here we hide and show select menu for staff blood group.
            $(".staffBloodGroup").hide();
            $("#staffBloodGroupYes").click(function(){
                
                $(".staffBloodGroup").fadeIn(1000);
                
            });
            $("#staffBloodGroupNo").click(function(){
                
                $(".staffBloodGroup").fadeOut(1000, function(){
                    $(".staffBloodGroup").hide();
                });
                
            });
            
            
            
            //Here we hide and show explanation box for staff disability.
            $(".staffDisability").hide();
            $("#staffDisableYes").click(function(){
                
                $(".staffDisability").fadeIn(1000);
                
            });
            $("#staffDisableNo").click(function(){
                
                $(".staffDisability").fadeOut(1000, function(){
                    $('#staffDisability').val('');
                    $(".staffDisability").hide();
                });
                
            });
            
            //Here we hide and show explanation box for staff medication.
            $(".staffMedication").hide();
            $("#staffMedicatedYes").click(function(){
                
                $(".staffMedication").fadeIn(1000);
                
            });
            $("#staffMedicatedNo").click(function(){
                
                $(".staffMedication").fadeOut(1000, function(){
                    $("#staffMedication").val('');
                    $(".staffMedication").hide();
                });
                
            });
            
            
            //Here we hide and show explanation box for staff allergy conditions.
            $(".staffAllergic").hide();
            $("#staffAllergicYes").click(function(){
                
                $(".staffAllergic").fadeIn(1000);
                
            });
            $("#staffAllergicNo").click(function(){
                
                $(".staffAllergic").fadeOut(1000, function(){
                    $("#staffAllergic").val('');
                    $(".staffAllergic").hide();
                });
                
            });
            
            
            //Here we hide and show explanation box for staff treatment conditions.
            $(".staffTreatment").hide();
            $("#staffTreatmentYes").click(function(){
                
                $(".staffTreatment").fadeIn(1000);
                
            })
            $("#staffTreatmentNo").click(function(){
                
                $(".staffTreatment").fadeOut(1000, function(){
                    $("#staffTreatment").val('');
                    $(".staffTreatment").hide();
                });
                
            })
            
            
            //Here we hide and show details box for staff physician.
            $(".staffPhysician").hide();
            $("#staffPhysicianYes").click(function(){
                
                $(".staffPhysician").fadeIn(1000);
                
            })
            $("#staffPhysicianNo").click(function(){
                
                $(".staffPhysician").fadeOut(1000, function(){
                    $(".staffPhysician").val('');
                    $(".staffPhysician").hide();
                });
                
            })
            
            
            //Here we hide and show details box for staff hospital.
            $(".staffHospital").hide();
            $("#staffHospitalYes").click(function(){
                
                $(".staffHospital").fadeIn(1000);
                
            })
            $("#staffHospitalNo").click(function(){
                
                $(".staffHospital").fadeOut(1000, function(){
                    $(".staffHospital").val('');
                    $(".staffHospital").hide();
                });
                
            })
            
            
            
            //Process the streams within the selected class
            $('.staffClassCode').change(function(){
                
                var processStreams = $absolute_path + "staff_module" + $separator + "staffInformation" + $separator + "process_streams";
                var staffClassCode = $("#staffClassCode").val();
                
                //alert(staffClassCode); exit();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processStreams,
                    data: {staffClassCode: staffClassCode},
                    cache: false,
                    success: function(html) {
                       $("#staffStreamCode").html(html);
                    }
                });

            });
               
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_staff"){

                    staffData($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


