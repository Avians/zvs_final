<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $create_budget = "create_new_budget";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("finance_module", "processBudgetInformation", $create_budget); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="create_budget_form">
    <div class="form-wizard" id="newBudget">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newBudgetInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Configure New Budget
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewBudgetInfo" data-toggle="tab" class="step">
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
                <div class="tab-pane" id="newBudgetInfo">
                    <h3 class="form-section form-title">New Budget Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me budgetCategoryCode" id="budgetCategoryCode" name="budgetCategoryCode" data-placeholder="Library, Laboratory, Salaries, ..." value="<?php echo $zf_formHandler->zf_getFormValue("budgetCategoryCode"); ?>">
                                        <?php
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "budget_category_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("budgetCategoryCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me budgetSubCategoryCode" id="budgetSubCategoryCode" name="budgetSubCategoryCode" data-placeholder="Books, Lab Chemicals, Class Seat, ... " value="<?php echo $zf_formHandler->zf_getFormValue("budgetSubCategoryCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("budgetSubCategoryCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                     <div class="clearfix"></div>
                    <div class="row margin-top-10">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Budget Year:</label>
                                <div class="col-md-8">
                                        <div class="input-group input-medium date-picker input-daterange" data-date="<?php echo $currentDate;?>" style="width: 277px !important;" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="budgetStartDate">
                                                <span class="input-group-addon">
                                                to </span>
                                                <input type="text" class="form-control" name="budgetEndDate">
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("budgetStartDate") ?>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Budget Amount:</label>
                                <div class="col-md-8">
                                    <input type="text" name="budgetAmount"  class="form-control currencyField" placeholder="2500, 30000, 45000" value="<?php echo $zf_formHandler->zf_getFormValue("budgetAmount"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("budgetAmount"); ?>
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
                <div class="tab-pane" id="confirmNewBudgetInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Attendance Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Attendance Label:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="attendanceName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Attendance Year:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="attendanceYear"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Start Date:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="attendanceStartDate"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">End Date:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="attendanceEndDate"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Attendance Status:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="attendanceStatus"></p>
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