<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_school_form = "new_school_form";
    
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("zvs_super_admin", "newSchoolRegistration", $new_school_form); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_school_form">
    <div class="form-wizard" id="newSchoolRegistration">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#schoolInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> School Information
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#adminInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Admin Information
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmSetupInfo" data-toggle="tab" class="step">
                        <span class="number">
                            3
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Details
                        </span>
                    </a>
                </li>
            </ul>
            <div id="bar" class="progress progress-striped active progress-bar-radius" role="progressbar">
                <div class="progress-bar progress-bar-info progress-bar-radius" style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar"></div>
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
                
                
                <!-- START OF SCHOOL SETUP FORM -->
                <div class="tab-pane" id="schoolInfo">
                    <h3 class="form-section form-title">Basic School Details</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Code:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolCode" placeholder="12345xxxx" value="<?php echo $zf_formHandler->zf_getFormValue("schoolCode"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Reg. Number:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="registrationNumber" placeholder="12345xxxx" value="<?php echo $zf_formHandler->zf_getFormValue("registrationNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("registrationNumber") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolName" placeholder="Zilas School" value="<?php echo $zf_formHandler->zf_getFormValue("schoolName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Year Established:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="dateOfEstablishment" data-placeholder="Year of establishment" value="<?php echo $zf_formHandler->zf_getFormValue("dateOfEstablishment"); ?>">
                                        <option value=""></option>
                                        <?php Zf_Core_Functions::Zf_GenerateYearOption(1800);?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("dateOfEstablishment") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Email:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolEmail" placeholder="info@zilasvirtualschool.com" value="<?php echo $zf_formHandler->zf_getFormValue("schoolEmail"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolEmail") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Website Url:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolWebsite" placeholder="http://www.zilasvirtualschool.com" value="<?php echo $zf_formHandler->zf_getFormValue("schoolWebsite"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolWebsite") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Phone Number:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolPhoneNumber" placeholder="12345" value="<?php echo $zf_formHandler->zf_getFormValue("schoolPhoneNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolPhoneNumber") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolMobileNumber" placeholder="+123 123 456789" value="<?php echo $zf_formHandler->zf_getFormValue("schoolMobileNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolMobileNumber") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">P.o Box Address:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolBoxAddress" placeholder="P.O Box 12345" value="<?php echo $zf_formHandler->zf_getFormValue("schoolAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolBoxAddress") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Motto:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolMotto" placeholder="Zeal, Inspired, Learn, Strength" value="<?php echo $zf_formHandler->zf_getFormValue("schoolMotto"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolMotto") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Level:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolLevel" data-placeholder="Primary, Secondary, .." value="<?php echo $zf_formHandler->zf_getFormValue("schoolLevel"); ?>">
                                        <option value=""></option>
                                        <option value="Primary School">Primary School</option>
                                        <option value="Secondary School">Secondary School</option>
                                        <option value="Tertiary College">Tertiary School</option>
                                        <option value="Polytechnic">Polytechnic</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolLevel") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolCategory" data-placeholder="Boarding, Day, Boarding/Day" value="<?php echo $zf_formHandler->zf_getFormValue("schoolCategory"); ?>">
                                        <option value=""></option>
                                        <option value="Boarding School">Boarding School</option>
                                        <option value="Day School">Day School</option>
                                        <option value="Boarding and Day">Boarding/Day School</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolCategory") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Gender:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolGender" data-placeholder="Boys, Girls, Mixed"  value="<?php echo $zf_formHandler->zf_getFormValue("schoolGender"); ?>">
                                        <option value=""></option>
                                        <option value="Boys School">Boys School</option>
                                        <option value="Girls School">Girls School</option>
                                        <option value="Mixed School">Mixed School</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolGender") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolType" data-placeholder="Public, Private" value="<?php echo $zf_formHandler->zf_getFormValue("schoolType"); ?>">
                                        <option value=""></option>
                                        <option value="Public School">Public School</option>
                                        <option value="Private School">Private School</option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolType") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Country:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolCountry" id="schoolCountry" name="schoolCountry" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("schoolCountry"); ?>">
                                        <?php
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "countries_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolCountry") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Locality:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolLocality" id="schoolLocality" name="schoolLocality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("schoolLocality"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolLocality") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Logo:</label>
                                <div class="col-md-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=School+Logo" alt="" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file form-btn">
                                                <span class="fileinput-new">
                                                    Select image
                                                </span>
                                                <span class="fileinput-exists">
                                                    Change
                                                </span>
                                                <input type="file" name="schoolLogoPath" value="">
                                            </span>
                                            &nbsp;&nbsp;
                                            <a href="#" class="btn default fileinput-exists form-btn" data-dismiss="fileinput">
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                </div>
                <!-- END OF SCHOOL SETUP FORM -->
                
                <!-- START OF ADMIN SETUP FORM-->
                <div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">School Administrator Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Designation:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="designation" data-placeholder="Mr., Mrs., Miss, Ms., ..."  value="<?php echo $zf_formHandler->zf_getFormValue("designation"); ?>">
                                        <option value=""></option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("designation") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="firstName" class="form-control" placeholder="Athias" value="<?php echo $zf_formHandler->zf_getFormValue("firstName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("fisrtName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="middleName" class="form-control" placeholder="Avians" value="<?php echo $zf_formHandler->zf_getFormValue("middleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("middleName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="lastName" class="form-control" placeholder="Athlan" value="<?php echo $zf_formHandler->zf_getFormValue("middleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("lastName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="idNumber" class="form-control" placeholder="123456789" value="<?php echo $zf_formHandler->zf_getFormValue("idNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("idNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="mobileNumber" class="form-control" placeholder="0711111111" value="<?php echo $zf_formHandler->zf_getFormValue("mobileNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("mobileNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
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
                                <label class="control-label col-md-4">Gender:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline"><input type="radio" name="gender" value="Male" checked data-title="Male"> Male </label>
                                        <label class="radio-inline"><input type="radio" name="gender" value="Female"  data-title="Female"> Female </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Country:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolAdminCountry" id="schoolAdminCountry" name="country" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("country"); ?>">
                                        <?php
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "countries_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("country") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Locality:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolAdminLocality" id="schoolAdminLocality" name="locality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("locality"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("locality") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Image:</label>
                                <div class="col-md-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=User+Image" alt=""/>
                                        </div>
                                        <div>
                                            <span class="btn default btn-file form-btn">
                                                <span class="fileinput-new">
                                                    Select image
                                                </span>
                                                <span class="fileinput-exists">
                                                    Change
                                                </span>
                                                <input type="file" name="imagePath" value="">
                                            </span>
                                            &nbsp;&nbsp;
                                            <a href="#" class="btn default fileinput-exists form-btn" data-dismiss="fileinput">
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <h3 class="form-section form-title">Login Details <small class="form-indicators">* This information is vital for platform login</small></h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" class="form-control" placeholder="user@zilasvirtualschool.com" value="<?php echo $zf_formHandler->zf_getFormValue("email"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("email"); ?>
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
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo $zf_formHandler->zf_getFormValue("password"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("password"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Confirm:</label>
                                <div class="col-md-8">
                                    <input type="password" name="password2" class="form-control" placeholder="Confirm Password" value="<?php echo $zf_formHandler->zf_getFormValue("password2"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("password2"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="createdBy" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMIN SETUP FORM-->
                
                <!-- CONFIRM SETUP INFORMATION -->
                <div class="tab-pane" id="confirmSetupInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">School Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Code:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Registration Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="registrationNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Year Established:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="dateOfEstablishment"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Email:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolEmail"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Website:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolWebsite"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Phone:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolPhoneNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Mobile:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolMobileNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Box Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolBoxAddress"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Motto:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolMotto"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Level:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolLevel"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Category:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolCategory"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Gender:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolGender"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Type:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolType"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Country:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolCountry"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">School Locality:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="schoolLocality"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <h4 class="form-section confirm-inner-title">School Administrator Information</h4>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Designation:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="designation"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="firstName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="middleName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="lastName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Gender:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="gender"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Id Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="idNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="mobileNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="email"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Box Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="boxAddress"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Country:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="country"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Admin Locality:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="locality"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    
                </div>
                <!-- END OF CONFIRM SETUP INFORMATION -->
                
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