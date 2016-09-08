<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_student = "new_student";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    //echo $currentDate;
    
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
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="firstName" class="form-control" placeholder="First Name" value="<?php echo $zf_formHandler->zf_getFormValue("firstName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("firstName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="middleName" class="form-control" placeholder="Middle Name" value="<?php echo $zf_formHandler->zf_getFormValue("middleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("middleName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="<?php echo $zf_formHandler->zf_getFormValue("lastName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("lastName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Gender Name:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input type="radio" name="gender" value="Male" checked data-title="Male"> Male </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="gender" value="Female"  data-title="Female"> Female </label>
                                    </div>
				</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Date of Birth:</label>
                                <div class="col-md-8">
                                    <div class="input-group input-medium date date-picker" data-date="<?php echo $currentDate;?>" style="width: 270px !important;" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control" readonly value="<?php echo $currentDate; ?>" >
                                        <span class="input-group-btn">
                                            <button class="btn default calendarBtn" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Religion:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me studentReligion" id="studentReligion" name="studentReligion" data-placeholder="Christian, Hindu, Muslim, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("studentReligion"); ?>">
                                        <?php
                                            //This widget creates select options for religions
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "religion_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("studentReligion") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Country:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me studentCountry" id="studentCountry" name="studentCountry" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("studentCountry"); ?>">
                                        <?php
                                            //This widget creates select options for countires
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "countries_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("studentCountry") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Locality:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me studentLocality" id="studentLocality" name="studentLocality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("studentLocality"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentLocality") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Box Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="boxAddress" class="form-control" placeholder="P.O Box 1111-0111, Nairobi - Kenya" value="<?php echo $zf_formHandler->zf_getFormValue("boxAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("boxAddress"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Phone Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="phoneNumber" class="form-control" placeholder="0711111111" value="<?php echo $zf_formHandler->zf_getFormValue("phoneNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("phoneNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Official Language:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me studentLanguage" id="studentLanguage" name="studentLanguage" data-placeholder="English, French, Spanish ..."  value="<?php echo $zf_formHandler->zf_getFormValue("studentLanguage"); ?>">
                                        <?php
                                            //This widget creates select options for languages
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "languages_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("studentLanguage") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Photo:</label>
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