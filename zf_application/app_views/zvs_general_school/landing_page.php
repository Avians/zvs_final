<?php

    //Here we load store module model for store suppliers
    $zf_controller->Zf_loadModel("section_module", "section_module_file");
    
    //This is user identification code
    $zf_urlParameter = Zf_SecureData::zf_decode_data($zf_actionData);
    
?>
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Landing Page</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-empire"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div class="row margin-top-10 margin-bottom-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-info">
                            <button class="close" data-dismiss="alert"></button>
                            <b>Below icons represent a set of modules that you are allowed to access based on your role within the school. Click on any module icon or a menu item on the left panel so as to navigate the system.</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        //Here we generate the landing page shortcuts
                        Zf_ApplicationWidgets::zf_load_widget("zvs_general_school", "landing_page_shortcuts.php");
                    ?>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

