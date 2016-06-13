<?php if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'department_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your department setup form. Please check in <strong>"Add a department"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'existent_department_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your department setup form. A similar department has already been registered. Check in <strong>"Add a department"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'department_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new department. You can now add sub-departments to the newly created department.
    </div> 
<?php
} 
if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'sub_department_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in you sub-department setup form. Please check in <strong>"Add a sub-department"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'existent_sub_department_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your sub-department setup form. A similar sub-department has already been registered. Check in <strong>"Add a sub-department"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'sub_department_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a sub-department. You can view the stream details.
    </div> 
<?php 
}
Zf_SessionHandler::zf_unsetSessionVariable("department_setup");
?>

