
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
}
    Zf_SessionHandler::zf_unsetSessionVariable("fee_setup");
?>