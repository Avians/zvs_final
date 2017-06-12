<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_transport_zone = "new_transport_zone";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("transport_module", "transport_Setup_Process", $new_transport_zone); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_transport_zone_form">
    <div class="form-wizard" id="newTransportZone">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newTransportZoneInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Transport Zone Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewTransportZoneInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Transport Zone Details
                        </span>
                    </a>
                </li>
            </ul>
            <div id="bar" class="progress progress-striped active progress-bar-radius" role="progressbar">
                <div class="progress-bar progress-bar-info progress-bar-radius" style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar"></div>
            </div>
            <div class="tab-content">
                <div class="alert alert-danger display-none">
                    <button class="close" data-dismiss="alert"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-none">
                    <button class="close" data-dismiss="alert"></button>
                    Your form validation is successful!
                </div>
                
                
                <!-- START OF LIBRARY SETUP FORM-->
                <div class="tab-pane" id="newTransportZoneInfo">
                    <h3 class="form-section form-title">New Transport Zone Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Zone Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportZoneName" class="form-control" placeholder="Zone 1, Zone 2, Zone 3, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportZoneName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportZoneName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Zone Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportZoneAlias" class="form-control" placeholder="Zone 1, Zone 2, Zone 3, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportZoneAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportZoneAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM ZONE SETUP SECTION-->
                <div class="tab-pane" id="confirmNewTransportZoneInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Transport Zone Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6">Transport Zone Name:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="transportZoneName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6">Transport Zone Alias:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="transportZoneAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                </div>
                <!-- END OF CONFIRM SETUP SECTION-->
                
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-5 col-md-7">
                        <a href="javascript:;" class="btn default button-previous">
                            <i class="m-icon-swapleft"></i> Back
                        </a>
                        <a href="javascript:;" class="btn blue button-next">
                            Continue <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                        <button type="submit" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>