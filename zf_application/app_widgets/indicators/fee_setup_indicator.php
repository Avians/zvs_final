
<?php if(Zf_SessionHandler::zf_getSessionVariable('fee_setup') == 'feeItem_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your fee item setup form. Please check in <strong>"School Fee Setup"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('fee_setup') == 'existing_feeItem_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your fee item setup form. The fee item has already been registered!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('fee_setup') == 'feeItem_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new fee item. You can now view school fees items in the overview section.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('fee_payment_schedule') == 'fee_payment_schedule_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your fee payment schedule configuration form. Please check in <strong>"Configure payment schedule"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('fee_payment_schedule') == 'existing_payment_schedule_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your fee payment schedule configuration form. The fee payment schedule has already been registered!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('fee_payment_schedule') == 'fee_payment_schedule_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new fee payment schedule. You can now view school fees payment scheduls.
    </div> 
<?php
}
    Zf_SessionHandler::zf_unsetSessionVariable("ee_payment_schedule");
    Zf_SessionHandler::zf_unsetSessionVariable("fee_setup");
?>