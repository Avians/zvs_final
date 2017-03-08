<?php

    //Here we load class module model for viewing classes
    $zf_controller->Zf_loadModel("class_module", "viewClasses");
    
    //This is user identification code
    $identificationCode = Zf_SecureData::zf_decode_data($zf_actionData);
    
    //echo $identificationCode; exit();
    
?>
    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">View Classes</h3>
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
                            <li><a>Overall Class Overview</a></li>
                            <li><a><i class="fa fa-user-plus"></i> Filtered Class Overview</a></li>
                        </ul>

                        <div class="z-content-inner" style="margin-bottom: 10px !important;">
                            <div>
                                <div class="row margin-top-10">
                                    <?php
                                        //Here we fetch all class details
                                        $zf_controller->zf_targetModel->fetchClassDetails($identificationCode);
                                    ?>
                                </div>
                            </div>
                            <div>
                                <div class="row margin-top-10">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                        <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                            <div class="portlet-body form" >
                                                
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

