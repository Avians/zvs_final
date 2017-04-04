<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("data_module", "processStaffData");
    
    //This is user identification code
    $identificationCode = Zf_SecureData::zf_decode_data($zf_actionData);
    
    Zf_SessionHandler::zf_setSessionVariable("userIdentificationCode", $identificationCode);
    
?>
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Manage Staff Data</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-database"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                        <li><a><i class="fa fa-cloud-download"></i>Down staff data template</a></li>
                        <li><a><i class="fa fa-cloud-upload"></i> Bulk upload staff data</a></li>
                    </ul>
                     <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 300px !important;">
                                        <div class="portlet-body form" >
                                            <div class="row margin-top-20">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 280px !important; height: auto !important; text-align: center !important">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" margin-top: 100px !important;">
                                                        <a href="<?php echo Zf_GenerateLinks::basic_internal_link("data_module", "download_data_templates", "staff_data_template.xlsx") ?>" target="_blank">
                                                            <i class="fa fa-cloud-download margin-top-20" style="font-size: 150px !important;"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" >
                                                        Download staff data template
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" style=" text-align: center !important;">
                                                        Staff Data Sheet Instructions
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles margin-top-20" style=" font-size: 12px !important;">
                                                        <ol class="instructions-list" start="i">
                                                            <li>Download staff data template from the left section of this page.</li>
                                                            <li>Open the download file in a spreadsheet application e.g. Excel, Numbers, or Libre Office.</li>
                                                            <li>Fill in all the worksheets without renaming any field titles or the worksheet names.</li>
                                                            <li>After Filling all valid information, counter-check then save all the changes that you have made.</li>
                                                            <li>Your staff data is now ready for uploading into the system.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            
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
    <!-- END CONTENT -->

