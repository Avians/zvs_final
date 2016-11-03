<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_feeItem = "new_feeItem";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>  

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newFeeItemRegistration", $new_feeItem); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_feeItem_form">
    <div class="form-wizard" id="newFeeItem">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newFeeItemInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> School Fees Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewFeeItemInfo" data-toggle="tab" class="step">
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
                <div class="tab-pane" id="newFeeItemInfo">
                    <h3 class="form-section form-title">Select Year &AMP; Category</h3>
                    
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; ">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select fees year:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="feeItemYear" class="form-control" data-placeholder="Enter fees year: <?php echo $currentYear;?>" value="<?php echo $zf_formHandler->zf_getFormValue("feeItemYear"); ?>">
                                        <option value=""></option>
                                        <?php Zf_Core_Functions::Zf_GenerateYearOption($currentYear+1, $currentYear);?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("feeItemYear") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="control-label" style="text-align: left !important; margin-left: 5% !important;"><u>Select the scope of school fees being set</u></div>
                                <div class="col-md-6">
                                    <div class="radio-list">
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" id="generalFeesButton" name="feeCategory" value="generalFees" data-title="General Fees" class="radio-buttons" checked="checked"> General Fees </label>
                                    </div>
                                </div>
                                <div class="col-md-6 center">
                                    <div class="radio-list">
                                        <label class="radio-inline  radio-labels">
                                        <input type="radio" id="classFeesButton" name="feeCategory" value="classFees" data-title="Specific Exam Mode"  class="radio-buttons"> Class Fees </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div id="generalSchoolFees">
                        <h3 class="form-section form-title">General School Fees</h3>
                    </div>
                    
                    <div id="classSpecificFees">
                    
                        <h3 class="form-section form-title">Class School Fees</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Select Class:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me" name="schoolClassCode" data-placeholder="Form 1 or Class 1, Form 2 or Class 2, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolClassCode"); ?>">
                                            <?php
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "class_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("schoolClassCode") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"> Fee Item:</label>
                                <div class="col-md-8">
                                    <input type="text" name="feeItem" class="form-control" placeholder="Tuition, Medical, Accommodation, ...." value="<?php echo $zf_formHandler->zf_getFormValue("feeItem"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("feeItem") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"> Item Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="itemAlias" class="form-control" placeholder="Tuition, Medical, Accommodation, ...." value="<?php echo $zf_formHandler->zf_getFormValue("itemAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("itemAlias") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Fee Amount:</label>
                                <div class="col-md-8">
                                    <input type="text" name="itemAmount" class="form-control" placeholder="2500, 3000.50, 7000,...." value="<?php echo $zf_formHandler->zf_getFormValue("itemAmount"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("itemAmount") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Item Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="itemStatus" value="1" data-title="Active"> Active </label>
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="itemStatus" value="0"  checked data-title="Inactive"> Inactive </label>
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
                <div class="tab-pane" id="confirmNewFeeItemInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">School Fees Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Fee Year:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="feeItemYear"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Selected Class:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolClassCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Fee Item:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="feeItem"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Item Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="itemAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Fee Amount:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="itemAmount"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Item Status:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result" data-display="itemStatus"></p>
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