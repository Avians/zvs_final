<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $edit_role = "edit_role";
    
?>
<div class="tabbable-custom">
    <div class="tab-content">
        <div class="tab-pane active form" id="editModuleForm">
            <form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newRoleRegistration", $edit_role); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
                <div class="form-wizard" id="eidt_module_form">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#editInfo" data-toggle="tab" class="step active">
                                    <span class="number">
                                        1
                                    </span>
                                    <span class="desc progress-form-title">
                                        <i class="fa fa-check"></i> Edit Role
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#confirmInfo" data-toggle="tab" class="step">
                                    <span class="number">
                                        2
                                    </span>
                                    <span class="desc progress-form-title">
                                        <i class="fa fa-check"></i> Confirm Editing
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            

                            <!-- START OF ADMIN SETUP FORM-->
                            <div class="tab-pane" id="editInfo">
                                <?php 
                                
                                    $editForm = $zf_model_data->zf_getEditRoleForm($zf_externalWidgetData); 
                                    
                                    echo $editForm;
                                ?>    
                            </div>
                            <!-- END OF ADMINL SETUP FORM-->

                            <!-- START OF CONFIRM SETUP SECTION-->
                            <div class="tab-pane" id="confirmInfo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Role Status:</label>
                                            <div class="col-md-6">
                                                <p class="form-control-static confirm-form-result" data-display="roleStatus"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <!-- END OF CONFIRM SETUP SECTION-->

                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="m-icon-swapleft"></i> Back
                                    </a>
                                    <a href="javascript:;" class="btn blue button-next">
                                        Continue <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
            <!--                        <a href="javascript:;" class="btn green button-submit">
                                        Submit <i class="m-icon-swapright m-icon-white"></i>
                                    </a>-->
                                    <button type="submit" class="btn green button-submit">
                                        Edit <i class="m-icon-swapright m-icon-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>