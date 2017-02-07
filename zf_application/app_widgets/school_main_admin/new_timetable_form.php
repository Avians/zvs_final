<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_attendance = "new_attendance";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newAttendanceRegistration", $new_attendance); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_attendance_form">
    <div class="form-wizard" id="newAttendance">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newAttendanceInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Configure Timetable
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewAttendanceInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Timetable Details
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
                <div class="tab-pane" id="newAttendanceInfo">
                    <h3 class="form-section form-title">New Timetable Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Week Day:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="timeTableWeekDay" class="form-control" data-placeholder="Select week day e.g. <?php echo date("l");?>" value="<?php echo $zf_formHandler->zf_getFormValue("timeTableWeekDay"); ?>">
                                        <option value=""></option>
                                        <?=Zf_Core_Functions::Zf_generateWeekDays();?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("timeTableWeekDay") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Timetable Year:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="timeTableYear" class="form-control" data-placeholder="Select Time Year: <?php echo $currentYear;?>" value="<?php echo $zf_formHandler->zf_getFormValue("timeTableYear"); ?>">
                                        <option value=""></option>
                                        <?php Zf_Core_Functions::Zf_GenerateYearOption($currentYear+1, $currentYear);?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("timeTableYear") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Class:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me timeTableClassCode" id="timeTableClassCode" name="timeTableClassCode" data-placeholder="Form 1 or Class 1, Form 2 or Class 2, ..." value="<?php echo $zf_formHandler->zf_getFormValue("timeTableClassCode"); ?>">
                                            <?php
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "class_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("timeTableClassCode") ?>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Name:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me timeTableStreamCode" id="timeTableStreamCode" name="timeTableStreamCode" data-placeholder="East, West, North, South, ..." value="<?php echo $zf_formHandler->zf_getFormValue("timeTableStreamCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("timeTableStreamCode") ?>
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
                <div class="tab-pane" id="confirmNewAttendanceInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Timetable Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Week Day:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="timeTableWeekDay"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Timetable Year:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="timeTableYear"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Class:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="timeTableClassCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="timeTableStreamCode"></p>
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