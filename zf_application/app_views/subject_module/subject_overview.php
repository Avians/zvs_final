<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("subject_module", "subjectOverview");
    
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
                <h3 class="page-title">Subject Overview</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-empire"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a>General subjects overview</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div style="margin-bottom: -15px !important;">
                            <!--START OF SECTION-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <!-- BEGIN DASHBOARD CONTENT -->
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php $zf_controller->zf_targetModel->getSubjectDashboardInformation($identificationCode);?> 
                                            </div>
                                        </div>
                                        <!-- END DASHBOARDCONTENT -->
                                        
                                        <div class="clearfix"></div>
                                        
                                        <!-- BEGIN TABLE CONTENT-->
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 0px !important;">
                                                <div class="portlet box zvs-content-blocks" style="min-height: 10px !important;">
                                                    <div class="portlet-empty table-responsive" style="margin-right: 4% !important;">
                                                        <?php echo $zf_generateTable; ?>
                                                    </div>
                                                </div>          
                                            </div>
                                        </div>
                                        <!-- END TABLE CONTENT-->
                                    </div>
                                </div>
                            </div>
                            <!--END OF SECTION-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->
        
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "subject_details";

        SubjectModule.init($current_view, $absolute_path, $separator );


    });
</script>  
