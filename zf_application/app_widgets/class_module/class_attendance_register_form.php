<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $class_attendance_register = "class_attendance_register";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("class_module", "processClassAttendance", $class_attendance_register ); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="class_attendance_register_form">
    <div class="form-wizard" id="attendanceRegister">
        <div class="form-body">
            <div class="row margin-top-10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-info">
                        <button class="close" data-dismiss="alert"></button>
                        <b>In order to mark a class attendance for a particular day, first select the class name from the drop-down, then select the corresponding stream. Fill in the calendar date for attendance, then a class list will populate.</b>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#attendanceRegisterInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Class Attendance Register
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmAttendanceRegisterInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Class Register
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
                
                
                <!-- START OF SUBJECT ASSIGNMENT SETUP FORM-->
                <div class="tab-pane" id="attendanceRegisterInfo">
                    <!--This is the section for selecting student-->
                    <div class="row" style="margin-top: -10px !important;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 160px !important; height: auto !important;">
                                        <div class="portlet-titles">Student Class Details</div>
                                        <div class="row" style="margin-top: 20px !important;">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Select Class:</label>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <select class="form-control select2me schoolClassCode" id="schoolClassCode" name="schoolClassCode" data-placeholder="Form 1 or Class 1, Form 2 or Class 2, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolClassCode"); ?>">
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
                                        </div>
                                        <div class="row clearfix"><br /></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Stream Name:</label>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <select class="form-control select2me classStreamCode" id="classStreamCode" name="classStreamCode" data-placeholder="East, West, North, South, ..." value="<?php echo $zf_formHandler->zf_getFormValue("classStreamCode"); ?>">
                                                            <option value=""></option>
                                                        </select>
                                                        <span class="help-block server-side-error" >
                                                            <?php echo $zf_formHandler->zf_getFormError("classStreamCode") ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="portlet-titles">Attendance Date.</div>
                                        <div class="row" style="margin-top: 20px !important;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Select Date:</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-medium date date-picker" data-date="<?php echo $currentDate;?>" style="width: 277px !important;" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                            <input type="text" class="form-control attendanceDate" id="attendanceDate" name="attendanceDate" readonly value="<?php echo $currentDate; ?>" >
                                                            <span class="input-group-btn">
                                                                <button class="btn default calendarBtn" type="button"><i class="fa fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                        <span class="help-block server-side-error">
                                                            <?php echo $zf_formHandler->zf_getFormError("attendanceDate") ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start of the actual attendance sheet-->
                    <div class="row" class="row margin-top-10">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="attendanceListContainer" style="margin-bottom: -5px !important;">
                            <div class="row" id="classListDetails">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks col-md-12" class="zvs_preloader" align="center">
                                        <div class="zvs_loader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of the actual attendance sheet-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    <!--/row-->
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmAttendanceRegisterInfo">
                    
                    <h4 class="form-section confirm-inner-title">Confirm Register Information</h4>
                    <div class="row" style="margin-top: -10px !important;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
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
                                                <p class="form-control-static confirm-form-result" data-display="classStreamCode"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--row-->


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Attendance Date:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static confirm-form-result" data-display="attendanceDate"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--row-->
                            </div>
                        </div>
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
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>