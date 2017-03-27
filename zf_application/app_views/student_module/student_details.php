<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("student_module", "processStudentDetails");
    
    //This is user identification code
    $identificationCode = Zf_SecureData::zf_decode_data($zf_actionData);
    
    Zf_SessionHandler::zf_setSessionVariable("financialStatusIdentificationCode", $identificationCode);
    
?>
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Student Details</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-users"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <div class="clearfix"></div>
        
        <!-- BEGIN DASHBOARD CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--START OF SUBJECT STATISTICS-->
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="dashboard-stat purple-sharp">
                            <div class="visual">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="details">
                                <div class="number" style="font-size: 35px !important">
                                    425
                                </div>
                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                    Total Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-users"></i>
                                </div>
                            </div>
                            <div class="more" style="height: 25px;" href="#">
                                Total Students In School
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="dashboard-stat green-sharp">
                            <div class="visual">
                                <i class="fa fa-male"></i>
                            </div>
                            <div class="details">
                                <div class="number" style="font-size: 35px !important">
                                    218
                                </div>
                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                    Male Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-male"></i>
                                </div>
                            </div>
                            <div class="more" style="height: 25px;" href="#">
                                Total Male Students In School
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="dashboard-stat blue-madison">
                            <div class="visual">
                                <i class="fa fa-female"></i>
                            </div>
                            <div class="details">
                                <div class="number" style="font-size: 35px !important">
                                   207
                                </div>
                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                    Female Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-female"></i>
                                </div>
                            </div>
                            <div class="more" style="height: 25px;" href="#">
                                Total Female Staff In School
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="dashboard-stat red-soft">
                            <div class="visual">
                                <i class="fa fa-wheelchair-alt"></i>
                            </div>
                            <div class="details">
                                <div class="number" style="font-size: 35px !important">
                                   10
                                </div>
                                <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                   Disabled Students&nbsp;&nbsp;<span style="font-size: 15px !important;"><i class="fa fa-wheelchair-alt"></i>
                                </div>
                            </div>
                            <div class="more" style="height: 25px;" href="#">
                                Total Disabled Students
                            </div>
                        </div>
                    </div>
                </div>
                <!--END OF SUBJECT STATISTICS-->
            </div>
        </div>
        <!-- END DASHBOARD CONTENT -->
        
        <div class="clearfix"></div>
        
        <!-- BEGIN TABLE CONTENT-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -10px !important;">
                <div class="portlet box zvs-content-blocks" style="min-height: 10px !important;">
                    <?php echo $zf_generateTable; ?>
                </div>          
            </div>
        </div>
        <!-- END TABLE CONTENT-->
        
        <div class="clearfix"></div>
        
        <!-- BEGIN CHART CONTENT-->
        <div class="row margin-top-10">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -10px !important;">
                Chart Goes Here         
            </div>
        </div>
        <!-- END CHART CONTENT-->
        
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "student_details";

        StudentModule.init($current_view, $absolute_path, $separator );


    });
</script>  
