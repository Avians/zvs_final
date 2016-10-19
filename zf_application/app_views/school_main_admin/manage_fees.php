<?php

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
                        <li><a><i class="fa fa-plus-square"></i> School fees setup</a></li>
                        <li><a><i class="fa fa-edit"></i> Edit School fees</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <!--This is the section for general school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="min-height: 30px !important;">
                                                General School Fees 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 right" style="min-height: 30px !important;">
                                                Select Year:
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 300px !important;">Percentage Representation</div>
                                            <div class="col-md-6">Actual Item Amounts</div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="min-height: 30px !important;">
                                                Class School Fees 
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right" style="min-height: 30px !important;">
                                                Select Class:
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right" style="min-height: 30px !important;">
                                                Select Year:
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 300px !important;">Percentage Representation</div>
                                            <div class="col-md-6">Actual Item Amounts</div>
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

