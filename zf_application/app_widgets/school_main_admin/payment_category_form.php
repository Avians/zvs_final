<?php
    
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_payment_category_form = "new_payment_category_form";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "ProcessPaymentInformation", $new_payment_category_form); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_payment_category_form">
    <div class="form-wizard" id="newPaymentCategoryForm">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newPaymentCategoryFormInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> New Category Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewPaymentCategoryFormInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Category Details
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
                
                
                <!-- START OF PAYMENT CATEGORY FORM-->
                <div class="tab-pane" id="newPaymentCategoryFormInfo">
                    <h3 class="form-section form-title">Payment Category Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Category Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="categoryName" class="form-control" placeholder="Bank, Mobile Money, E-Wallet, Card ..." value="<?php echo $zf_formHandler->zf_getFormValue("categoryName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("categoryName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Category Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="categoryAlias" class="form-control" placeholder="Bank, Mobile Money, E-Wallet, Card ..." value="<?php echo $zf_formHandler->zf_getFormValue("categoryAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("categoryAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                </div>
                <!-- END OF PAYMENT CATEGORY FORM-->
                
                <!-- START OF CONFIRM PAYMENT CATEGORY SECTION-->
                <div class="tab-pane" id="confirmNewPaymentCategoryFormInfo">
                    <h3 class="form-section form-title">Confirm Category Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Category Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="categoryName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Category Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="categoryAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                </div>
                <!-- END OF CONFIRM PAYMENT CATEGORY SECTION-->
                
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

