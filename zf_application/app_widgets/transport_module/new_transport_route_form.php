<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_transport_route = "new_transport_route";;
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("transport_module", "transport_Setup_Process", $new_transport_route); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_transport_route_form">
    <div class="form-wizard" id="newTransportRoute">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newTransportRouteInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Transport Route Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewTransportRouteInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Transport Route Details
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
                <div class="tab-pane" id="newTransportRouteInfo">
                    <h3 class="form-section form-title">New Transport Route Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Transport Zone:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me transportZoneCodeTransportRoute" id="transportZoneCodeTransportRoute" name="transportZoneCode" data-placeholder="Zone 1, Zone 2, Zone 3,..." value="<?php echo $zf_formHandler->zf_getFormValue("transportZoneCode"); ?>">
                                        <?php
                                            //Here we pull all the transport zones 
                                            Zf_ApplicationWidgets::zf_load_widget("transport_module", "process_transport_zones.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportZoneCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Route Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportRouteName" class="form-control" placeholder="Route 1, Route 2, Route 3, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportRouteName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportRouteName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Route Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportRouteAlias" class="form-control" placeholder="Route 1, Route 2, Route 3, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportRouteAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportRouteAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM LIBRARY SETUP SECTION-->
                <div class="tab-pane" id="confirmNewTransportRouteInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Transport Route Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Zone Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transportZoneCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Route Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transportRouteName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Route Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transportRouteAlias"></p>
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