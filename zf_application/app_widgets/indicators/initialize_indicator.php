
<?php if(Zf_SessionHandler::zf_getSessionVariable('initialize_indicator') == 'confirm_account'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Sorry, you will not be able to login until your account is confirmed. Check email.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('initialize_indicator') == 'account_confirmed'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Thank you for successfully confirming your account account. You can now login here.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('initialize_indicator') == 'email_reset_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Your password was successfully reset. Check your email then login here.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("initialize_indicator");
?>