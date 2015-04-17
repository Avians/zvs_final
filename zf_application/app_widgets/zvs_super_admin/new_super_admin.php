<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $zvs_formParameter = "new_super_admin";
    
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("zvs_super_admin", "userInformation", $zvs_formParameter); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
    <div class="form-wizard" id="newSuperAdmin">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#adminInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Super Admin Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Admin Details
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
                <div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">Super Administrator Information</h3>
                    
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
                                    <select class="form-control select2me adminCountry" id="adminCountry" name="country" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("country"); ?>">
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
                                    <select class="form-control select2me adminLocality" id="adminLocality" name="locality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("locality"); ?>">
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
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=profile+image" alt=""/>
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
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Super Administrator Setup Information</h4>
                     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="email">[Always remember your email and password]</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Designation:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="designation"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="firstName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="middleName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="lastName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID Number:</label>
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
                                <label class="control-label col-md-4">Box Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="boxAddress"></p>
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
                                <label class="control-label col-md-4">Country:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="country"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Locality:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="locality"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
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