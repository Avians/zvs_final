<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("staff_module", "staffInformation");
    
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
                <h3 class="page-title">Staff Information</h3>
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
                        <li><a>General staff details</a></li>
                    </ul>

                    <div class="z-content-inner" style="background-color: #EFEFEF !important;">
                        <div style="margin-bottom: -10px !important;">
                            <!--This is the section for selecting student-->
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="alert alert-info">
                                        <button class="close" data-dismiss="alert"></button>
                                        <b>In order to view staff profile, select a specific school role to which the target staff belongs. From the populated staff list, select/search the name of the staff whose profile you want to view.</b>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet zvs-content-blocks" style="min-height: 150px !important;">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 90px !important; height: auto !important;">
                                                <div class="portlet-titles">Filter Staff Role</div>
                                                <div class="row" style="margin-top: 20px !important;">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Select Role:</label>
                                                            <div class="col-md-8">
                                                                <select class="form-control select2me schoolRoleCode" id="schoolRoleCode" name="schoolRoleCode" data-placeholder="" value="<?php echo $zf_formHandler->zf_getFormValue("schoolRoleCode"); ?>">
                                                                    <?php
                                                                        //Here we fetch all available school roles
                                                                        Zf_ApplicationWidgets::zf_load_widget("zvs_options", "role_select.php", $identificationCode);
                                                                    ?>
                                                                </select>
                                                                <span class="help-block server-side-error">
                                                                    <?php echo $zf_formHandler->zf_getFormError("schoolRoleCode") ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="portlet-titles">Filter Staff Name</div>
                                                <div class="row" style="margin-top: 20px !important;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Name/ID No:</label>
                                                            <div class="col-md-8">
                                                                <select class="form-control select2me staffIdentificationCode" id="staffIdentificationCode" name="staffIdentificationCode" data-placeholder="[25138058] - Athias Avians, ..." value="<?php echo $zf_formHandler->zf_getFormValue("staffIdentificationCode"); ?>">
                                                                    <option value=""></option>
                                                                </select>
                                                                <span class="help-block server-side-error" >
                                                                    <?php echo $zf_formHandler->zf_getFormError("staffIdentificationCode") ?>
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
                            
                            <!--This section holds information about the staff who has been selected-->
                            <div class="row" class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="staffProfileContainer" style="margin-bottom: -5px !important;">
                                    <div class="row" id="staffProfileDetails">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet zvs-content-blocks col-md-12" class="zvs_preloader" align="center">
                                                <div class="zvs_loader"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="relatedDetailsContainer" style="margin-bottom: -5px !important;">
                                    <div class="row" id="relatedStaffDetails">
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
        var $current_view = "staff_profile";

        StaffModule.init($current_view, $absolute_path, $separator );
        
        //This ensures that the data pre-loader is loaded before data is loaded.
        $(".studentsListDetails").change(function(){

            $(".zvs_preloader, .zvs_loader").show();

            $( "#guardianProfileDetails").load(function() {
                $(".zvs_preloader, .zvs_loader").hide();
            });

        });

    });
</script>  
