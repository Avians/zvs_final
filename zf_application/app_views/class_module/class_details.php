<?php

    //Here we load class module model for viewing classes
    $zf_controller->Zf_loadModel("class_module", "viewClasses");
    
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
                    <h3 class="page-title">Stream Details</h3>
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
                        <li><a>Student stream overview</a></li>
                    </ul>

                    <div class="z-content-inner" style="margin-bottom: 10px !important;">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -10px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 10px !important;">
                                        <div class="portlet-empty table-responsive" style="margin-right: 4% !important;">
                                            <div style="margin-right: 8px !important;"><?php echo $zf_generateTable; ?></div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

        <div class="clearfix"></div>
            
        </div>
    </div>
    <!-- END CONTENT -->

