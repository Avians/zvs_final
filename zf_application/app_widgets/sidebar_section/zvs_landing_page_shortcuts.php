<?php

    /** 
     * This menu is used by school general administrator
     */

    //This holds an array of the active URL
    $activeURL = Zf_Core_Functions::Zf_URLSanitize();

    //This are the active controller, action and parameter if any.
    $zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

    //User identification code. This code is also stored in a session variable
    $identificationCode = $zf_externalWidgetData;
    
    /**
     * We access the database to retrieve the resources assigned to the current user role. If there are resources assigned in the returned array
     * then we return those resources in an array.
     */

    //This array holds all valid user resources for the selected role.
    $zvs_allowedResources = $zf_model_data->zvs_fetchUserActiveResources($identificationCode);

//    echo "<pre>";
//    print_r($zvs_allowedResources);
//    echo "</pre>"; exit();
    //MODULES AND RESOURCES LIST BEGINS HERE

    /**
     * This is a list of all availeble platform modules with available resources
     * 
     * This list will always be updated as modules and resources are built into the platform.
     *
     */


    //1. Class Module(ClsMod) ==> zvs_class
    if(Zf_Core_Functions::Zf_recursiveArray(CLASS_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "class_module.php", $zvs_allowedResources);
        
    } 

    //2. Department Module(DepMod) ==> zvs_department
    if(Zf_Core_Functions::Zf_recursiveArray(DEPARTMENT_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "department_module.php", $zvs_allowedResources);

    } 
 
    //3. Finance Module(FinMod) ==> zvs_finance
    if(Zf_Core_Functions::Zf_recursiveArray(FINANCE_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "finance_module.php", $zvs_allowedResources);
        
    } 
    
    
    //4. Staff Module(SstMod) ==> zvs_Staff
    if(Zf_Core_Functions::Zf_recursiveArray(STAFF_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "staff_module.php", $zvs_allowedResources);
    
    } 
    
  
    //5. Student Module(StuMod) ==> zvs_student
    if(Zf_Core_Functions::Zf_recursiveArray(STUDENT_MODULE, $zvs_allowedResources)){ 
         
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "student_module.php", $zvs_allowedResources);
         
    }
    
    
    //6. Parent Module(ParMod) ==> zvs_parent
    if(Zf_Core_Functions::Zf_recursiveArray(PARENT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "parent_module.php", $zvs_allowedResources);
    
    }

 
    //7. BOG Module(BogMod) ==> zvs_bog
    if(Zf_Core_Functions::Zf_recursiveArray(BOG_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "bog_module.php", $zvs_allowedResources);
        
    }

    
    //8. Subject Module(SubMod) ==> zvs_subject
    if(Zf_Core_Functions::Zf_recursiveArray(SUBJECT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "subject_module.php", $zvs_allowedResources);
        
    }


    //9. Examination Module(ExmMod) ==> zvs_examination
    if(Zf_Core_Functions::Zf_recursiveArray(EXAMINATION_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "examination_module.php", $zvs_allowedResources);
       
    }


    //10. Grade Module(GrdMod) ==> zvs_grade
    if(Zf_Core_Functions::Zf_recursiveArray(GRADE_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "grade_module.php", $zvs_allowedResources);
    
    }

 
    //11. Timetable Module(TtbMod) ==> zvs_timetable
    if(Zf_Core_Functions::Zf_recursiveArray(TIMETABLE_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "timetable_module.php", $zvs_allowedResources);
        
    }

 
    //12. Noticeboard Module(NtcMod) ==> zvs_noticeboard
    if(Zf_Core_Functions::Zf_recursiveArray(NOTICEBOARD_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "noticeboard_module.php", $zvs_allowedResources);
           
    }

 
    //13. Library Module(LibMod) ==> zvs_library
    if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "library_module.php", $zvs_allowedResources);
    
    }

 
    //14. Transport Module(TrnMod) ==> zvs_transport
    if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "transport_module.php", $zvs_allowedResources);
        
    }

 
    //15. Kitchen Module(KtnMod) ==> zvs_kitchen
    if(Zf_Core_Functions::Zf_recursiveArray(KITCHEN_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "kitchen_module.php", $zvs_allowedResources);
    
    }


    //16. Health Module(HthMod) ==> zvs_healthCare
    if(Zf_Core_Functions::Zf_recursiveArray(HEALTH_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "health_module.php", $zvs_allowedResources);
 
    }

 
    //17. Hostel Module(HosMod) ==> zvs_hostel
    if(Zf_Core_Functions::Zf_recursiveArray(HOSTEL_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "hostel_module.php", $zvs_allowedResources);

    } 

 
    //18. Asset Module(AssMod) ==> zvs_asset
    if(Zf_Core_Functions::Zf_recursiveArray(ASSET_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "asset_module.php", $zvs_allowedResources);

    } 
    

 
    //19. Store Module(StrMod) ==> zvs_store
    if(Zf_Core_Functions::Zf_recursiveArray(STORE_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "store_module.php", $zvs_allowedResources);

    } 
    

 
    //20. Data Module(DtaMod) ==> zvs_data
    if(Zf_Core_Functions::Zf_recursiveArray(DATA_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("landing_page_shortcuts", "data_module.php", $zvs_allowedResources);

    }  
 
    
?>