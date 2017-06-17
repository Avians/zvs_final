<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_staff = "new_staff";
    
    $currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    $currentYear = explode("-", $currentDate)[2];
    
    //echo $currentYear;
    
    //echo $identificationCode."<br/>_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k";
    
    $registeredBy = $identificationCode;
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("staff_module", "ProcessStaffInformation", $new_staff); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_staff_form">
    <div class="form-wizard" id="newStaff">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newStaffInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> New Staff Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewStaffInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Staff Details
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
                    <div class="tab-pane" id="newStaffInfo">
                        
                     <!-- START STAFF DETAILS-->
                        <h3 class="form-section block form-title">New Staff Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">First Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffFirstName" class="form-control" placeholder="First Name" value="<?php echo $zf_formHandler->zf_getFormValue("staffFirstName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffFirstName"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Middle Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffMiddleName" class="form-control" placeholder="Middle Name" value="<?php echo $zf_formHandler->zf_getFormValue("staffMiddleName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffMiddleName"); ?>
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
                                        <input type="text" name="staffLastName" class="form-control" placeholder="Last Name" value="<?php echo $zf_formHandler->zf_getFormValue("staffLastName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffLastName"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Staff ID Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffIdNumber" class="form-control" placeholder="2513801222, 12345678, 000001, ..." value="<?php echo $zf_formHandler->zf_getFormValue("staffIdNumber"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffIdNumber"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Staff Gender:</label>
                                    <div class="col-md-8">
                                        <div class="radio-list">
                                            <label class="radio-inline radio-labels">
                                            <input type="radio" name="staffGender" value="Male" checked data-title="Male"> Male </label>
                                            <label class="radio-inline radio-labels">
                                            <input type="radio" name="staffGender" value="Female"  data-title="Female"> Female </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Marital Status:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me staffMaritalStatus" id="staffMaritalStatus" name="staffMaritalStatus" data-placeholder="Single, Married, Divorced, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("staffMaritalStatus"); ?>">
                                            <?php
                                                //This widget creates select options for religions
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "marital_status_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("staffMaritalStatus") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Date of Birth:</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-medium date date-picker" data-date="<?php echo $currentDate;?>" style="width: 277px !important;" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" class="form-control" name="staffDateOfBirth" readonly value="<?php echo $currentDate; ?>" >
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
                                        <select class="form-control select2me staffReligion" id="staffReligion" name="staffReligion" data-placeholder="Christian, Hindu, Muslim, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("staffReligion"); ?>">
                                            <?php
                                                //This widget creates select options for religions
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "religion_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("staffReligion") ?>
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
                                        <select class="form-control select2me staffCountry" id="staffCountry" name="staffCountry" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("staffCountry"); ?>">
                                            <?php
                                                //This widget creates select options for countires
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "countries_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("staffCountry") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Locality:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me staffLocality" id="staffLocality" name="staffLocality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("staffLocality"); ?>">
                                            <option value=""></option>
                                        </select>
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffLocality") ?>
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
                                        <input type="text" name="staffBoxAddress" class="form-control" placeholder="P.O Box 1111-0111, Nairobi - Kenya" value="<?php echo $zf_formHandler->zf_getFormValue("staffBoxAddress"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffBoxAddress"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffPhoneNumber" class="form-control" placeholder="0711111111" value="<?php echo $zf_formHandler->zf_getFormValue("staffPhoneNumber"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffPhoneNumber"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Staff Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffAdmissionNumber" class="form-control" placeholder="001, 002, ABC-001, ABC-002,..." value="<?php echo $zf_formHandler->zf_getFormValue("staffAdmissionNumber"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffAdmissionNumber"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Official Language:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me staffLanguage" id="staffLanguage" name="staffLanguage" data-placeholder="English, French, Spanish ..."  value="<?php echo $zf_formHandler->zf_getFormValue("staffLanguage"); ?>">
                                            <?php
                                                //This widget creates select options for languages
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "languages_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("staffLanguage") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <!-- END OF STAFF DETAILS-->
                        
                        <!-- START STAFF FAMILY DETAILS-->
                        
                        
                        <!-- END STAFF FAMILY DETAILS-->
                        
                        <!-- START STAFF LOGIN DETAILS-->
                        <h3 class="form-section form-title">Staff Login Details <small class="form-indicators" style="color:#ff0000 !important;">* This information is vital for staff platform login</small></h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Email Address:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="staffEmailAddress" class="form-control" placeholder="staff@zilasvirtualschool.com" value="<?php echo $zf_formHandler->zf_getFormValue("staffEmailAddress"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffEmailAddress"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">School Role:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me staffSchoolRole" id="staffSchoolRole" name="staffSchoolRole" data-placeholder="Teacher, Librarian, Cook, Matron, ..." value="<?php echo $zf_formHandler->zf_getFormValue("staffSchoolRole"); ?>">
                                            <?php
                                                $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "role_select.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("staffSchoolRole") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Password:</label>
                                    <div class="col-md-8">
                                        <input type="password" name="staffPassword" id="staffPassword" class="form-control" placeholder="Password" value="<?php echo $zf_formHandler->zf_getFormValue("staffPassword"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffPassword"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Confirm:</label>
                                    <div class="col-md-8">
                                        <input type="password" name="staffPassword2" class="form-control" placeholder="Confirm Password" value="<?php echo $zf_formHandler->zf_getFormValue("staffPassword2"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("staffPassword2"); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <!-- END STAFF LOGIN DETAILS-->
                      
                    
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="registeredBy" class="form-control" value="<?php echo $registeredBy; ?>">
                        </div>
                    </div>
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmNewStaffInfo">
                    
                    <h3 class="form-section block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Staff Information</h3>
                    <div class="container">
                        <div id="confirmationTab">
                            <ul class="resp-tabs-list hor_2">
                                <li>Personal Information</li>
                                <li>Login Information</li>
                            </ul>
                            <div class="resp-tabs-container hor_2">
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">First Name:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffFirstName"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Middle Name:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result"  data-display="staffMiddleName"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Last Name:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffLastName"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff ID Number:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffIdNumber"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Gender:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffGender"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Marital Status:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffMaritalStatus"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Date of Birth:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffDateOfBirth"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Religion:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffReligion"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Country:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffCountry"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Locality:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffLocality"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Address:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffBoxAddress"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Phone No.:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffPhoneNumber"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Number:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffAdmissionNumber"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Staff Language:</label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static confirm-form-result" data-display="staffLanguage"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--row-->
                                </div>
                                <div>
                                    <h4 class="form-section confirm-inner-title">Staff Login Information</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Staff Email:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static confirm-form-result" data-display="staffEmailAddress"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Staff Role:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static confirm-form-result" data-display="staffSchoolRole"></p>
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
