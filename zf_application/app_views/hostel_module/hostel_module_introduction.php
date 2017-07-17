<?php

    //Here we load store module model for store suppliers
    //$zf_controller->Zf_loadModel("class_module", "section_module_file");
    
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
                <h3 class="page-title">Hostel Module</h3>
                <div class="page-breadcrumb breadcrumb">
                    <div class="row">
                        <div class="col-lg-6 text-left">
                            <i class="fa fa-building-o"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                        </div>
                        <div class="col-lg-6 landing_page_link">
                            <?php Zf_BreadCrumbs::zf_landing_page($identificationCode); ?>
                        </div>
                    </div>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
             <div class="portlet-body" >
                <div class="row margin-top-20">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 300px !important; height: auto !important; text-align: center !important">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" margin-top: 20px !important;">
                            <img src="<?php echo ZF_ROOT_PATH.ZF_DATASTORE."zvs_module_images".DS."hostel.png"; ?>" width=" 75% " height=" 75%" alt="Hostel Module" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" style=" text-align: center !important;">
                            Introduction to hostel module
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles margin-top-20" style=" font-size: 12px !important;">
                            <p>This module contains all resources that the school administrator has allowed for your use to access and/or manage all hostel related information.<br></p>
                            <p><br>With over five resources, you will only be able to use resources whose access you have have been assigned to your school role. If all resource are taken away from the role, the entire module will not be available for your use.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

