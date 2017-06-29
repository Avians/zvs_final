<?php
    
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_vendor_settings_form = "new_vendor_settings_form";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "ProcessPaymentInformation", $new_vendor_settings_form); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_vendor_settings_form">
    <div class="form-wizard" id="newVendorSettingsForm">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newVendorSettingsFormInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Vendor Settings Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewVendorSettingsFormInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Settings Details
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
                <div class="tab-pane" id="newVendorSettingsFormInfo">
                    <h3 class="form-section form-title">Vendor Settings Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Categories:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolVendorSettingsCategoryCode" id="schoolVendorSettingsCategoryCode" name="schoolVendorCategoryCode" data-placeholder="Bank, Mobile Money, Card, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolVendorCategoryCode"); ?>">
                                        <?php
                                            //Here we pull all the available school payment categories 
                                            Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "process_vendor_payment_categories.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolVendorCategoryCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolVendorSettingsPaymentCode" id="schoolVendorSettingsPaymentCode" name="schoolPaymentVendorCode" data-placeholder="Safaricom, Equity, KCB, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolPaymentVendorCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolPaymentVendorCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Line:</label>
                                <div class="col-md-8">
                                    <input type="text" name="accountLineName" class="form-control" placeholder="Bank Account, Paybill, E-Wallet,..." value="<?php echo $zf_formHandler->zf_getFormValue("accountLineName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("accountLineName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="accountLineAlias" class="form-control" placeholder="Bank Account, Paybill, E-Wallet,..." value="<?php echo $zf_formHandler->zf_getFormValue("accountLineAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("accountLineAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                </div>
                <!-- END OF ADMIN SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmNewVendorSettingsFormInfo">
                    <h3 class="form-section form-title">Confirm Settings Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Category:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolVendorCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolPaymentVendorCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Line:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="accountLineName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="accountLineAlias"></p>
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

