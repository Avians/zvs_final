    <?php
        
        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the controller
        $zvs_controller = $activeURL[0];
        
        //This is unique code for each school
        $systemSchoolCode = Zf_SecureData::zf_decode_url($zf_actionData);
        
        //This model holds all user information details
        $zf_controller->Zf_loadModel("zvs_platform_details", "platformSchoolDetails");
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
        
    ?>
    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">Main Dashboard</h3>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-sitemap"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countAllSchools($identificationCode);?>
                                    </div>
                                    <div class="desc">
                                        Total Virtual Schools
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of virtual schools that are registered on Zilas Virtual Schools
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-check-square-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countActiveSchools($identificationCode);?>
                                    </div>
                                    <div class="desc">
                                        Active Virtual Schools
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of virtual schools that are actively operating on Zilas Virtual Schools
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-expeditedssl"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countSuspendedSchools($identificationCode);?>
                                    </div>
                                    <div class="desc">
                                        Suspended Virtual Schools
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of virtual schools that have been suspended on Zilas Virtual Schools
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DASHBOARD STATS -->
                    <div class="clearfix"><br></div>
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countAllAdministrators();?>
                                    </div>
                                    <div class="desc">
                                        Total Platform Administrators
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of platform administrators including super administrators
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countActiveAdministrators($identificationCode);?>
                                    </div>
                                    <div class="desc">
                                        Active Administrators
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of administrators actively operating on Zilas Virtual Schools
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-user-times"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php $zf_controller->zf_targetModel->zvs_countSuspendedAdministrators($identificationCode);?>
                                    </div>
                                    <div class="desc">
                                        Suspended Administrators
                                    </div>
                                </div>
                                <div class="more" style="height: 40px;" href="#">
                                    Total number of administrators suspended from Zilas Virtual Schools
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DASHBOARD STATS -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- END INNER CONTENT -->
            
            <div class="clearfix"><hr><br></div>
            
            <!-- BEGIN DASHBOARD SHORTCUTS -->
            <?php
                Zf_ApplicationWidgets::zf_load_widget("zvs_super_admin", "dashboard_shortcuts.php", $identificationCode);
            ?>
            <!-- END DASHBOARD SHORTCUTS -->
            
            <div class="clearfix"><hr><br></div>
            
            <!-- BEGIN SCHOOL LOCALITIES -->
            <div class="row margin-top-0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                        <div class="zvs-content-titles">
                            <h3 class="">School Locations on Map</h3>
                        </div>
                        <div class="portlet-body">
                            <div class="zvs-body-contents">
                                xxxx
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
            <!-- END SCHOOL LOCALITIES -->
            
            <div class="clearfix"><br></div>
            
        </div>
    </div>
    <!-- END CONTENT -->

