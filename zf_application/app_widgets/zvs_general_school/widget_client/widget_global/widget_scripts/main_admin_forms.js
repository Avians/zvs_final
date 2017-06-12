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
        
        
        //Here we process all subject details
        var subjectDetails = function ($absolute_path, $separator){
            
            //Process school departments based on available school departments
            $('.schoolDepartmentCode').change(function(){

                var processSchoolSubDepartments = $absolute_path + "school_main_admin" + $separator + "ManageSchoolDepartments" + $separator + "process_sub_departments";
                var schoolDepartmentCode = $("#schoolDepartmentCode").val();

                //alert(schoolDepartmentCode); exit();

                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processSchoolSubDepartments,
                    data: {schoolDepartmentCode: schoolDepartmentCode},
                    cache: false,
                    success: function(html) {
                       $("#schoolSubDepartmentCode").html(html);
                    }
                });

            });
            
        };
        
        
        
        //Here we process all fee form data
        var feesDetails = function ($absolute_path, $separator){
            
            //This section processes all charts for the fee section
            $('#generalFeesDynamicPieChart, #generalFeesDynamicBarChart, #classFeesDynamicPieChart, #classFeesDynamicBarChart').hide();
            
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

                $('#classFeesSplashScreen').remove();
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
            
            
            //Process the fee payment periods based on selected year
            $('.paymentYear').change(function(){
                
                var processPaymentYear = $absolute_path + "school_main_admin" + $separator + "newFeeItemRegistration" + $separator + "process_year";
                var paymentYear = $("#paymentYear").val();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processPaymentYear,
                    data: {paymentYear: paymentYear},
                    cache: false,
                    success: function(html) {
                       $("#paymentPeriod").html(html);
                    }
                });

            });
            
        };
        
        
        
        //Here we process all attendance data
        var attendanceDetails = function ($absolute_path, $separator){
            
            $('#activeAttendanceSchedule').hide();
            
            $('#activeAttendanceYear').change(function(){
                
                var selectedYear = $('#activeAttendanceYear').val();
                
                if(selectedYear == "Select year"){
                    
                     $('#attendanceSplashScreen').show();
                     $('#activeAttendanceSchedule').hide();
                    
                }else{
                    
                    $('#attendanceSplashScreen').hide();
                    $('#activeAttendanceSchedule').show();
                    
                    $('#feeDefaultTitle').hide(); $('#feeClassTitle').show();
                    //Model variables
                    var targetController = "school_main_admin";
                    var targetAction = "processAttendanceSchedule";
                    var attendanceSchedule = "attendanceSchedule";

                    var processAttendanceValues = $absolute_path + targetController + $separator + targetAction + $separator + attendanceSchedule;

                    //Here we run ajax task for attendance schedule
                    $.ajax({
                        type: "POST",
                        url: processAttendanceValues,
                        data: {postedValues : selectedYear},
                        cache: false,
                        success: function(html) {
                           $("#activeAttendanceSchedule").html(html);
                        }
                    });
                    
                }
                
                
                
            });
            
        };
        
        
        
        //Here we process all the javascript that is related to processing of budget
        var budgetDetails = function ($absolute_path, $separator){
            
            //Process budget categories based in the selected financial year
            $('.financialYearCodeSubCategory').change(function(){

                var processBudgetCategories = $absolute_path + "school_main_admin" + $separator + "NewBudgetCategoriesRegistration" + $separator + "process_budget_categories";
                var financialYearCode = $("#financialYearCodeSubCategory").val();

                //alert(financialYearCode); exit();

                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processBudgetCategories,
                    data: {financialYearCode: financialYearCode},
                    cache: false,
                    success: function(html) {
                       $("#budgetCategoryCodeSubCategory").html(html);
                    }
                });

            });
            
            
            //Process budget overview upon selection of a financial year
            $('#generalFinancialYearSelector').change(function(){
                
                $('#generalStaticBudgetOverview').fadeOut(1500, function(){
                    
                    $("#generateDynamicBudgetOverview").fadeIn(500, function(){
                        
                        var processBudgetOverview = $absolute_path + "school_main_admin" + $separator + "configureBudgetCategories" + $separator + "process_budget_overview";
                        var financialYearCode = $("#generalFinancialYearSelector").val();

                        //alert(financialYearCode); exit();

                        //Here we run ajax task
                        $.ajax({
                            type: "POST",
                            url: processBudgetOverview,
                            data: {financialYearCode: financialYearCode},
                            cache: false,
                            success: function(html) {
                               $("#generateDynamicBudgetOverview").html(html);
                            }
                        });
                        
                    });
                    
                });        
                
            });
            
            
            
        };
        
        
        //Here we process all timetable details
        var timeTableDetails = function ($absolute_path, $separator){
            
            //Process the streams within the selected class
            $('.timeTableClassCode').change(function(){
                
                var processStreams = $absolute_path + "school_main_admin" + $separator + "timeTableInformation" + $separator + "process_streams";
                var timeTableClassCode = $("#timeTableClassCode").val();
                
                //alert(timeTableClassCode); exit();
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processStreams,
                    data: {timeTableClassCode: timeTableClassCode},
                    cache: false,
                    success: function(html) {
                       $("#timeTableStreamCode").html(html);
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
                    
                }if($current_view === "manage_subjects"){
                    
                    subjectDetails($absolute_path, $separator);
                    
                }if($current_view === "manage_fees"){
                    
                    feesDetails($absolute_path, $separator);
                    
                }if($current_view === "configure_attendance"){
                    
                    attendanceDetails($absolute_path, $separator);
                    
                }if($current_view === "configure_budget"){
                    
                    budgetDetails($absolute_path, $separator);
                    
                }if($current_view === "configure_timeTable"){
                    
                    timeTableDetails($absolute_path, $separator);
                    
                }

            }

        };  
        
    }(); 
    
    
</script>