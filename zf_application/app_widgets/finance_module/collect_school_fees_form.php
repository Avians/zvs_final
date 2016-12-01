<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $collect_fees = "collect_fees";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>  

<form action="<?php Zf_GenerateLinks::basic_internal_link("finance_module", "processFeeInformation", $collect_fees); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="collectFees_form">
    <div class="form-wizard" id="collectFees">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#collectFeesInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Collect School Fees
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmCollectFeesInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Fees Details
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
                <div class="tab-pane" id="collectFeesInfo">
                    <h3 class="form-section form-title">Student Fees Details</h3>
                    
                    <!--Here is an auto-generated form with student details-->
                    <div id="studentformData"></div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Year:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me paymentYear" id="paymentYear" name="paymentScheduleYear" class="form-control" data-placeholder="Enter fee payment year: <?php echo $currentYear;?>" value="<?php echo $zf_formHandler->zf_getFormValue("paymentScheduleYear"); ?>">
                                        <option value=""></option>
                                        <?php Zf_Core_Functions::Zf_GenerateYearOption($currentYear+1, $currentYear-2);?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentScheduleYear") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Payment Period:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me paymentPeriod" id="paymentPeriod" name="paymentScheduleName" data-placeholder="First Term, First Semester, ..." value="<?php echo $zf_formHandler->zf_getFormValue("paymentScheduleName"); ?>">
                                            <option value=""></option>
                                        </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentScheduleName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount Paid:</label>
                                <div class="col-md-8">
                                    <input type="text" name="paymentAmount" class="form-control" placeholder="2500, 30000, 45000" value="<?php echo $zf_formHandler->zf_getFormValue("paymentAmount"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("paymentAmount"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmCollectFeesInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Fees Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">School Fees Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Full  Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="studentFullName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admission No:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="studentAdmissionNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Student Class:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="studentClassName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Student Stream:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="studentStreamName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Selected Year:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="paymentScheduleYear"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Payment Period:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="paymentScheduleName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount Paid:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="paymentAmount"></p>
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
                        <a href="javascript:;" class="btn default button-previous" id="button-previous">
                            <i class="m-icon-swapleft"></i> Back
                        </a>
                        <a href="javascript:;" class="btn blue button-next" id="button-next">
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