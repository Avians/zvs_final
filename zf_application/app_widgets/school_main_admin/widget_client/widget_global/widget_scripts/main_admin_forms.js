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
        var feesDetails = function ($absolute_path, $separator){
            
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
            
            
            //This section processes all charts for the fee section
            
            $('#generalFeesDynamicPieChart, #generalFeesDynamicBarChart, #classFeesDynamicPieChart, #classFeesDynamicBarChart').hide();
            
            //GENERAL FEES CHARTS.
            $("#generalFeesYearsSelector").change(function(){
                
                $('#generalFeesStaticPieChart, #generalFeesStaticBarChart').remove();
                $('#generalFeesDynamicPieChart, #generalFeesDynamicBarChart').show();
                
                //This is value of the selected year
                var selectedGeneralFeesYear = $("#generalFeesYearsSelector").val();
                
                var targetController = "school_main_admin";
                var targetAction = "processDynamicFeesCharts";
                var generalPieChart = "generalPieChart";
                var generalBarChart = "generalBarChart";

                //The absloute path to chart processing model
                //$absolute_path + "zvs_super_admin" + $separator + "userInformation" + $separator + "process_locality";
                var processGeneralPieChart = $absolute_path + targetController + $separator + targetAction + $separator + generalPieChart;
                var processGeneralBarChart = $absolute_path + targetController + $separator + targetAction + $separator + generalBarChart;

                //Here we run ajax task for dynamic pie chart
                $.ajax({
                    type: "POST",
                    url: processGeneralPieChart,
                    data: {postedChartValues : selectedGeneralFeesYear},
                    cache: false,
                    success: function(html) {
                       $("#generalFeesDynamicPieChart").html(html);
                    }
                });

                //Here we run ajax task for dynamic pie chart
                $.ajax({
                    type: "POST",
                    url: processGeneralBarChart,
                    data: {postedChartValues : selectedGeneralFeesYear},
                    cache: false,
                    success: function(html) {
                       $("#generalFeesDynamicBarChart").html(html);
                    }
                });
                
            });
            
            
            
            //CLASS FEES CHARTS
            $("#classFeesYearsSelector, #activeClassSelector").change(function(){
                
                $('#classFeesStaticPieChart, #classFeesStaticBarChart').remove();
                $('#classFeesDynamicPieChart, #classFeesDynamicBarChart').show();
                
                //This is the value of the selected year
                var selectedClassFeesYear = $("#classFeesYearsSelector").val();
                
                //This is the value of the selected class
                var selectedActiveClass = $("#activeClassSelector").val();
                
                var targetController = "school_main_admin";
                var targetAction = "processDynamicFeesCharts";
                var classPieChart = "classPieChart";
                var classBarChart = "classBarChart";
                
                //This is the overall chart values
                var classChartValues = selectedClassFeesYear + "[`^`]" + selectedActiveClass;

                //The absloute path to chart processing model
                var processClassPieChart = $absolute_path + targetController + $separator + targetAction + $separator + classPieChart;
                var processClassBarChart = $absolute_path + targetController + $separator + targetAction + $separator + classBarChart;
                
                //Here we run ajax task for dynamic pie chart
                $.ajax({
                    type: "POST",
                    url: processClassPieChart,
                    data: {postedChartValues : classChartValues},
                    cache: false,
                    success: function(html) {
                       $("#classFeesDynamicPieChart").html(html);
                    }
                });

                //Here we run ajax task for dynamic pie chart
                $.ajax({
                    type: "POST",
                    url: processClassBarChart,
                    data: {postedChartValues : classChartValues},
                    cache: false,
                    success: function(html) {
                       $("#classFeesDynamicBarChart").html(html);
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
                    
                }if($current_view === "manage_fees"){
                    
                    feesDetails($absolute_path, $separator);
                    
                }

            }

        };  
        
    }(); 
    
    
</script>