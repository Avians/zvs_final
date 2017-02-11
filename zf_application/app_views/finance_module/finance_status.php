<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("finance_module", "processFinanceStatus");
    
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
                <h3 class="page-title">Finance Status</h3>
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
                        <li><a>General Finance Status</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div style="margin-bottom: -15px !important;">
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 400px !important;">
                                        <!--START OF FINANCIAL SELECTOR-->
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important;">
                                                <div id="financeStatusDefaultTitle" style="color: #21b4e2 !important;"></div>
                                                <div id="financeDynamicDefaultTitle" style="color: #21b4e2 !important;"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                Financial Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("selectedFinancialYear");?>
                                            </div>
                                        </div>
                                        <!--END OF FINANCIAL SELECTOR-->
                                        <div class="clearfix"></div>
                                        <!--START OF MAIN DATA SECTION-->
                                        <div class="row margin-top-10" >
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="financialStatusData"></div>    
                                        </div>
                                        <!--END OF MAIN DATA SECTION-->
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
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "finance_status";

        FinanceModule.init($current_view, $absolute_path, $separator );


    });
</script>  
