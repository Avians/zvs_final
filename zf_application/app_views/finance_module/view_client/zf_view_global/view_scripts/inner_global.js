/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var FinanceModule = function(){

    //Here we process all finance status javascript and ajax
    var financeStatus = function($absolute_path, $separator){
        
        //Global Model variables
        var targetController = "finance_module";
        var targetAction = "processFinanceStatus";
        
        
        //THIS SECTION PROCESSES FINANCE STATUS BASED ON SCHOOL FEES FOR THE SELECTED YEAR
        var feesFinancialParameter = "feesFinancialStatus";
        var feesFinancialYear = $('#selectedFeesFinancialYear').val();
        
        $("#feesFinanceStatusDefaultTitle, #feesFinanceDynamicDefaultTitle").hide();
        
        //Show the title based on the default Year
        $("#feesFinanceStatusDefaultTitle").html(feesFinancialYear+" - General School Finance Status");
        $("#feesFinanceStatusDefaultTitle").show();
        
        var processFeesFinancialStatus = $absolute_path + targetController + $separator + targetAction + $separator + feesFinancialParameter;

        //Here we run ajax task for class fee structure
        $.ajax({
            type: "POST",
            url: processFeesFinancialStatus,
            data: {postedFinancialYear : feesFinancialYear},
            cache: false,
            success: function(html) {
               $("#feesFinancialStatus").html(html);
            }
        });
        
        
        //Change the title year based on the changed year
        $("#selectedFeesFinancialYear").change(function(){
           
            var feesFinancialYear = $('#selectedFeesFinancialYear').val();
            $("#feesFinanceDynamicDefaultTitle").html(feesFinancialYear+" - General School Finance Status");
            $("#feesFinanceStatusDefaultTitle").hide(); $("#feesFinanceDynamicDefaultTitle").fadeIn(3000);
            
            var processFeesFinancialStatus = $absolute_path + targetController + $separator + targetAction + $separator + feesFinancialParameter;

            //Here we run ajax task for class fee structure
            $.ajax({
                type: "POST",
                url: processFeesFinancialStatus,
                data: {postedFinancialYear : feesFinancialYear},
                cache: false,
                success: function(html) {
                   $("#feesFinancialStatus").html(html);
                }
            });
            
        });
        
        
        
        //THIS SECTION PROCESSES FINANCE STATUS BASED ON SCHOOL FEES FOR THE SELECTED YEAR
        var budgetFinancialYearName = "budgetFinancialYearName";
        var budgetFinancialStatus = "budgetFinancialStatus";
        
        $("#budgetFinanceDynamicDefaultTitle, #dynamicBudgetFinancialStatus").hide();
        
        
        //Change the budget title when the financial year changes
        $("#selectedBudgetFinancialYear").change(function(){
            
            $("#budgetFinanceStaticDefaultTitle, #staticBudgetFinancialStatus").hide(); 
            $("#budgetFinanceDynamicDefaultTitle, #dynamicBudgetFinancialStatus").show(function(){
                
                var budegtFinancialYearCode = $('#selectedBudgetFinancialYear').val();
                //alert(budegtFinancialYearCode); die();

                var processDynamicBudgetTitle = $absolute_path + targetController + $separator + targetAction + $separator + budgetFinancialYearName;
                var processDynamicBudgetStatus = $absolute_path + targetController + $separator + targetAction + $separator + budgetFinancialStatus;

                //Here we run ajax task for processing dynamic financial year title
                $.ajax({
                    type: "POST",
                    url: processDynamicBudgetTitle,
                    data: {postedFinancialYear : budegtFinancialYearCode},
                    cache: false,
                    success: function(html) {
                       $("#budgetFinanceDynamicDefaultTitle").html(html);
                    }
                });
                
                
                //Here we run ajax task for processing dynamic financial status
                $.ajax({
                    type: "POST",
                    url: processDynamicBudgetStatus,
                    data: {postedFinancialYear : budegtFinancialYearCode},
                    cache: false,
                    success: function(html) {
                       $("#dynamicBudgetFinancialStatus").html(html);
                    }
                });
            
            });
            
        });
        
        
    };

    //Here we process all fee structure javascript and ajax
    var feeStructure = function ($absolute_path, $separator){

        $('#feeStructureData, #feeClassTitle, #printButton, .hidden-fee-structure').hide();
        
        $('#activeClassSelector, #classFeesYearsSelector').change(function(){
            
            //Selected class
            var selectedClass = $('#activeClassSelector').val();
            
            //Selected year
            var selectedYear = $('#classFeesYearsSelector').val();
            
            if(selectedClass == ""){
                
                $('#feeClassTitle').hide(); $('#feeDefaultTitle, #printButton').show();
                
            }else{
                
                $('#feeDefaultTitle').hide(); $('#feeClassTitle, #printButton').show();
                //Model variables
                var targetController = "finance_module";
                var targetAction = "processFeeStructure";
                var feeClassTitle = "feeClassTitle";
                var classTitleValues = selectedClass + "[`^`]" + selectedYear;

                var processClassTitleValues = $absolute_path + targetController + $separator + targetAction + $separator + feeClassTitle;

                //Here we run ajax task for class fee structure
                $.ajax({
                    type: "POST",
                    url: processClassTitleValues,
                    data: {postedTitleValues : classTitleValues},
                    cache: false,
                    success: function(html) {
                       $("#feeClassTitle").html(html);
                    }
                });
                
            }
        });
        
        
        
        $('#activeClassSelector, #classFeesYearsSelector').change(function(){
            
            $('#feeStructureSplashScreen').hide(); $('#feeStructureData').show();
            
            //Selected class
            var selectedClass = $('#activeClassSelector').val();
            
            //Selected year
            var selectedYear = $('#classFeesYearsSelector').val();
            
            //Model variables
            var targetController = "finance_module";
            var targetAction = "processFeeStructure";
            var classFeeStructure = "classFeeStructure";
            var classFeeSummary = "classFeeSummary"
            var classFeeValues = selectedClass + "[`^`]" + selectedYear;
            
            
            
            //The absloute path to chart processing model
            var processClassFeeStructure = $absolute_path + targetController + $separator + targetAction + $separator + classFeeStructure;
            var processClassFeeSummary = $absolute_path + targetController + $separator + targetAction + $separator + classFeeSummary;

            //Here we run ajax task for class fee structure
            $.ajax({
                type: "POST",
                url: processClassFeeStructure,
                data: {postedFeeValues : classFeeValues},
                cache: false,
                success: function(html) {
                   $("#classFeeStructure").html(html);
                }
            });

            //Here we run ajax task for class fee summary
            $.ajax({
                type: "POST",
                url: processClassFeeSummary,
                data: {postedFeeValues : classFeeValues},
                cache: false,
                success: function(html) {
                   $("#classFeeSummary").html(html);
                }
            });
            
        });

    };
    
    
    //Here we process all fee collection details javascript and ajax
    var collectFees = function ($absolute_path, $separator){
        
        $('#feesHistoryContainer, #collectFeesContainer').hide();
        
        
        //Process the streams within the selected class
        $('.studentClassCode').change(function(){

            var processStreams = $absolute_path + "finance_module" + $separator + "ProcessFeeInformation" + $separator + "process_streams";
            var studentClassCode = $("#studentClassCode").val();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStreams,
                data: {studentClassCode: studentClassCode},
                cache: false,
                success: function(html) {
                   $("#studentStreamCode").html(html);
                }
            });

        });
        
        
        
        
        //Process the streams within the selected class
        $('.studentStreamCode').change(function(){

            var processStudentsList = $absolute_path + "finance_module" + $separator + "ProcessFeeInformation" + $separator + "process_students_list";
            var studentStreamCode = $("#studentStreamCode").val();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processStudentsList,
                data: {studentStreamCode: studentStreamCode},
                cache: false,
                success: function(html) {
                   $("#studentsListDetails").html(html);
                }
            });

        });
        
        
        //Process the streams within the selected class
        $('.studentsListDetails, #feesHistoryYear').change(function(){
            
            $('#collectFeesContainer').hide();
            
            $('#feesHistoryContainer').fadeIn(1000, function(){
                
                $('#feesHistoryDetails').show();
                
                var zvs_connect = "[`^`]";
                var processFeeHistory = $absolute_path + "finance_module" + $separator + "ProcessFeeInformation" + $separator + "process_fee_history";
                var identificationCode = $("#studentsListDetails").val();
                var feesHistoryYear = $("#feesHistoryYear").val();
                var feesHistoryIdentifier = identificationCode+zvs_connect+feesHistoryYear;
                
                //Here we run ajax task
                $.ajax({
                    type: "POST",
                    url: processFeeHistory,
                    data: {feesHistoryIdentifier: feesHistoryIdentifier},
                    cache: false,
                    success: function(html) {
                       $("#feesHistoryDetails").html(html);
                    }
                });
                
            });
            
        });
        
        
        $('.studentsListDetails, #feesHistoryYear').change(function(){
            
            var collectSchoolFees = $absolute_path + "finance_module" + $separator + "ProcessFeeInformation" + $separator + "collect_school_fees";
            
            var zvs_connect = "[`^`]";
            var studentIdentificationCode = $("#studentsListDetails").val();
            var feesHistoryYear = $("#feesHistoryYear").val();
            
            var feesHistoryIdentifier = studentIdentificationCode+zvs_connect+feesHistoryYear;

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: collectSchoolFees,
                data: {feesHistoryIdentifier: feesHistoryIdentifier},
                cache: false,
                success: function(html) {
                   $("#studentformData").html(html);
                }
            });
            
        });
        
        
        
        //Process the fee payment periods based on selected year
        $('.paymentYear').change(function(){
            
            var processPaymentPeriod = $absolute_path + "finance_module" + $separator + "ProcessFeeInformation" + $separator + "process_payment_period";
            var paymentYear = $("#paymentYear").val();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processPaymentPeriod,
                data: {paymentYear: paymentYear},
                cache: false,
                success: function(html) {
                   $("#paymentPeriod").html(html);
                }
            });

        });
        
        
        
    };


    //Here we process all the new budget creation details javascript and ajax
    var createBudget = function ($absolute_path, $separator){
        
        
        //Process the budget categories that fall within a given financial year
        $('.financialYearCode').change(function(){

            var processBudgetCategories = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_categories";
            var financialYearCode = $("#financialYearCode").val();

            //alert(financialYearCode); exit();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processBudgetCategories,
                data: {financialYearCode: financialYearCode},
                cache: false,
                success: function(html) {
                   $("#budgetCategoryCode").html(html);
                }
            });

        });
        
        
        //Process budget sub-categories that belong to the selected category
        $('.budgetCategoryCode').change(function(){

            var processBudgetSubCategories = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_sub_categories";
            var budgetCategoryCode = $("#budgetCategoryCode").val();

            //alert(budgetCategoryCode); exit();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processBudgetSubCategories,
                data: {budgetCategoryCode: budgetCategoryCode},
                cache: false,
                success: function(html) {
                   $("#budgetSubCategoryCode").html(html);
                }
            });

        });
        
        
        
        //Process the budget overview for the selected fincial year
        $('.generalOverviewFinancialYearCode').change(function(){

            $('#generalStaticBudgetOverview').fadeOut(1000, function(){
                    
                $("#generateDynamicBudgetOverview").fadeIn(2000, function(){

                    var processBudgetOverview = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_overview";
                    var financialYearCode = $("#generalOverviewFinancialYearCode").val();

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
    


    //Here we process all finance allocation details using javascript and ajax
    var allocateFinances = function ($absolute_path, $separator){
        
        
        //Process the budget categories that fall within a given financial year
        $('.financialYearCode').change(function(){

            var processBudgetCategories = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_categories";
            var financialYearCode = $("#financialYearCode").val();

            //alert(financialYearCode); exit();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processBudgetCategories,
                data: {financialYearCode: financialYearCode},
                cache: false,
                success: function(html) {
                   $("#budgetCategoryCode").html(html);
                }
            });

        });
        
        
        //Process budget sub-categories that belong to the selected category
        $('.budgetCategoryCode').change(function(){

            var processBudgetSubCategories = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_sub_categories";
            var budgetCategoryCode = $("#budgetCategoryCode").val();

            //alert(budgetCategoryCode); exit();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processBudgetSubCategories,
                data: {budgetCategoryCode: budgetCategoryCode},
                cache: false,
                success: function(html) {
                   $("#budgetSubCategoryCode").html(html);
                }
            });

        });
        
        
        
        //Process the budget overview for the selected fincial year
        $('.generalOverviewFinancialYearCode').change(function(){

            $('#generalStaticBudgetOverview').fadeOut(1000, function(){
                    
                $("#generateDynamicBudgetOverview").fadeIn(2000, function(){

                    var processBudgetOverview = $absolute_path + "finance_module" + $separator + "ProcessBudgetInformation" + $separator + "process_budget_overview";
                    var financialYearCode = $("#generalOverviewFinancialYearCode").val();

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
    
    

   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "finance_status"){
                
                financeStatus($absolute_path, $separator);
                
            }else if($current_view === "fee_structure"){

                feeStructure($absolute_path, $separator);

            }else if($current_view === "collect_fees"){
                
                collectFees($absolute_path, $separator);
                
            }else if($current_view === "create_budget"){

                createBudget($absolute_path, $separator);

            }else if($current_view === "allocate_finances"){

                allocateFinances($absolute_path, $separator);

            }

        }

    }; 


}();


