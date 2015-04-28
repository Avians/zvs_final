<script type="text/javascript" >

    var AdministratorLocations = function(){
        
        //Here we process school locality.
        var adminLocality = function ($absolute_path, $separator){
            
            $('.adminCountry').change(function(){
                
                var processLocality = $absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var countryCode = $("#adminCountry").val();

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: countryCode},
                    cache: false,
                    success: function(html) {
                       $("#adminLocality").html(html);
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


