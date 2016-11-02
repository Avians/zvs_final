<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_payment_schedule = "fee_payment_schedule";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newFeeItemRegistration", $new_payment_schedule); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_payment_schedule_form">
    <div class="form-wizard" id="newPaymentSchedule">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newPaymentScheduleInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Configure Payment Schedule
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewPaymentScheduleInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Payment Schedule Details
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
                
                
                <!-- START OF ADMIN SETUP FORM-->
                <div class="tab-pane" id="newPaymentScheduleInfo">
                    <h3 class="form-section form-title">Payment Schedule Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Year:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me paymentYear" id="paymentYear" name="paymentYear" class="form-control" data-placeholder="Enter fee payment year: <?php echo $currentYear;?>" value="<?php echo $zf_formHandler->zf_getFormValue("paymentYear"); ?>">
                                        <option value=""></option>
                                        <?php Zf_Core_Functions::Zf_GenerateYearOption($currentYear+1, $currentYear);?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentYear") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Payment Period:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me paymentPeriod" id="paymentPeriod" name="paymentPeriod" data-placeholder="First Term, First Semester, ..." value="<?php echo $zf_formHandler->zf_getFormValue("studentStreamCode"); ?>">
                                            <option value=""></option>
                                        </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentPeriod") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">% Fee Proportion:</label>
                                <div class="col-md-8">
                                    <input type="text" name="paymentProportion" class="form-control" placeholder="50%, 30%, 20%, ..." value="<?php echo $zf_formHandler->zf_getFormValue("paymentProportion"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentProportion") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Schedule Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="paymentStatus" value="1" data-title="Active"> Active </label>
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="paymentStatus" value="0" checked  data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmNewPaymentScheduleInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Confirm Payment Schedule</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Payment year:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result" data-display="paymentYear"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Payment Period:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result"  data-display="paymentPeriod"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">% Fee Proportion:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result" data-display="paymentProportion"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Payment Status:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result"  data-display="paymentStatus"></p>
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
<!--                        <a href="javascript:;" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </a>-->
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