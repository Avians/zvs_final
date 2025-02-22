<?php

    $activeURL = Zf_Core_Functions::Zf_URLSanitize();

    //This is the controller
    $zvs_controller = $activeURL[0];
    
    //This is the parameter
    $urlParameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($activeURL[2]));
    
    
    $identicationCode = $urlParameter[0]; $systemSchoolCode = $urlParameter[1]; 
    $roleName = $urlParameter[2]; $schoolRoleCode = $systemSchoolCode.ZVSS_CONNECT.$roleName;
    
    //We are accessing the model that holds all class details
    $zf_controller->Zf_loadModel("school_main_admin", "manageSchoolRoles");
    
    $actualRoleDetails = $zf_controller->zf_targetModel->zvs_fetchRolesDetails($systemSchoolCode, $schoolRoleCode);
    
    foreach ($actualRoleDetails as $roleDetails) {
        
        $schoolRoleName = $roleDetails['schoolRoleName']; $assignStatus = $roleDetails['assignStatus']; 
        $roleStatus = $roleDetails['roleStatus'];  $dateCreated = $roleDetails['dateCreated'];
        
        $currentAssignStatus = ($assignStatus == 1 ? 'Assigned - <i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'Not Assigned - <i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
        $currentRoleStatus = ($roleStatus == 1 ? 'Active - <i class="fa fa-check-circle" style="color:#3c763d !important;"></i>':'Inactive - <i class="fa fa-times-circle" style="color:#a94442 !important;"></i>');
        
        $urlParameter[] = $schoolRoleName;
    }
    
    
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Role Details</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs();?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>
        <?php
            //This is the pop up indicator that shows a success or a failure in creating a new class.
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "module_resource_indicator.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
        ?> 

        <!-- BEGIN INNER CONTENT -->
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a><?=$schoolRoleName;?> Overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a resources to <?=$schoolRoleName;?></a></li>
                        <li><a><i class="fa fa-plus-square"></i> Delete resources from <?=$schoolRoleName;?></a></li>
                    </ul>
                    
                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>School Role Details</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-condensed table-responsive table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important; color: #21B4E2 !important;text-align: right !important; width: 130px;">Role Name:</td>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important;"><?= $schoolRoleName; ?></td></tr>
                                                                <tr>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important; color: #21B4E2 !important;text-align: right !important;">Role Status:</td>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important;"><?= $currentRoleStatus; ?></td></tr>
                                                                <tr>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important; color: #21B4E2 !important;text-align: right !important;">Resources:</td>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important;"><?= $currentAssignStatus; ?></td></tr>
                                                                <tr>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important; color: #21B4E2 !important;text-align: right !important;">Date Created:</td>
                                                                    <td style="padding-top: 15px !important; padding-bottom: 15px !important;"><?= $dateCreated." (Date Created)"; ?></td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="portlet-body-short" style="border: 0px solid #000 !important;">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-20" style="margin-top: 10% !important;">
                                                    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_resources", $identicationCode); ?> " style="text-decoration: none !important;">
                                                        <button type="button" class="btn zvs-buttons center-block" style="color: #ffffff !important;">
                                                            <i style="color: #ffffff !important;" class="fa fa-yelp"></i> &nbsp;Manage Resources
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--span-->
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <?php 
                                        //Access to pull all administrator information.
                                        $zf_controller->Zf_loadModel("school_main_admin", "platformSchoolResources");
                                        $zf_controller->zf_targetModel->fetchRoleResources($schoolRoleCode, $schoolRoleName);
                                    ?>
                                </div>
                                <!--span-->
                            </div>
                        </div>
                        <div>
                            <?php
                                //Here we pull all available platform resources so as to assign them to school roles.
                                $zf_controller->zf_targetModel->addRoleResources($urlParameter);
                            ?>
                        </div>
                        <div>
                            <?php
                                //Here we pull all available platform resources so as to assign them to school roles.
                                $zf_controller->zf_targetModel->deleteRoleResources($urlParameter);
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

