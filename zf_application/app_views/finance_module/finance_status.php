<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("finance_module", "financeStatus");
    
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
                                                <div id="feeDefaultTitle">2017 - General School Finance Status</div>
                                                <div id="feeClassTitle" style="color: #21b4e2 !important; padding-top: 3px;"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                Financial Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("feesHistoryYear");?>
                                            </div>
                                        </div>
                                        <!--END OF FINANCIAL SELECTOR-->
                                        <div class="clearfix"></div>
                                        <!--START OF FINANCIAL STATUS-->
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat purple-sharp">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->totalAmountExpected($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Amount Expected
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Total amount expected for the year 2017
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat green-sharp">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->totalAmountPaid($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Amount Paid
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Total amount Paid for the year 2017
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat blue-madison">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->totalAmountPending($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Amount Pending
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Total amount pending for the year 2017
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END OF FINANCIAL STATUS-->
                                        <div class="clearfix margin-top-10"><hr></div>
                                        <!--START OF FINANCIAL STATUS CHARTS-->
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 350px !important; height: auto !important;">
                                                <div class="portlet-titles">2017 - Finance Status Proportion</div>
                                                <div id="financeStatusPie">
                                                    <?=$zf_controller->zf_targetModel->financialStatusPieChart($identificationCode);?>
                                                </div>
                                            </div> 
                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                <div class="portlet-titles">2017 - Class Finance Status</div>
                                                <div id="financeStatusBarGraph">
                                                    <?=$zf_controller->zf_targetModel->financialStatusBarGraph($identificationCode);?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END OF FINANCIAL STATUS CHARTS-->
                                        <div class="clearfix margin-top-10"><hr></div>
                                        <!--START OF FINANCIAL ALLOCATIONS-->
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="portlet-titles">2017 - General Finance Allocations</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat purple-sharp">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->estimatedRunningBudget($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Running Budget
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Estimated Running Budget for 2017
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat green-sharp">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->totalAmountAllocated($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Amount Allocated
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Total Amount Allocated For 2017 Budget
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat blue-madison">
                                                    <div class="visual">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number">
                                                            KES: <?=$zf_controller->zf_targetModel->totalAllocationBalance($identificationCode);?>
                                                        </div>
                                                        <div class="desc" style="padding-top: 5px; font-family: Ubuntu-B;">
                                                            Total Allocation Pending
                                                        </div>
                                                    </div>
                                                    <div class="more" style="height: 40px;" href="#">
                                                        Total Amount Pending For 2017 Budget
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--START OF FINANCIAL ALLOCATIONS-->
                                        <div class="clearfix margin-top-10"><hr></div>
                                        <!--START OF FINANCIAL ALLOCATION CHARTS-->
                                        <div class="row">
                                            <div class="col-md-7 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 300px !important; height: auto !important;">
                                                <div class="portlet-titles">2017 - Finance Allocation Details</div>
                                                Bar Graph
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="portlet-titles">2017 - Finance Allocation Proportion</div>
                                                Pie Chart
                                            </div> 
                                        </div>
                                        <!--END OF FINANCIAL ALLOCATION CHARTS-->
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