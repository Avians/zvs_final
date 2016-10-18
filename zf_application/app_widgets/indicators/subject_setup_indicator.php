<?php if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'subject_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your subject setup form. Please check in <strong>"Add a new subject"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'existing_subject_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your subject setup form. The subject has already been registered!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'subject_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new subject. You can now view subjects offered in the school.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'subject_update_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated the subject. You can now view updated subjects offered in the school.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'subjects_activated_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully activated all subject. All school subjects are now active.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('subject_setup') == 'subjects_activated_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        There was an error in activating all subjects. Ensure that the checkbox is marked and try again.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("subject_setup");
?>