<?php if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'class_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your class setup form. Please check in <strong>"Add a class"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'existent_class_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your class setup form. A similar class has already been registered. Check in <strong>"Add a class"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'class_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new class. You can now add streams to the newly created class.
    </div> 
<?php
} 
if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'stream_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in you stream setup form. Please check in <strong>"Add a stream"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'existent_stream_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your stream setup form. A similar stream has already been registered. Check in <strong>"Add a stream"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('department_setup') == 'stream_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a stream. You can view the stream details.
    </div> 
<?php 
}
Zf_SessionHandler::zf_unsetSessionVariable("department_setup");
?>

