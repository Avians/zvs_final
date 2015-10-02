
    
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
            
            <!-- START DASHBOARD SHORTCUTS -->
            <?php
                Zf_ApplicationWidgets::zf_load_widget("school_main_admin", "dashboard_shortcuts.php");
            ?>
            <!-- END DASHBOARD SHORTCUTS -->
            
            <div class="clearfix"><hr><br></div>

            <!-- BEGIN SCHOOL LOCALITIES -->
            <div class="row margin-top-0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                        <div class="zvs-content-titles">
                            <h3 class="">School Location on Map</h3>
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

