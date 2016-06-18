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

//This array holds all valid resources
$zvs_allowedResources = $zf_model_data->zvs_fetchUserResources($identificationCode);


//MODULES AND RESOURCES LIST BEGINS HERE

/**
 * This is a list of all availeble platform modules with available resources
 * 
 * This list will always be updated as modules and resources are built into the platform.
 *
 */


    //1. Class Module(ClsMod) ==> zvs_class
    if(Zf_Core_Functions::Zf_recursiveArray(CLASS_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "class_module.php", $zvs_allowedResources);
        
    } 
 
    //2. Department Module(DepMod) ==> zvs_department
    if(Zf_Core_Functions::Zf_recursiveArray(DEPARTMENT_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "department_module.php", $identificationCode);

    } 
 
    //3. Finance Module(FinMod) ==> zvs_finance
    if(Zf_Core_Functions::Zf_recursiveArray(FINANCE_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "finance_module.php", $identificationCode);
        
    } 
  
    //4. Student Module(StuMod) ==> zvs_student
    if(Zf_Core_Functions::Zf_recursiveArray(STUDENT_MODULE, $zvs_allowedResources)){ 
         
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "student_module.php", $identificationCode);
         
    }


    //5. Teacher Module(TchMod) ==> zvs_teacher
    if(Zf_Core_Functions::Zf_recursiveArray(TEACHER_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "teacher_module.php", $identificationCode);

    }

    
    //6. Sub Staff Module(SstMod) ==> zvs_subStaff
    if(Zf_Core_Functions::Zf_recursiveArray(SUB_STAFF_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "sub_staff_module.php", $identificationCode);
    
    }  
    
    
    //7. Parent Module(ParMod) ==> zvs_parent
    if(Zf_Core_Functions::Zf_recursiveArray(PARENT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "parent_module.php", $identificationCode);
    
    }

 
    //8. BOG Module(BogMod) ==> zvs_bog
    if(Zf_Core_Functions::Zf_recursiveArray(BOG_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "bog_module.php", $identificationCode);
        
    }

    
    //9. Subject Module(SubMod) ==> zvs_subject
    if(Zf_Core_Functions::Zf_recursiveArray(SUBJECT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "subject_module.php", $identificationCode);
        
    }


    //10. Examination Module(ExmMod) ==> zvs_examination
    if(Zf_Core_Functions::Zf_recursiveArray(EXAMINATION_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "examination_module.php", $identificationCode);
       
    }


    //11. Marksheet Module(MrkMod) ==> zvs_marksheet
    if(Zf_Core_Functions::Zf_recursiveArray(MARKSHEET_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "marksheet_module.php", $identificationCode);
    
    }

 
    //12. Timetable Module(TtbMod) ==> zvs_timetable
    if(Zf_Core_Functions::Zf_recursiveArray(TIMETABLE_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "timetable_module.php", $identificationCode);
        
    }

 
    //13. Noticeboard Module(NtcMod) ==> zvs_noticeboard
    if(Zf_Core_Functions::Zf_recursiveArray(NOTICEBOARD_MODULE, $zvs_allowedResources)){
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "noticeboard_module.php", $identificationCode);
           
    }

 
    //14. Library Module(LibMod) ==> zvs_library
    if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "library_module.php", $identificationCode);
    
    }

 
    //15. Transport Module(TrnMod) ==> zvs_transport
    if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "transport_module.php", $identificationCode);
        
    }

 
    //16. Kitchen Module(KtnMod) ==> zvs_kitchen
    if(Zf_Core_Functions::Zf_recursiveArray(KITCHEN_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "kitchen_module.php", $identificationCode);
    
    }


    //17. Health Module(HthMod) ==> zvs_healthCare
    if(Zf_Core_Functions::Zf_recursiveArray(HEALTH_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "health_module.php", $identificationCode);
 
    }

 
    //18. Hostel Module(HosMod) ==> zvs_hostel
    if(Zf_Core_Functions::Zf_recursiveArray(HOSTEL_MODULE, $zvs_allowedResources)){ 
        
        Zf_ApplicationWidgets::zf_load_widget("modules_section", "hostel_module.php", $identificationCode);

    } 
    
?>