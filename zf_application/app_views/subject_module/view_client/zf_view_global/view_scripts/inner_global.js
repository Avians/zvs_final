/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var SubjectModule = function(){

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
    
    

   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "create_budget"){

                createBudget($absolute_path, $separator);

            }

        }

    }; 


}();


