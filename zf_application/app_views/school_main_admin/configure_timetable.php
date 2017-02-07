<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("school_main_admin", "newTimeTableConfiguration");
    
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
                <h3 class="page-title">Configure Time-Table</h3>
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
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "timetable_configuration_indicator.php";
            //Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
            
        ?> 

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>School timetable overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> School timetable setup</a></li>
                    </ul>
                     <div class="z-content-inner">
                        <!--This is the timetable configuration form--> 
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for registering platform super administrators
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "new_timetable_form.php");
                                            ?>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                         
                        <div>
                            
                            <!--This is the section for general school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles" style="min-height: 30px !important; font-weight: 900; color: #21B4E2 !important;">
                                                General Stream Timetable 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 30px !important; font-weight: 900;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("activeAttendanceYear");?> 
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 30px !important; font-weight: 900;">
                                                Select Class: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("activeAttendanceYear");?> 
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles"  style="min-height: 30px !important; text-align: right !important;">
                                                Select Stream: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("activeAttendanceYear");?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="attendanceSplashScreen">
                                                Timetable overview goes here!!
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="activeAttendanceSchedule"></div>
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
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "configure_timeTable";

        ManageForms.init($current_view, $absolute_path, $separator );


    });
</script>

