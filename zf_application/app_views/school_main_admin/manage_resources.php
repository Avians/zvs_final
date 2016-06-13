<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("school_main_admin", "platformSchoolResources");
    
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
            $zf_widgetFolder = "indicators"; $zf_widgetFile = "resources_roles_mapper.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
        ?> 
        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>Platform Modules &AMP; Resources</a></li>
                        <li><a>Resource Allocation Overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Assign Resources to Roles</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <?php
                                    //Here we fetch all role details
                                    $zf_controller->zf_targetModel->fetchResourceDetails();
                                ?>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 100px !important;">
                                        <div class="portlet-body form" >
                                            <h3 class="form-section form-title" style="padding-top: 10px !important;">Assignment of Platform Resources to Active School Roles</h3> 
                                            <div class="alert alert-info">
                                                <button class="close" data-dismiss="alert"></button>
                                                <h5>This section allows you to be able to have an overview of how platform resources have been assigned to active school roles. Inactive school roles will not be shown in this section!</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row margin-top-10">
                                <?php
                                    //This method does fetch all school roles and resources assigned to them
                                    $zf_controller->zf_targetModel->fetchRolesDetails($identificationCode);
                                ?>
                            </div>
                        </div>
                        <div>
                            <?php
                                //Here we pull all available platform resources so as to assign them to school roles.
                                $zf_controller->zf_targetModel->pullSchoolRoles($identificationCode);
                            ?>
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

