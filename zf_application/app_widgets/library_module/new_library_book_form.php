<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
    
    $new_library_book = "new_library_book";

    //$currentDate = Zf_Core_Functions::Zf_CurrentDate();
    
    //$currentYear = explode("-", $currentDate)[2];
    
?>

<form action="<?php Zf_GenerateLinks::basic_internal_link("library_module", "library_Setup_Process", $new_library_book); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="new_library_book_form">
    <div class="form-wizard" id="newLibraryBook">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#newLibraryBookInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Library Book Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmNewLibraryBookInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Library Book Details
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
                <div class="tab-pane" id="newLibraryBookInfo">
                    <h3 class="form-section form-title">New Library Book Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Library Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me libraryCategoryCodeNewBook" id="libraryCategoryCodeNewBook" name="libraryCategoryCode" data-placeholder="Mathematics, Science, Langauages,..." value="<?php echo $zf_formHandler->zf_getFormValue("libraryCategoryCode"); ?>">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me librarySubCategoryCodeNewBook" id="librarySubCategoryCodeNewBook" name="librarySubCategoryCode" data-placeholder="Mathematics Books, Science Books" value="<?php echo $zf_formHandler->zf_getFormValue("librarySubCategoryCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("librarySubCategoryCode"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Book Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="libraryBookName" class="form-control" placeholder="English Dictionary, Kamusi ya Kiswahili, ...." value="<?php echo $zf_formHandler->zf_getFormValue("libraryBookName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("libraryBookName"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Book Author:</label>
                                <div class="col-md-8">
                                    <input type="text" name="libraryBookAuthor" class="form-control" placeholder="Shakes Spear, William Warren, Anne ...." value="<?php echo $zf_formHandler->zf_getFormValue("libraryBookAuthor"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("libraryBookAuthor"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">No. of Copies:</label>
                                <div class="col-md-8">
                                    <input type="text" name="bookNoOfCopies" class="form-control" placeholder="1, 10, 30 ...." value="<?php echo $zf_formHandler->zf_getFormValue("bookNoOfCopies"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("bookNoOfCopies"); ?>
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
                <div class="tab-pane" id="confirmNewLibraryBookInfo">
                    <h3 class="block  form-title"><i class='fa fa-user' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Library Book Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Library Category:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="libraryCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="librarySubCategoryCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Book Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="libraryBookName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Book Author:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="libraryBookAuthor"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">No. of Copies:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="bookNoOfCopies"></p>
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