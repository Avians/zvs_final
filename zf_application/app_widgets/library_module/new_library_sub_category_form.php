<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_library_sub_category = "new_library_sub_category";;
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("library_module", "library_Setup_Process", $new_library_sub_category); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_library_sub_category_form">
    <div class="form-wizard" id="newLibrarySubCategory">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newLibrarySubCategoryInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Library Category Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewLibrarySubCategoryInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Library Category Details
                        </span>
                    </a>
                </li>
            </ul>
            <div id="bar" class="progress progress-striped active progress-bar-radius" role="progressbar">
                <div class="progress-bar progress-bar-info progress-bar-radius" style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar"></div>
            </div>
            <div class="tab-content">
                <div class="alert alert-danger display-none">
                    <button class="close" data-dismiss="alert"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-none">
                    <button class="close" data-dismiss="alert"></button>
                    Your form validation is successful!
                </div>
                
                
                <!-- START OF LIBRARY SETUP FORM-->
                <div class="tab-pane" id="newLibrarySubCategoryInfo">
                    <h3 class="form-section form-title">New Library Category Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Library Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me libraryCategoryCodeSubCategory" id="libraryCategoryCodeSubCategory" name="libraryCategoryCode" data-placeholder="Mathematics, Science, Langauages,..." value="<?php echo $zf_formHandler->zf_getFormValue("libraryCategoryCode"); ?>">
                                        <?php
                                            //Here we pull all the library categories 
                                            Zf_ApplicationWidgets::zf_load_widget("library_module", "process_library_categories.php", $identificationCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("libraryCategoryCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="librarySubCategoryName" class="form-control" placeholder="Class One Mathematics Book" value="<?php echo $zf_formHandler->zf_getFormValue("librarySubCategoryName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("librarySubCategoryName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" name="librarySubCategoryAlias" class="form-control" placeholder="Class One Mathematics Book" value="<?php echo $zf_formHandler->zf_getFormValue("librarySubCategoryAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("librarySubCategoryAlias"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <input type="hidden" class="form-control" name="adminIdentificationCode" value="<?php echo $identificationCode; ?>">
                    
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM LIBRARY SETUP SECTION-->
                <div class="tab-pane" id="confirmNewLibrarySubCategoryInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Library Category Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Library Category Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="libraryCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="librarySubCategoryName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category Alias:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="librarySubCategoryAlias"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                </div>
                <!-- END OF CONFIRM SETUP SECTION-->
                
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-5 col-md-7">
                        <a href="javascript:;" class="btn default button-previous">
                            <i class="m-icon-swapleft"></i> Back
                        </a>
                        <a href="javascript:;" class="btn blue button-next">
                            Continue <i class="m-icon-swapright m-icon-white"></i>
                        </a>
<!--                        <a href="javascript:;" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </a>-->
                        <button type="submit" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>