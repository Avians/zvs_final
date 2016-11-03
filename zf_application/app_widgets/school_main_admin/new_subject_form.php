<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_subject = "new_subject";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newSubjectRegistration", $new_subject); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_subject_form">
    <div class="form-wizard" id="newSubject">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newSubjectInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> New Subject Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewSubjectInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Subject Details
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
                <div class="tab-pane" id="newSubjectInfo">
                    <h3 class="form-section form-title">New Subject Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="subjectName" class="form-control" placeholder="Mathematics, English, Biology, ..." value="<?php echo $zf_formHandler->zf_getFormValue("subjectName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("subjectName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="subjectAlias" class="form-control" placeholder="Mathematics, English, Biology, ..." value="<?php echo $zf_formHandler->zf_getFormValue("subjectAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("subjectAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Code:</label>
                                <div class="col-md-8">
                                    <input type="text" name="subjectCode" class="form-control" placeholder="101, 201, 301, ..." value="<?php echo $zf_formHandler->zf_getFormValue("subjectCode"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("subjectCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="subjectStatus" value="1" data-title="Active"> Active </label>
                                        <label class="radio-inline radio-labels">
                                        <input type="radio" name="subjectStatus" value="0" checked  data-title="Inactive"> Inactive </label>
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
                <div class="tab-pane" id="confirmNewSubjectInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Subject/Dormitory Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="subjectName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="subjectAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Code:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="subjectCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Subject Status:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="subjectStatus"></p>
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