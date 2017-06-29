<?php

    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_payment_account_form = "new_payment_account_form";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "ProcessPaymentInformation", $new_payment_account_form); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_payment_account_form">
    <div class="form-wizard" id="newPaymentAccountForm">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newPaymentAccountFormInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Payment Account Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewPaymentAccountFormInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Account Details
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
                <div class="tab-pane" id="newPaymentAccountFormInfo">
                    <h3 class="form-section form-title">Payment Account Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Categories:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolVendorAccountCategoryCode" id="schoolVendorAccountCategoryCode" name="schoolVendorCategoryCode" data-placeholder="Bank, Mobile Money, Card, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolVendorCategoryCode"); ?>">
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
                                    <select class="form-control select2me schoolVendorAccountPaymentCode" id="schoolVendorAccountPaymentCode" name="schoolPaymentVendorCode" data-placeholder="Safaricom, Equity, KCB, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolPaymentVendorCode"); ?>">
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
                                    <select class="form-control select2me schoolVendorAccountLineCode" id="schoolVendorAccountLineCode" name="schoolVendorAccountLineCode" data-placeholder="Bank Account, Paybill, Card, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolVendorAccountLineCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolVendorAccountLineCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="accountName" class="form-control" placeholder="Bank/Paybill Account Name,..." value="<?php echo $zf_formHandler->zf_getFormValue("accountName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("accountName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="accountNumber" class="form-control" placeholder="Bank/Paybill Account Number,..." value="<?php echo $zf_formHandler->zf_getFormValue("accountNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("accountNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Branch (Optional):</label>
                                <div class="col-md-8">
                                    <input type="text" name="accountBranch" class="form-control" placeholder="Bank Branch,..." value="<?php echo $zf_formHandler->zf_getFormValue("accountBranch"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("accountBranch"); ?>
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
                <div class="tab-pane" id="confirmNewPaymentAccountFormInfo">
                    <h3 class="form-section form-title">Confirm Account Information</h3>
                    
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
                                    <p class="form-control-static confirm-form-result" data-display="schoolVendorAccountLineCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="accountName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="accountNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Account Branch:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="accountBranch"></p>
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

