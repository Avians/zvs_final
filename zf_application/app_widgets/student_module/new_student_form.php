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
                                    <input type="text" name="studentFirstName" class="form-control" placeholder="First Name" value="<?php echo $zf_formHandler->zf_getFormValue("studentFirstName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentFirstName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="studentMiddleName" class="form-control" placeholder="Middle Name" value="<?php echo $zf_formHandler->zf_getFormValue("studentMiddleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentMiddleName"); ?>
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
                                    <input type="text" name="studentLastName" class="form-control" placeholder="Last Name" value="<?php echo $zf_formHandler->zf_getFormValue("studentLastName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentLastName"); ?>
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
                                        <input type="radio" name="studentGender" value="Male" checked data-title="Male"> Male </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="studentGender" value="Female"  data-title="Female"> Female </label>
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
                                    <div class="input-group input-medium date date-picker" data-date="<?php echo $currentDate;?>" style="width: 277px !important;" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control" name="studentDateOfBirth" readonly value="<?php echo $currentDate; ?>" >
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
                                    <input type="text" name="studentBoxAddress" class="form-control" placeholder="P.O Box 1111-0111, Nairobi - Kenya" value="<?php echo $zf_formHandler->zf_getFormValue("studentBoxAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentBoxAddress"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Phone Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="studentPhoneNumber" class="form-control" placeholder="0711111111" value="<?php echo $zf_formHandler->zf_getFormValue("studentPhoneNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentPhoneNumber"); ?>
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
                    </div>
                    <!--/row-->
                    <!-- END OF STUDENT DETAILS-->
                   
                    
                    <!-- START PARENT DETAILS-->
                    <h3 class="form-section form-title">Guardian Details</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="guardianFirstName" class="form-control" placeholder="First Name" value="<?php echo $zf_formHandler->zf_getFormValue("guardianFirstName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianFirstName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Middle Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="guardianMiddleName" class="form-control" placeholder="Middle Name" value="<?php echo $zf_formHandler->zf_getFormValue("guardianMiddleName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianMiddleName"); ?>
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
                                    <input type="text" name="guardianLastName" class="form-control" placeholder="Last Name" value="<?php echo $zf_formHandler->zf_getFormValue("guardianLastName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianLastName"); ?>
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
                                        <input type="radio" name="guardianGender" value="Male" checked data-title="Male"> Male </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="guardianGender" value="Female"  data-title="Female"> Female </label>
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
                                    <div class="input-group input-medium date date-picker" data-date="<?php echo $currentDate;?>" style="width: 277px !important;" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control" name="guardianDateOfBirth" readonly value="<?php echo $currentDate; ?>" >
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
                                    <select class="form-control select2me guardianReligion" id="guardianReligion" name="guardianReligion" data-placeholder="Christian, Hindu, Muslim, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("guardianReligion"); ?>">
                                        <?php
                                            //This widget creates select options for religions
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "religion_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("guardianReligion") ?>
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
                                    <select class="form-control select2me guardianCountry" id="guardianCountry" name="guardianCountry" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("guardianCountry"); ?>">
                                        <?php
                                            //This widget creates select options for countires
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "countries_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("guardianCountry") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Locality:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me guardianLocality" id="guardianLocality" name="guardianLocality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("guardianLocality"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianLocality") ?>
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
                                    <input type="text" name="guardianBoxAddress" class="form-control" placeholder="P.O Box 1111-0111, Nairobi - Kenya" value="<?php echo $zf_formHandler->zf_getFormValue("guardianBoxAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianBoxAddress"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Phone Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="guardianPhoneNumber" class="form-control" placeholder="0711111111" value="<?php echo $zf_formHandler->zf_getFormValue("guardianPhoneNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianPhoneNumber"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Relation:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me guardianRelation" id="guardianRelation" name="guardianRelation" data-placeholder="Parent, Grandparent, Cousin ..."  value="<?php echo $zf_formHandler->zf_getFormValue("guardianRelation"); ?>">
                                        <?php
                                            //This widget creates select options for relation
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "guardians_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("guardianRelation") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Occupation:</label>
                                <div class="col-md-8">
                                    <input type="text" name="guardianOccupation" class="form-control" placeholder="Farmer, Teacher, Accountant, ...." value="<?php echo $zf_formHandler->zf_getFormValue("guardianOccupation"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("guardianOccupation"); ?>
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
                                    <select class="form-control select2me guardianLanguage" id="guardianLanguage" name="guardianLanguage" data-placeholder="English, French, Spanish ..."  value="<?php echo $zf_formHandler->zf_getFormValue("guardianLanguage"); ?>">
                                        <?php
                                            //This widget creates select options for languages
                                            $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "languages_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("guardianLanguage") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <!-- END PARENT DETAILS-->
                    
                    
                    <!-- START MEDICAL DETAILS-->
                    <h3 class="form-section form-title">Medical Details</h3>
                    <!--Student blood group-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">What is your blood group?:</label>
                                <div class="col-md-12">
                                    <input type="text" name="studentBloodGroup" class="form-control" placeholder="First Name" value="<?php echo $zf_formHandler->zf_getFormValue("studentBloodGroup"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentBloodGroup"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Student disability-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Do you have any conditions or disabilities that limit your physical activities?:</label>
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="studentDisableYes" type="radio" name="isStudentDisable" value="Yes"> Yes </label>
                                        <label class="radio-inline">
                                        <input id="studentDisableNo" type="radio" name="isStudentDisable" value="No" > No </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 studentDisability">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Explain Conditions or Disabilities:</label>
                                <div class="col-md-12">
                                    <textarea type="text" rows="10" name="studentDisability" class="form-control" placeholder="Explaing your conditions or disabilities in this section" value="<?php echo $zf_formHandler->zf_getFormValue("studentDisability"); ?>"></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentDisability"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Student medication-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Do you have any medications that currently you are taking regularly?:</label>
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="studentMedicatedYes" type="radio" name="isStudentMedicated" value="Yes"> Yes </label>
                                        <label class="radio-inline">
                                        <input id="studentMedicatedNo" type="radio" name="isStudentMedicated" value="No" > No </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 studentMedication">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Explain Current Medications:</label>
                                <div class="col-md-12">
                                    <textarea type="text" rows="10" name="studentMedication" class="form-control" placeholder="Explaing medications that you are currently undertaking regularly" value="<?php echo $zf_formHandler->zf_getFormValue("studentMedication"); ?>"></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentMedication"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                    <!--Student medication-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Do you experience allergies or allergic reactions to; Medicines, foods, seasons or any other?:</label>
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="studentAllergicYes" type="radio" name="isStudentAllergic" value="Yes"> Yes </label>
                                        <label class="radio-inline">
                                        <input id="studentAllergicNo" type="radio" name="isStudentAllergic" value="No" > No </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 studentAllergic">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Explain your allergy condition:</label>
                                <div class="col-md-12">
                                    <textarea type="text" rows="10" name="studentAllergic" class="form-control" placeholder="Explain your allergy conditions in this section" value="<?php echo $zf_formHandler->zf_getFormValue("studentAllergic"); ?>"></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentAllergic"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                    <!--Student special treatment-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Do you have any conditions that require a special consideration or treatment?:</label>
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="studentTreatmentYes" type="radio" name="isStudentTreatment" value="Yes"> Yes </label>
                                        <label class="radio-inline">
                                        <input id="studentTreatmentNo" type="radio" name="isStudentTreatment" value="No" > No </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 studentTreatment">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Explain your special treatment or consideration condition:</label>
                                <div class="col-md-12">
                                    <textarea type="text" rows="10" name="studentTreatment" class="form-control" placeholder="Explain your special treatment or consideration conditions in this section" value="<?php echo $zf_formHandler->zf_getFormValue("studentTreatment"); ?>"></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentTreatment"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                    <!--Student special doctor-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Incase of an emergency, do you have a specialized doctor/physician who handles your case?:</label>
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="studentTreatmentYes" type="radio" name="isStudentTreatment" value="Yes"> Yes </label>
                                        <label class="radio-inline">
                                        <input id="studentTreatmentNo" type="radio" name="isStudentTreatment" value="No" > No </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 studentTreatment">
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align: left !important;">Explain your special treatment or consideration condition:</label>
                                <div class="col-md-12">
                                    <textarea type="text" rows="10" name="studentTreatment" class="form-control" placeholder="Explain your special treatment or consideration conditions in this section" value="<?php echo $zf_formHandler->zf_getFormValue("studentTreatment"); ?>"></textarea>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentTreatment"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- END MEDICAL DETAILS-->
                    
                    
                    <!-- START CLASS DETAILS-->
                    <h3 class="form-section form-title">Class Details</h3>
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
