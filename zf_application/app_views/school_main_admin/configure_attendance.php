e<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("school_main_admin", "newAttendanceRegistration");
    
    //This is user identification code
    $identificationCode = Zf_SecureData::zf_decode_data($zf_actionData);
    
?>


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Configure Attendance</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>
        <?php
            //This is the pop up indicator that shows a success or a failure in creating a new attendance schedule.
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "attendance_configuration_indicator.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
        ?>    
        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>School attendance overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> School attendance setup</a></li>
                    </ul>
                     <div class="z-content-inner">
                        <div>
                            
                            <!--This is the section for general school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 300px !important;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 30px !important; font-weight: 900;">
                                                General Attendance Schedule 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles"  style="min-height: 30px !important; text-align: right !important;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("activeAttendanceYear");?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="attendanceSplashScreen">
                                                <?php
                                                    $zf_controller->Zf_loadModel("school_main_admin", "processAttendanceSchedule"); 
                                                    //Here we fetch class fee datails school attendance for the current year
                                                    $zf_controller->zf_targetModel->processAnnualAttendanceSchedule();
                                                ?>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="activeAttendanceSchedule"></div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for registering platform super administrators
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "new_attendance_form.php");
                                            ?>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->
            
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "configure_attendance";

        ManageForms.init($current_view, $absolute_path, $separator );


    });
</script>

