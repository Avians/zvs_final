<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
   
    
    $new_resource = "new_resource";
    
?>
<form id="newResourceForm" action="<?php Zf_GenerateLinks::basic_internal_link("zvs_super_admin", "newResourcesRegistration", $new_resource); ?>" method="post" class="form-horizontal" >    
    <div class="row margin-top-10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
            <div class="portlet box zvs-content-blocks" style="min-height: 200px !important;">
                <div class="portlet-body form" >
                    <h3 class="form-section form-title" style="padding-top: 10px !important;">Assign Platform Resources to Platform Modules</h3>
                    <div class="row" style="margin-top: 50px !important;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Module:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me moduleOptions" id="moduleOptions" name="moduleNamePrefix" data-placeholder="Finance, Subject, Department, Class, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("moduleNamePrefix"); ?>">
                                        <?php
                                            $zf_widgetFolder = "zvs_super_admin";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, "modules_options.php");
                                        ?>
                                    </select>
                                     <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("moduleNamePrefix"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Resource Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="resourceName" class="form-control" placeholder="Finance, Subject, Department, Class, ..." value="<?php echo $zf_formHandler->zf_getFormValue("resourceName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("resourceName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2">Description:</label>
                                <div class="col-md-10">
                                    <textarea type="text" name="resourceDescription" class="form-control" id="summernote_1" placeholder="Resource Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    
   <div class="form-actions fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-offset-5 col-md-7">
                    <button type="submit" class="btn blue button-submit">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


