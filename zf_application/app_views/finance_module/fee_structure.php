<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("finance_module", "feeStructure");
    
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
                <h3 class="page-title">Fees Structure</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a>Fee Structure overview</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important;">
                                                Fees Structure
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: center !important;">
                                                Select Class: <?=$zf_controller->zf_targetModel->zvs_buildClassOption($identificationCode,"activeClassSelector");?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("classFeesYearsSelector");?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" min-height: 300px !important;">
                                                <div id="feeStructureSplashScreen">
                                                    <?=$zf_controller->zf_targetModel->feeStructureSplashScreen();?>
                                                </div>
                                                
                                            </div>
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

        //ManageForms.init($current_view, $absolute_path, $separator );


    });
</script> 

