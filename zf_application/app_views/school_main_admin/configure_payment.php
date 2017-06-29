<?php

    //Here we load library module model for having an overview
    $zf_controller->Zf_loadModel("school_main_admin", "processPaymentInformation");
    
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
                <h3 class="page-title">Configure Payment Modes</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-linode"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a> Configuration overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add payment categories</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add payment vendors</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Payment vendor settings</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Payment account settings</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div>
                            <div class="row margin-top-10">
                                <?php
                                    //Here we fetch all school payment information details
                                    $zf_controller->zf_targetModel->fetchSchoolPaymentDetails($identificationCode);
                                ?>
                            </div>
                        </div>
                        <div style="margin-bottom: -15px !important;">
                            <!--START OF SECTION-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for creating new payment category
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "payment_category_form.php", $identificationCode);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF SECTION-->
                        </div>
                        <div style="margin-bottom: -15px !important;">
                            <!--START OF SECTION-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for creating new payment vendor
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "payment_vendor_form.php", $identificationCode);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF SECTION-->
                        </div>
                        <div style="margin-bottom: -15px !important;">
                            <!--START OF SECTION-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for creating new vendor settings
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "payment_vendor_settings_form.php", $identificationCode);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF SECTION-->
                        </div>
                        <div style="margin-bottom: -15px !important;">
                            <!--START OF SECTION-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for creating new payment accounts settings
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "payment_accounts_form.php", $identificationCode);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF SECTION-->
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
        var $current_view = "configure_payment";

        ManageForms.init($current_view, $absolute_path, $separator );


    });
</script>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

