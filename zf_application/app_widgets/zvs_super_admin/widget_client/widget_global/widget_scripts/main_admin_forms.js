<script type="text/javascript" >

    //This variable processes platform administrators locations
    var AdministratorLocations = function(){
        
        //Here we process school locality.
        var adminLocality = function ($absolute_path, $separator){
            
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
            
            
            //Process the loclity of a platform administrator
            $('.platformAdminCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var countryCodePlatformAdmin = $("#platformAdminCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: countryCodePlatformAdmin},
                    cache: false,
                    success: function(html){
                        $('#platformAdminLocality').html(html);
                    }
                });

            });
               
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_user"){

                    adminLocality($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
    
    
    
    //This variable processes school locations
    var SchoolLocations = function(){
        
        //This function processes the locality of a school and its administrator.
        var schoolLocality = function ($absolute_path, $separator){
            
            //Process the locality of a given school within the selected country
            $('.schoolCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var schoolCountryCode = $("#schoolCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: schoolCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#schoolLocality").html(html);
                    }
                });

            });
            
            
            //Process the locality of a school administrator from his/her selected country
            $('.schoolAdminCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var schoolCountryCode = $("#schoolAdminCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: schoolCountryCode},
                    cache: false,
                    success: function(html) {
                       $("#schoolAdminLocality").html(html);
                    }
                });

            });
            
               
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_school"){

                    schoolLocality($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


