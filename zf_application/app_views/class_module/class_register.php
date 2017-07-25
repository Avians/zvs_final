<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("student_module", "studentInformation");
    
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
                <h3 class="page-title">Class Register</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-calendar-check-o"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a><i class="fa fa-calendar-check-o"></i> Take Class Attendance</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div class="form" style="margin-bottom: -10px !important;">
                            <?php
                                //This is the form for assinging vehicles to driver
                                Zf_ApplicationWidgets::zf_load_widget("class_module", "class_attendance_register_form.php");
                            ?>
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
        var $current_view = "class_register";

        ClassModule.init($current_view, $absolute_path, $separator );
        
        //This ensures that the data pre-loader is loaded before data is loaded.
        $(".studentsListDetails").change(function(){

            $(".zvs_preloader, .zvs_loader").show();

            $( "#classAttendanceList").load(function() {
                $(".zvs_preloader, .zvs_loader").hide();
            });

        });

    });
</script>  
