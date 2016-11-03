
<?php if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'attendance_configuration_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your grade setup form. Please check in <strong>"Add new grades"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'existing_attendance_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your attendance form. This attendance schedule has already been registered for the selected year!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'attendance_configuration_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new attendance schedule. You can now view attendance schedule in the overview. section
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'attendance_year_error'){    
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Check to ensure that attendance year is the same as start year in the start date form field!!
    </div> 
<?php    
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'start_year_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Start year cannot be greater than end year. Rectify the error to continue!!
    </div> 
<?php     
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'start_month_error'){
?>   
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Start month cannot be greater than end month for the same year. Rectify the error to continue!!
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('configure_attendance') == 'start_date_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Starte date cannot be greater than end date for the same year and month. Rectify the error to continue!!
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("configure_attendance");
?>