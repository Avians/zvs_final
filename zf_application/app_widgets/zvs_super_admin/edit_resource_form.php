<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $edit_resource = "edit_resource";
    
?>
<div class="tabbable-custom">
    <div class="tab-content">
        <div class="tab-pane active form" id="editModuleForm">
            <form action="<?php Zf_GenerateLinks::basic_internal_link("zvs_super_admin", "newResourcesRegistration", $edit_resource); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
                <div class="form-wizard" id="eidt_module_form">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#editInfo" data-toggle="tab" class="step active">
                                    <span class="number">
                                        1
                                    </span>
                                    <span class="desc progress-form-title">
                                        <i class="fa fa-check"></i> Edit Resource
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
                                

                                
                                    $resourceData = explode(ZVSS_CONNECT, $zf_model_data->zf_getEditResourceForm($zf_externalWidgetData)); 
                                    
                                    $editForm = $resourceData [0]; $resourceStatus = $resourceData [1];
                                    
                                    echo $editForm;
                                ?>    
                            </div>
                            <!-- END OF ADMINL SETUP FORM-->

                            <!-- START OF CONFIRM SETUP SECTION-->
                            <div class="tab-pane" id="confirmInfo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Resource Status:</label>
                                            <div class="col-md-6">
                                                <p class="form-control-static confirm-form-result" data-display="resourceStatus"></p>
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
                                        <?php echo $resourceStatus == 1 ? 'Deactivate':'Activate'; ?> <i class="m-icon-swapright m-icon-white"></i>
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