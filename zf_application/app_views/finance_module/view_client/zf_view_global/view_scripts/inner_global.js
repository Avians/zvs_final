/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var FinanceModule = function(){


    //Here we process all fee structure.
    var feeStructure = function ($absolute_path, $separator){

        $('#feeStructureData, #feeClassTitle').hide();
        
        $('#activeClassSelector, #classFeesYearsSelector').change(function(){
            
            //Selected class
            var selectedClass = $('#activeClassSelector').val();
            
            //Selected year
            var selectedYear = $('#classFeesYearsSelector').val();
            
            if(selectedClass == ""){
                
                $('#feeClassTitle').hide(); $('#feeDefaultTitle').show();
                
            }else{
                
                $('#feeDefaultTitle').hide(); $('#feeClassTitle').show();
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
    
    
    //Here we process all fee collection details
    var collectFees = function ($absolute_path, $separator){
        
        //$('#feesHistoryContainer, #collectFeesContainer').hide();
        
    };



   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "fee_structure"){

                feeStructure($absolute_path, $separator);

            }else if($current_view === "collect_fees"){
                
                collectFees($absolute_path, $separator);
                
            }

        }

    }; 


}();


