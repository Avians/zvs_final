<?php if(Zf_SessionHandler::zf_getSessionVariable('hostel_setup') == 'hostel_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your hostel setup form. Please check in <strong>"Add a hostel/dormitory"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('hostel_setup') == 'existent_hostel_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your hostel setup form. A similar hostel has already been registered. Check in <strong>"Add a hostel/dormitory"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('hostel_setup') == 'hostel_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new hostel/dormitory. You can now have an overview.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("hostel_setup");
?>

