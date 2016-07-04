<?php if(Zf_SessionHandler::zf_getSessionVariable('resources_roles_mapper') == 'mapper_form_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have not selected a school role. Check <strong>"Assign Resources to Roles"</strong> section and select a role, then re-assign resources!!
    </div>
<?php }else if(Zf_SessionHandler::zf_getSessionVariable('resources_roles_mapper') == 'role_mapping_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout" style="text-align: left !important;">
        <button class="close" data-dismiss="alert"></button>
        <b>You action has been terminated due one of the following, please check and try again!!</b>
        <ol>
            <li>There are no active resources availed within any modules.</li>
            <li>You did not select any resources from the ones provided.</li>
            <li>You did not select a role to assign availed resources to.</li>
        </ol>
    </div>
<?php }else if(Zf_SessionHandler::zf_getSessionVariable('resources_roles_mapper') == 'role_mapping_success'){ ?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully assigned resources to a school role. You can now have an overview of assigned roles.
    </div> 
<?php
} 
Zf_SessionHandler::zf_unsetSessionVariable("resources_roles_mapper");