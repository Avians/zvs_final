<?php

    //This model processes all transport overview information.
    $zf_controller->Zf_loadModel("transport_module", "transportOverview");
    
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
                <h3 class="page-title">Transport Overview</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-empire"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        
        <div class="clearfix"></div>
        
        <!-- BEGIN DASHBOARD CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php $zf_controller->zf_targetModel->getTransportDashboardInformation($identificationCode); ?> 
            </div>
        </div>
        <!-- END DASHBOARDCONTENT -->
        
        <div class="clearfix"></div>
        
        <!-- BEGIN TABLE CONTENT -->
        <div class="row">
            
            <!-- BEGINING OF ZONES AND ROUTES -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php $zf_controller->zf_targetModel->getTransportZonesAndRoutes($identificationCode); ?>
            </div>
            <!-- END OF ZONES AND ROUTES -->
            
            <!-- BEGINING OF CATEGORIES AND VEHICLES -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php $zf_controller->zf_targetModel->getTransportCategoriesAndVehicles($identificationCode); ?>
            </div>
            <!-- END OF CATEGORIES AND VEHICLES -->
            
            <!-- BEGINING OF DRIVERS -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php $zf_controller->zf_targetModel->getTransportDrivers($identificationCode); ?>
            </div>
            <!-- END OF ZONES AND ROUTES -->
        </div>
        <!-- END TABLE CONTENT-->
        
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "transport_overview";

        //TransportModule.init($current_view, $absolute_path, $separator );


    });
</script>  