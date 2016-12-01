<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("finance_module", "collectFees");
    
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
                <h3 class="page-title">Collect Fees</h3>
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
                        <li><a>Collect school fees</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div style="margin-bottom: -10px !important;">
                            <!--This is the section for class school fees-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="alert alert-info">
                                        <button class="close" data-dismiss="alert"></button>
                                        <b>In order to collect student school fees, select a class, then select an associated stream. From the populated student list, select the name of the student whose fees is to be collected.</b>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 160px !important; height: auto !important;">
                                                <div class="portlet-titles">Class Details</div>
                                                <div class="row" style="margin-top: 20px !important;">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Select Class:</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                <select class="form-control select2me studentClassCode" id="studentClassCode" name="studentClassCode" data-placeholder="Form 1 or Class 1, Form 2 or Class 2, ..." value="<?php echo $zf_formHandler->zf_getFormValue("studentClassCode"); ?>">
                                                                    <?php
                                                                        $zf_widgetFolder = "zvs_options"; $zf_widgetFile = "class_select.php";
                                                                        Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identificationCode);
                                                                    ?>
                                                                </select>
                                                                <span class="help-block server-side-error">
                                                                    <?php echo $zf_formHandler->zf_getFormError("studentClassCode") ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix"><br /></div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Stream Name:</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                <select class="form-control select2me studentStreamCode" id="studentStreamCode" name="studentStreamCode" data-placeholder="East, West, North, South, ..." value="<?php echo $zf_formHandler->zf_getFormValue("studentStreamCode"); ?>">
                                                                    <option value=""></option>
                                                                </select>
                                                                <span class="help-block server-side-error" >
                                                                    <?php echo $zf_formHandler->zf_getFormError("studentStreamCode") ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="portlet-titles">Name / Admission No.</div>
                                                <div class="row" style="margin-top: 20px !important;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Name/Admn No:</label>
                                                            <div class="col-md-8">
                                                                <select class="form-control select2me studentsListDetails" id="studentsListDetails" name="studentsListDetails" data-placeholder="Athias Avians - 2373, ..." value="<?php echo $zf_formHandler->zf_getFormValue("studentsListDetails"); ?>">
                                                                    <option value=""></option>
                                                                </select>
                                                                <span class="help-block server-side-error" >
                                                                    <?php echo $zf_formHandler->zf_getFormError("studentsListDetails") ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            
                            <!--This section holds information about the students fee details-->
                            <div class="row" id="feesHistoryContainer">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 300px !important;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important;">
                                                <div id="feeDefaultTitle">Fee Payment History</div>
                                                <div id="feeClassTitle" style="color: #21b4e2 !important; padding-top: 3px;"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 portlet-titles" style="min-height: 35px !important; text-align: right !important;">
                                                Select Year: <?=$zf_controller->zf_targetModel->zvs_buildYearsOption("feesHistoryYear");?>
                                            </div>
                                        </div>
                                        <div class="row" id="feesHistoryDetails"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--This section holds the form that is used collect school fees-->
                            <div class="row" id="collectFeesContainer">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important; margin-bottom: 0px !important;">
                                        <div class="portlet-body form">
                                            <?php
                                                //This is the form for school fee setup
                                                Zf_ApplicationWidgets::zf_load_widget("finance_module", "collect_school_fees_form.php", $studentIdentificationCode);
                                            ?>
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
        var $current_view = "collect_fees";

        FinanceModule.init($current_view, $absolute_path, $separator );


    });
</script>  
