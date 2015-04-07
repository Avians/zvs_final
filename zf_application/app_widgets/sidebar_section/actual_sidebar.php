
<?php
    
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");

    //Here we decode the identification code into an identification Array.
    $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

    //User role
    $userRole = $identificationArray[3];



    //Side menu for super administrator
    if($userRole == ZVS_SUPER_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_super_admin.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for platform administrator
    if($userRole == ZVS_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_platform_admin.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school principal
    if($userRole == SCHOOL_PRINCIPAL){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_principal.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school main administrator
    if($userRole == SCHOOL_MAIN_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_main_admin.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school general administrator
    if($userRole == SCHOOL_GENERAL_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_general_admin.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school sub staff
    if($userRole == SCHOOL_SUB_STAFF){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_sub_staff.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school BOG
    if($userRole == SCHOOL_BOG){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_bog.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school student
    if($userRole == SCHOOL_STUDENT){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_student.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school parent
    if($userRole == SCHOOL_PARENT){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_parent.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for school alumni
    if($userRole == SCHOOL_ALUMNI){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_alumni.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for platform guest user
    if($userRole ==  ZVS_GUEST_USER){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_guest_user.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for platform banned user
    if($userRole ==  ZVS_BANNED_USER){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_banned_user.php", $identificationCode);
        
    }
    
    
    
    //General side menu for platform users
    if($userRole != ZVS_BANNED_USER && $userRole != ZVS_GUEST_USER){
    
        //Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_general_menu.php", $identificationCode);
        
    }
      
?>