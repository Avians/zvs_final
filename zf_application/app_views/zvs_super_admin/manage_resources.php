<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("zvs_platform_details", "platformSchoolResources");
    
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
                <h3 class="page-title">Manage Resources</h3>
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
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "module_resource_indicator.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
        ?> 
        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>Platform Modules &AMP; Resources</a></li>
                        <li><a><i class="fa fa-plus-square"></i> New Resource Module</a></li>
                        <li><a><i class="fa fa-plus-square"></i> New Platform Resource</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <?php
                                    //Here we fetch all resources and modules
                                    $zf_controller->zf_targetModel->fetchResourceModuleDetails($identificationCode);
                                ?>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 100px !important;">
                                        <div class="portlet-body form" >
                                            <h3 class="form-section form-title" style="padding-top: 10px !important;">Create a New Platform Modules</h3> 
                                            <div class="alert alert-info">
                                                <button class="close" data-dismiss="alert"></button>
                                                <h5>This section allows you to be able to create a new resource module also known as resource category. All platform resources are grouped into modules.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row margin-top-10">
                                <!--Module form goes here-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            <?php
                                                //This is the form for registering platform super administrators
                                                Zf_ApplicationWidgets::zf_load_widget("zvs_platform_details", "new_module_form.php");
                                            ?>
                                        </div>
                                    </div>          
                                </div>
                                <!--End of Module form-->
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 100px !important;">
                                        <div class="portlet-body form" >
                                            <h3 class="form-section form-title" style="padding-top: 10px !important;">Create a New Platform Resource</h3> 
                                            <div class="alert alert-info">
                                                <button class="close" data-dismiss="alert"></button>
                                                <h5>This section allows you to be able to register a new platform resource and assigning it to an existing module/category.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row margin-top-10">
                                <?php
                                    //Here we pull all available platform resource modules so that we can assign a resource to a module.
                                    $zf_controller->zf_targetModel->pullResourceModules();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->
        
        <div class="clearfix"><br></div>

    </div>
</div>
<!-- END CONTENT -->
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

