<script type="text/javascript" >

    //This variable processes platform administrators locations
    var ManageForms = function(){
        
        //Here we process all class details.
        var classDetails = function ($absolute_path, $separator){
            
            //Process the locality of a super administrator
            $('.superAdminCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var countryCodeSuperAdmin = $("#superAdminCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: countryCodeSuperAdmin},
                    cache: false,
                    success: function(html) {
                       $("#superAdminLocality").html(html);
                    }
                });

            });
               
        };
        
        
        //Here we process all department details.
        var departmentDetails = function ($absolute_path, $separator){
            
            //Process the locality of a super administrator
            $('.superAdminCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var countryCodeSuperAdmin = $("#superAdminCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: countryCodeSuperAdmin},
                    cache: false,
                    success: function(html) {
                       $("#superAdminLocality").html(html);
                    }
                });

            });
               
        };
        
        //Here we process all fee form data
        var feesDetails = function (){
            
            //Hide both general and class fee forms
            $("#classSpecificFees").hide();
            
            //Show general fees form
            $("#generalFeesButton").click(function(){
                
                $("#classSpecificFees").hide();
                
                $("#generalSchoolFees").fadeIn(1000, function(){
                    
                });
                
            });
            
            //Show class fees form
            $("#classFeesButton").click(function(){
                
                $("#generalSchoolFees").hide();
                
                $("#classSpecificFees").fadeIn(1000, function(){
                    
                });
                
            });
            
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "manage_classes"){

                    classDetails($absolute_path, $separator);

                }if($current_view === "manage_department"){
                    
                    departmentDetails($absolute_path, $separator);
                    
                }if($current_view === "manage_fees"){
                    
                    feesDetails();
                    
                }

            }

        };  
        
    }(); 
    
    
</script>