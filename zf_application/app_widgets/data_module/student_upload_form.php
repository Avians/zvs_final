<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $student_data_template = "student_data_template";
    
    //echo $identificationCode."<br/>_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k";
    
    $registeredBy = $identificationCode;
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("data_module", "upload_data_templates", $student_data_template); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-12">
                <input type="hidden" name="dataUploadFormError" class="form-control" value="Test data">
                <div class="col-md-12 help-block server-side-error" >
                    <?php echo $zf_formHandler->zf_getFormError("dataUploadFormError"); ?>
                </div>
            </div>
        </div>
    </div>
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

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>
