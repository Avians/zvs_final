<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("zvs_school_details", "platformSchoolDetails");
    
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
                <h3 class="page-title">Register New School</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs();?>
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
                        <li><a>Platform schools overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a new platform school</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Configure school details</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Primary Schools</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">School Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform primary schools
                                                                $zf_controller->zf_targetModel->fetchPlatformSchools("primarySchools", $identificationCode);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all platform primary schools
                                                    $zf_controller->zf_targetModel->countPlatformSchools("primarySchools", $identificationCode);
                                                ?>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Secondary Schools</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="school-class-inner scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0" >
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">School Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform secondary schools
                                                                $zf_controller->zf_targetModel->fetchPlatformSchools("secondarySchools", $identificationCode);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all platform secondary schools
                                                    $zf_controller->zf_targetModel->countPlatformSchools("secondarySchools", $identificationCode);
                                                ?>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Tertiary Colleges</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="zvs-table-blocks scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">School Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform tertiary schools
                                                                $zf_controller->zf_targetModel->fetchPlatformSchools("tertiaryColleges", $identificationCode);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all platform tertiary colleges
                                                    $zf_controller->zf_targetModel->countPlatformSchools("tertiaryColleges", $identificationCode);
                                                ?>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="zvs-content-titles">
                                            <h3 class="">Platform Polytechnics</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="school-class-inner scroller zvs-table-blocks" data-always-visible="1" data-rail-visible="0" >
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th  style="width: 60%;">School Names</th><th style="width: 30%;">Status</th><th style="width: 10%;">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Fetch all platform polytechnics
                                                                $zf_controller->zf_targetModel->fetchPlatformSchools("polytechnics", $identificationCode);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="zvs-content-footer">
                                            <div class="row">
                                                <?php  
                                                    //Count all platform polytechnics
                                                    $zf_controller->zf_targetModel->countPlatformSchools("polytechnics", $identificationCode);
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
                                                //This is the form for registering platform school
                                                Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "new_school_form.php");
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
                                                //Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "new_platform_admin.php");
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
        var $current_view = "new_school";

        SchoolLocations.init($current_view, $absolute_path, $separator );


    });
</script>   

