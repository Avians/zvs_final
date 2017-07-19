<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("student_module", "studentInformation");
    
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
                <h3 class="page-title">Student &AMP; Guardian Information</h3>
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
                            <!--This is the section for selecting student-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="alert alert-info">
                                        <button class="close" data-dismiss="alert"></button>
                                        <b>In order to view a student profile, select the target student class, then select an associated stream. From the populated student list, select/search the name of the student whose profile you want to view.</b>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 160px !important; height: auto !important;">
                                                <div class="portlet-titles">Student Class Details</div>
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
                            
                            <!--This section holds information about the students who has been selected-->
                            <div class="row" class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="studentProfileContainer" style="margin-bottom: -5px !important;">
                                    <div class="row" id="studentProfileDetails">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet zvs-content-blocks col-md-12" class="zvs_preloader" align="center">
                                                <div class="zvs_loader"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="guardianProfileContainer" style="margin-bottom: -5px !important;">
                                    <div class="row" id="guardianProfileDetails">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet zvs-content-blocks col-md-12" class="zvs_preloader" align="center">
                                                <div class="zvs_loader"></div>
                                            </div>
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
        var $current_view = "student_guardian_profile";

        ParentModule.init($current_view, $absolute_path, $separator );
        
        //This ensures that the data pre-loader is loaded before data is loaded.
        $(".studentsListDetails").change(function(){

            $(".zvs_preloader, .zvs_loader").show();

            $( "#guardianProfileDetails").load(function() {
                $(".zvs_preloader, .zvs_loader").hide();
            });

        });

    });
</script>  
