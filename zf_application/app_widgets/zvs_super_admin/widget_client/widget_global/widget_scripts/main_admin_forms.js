<script type="text/javascript" >

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
               
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_user"){

                    adminLocality($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


