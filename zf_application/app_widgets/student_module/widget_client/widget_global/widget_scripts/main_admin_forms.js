<script type="text/javascript" >


    //This variable processes school locations
    var StudentLocations = function(){
        
        //This function processes the locality of a school and its administrator.
        var studentLocality = function ($absolute_path, $separator){
            
            //Process the locality of a school administrator from his/her selected country
            $('.studentCountry').change(function(){
                
                var processLocality = $absolute_path + "student_module" + $separator + "studentInformation" + $separator + "process_locality";
                var studentCountryCode = $("#studentCountry").val();

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
            
               
        };
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_student"){

                    studentLocality($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
</script>


