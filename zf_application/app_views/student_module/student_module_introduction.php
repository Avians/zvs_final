<?php

    //Here we load store module model for store suppliers
    //$zf_controller->Zf_loadModel("class_module", "section_module_file");
    
    //This is user identification code
    $zf_urlParameter = Zf_SecureData::zf_decode_data($zf_actionData);
    
?>
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Student Module</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-cubes"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
             <div class="portlet-body" >
                <div class="row margin-top-20">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 300px !important; height: auto !important; text-align: center !important">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" margin-top: 20px !important;">
                            <img src="<?php echo ZF_ROOT_PATH.ZF_DATASTORE."zvs_module_images".DS."students.png"; ?>" width=" 75% " height=" 75%" alt="Student Module" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" style=" text-align: center !important;">
                            Introduction to student module
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles margin-top-20" style=" font-size: 12px !important;">
                            <ol class="instructions-list" start="i">
                                <li>Download students data template from the left section of this page.</li>
                                <li>Open the download file in a spreadsheet application e.g. Excel, Numbers, or Libre Office.</li>
                                <li style="color: #ff0000;"><strong>NB:</strong> You will be uploading data in batches of at-most 30 records at a time.</li>
                                <li>Fill in at-most 30 records, without renaming any field titles or the worksheet names.</li>
                                <li>After filling all valid information, counter-check then save all the changes that you have made.</li>
                                <li>Your students data is now ready for uploading into the system.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

