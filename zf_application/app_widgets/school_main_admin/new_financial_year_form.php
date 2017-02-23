<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_financial_year = "new_financial_year";

    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newFinancialYearRegistration", $new_financial_year); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_financial_year_form">
    <div class="form-wizard" id="newFinancialYear">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newFinancialYearInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Financial Year Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewFinancialYearInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Financial Year Details
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
                <div class="tab-pane" id="newFinancialYearInfo">
                    <h3 class="form-section form-title">New Financial Year Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Financial Year:</label>
                                <div class="col-md-8">
                                        <div class="input-group input-medium date-picker input-daterange" data-date="<?=$currentYear;?>" style="width: 277px !important;" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="financialYearStartDate">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="financialYearEndDate">
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("financialYearStartDate") ?>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Alias Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="financialYearAlias" class="form-control" placeholder="E.g. <?=$currentYear;?> Financial Year, ...." value="<?php echo $zf_formHandler->zf_getFormValue("financialYearAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("financialYearAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmNewFinancialYearInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Financial Year Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Start Date:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="financialYearStartDate"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">End Date:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="financialYearEndDate"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Alias Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="financialYearAlias"></p>
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