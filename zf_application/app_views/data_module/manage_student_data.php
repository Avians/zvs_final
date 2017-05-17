<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("data_module", "processStudentData");
    
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
                <h3 class="page-title">Manage Student Data</h3>
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
                        <li><a><i class="fa fa-cloud-download"></i>Download student data template</a></li>
                        <li><a><i class="fa fa-cloud-upload"></i> Bulk upload student data</a></li>
                    </ul>
                     <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            <div class="row margin-top-20">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 300px !important; height: auto !important; text-align: center !important">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" margin-top: 80px !important;">
                                                        <a href="<?php echo Zf_GenerateLinks::basic_internal_link("data_module", "download_data_templates", "students_data_template.xls") ?>" target="_blank">
                                                            <i class="fa fa-cloud-download margin-top-20" style="font-size: 150px !important; color: #21B4E2;"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" >
                                                        Download students data template 
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" style=" text-align: center !important;">
                                                        Students Data Sheet Instructions
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
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -15px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 340px !important;">
                                        <div class="portlet-body form" >
                                            <div class="row margin-top-20">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #efefef; min-height: 300px !important; height: auto !important; text-align: center !important">
                                                    <form action="<?php Zf_GenerateLinks::basic_internal_link("data_module", "upload_data_templates", "student_data_template"); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail margin-top-20" style="width: 150px; height: 120px; padding-top: 50px;">
                                                                        <i class="fa fa-cloud-upload" style="font-size: 100px !important; color: #21B4E2;"></i>
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 120px; color: #21B4E2 !important; padding-top: 0px;"></div>
                                                                    <div style="margin-left: 10px !important; margin-top: 10px !important;">
                                                                        <span class="btn default btn-file form-btn">
                                                                            <span class="fileinput-new">
                                                                                Select File
                                                                            </span>
                                                                            <span class="fileinput-exists">
                                                                                Change
                                                                            </span>
                                                                            <input type="file" name="studentDataTemplate" value="">
                                                                        </span>
                                                                        &nbsp;&nbsp;
                                                                        <span>
                                                                            <a href="#" class="btn default fileinput-exists form-btn" data-dismiss="fileinput">
                                                                                Remove
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-actions fluid">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn zvs-buttons center-block" style="color: #ffffff !important;">
                                                                            Upload Student Data
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="createdBy" value="<?php echo $identificationCode; ?>">
                                                    </form>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles-blue margin-top-20" style=" text-align: center !important;">
                                                        Student Data Upload Instructions
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 portlet-titles margin-top-20" style=" font-size: 12px !important;">
                                                        <ol class="instructions-list" start="1">
                                                            <li style="color: #ff0000;"><strong>NB:</strong> Check to ensure that the student data template, you are about to upload, has at-most 30 student records.</li>
                                                            <li>Click on <u>Select File</u> so at to select student data template file that you have correctly filled with valid student data.</li>
                                                            <li>Once selected, you will have the ability to change the file in either of the following two ways:</li>
                                                            <ol class="instructions-list" start="1" type="i">
                                                                <li>Select <u>Change</u>, to change your current selection of student data template</li>
                                                                <li>Select <u>Remove</u>, to remove your current selection of student data template</li>
                                                            </ol>
                                                        </ol>
                                                        <ol class="instructions-list" start="3">
                                                            <li>Click <u>Upload Student Data</u> so as to upload your student data to the database</li>
                                                        </ol>
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
            </div>
        </div>
        <!-- END INNER CONTENT -->
        
    </div>
    <!-- END CONTENT -->