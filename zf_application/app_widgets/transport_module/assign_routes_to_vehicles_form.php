<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $assign_routes = "assign_routes";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("transport_module", "transport_Vehicles_Process", $assign_routes); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="assign_routes_form">
    <div class="form-wizard" id="assignRoutes">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#assignRoutesInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Assign Routes to Vehicles
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmAssignRoutesInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Routes Details
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
                
                
                <!-- START OF SUBJECT ASSIGNMENT SETUP FORM-->
                <div class="tab-pane" id="assignRoutesInfo">
                    <h3 class="form-section form-title">Routes Assignment Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Vehicle:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="transportVehicleCodeRoute" data-placeholder="" value="<?php echo $zf_formHandler->zf_getFormValue("transportVehicleCodeRoute"); ?>">
                                        <?php
                            
                                            //Create a concatenated parameter, what will later be exploded
                                            $zvs_parameter = $identificationCode.ZVSS_CONNECT."assign_routes";

                                            //Here we pull all the available school transport routes 
                                            Zf_ApplicationWidgets::zf_load_widget("transport_module", "process_transport_vehicles.php", $zvs_parameter);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("transportVehicleCodeRoute") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row margin-top-10">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning">
                                <button class="close" data-dismiss="alert"></button>
                                <b>Select all routes that will be plied or served by the selected vehicle</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            //Here we pull all the available school transport routes 
                            Zf_ApplicationWidgets::zf_load_widget("transport_module", "process_transport_routes.php", $identificationCode);
                        ?>
                    </div>
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    <!--/row-->
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmAssignRoutesInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Route Assignment Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vehicle Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transportVehicleCodeRoute"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--row-->
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
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>