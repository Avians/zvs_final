<?php

    //Here we load asset module model for asset setup
    $zf_controller->Zf_loadModel("asset_module", "asset_setup");
    
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
                <h3 class="page-title">Asset Setup</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-cogs"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a>School asset overview</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a new asset category</a></li>
                        <li><a><i class="fa fa-plus-square"></i> Add a new asset sub-category</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        Have an overview of school asset here
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        Create a new asset category here
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        Create a new asset sub-category here
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

