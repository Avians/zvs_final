
<?php if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'grade_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your grade setup form. Please check in <strong>"Add new grades"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'existing_grade_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your grade setup form. The grade has already been registered!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'grade_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new grade. You can now view the grades offered in the school.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'grade_existence_error'){    
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The selected grade label is already existent for another. Set a different grade label and try again.
    </div> 
<?php    
}else if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'grade_non_existence_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The grade label you are trying to update does not exist. There seems to be an internal system error.
    </div> 
<?php     
}else if(Zf_SessionHandler::zf_getSessionVariable('grade_setup') == 'grade_update_success'){
?>   
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated the grade details for the selected grade.
    </div>
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("grade_setup");
?>