<?php if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'module_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your module setup form. Please check in <strong>"New Resource Module"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'existent_module_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your module setup form. A similar module has already been registered. Check in <strong>"New Resource Module"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'module_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new resource module. You can now have an overview.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'resource_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your resource setup form. Please check in <strong>"New Platform Resource"</strong> section and rectify the form errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'existent_reource_error'){ 
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors in your resource setup form. A similar resource has already been registered. Check in <strong>"New Platform Resource"</strong> section!!
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'resource_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully created a new resource. You can now have an overview.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'module_activation_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The module has successfully been activated. It will now be listed as active.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'module_deactivation_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The module has successfully been de-activated. It will now be listed as inactive.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'module_activation_error'){
?>
    <div class="alert alert-success display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        There was an error in the module activation form. Kindly check and rectify.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'resource_activation_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Resource has successfully been activated. It will now be listed as active.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'resource_deactivation_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Resource has successfully been de-activated. It will now be listed as inactive.
    </div> 
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('module_resources_setup') == 'resource_activation_error'){
?>
    <div class="alert alert-success display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        There was an error in the resource activation form. Kindly check and rectify.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("module_resources_setup");
?>

