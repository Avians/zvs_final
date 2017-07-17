/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This variable processes platform administrators locations
var Hostel_Module = function(){

    //Here we process all finance status javascript and ajax
    var schoolLibrarySetup = function($absolute_path, $separator){
        
        //Global Model variables
        var targetController = "library_module";
        var targetAction = "library_Setup_Process";
         
        $('#libraryCategoryCodeNewBook').change(function(){
            
            var processLibrarySubCategory = $absolute_path + targetController + $separator + targetAction + $separator + "process_library_sub_categories";
            var libraryCategoryCode = $('#libraryCategoryCodeNewBook').val();
            
            //alert(libraryCategoryCode); die();

            //Here we run ajax task
            $.ajax({
                type: "POST",
                url: processLibrarySubCategory ,
                data: {libraryCategoryCode: libraryCategoryCode},
                cache: false,
                success: function(html) {
                   $("#librarySubCategoryCodeNewBook").html(html);
                }
            });

        });
        
    };


   //Here we initialize all the above functions
    return { 

        init:function($current_view, $absolute_path, $separator){

            if($current_view === "hostel_register_student"){
                
                //schoolLibrarySetup($absolute_path, $separator);
                
            }

        }

    }; 


}();


