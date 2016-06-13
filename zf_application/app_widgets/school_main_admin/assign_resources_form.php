<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
   
    
    $assignResources = "mapResources";
    
    $manageResourcesParameters = $identificationCode.ZVSS_CONNECT.$assignResources;
    
    $schoolSystemCode = $zf_externalWidgetData;
    
?>
<form id="subjectUpdateForm" action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newResourcesRolesMapper", $manageResourcesParameters); ?>" method="post" class="form-horizontal" >    
    
    <div class="row margin-top-10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
            <div class="portlet box zvs-content-blocks" style="min-height: 200px !important;">
                <div class="portlet-body form" >
                    <h3 class="form-section form-title" style="padding-top: 10px !important;">Assign Platform Resources to School Roles</h3> 
                    <div class="alert alert-info">
                        <button class="close" data-dismiss="alert"></button>
                        Select a role from available school roles and assign available platform resources to the selected role.
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; padding-top: 30px !important;">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select School Role:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me roleOptions" id="roleOptions" name="schoolRoleId" data-placeholder="Principal, Bursar, Teacher, Parent ...."  value="<?php echo $zf_formHandler->zf_getFormValue("schoolRoleId"); ?>">
                                        <?php
                                            $zf_widgetFolder = "school_main_admin";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, "roles_options.php", $schoolSystemCode);
                                        ?>
                                    </select>
                                     <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolRoleId"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12" style="padding-top: 30px !important;">
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-2">
                                            <div class="checkbox-list activateAllSubjects">
                                                <label class="checkbox-inline">
                                                    <input id="activateAllSubjects" type="checkbox" name="activateAllSubjects" value="1">&nbsp;Activate all inactive subjects</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    
    <h3 class="form-section form-title">Select resources to assign a role</h3>
    
    <div class="row">
        <?php
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, "pull_platform_resources.php", $schoolSystemCode);
        ?>    
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


