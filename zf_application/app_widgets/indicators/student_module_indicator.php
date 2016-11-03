<?php if(Zf_SessionHandler::zf_getSessionVariable('student_registration') == 'general_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your student registration form. Please check in <strong>"Add New Student"</strong> section and rectify the form errors!!
    </div>
<?php }else if(Zf_SessionHandler::zf_getSessionVariable('student_registration') == 'existent_student_email'){ ?>    
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        This email address has already been registered for another user. Check in <strong>"Add New Student"</strong> section!!
    </div>  
<?php } else if(Zf_SessionHandler::zf_getSessionVariable('student_registration') == 'existent_admission_number'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        A similar admission number has already been registered. Check in <strong>"Add New Student"</strong> section!!
    </div>
<?php  }else if(Zf_SessionHandler::zf_getSessionVariable('student_registration') == 'student_registration_success'){ ?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully registered a new student. You can now have an overview of school students.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("student_registration");
?>

