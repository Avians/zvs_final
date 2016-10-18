<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_marksheet = "new_marksheet";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newMarksheetRegistration", $new_marksheet); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_marksheet_form">
    <div class="form-wizard" id="newMarksheet">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newMarksheetInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Marksheet Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewMarksheetInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Marksheet Details
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
                <div class="tab-pane" id="newMarksheetInfo">
                    <h3 class="form-section form-title">New Marksheet Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Label:</label>
                                <div class="col-md-8">
                                    <input type="text" name="gradeName" class="form-control" placeholder="A,  A-,  B+,  B,  B-, ..." value="<?php echo $zf_formHandler->zf_getFormValue("gradeName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("gradeName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="gradeAlias" class="form-control" placeholder="A plain, B plus, B plain, ...." value="<?php echo $zf_formHandler->zf_getFormValue("gradeAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("gradeAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Points:</label>
                                <div class="col-md-8">
                                    <input type="text" name="gradePoints" class="form-control" placeholder="12, 10, 8, 6, ...." value="<?php echo $zf_formHandler->zf_getFormValue("gradePoints"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("gradePoints") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Comments:</label>
                                <div class="col-md-8">
                                    <textarea type="text" name="gradeComments" class="form-control" placeholder="Excellent, Good, Fair, Pass, ..." value="<?php echo $zf_formHandler->zf_getFormValue("gradeComments");?>" rows="1" ></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("gradeComments"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="gradeStatus" value="1" data-title="Active"> Active </label>
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="gradeStatus" value="0" checked  data-title="Inactive"> Inactive </label>
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
                <div class="tab-pane" id="confirmNewMarksheetInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Marksheet Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Label:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="gradeName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="gradeAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Points:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="gradePoints"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Comments:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="gradeComments"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Grade Status:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="gradeStatus"></p>
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