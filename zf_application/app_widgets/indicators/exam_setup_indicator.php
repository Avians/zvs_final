
<?php if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your exams setup form. Please check in <strong>"Add a new examination"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'existing_exam_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your exams setup form. The examination has already been registered!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new examination. You can now view examinations offered in the school.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_mode_existence_error'){    
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The selected exam mode is already existent. Set a different exam mode name and try again.
    </div> 
<?php    
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_mode_non_existence_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The selected exam mode does not exist. There seems to be an internal system error.
    </div> 
<?php     
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_mode_edit_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        There was an error while editing the exam mode for the selected subject exam. Review and try again
    </div> 
<?php   
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exam_mode_update_success'){
?>   
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated the examination mode for the selected subject exam.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exams_activation_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully activated all examination modes in the selected subject.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('exam_setup') == 'exams_activation_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        There was an error in activating all examination modes in the selected. Ensure that the check-box is marked and try again.
    </div> 
<?php
}
    Zf_SessionHandler::zf_unsetSessionVariable("exam_setup");
?>