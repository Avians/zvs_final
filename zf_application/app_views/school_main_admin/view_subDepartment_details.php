<?php

    $activeURL = Zf_Core_Functions::Zf_URLSanitize();

    //This is the controller
    $zvs_controller = $activeURL[0];

    //This is user identificationCode
    $identificationCode = $zf_actionData;
    
    //This is the parameter
    $schoolSubDepartmentCode = Zf_SecureData::zf_decode_url($activeURL[2]);

    //We are accessing the model that holds all department details
    $zf_controller->Zf_loadModel("school_main_admin", "manageSchoolDepartments");
    
    $actualSubDepartmentDetails = $zf_controller->zf_targetModel->zvs_fetchSubDepartmentOuterDetails($schoolSubDepartmentCode);
    
    foreach ($actualSubDepartmentDetails as $subDepartmentDetails) {
        
        $subDepartmentName = $subDepartmentDetails[schoolSubDepartmentName];
        
    }

?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Sub-Department Details</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a><?=$subDepartmentName;?> Overview</a></li>
                        <li><a><i class="fa fa-edit"></i>Edit <?=$subDepartmentName;?></a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Head of Sub-department Profile</h3>
                                        </div>
                                        <div class="portlet-body">

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    Data goes here
                                                </div>
                                            </div>

                                        </div>
                                    </div>  
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Platform Administrator Details</h3>
                                        </div>
                                        <div class="portlet-body-short" style="border: 0px solid #000 !important;">
                                            Data goes here
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Sub-department Details</h3>
                                        </div>
                                        <div class="portlet-body" style="text-align: justify;">

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    Data goes here
                                                </div>
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
                                            form for editing {form_name} goes here.
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



