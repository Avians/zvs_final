<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_hostel_student = "new_hostel_student";
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("hostel_module", "process_hostel_student", $new_hostel_student); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_hostel_student_form">
    <div class="form-wizard" id="newHostelStudent">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newHostelStudentInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Student Hostel Details
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewHostelStudentInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Hostel Details
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
                
                
                <!-- START OF LIBRARY SETUP FORM-->
                <div class="tab-pane" id="newHostelStudentInfo">
                    <h3 class="form-section form-title">New Student Hostel Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Student:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me studentIdentificationCode" id="studentIdentificationCode" name="studentIdentificationCode" data-placeholder="Student Name [Admission No.]" value="<?php echo $zf_formHandler->zf_getFormValue("studentIdentificationCode"); ?>">
                                        <?php
                                            //Here we pull all students in the school
                                            Zf_ApplicationWidgets::zf_load_widget("hostel_module", "process_school_students.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("studentIdentificationCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Hostel:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me schoolHostelCode" id="schoolHostelCode" name="schoolHostelCode" data-placeholder="School Hostel Name" value="<?php echo $zf_formHandler->zf_getFormValue("schoolHostelCode"); ?>">
                                        <?php
                                            //Here we pull all hostels in the school
                                            Zf_ApplicationWidgets::zf_load_widget("hostel_module", "process_school_hostels.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolHostelCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM LIBRARY SETUP SECTION-->
                <div class="tab-pane" id="confirmNewHostelStudentInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Hostel Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Student Hostel Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Student Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="studentIdentificationCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Hostel Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="schoolHostelCode"></p>
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