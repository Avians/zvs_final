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
                <h3 class="page-title">Manage Staff</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-cubes"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a><i class="fa fa-plus-square"></i> Register New Staff</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for registering new staff into school by main admin
                                                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "new_staff_form.php");
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
        var $current_view = "manage_staff";

        ManageForms.init($current_view, $absolute_path, $separator );


    });
</script>  

