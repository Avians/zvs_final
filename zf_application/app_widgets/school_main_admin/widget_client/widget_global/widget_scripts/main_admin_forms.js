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
        
        
        //Here we process all class details.
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
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "manage_classes"){

                    classDetails($absolute_path, $separator);

                }if($current_view === "manage_department"){
                    
                    departmentDetails($absolute_path, $separator);
                    
                }

            }

        };  
        
    }(); 
    
    
</script>