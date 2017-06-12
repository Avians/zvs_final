<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_transport_vehicle = "new_transport_vehicle";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("transport_module", "transport_Vehicles_Process", $new_transport_vehicle); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_transport_vehicle_form">
    <div class="form-wizard" id="newTransportVehicle">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newTransportVehicleInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Transport Vehicle Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewTransportVehicleInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Transport Vehicle Details
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
                <div class="tab-pane" id="newTransportVehicleInfo">
                    <h3 class="form-section form-title">New Transport Vehicle Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vehicle Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportVehicleName" class="form-control" placeholder="Van, Mini-bus, School Bus, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportVehicleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportVehicleName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Registration No:</label>
                                <div class="col-md-8">
                                    <input type="text" name="vehicleRegistrationNumber" class="form-control" placeholder="Vehicle Registration Number" value="<?php echo $zf_formHandler->zf_getFormValue("vehicleRegistrationNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("vehicleRegistrationNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vehicle Capacity:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transportVehicleCapacity" class="form-control" placeholder="14, 21, 27, 33, 45, ...." value="<?php echo $zf_formHandler->zf_getFormValue("transportVehicleCapacity"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transportVehicleCapacity"); ?>
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
                <div class="tab-pane" id="confirmNewTransportVehicleInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Transport Vehicle Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6">Vehicle Name:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="transportVehicleName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6">Registration No:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="vehicleRegistrationNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6">Vehicle Capacity:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="transportVehicleCapacity"></p>
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