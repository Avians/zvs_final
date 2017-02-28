<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $allocate_finance = "allocate_finance";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("finance_module", "processBudgetInformation", $allocate_finance); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="allocate_finance_form">
    <div class="form-wizard" id="newFinanceAllocation">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newFinanceAllocationInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Configure New Budget
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmFinanceAllocationInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Budget Details
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
                <div class="tab-pane" id="newFinanceAllocationInfo">
                    <h3 class="form-section form-title">New Budget Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Financial Year:</label>
                                <div class="col-md-7">
                                    <select class="form-control select2me financialYearCode" id="financialYearCode" name="financialYearCode" data-placeholder="<?php echo $currentDate."/".$currentDate+1;?> - Financial year" value="<?php echo $zf_formHandler->zf_getFormValue("financialYearCode"); ?>">
                                        <?php
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "financial_years_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("financialYearCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budget Category:</label>
                                <div class="col-md-7">
                                    <select class="form-control select2me budgetCategoryCode" id="budgetCategoryCode" name="budgetCategoryCode" data-placeholder="Health, Library, Kitchen, Laboratory..." value="<?php echo $zf_formHandler->zf_getFormValue("budgetCategoryCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("budgetCategoryCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budget Sub Category:</label>
                                <div class="col-md-7">
                                    <select class="form-control select2me budgetSubCategoryCode" id="budgetSubCategoryCode" name="budgetSubCategoryCode" data-placeholder="Books, Lab Chemicals, Class Seat, ... " value="<?php echo $zf_formHandler->zf_getFormValue("budgetSubCategoryCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("budgetSubCategoryCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budgeted Amount:</label>
                                <div class="col-md-7">
                                    <input type="text" name="allocatedAmount"  class="form-control currencyField" placeholder="2500, 30000, 45000" value="<?php echo $zf_formHandler->zf_getFormValue("allocatedAmount"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("allocatedAmount"); ?>
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
                <div class="tab-pane" id="confirmFinanceAllocationInfo">
                    <h3 class="block  form-title"><i class='fa fa-money' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Budget Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Financial Year:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result" data-display="financialYearCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budget Category:</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result"  data-display="budgetCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budget Sub Category</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result" data-display="budgetSubCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Budgeted Amount</label>
                                <div class="col-md-7">
                                    <p class="form-control-static confirm-form-result"  data-display="allocatedAmount"></p>
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