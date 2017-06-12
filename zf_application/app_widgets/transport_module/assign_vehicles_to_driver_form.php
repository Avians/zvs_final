<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $assign_vehicles = "assign_vehicles";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("transport_module", "transport_Drivers_Process", $assign_vehicles); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="assign_vehicles_form">
    <div class="form-wizard" id="assignVehicles">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#assignVehiclesInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Assign Vehicles to Driver
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmAssignVehiclesInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Driver Details
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
                <div class="tab-pane" id="assignVehiclesInfo">
                    <h3 class="form-section form-title">Vehicles Assignment Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Role:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolRoleCode" id="schoolRoleCode" name="schoolRoleCode" data-placeholder="" value="<?php echo $zf_formHandler->zf_getFormValue("schoolRoleCode"); ?>">
                                        <?php
                                            //Here we fetch all available school roles
                                            Zf_ApplicationWidgets::zf_load_widget("zvs_options", "role_select.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolRoleCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Driver:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me staffIdentificationCode" id="staffIdentificationCode" name="staffIdentificationCode" data-placeholder="Driver Full Name" value="<?php echo $zf_formHandler->zf_getFormValue("staffIdentificationCode"); ?>">
                                        <option value="selectVehicleDriver">Select a vehicle driver</option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("staffIdentificationCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row margin-top-10">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning">
                                <button class="close" data-dismiss="alert"></button>
                                <b>Form the vehicles listed below, select any that can be driven by the selected school staff (driver).</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            
                            //Create a concatenated parameter, what will later be exploded
                            $zvs_parameter = $identificationCode.ZVSS_CONNECT."assign_vehicles";
                                    
                            //Here we pull all the available school transport routes 
                            Zf_ApplicationWidgets::zf_load_widget("transport_module", "process_transport_vehicles.php", $zvs_parameter);
                        ?>
                    </div>
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    <!--/row-->
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmAssignVehiclesInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Vehicle Assignment Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Role Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolRoleCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Driver Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="staffIdentificationCode"></p>
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