
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
    else if($userRole == ZVS_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_platform_admin.php", $identificationCode);
        
    }
    
    
    
    
    
    //Side menu for school main administrator
    else if($userRole == SCHOOL_MAIN_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "school_main_admin.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for platform guest user
    else if($userRole ==  ZVS_GUEST_USER){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_guest_user.php", $identificationCode);
        
    }
    
    
    
    
    //Side menu for platform banned user
    else if($userRole ==  ZVS_BANNED_USER){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_banned_user.php", $identificationCode);
        
    }
    
    
    
    //General side menu for platform users
    else{
        
        if($userRole != "" && !empty($userRole)){
    
            Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_general_school_menu.php", $identificationCode);  
        
        }else{
            
            echo "Menu Error!!";
            
        }
        
    }
      
?>