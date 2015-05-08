<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("zvs_super_admin", "userInformation");
    
?>    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">New Administrative User</h3>
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
                        <li><a>Platform users overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a new super administrator</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a new platform administrator</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Super Administrators</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">Full Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform super administartors
                                                                $zf_controller->zf_targetModel->fetchSuperAdministrators();
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all types of platform administrators
                                                    $zf_controller->zf_targetModel->countSuperAdministrators();
                                                ?>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Administrators</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="school-class-inner scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0" >
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">Full Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform main administartors
                                                                $zf_controller->zf_targetModel->fetchPlatformAdministrators();
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all types of platform administrators
                                                    $zf_controller->zf_targetModel->countPlatformAdministrators();
                                                ?>
                                            </div>
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
                                                Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "new_super_admin.php");
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
                                                //This is the form for registering platform main administrators
                                                Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "new_platform_admin.php");
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
        var $current_view = "new_user";

        AdministratorLocations.init($current_view, $absolute_path, $separator );


    });
</script>

