<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_student = "new_student";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("student_module", "newStudentRegistration", $new_student); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_stream_form">
    <div class="form-wizard" id="newStream">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newStreamInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> New Student Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewStreamInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Student Details
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
                <div class="tab-pane" id="newStreamInfo">
                    
                    <!-- START STUDENT DETAILS-->
                    <h3 class="form-section form-title">Student Details</h3>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="streamName" class="form-control" placeholder="East, West, North, South,...." value="<?php echo $zf_formHandler->zf_getFormValue("streamName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("streamName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <!-- END OF STUDENT DETAILS-->
                   
                    
                    <!-- START PARENT DETAILS-->
                    <h3 class="form-section form-title">Parent Details</h3>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="streamName" class="form-control" placeholder="East, West, North, South,...." value="<?php echo $zf_formHandler->zf_getFormValue("streamName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("streamName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <!-- END PARENT DETAILS-->
                    
                    
                    <!-- START MEDICAL DETAILS-->
                    <h3 class="form-section form-title">Medical Details</h3>
                    <!-- END MEDICAL DETAILS-->
                    
                    
                    <!-- START CLASS DETAILS-->
                    <h3 class="form-section form-title">Class Details</h3>
                    <!-- END CLASS DETAILS-->
                    
                    
                    <!-- START HOSTEL DETAILS-->
                    <h3 class="form-section form-title">Hostel Details</h3>
                    <!-- END HOSTEL DETAILS-->
                    
                    
                    <!-- START LOGIN DETAILS-->
                    <h3 class="form-section form-title">Login Details</h3>
                    <!-- END LOGIN DETAILS-->
                    
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmNewStreamInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Stream Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Class Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolClassCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="streamName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Capacity:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="streamCapacity"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--row-->
                    
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