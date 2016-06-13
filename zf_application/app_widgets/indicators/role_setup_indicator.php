<?php if(Zf_SessionHandler::zf_getSessionVariable('role_setup') == 'role_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your role setup form. Please check in <strong>"Add a new role"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('role_setup') == 'existent_role_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your role setup form. A similar role has already been registered. Check in <strong>"Add a new role"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('role_setup') == 'role_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new role. You can now have an overview of the school roles.
    </div> 
<?php
} 
Zf_SessionHandler::zf_unsetSessionVariable("role_setup");
?>

