<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("finance_module", "feeStructure");
    
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
                <h3 class="page-title">Fees Structure</h3>
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
                        <li><a>Fee Structure overview</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet zvs-content-blocks" style="min-height: 300px !important;">
                                        <div id="feeStructureView">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important;">
                                                    <div id="feeDefaultTitle">Fees Structure</div>
                                                    <div id="feeClassTitle" style="color: #21b4e2 !important; padding-top: 3px;"></div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                    Select Class: <?=$zf_controller->zf_targetModel->zvs_buildClassOption($identificationCode,"activeClassSelector");?>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                    Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("classFeesYearsSelector");?>
                                                </div>
                                            </div>
                                            <div class="row" id="feeStructureSplashScreen">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="min-height: 240px !important;">
                                                    <?=$zf_controller->zf_targetModel->feeStructureSplashScreen();?> 
                                                </div>
                                            </div>
                                            <div class="row" id="feeStructureData">
                                                <div class="col-md-5 col-sm-12 col-xs-12" id="classFeeStructure" style="border-right: 1px solid #efefef; min-height: 450px !important; height: auto !important;"></div>
                                                <div class="col-md-7 col-sm-12 col-xs-12" id="classFeeSummary" ></div>
                                            </div>
                                            <div class="hidden-fee-structure">Hidden fees structure</div>
                                        </div>
                                        <?php
                                        
                                            $css = array (
                                                '.stylel' => 'color: blue;',
                                                '.style2' => 'border: 1px solid red !important;'
                                            );


                                            $printData = '<div class="table-responsive" style="width: 50% !important; margin-left: 25%; border: 1px solid #EDEDED !important;">
                                                            <div style="color: #21b4e2 !important; padding-top: 3px;">Form One Fees Structure - 2016</div>
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60%;"> Fee Item Name</th><th style="width: 35%; text-align: right; padding-right: 10px;">Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr><td>Tuition</td><td style="text-align: right; padding-right: 10px;">4,000.00</td></tr>
                                                                    <tr><td>Boarding</td><td style="text-align: right; padding-right: 10px;">32,300.00</td></tr>
                                                                    <tr><td>Insurance</td><td style="text-align: right; padding-right: 10px;">1,050.00</td></tr>
                                                                    <tr><td>Medical</td><td style="text-align: right; padding-right: 10px;">500.00</td></tr>
                                                                    <tr><td>Activity</td><td style="text-align: right; padding-right: 10px;">800.00</td></tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th style="width: 60%;"> Totals</th><th style="width: 35%; text-align: right; padding-right: 10px;">38,650.00</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>';

                                            $dataContext = Zf_Print_Anything::zf_addPrintContext($printData, $css);
                                            $btnCss = 'style="padding: 5px 8px 5px 8px;'
                                                    . 'text-align: center;float: right;'
                                                    . 'background-color: #02A6D8;'
                                                    . 'color: #fff;text-decoration: none;'
                                                    . 'margin: 10px; border: 0px !important;"'
                                                    . 'font-family: Roboto-Thin !important;';

                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-10" id="printButton">
                                            <?=Zf_Print_Anything::zf_showPrintButton($dataContext, 'Print Fee Structure', $btnCss);?>
                                        </div>
                                        <div class="row">
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
<script type="text/javascript">
    
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?= ZF_ROOT_PATH; ?>";
        var $separator = "<?= DS; ?>";
        var $current_view = "fee_structure";

        FinanceModule.init($current_view, $absolute_path, $separator );


    });

</script>  

