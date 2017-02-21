e<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("school_main_admin", "manageSchoolFees");
    
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
                <h3 class="page-title">Manage School Fees</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>
        <?php
            //This is the pop up indicator that shows a success or a failure in creating a new class.
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "fee_setup_indicator.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
        ?>    
        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>School fees overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Configure school fees</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Configure payment schedule</a></li>
                        <li><a>Payment schedule overview</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <!--This is the section for general school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 30px !important; font-weight: 900;">
                                                General School Fees 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles"  style="min-height: 30px !important; text-align: right !important;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("generalFeesYearsSelector");?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" id="generalFeesStaticPieChart" style="border-right: 1px solid #efefef; min-height: 300px !important;">
                                                <?php
                                                    //Here we fetch general fee datails for the school in a pie chart
                                                    $zf_controller->zf_targetModel->fetchGeneralFeesPieChart($identificationCode);
                                                ?>
                                            </div>
                                            <div class="col-md-6" id="generalFeesDynamicPieChart" style="border-right: 1px solid #efefef; min-height: 300px !important;"></div>
                                            <div class="col-md-6" id="generalFeesStaticBarChart">
                                                <?php
                                                    //Here we fetch general fee datails for the school in a bar chart
                                                    $zf_controller->zf_targetModel->fetchGeneralFeesBarChart($identificationCode);
                                                ?>
                                            </div>
                                            <div class="col-md-6" id="generalFeesDynamicBarChart"></div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important;">
                                                Class School Fees 
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: center !important;">
                                                Select Class: <?=$zf_controller->zf_targetModel->zvs_buildClassOption($identificationCode,"activeClassSelector");?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("classFeesYearsSelector");?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2" id="classFeesSplashScreen">
                                                    <div class="zvs-content-warnings" style="text-align: center !important; padding-top: 15% !important;">
                                                        <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i><br>
                                                        <span class="content-view-errors" >
                                                            <b>&nbsp;You have to select a class so as to have a view of class based school fees. This is school fees paid by the selected class in addition to the general school fees.</b>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-6" id="classFeesDynamicPieChart" style="border-right: 1px solid #efefef; min-height: 300px !important;">
                                            </div>
                                            <div class="col-md-6" id="classFeesDynamicBarChart"></div>
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
                                                //This is the form for school fee setup
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "fees_setup_form.php");
                                            ?>
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
                                                //This is the form for school fee setup
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "payment_schedule_form.php");
                                            ?>
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
                                                //Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "new_hostel_form.php");
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
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "manage_fees";

        ManageForms.init($current_view, $absolute_path, $separator );


    });
</script> 

