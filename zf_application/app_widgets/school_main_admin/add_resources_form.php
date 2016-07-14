<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
   
    
    $assignResources = "mapResources";
    
    $manageResourcesParameters = $identificationCode.ZVSS_CONNECT.$assignResources;
    
    $urlParameter = $zf_externalWidgetData;
    
?>
<form id="subjectUpdateForm" action="<?php Zf_GenerateLinks::basic_internal_link("school_main_admin", "newResourcesRolesMapper", $manageResourcesParameters); ?>" method="post" class="form-horizontal" >    
    
    <div class="row margin-top-10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet box zvs-content-blocks" style="min-height: 50px !important;">
                <div class="portlet-body form" >
                    <h3 class="form-section form-title" style="padding-top: 30px !important;">Add Platform Resources to <?=$urlParameter[2];?></h3> 
                    <div class="alert alert-info">
                        <button class="close" data-dismiss="alert"></button>
                        Select resources from the available platform resources and add them to the role of <?=lcfirst($urlParameter[2]);?>.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    
    <div class="row">
        <?php
            //Here we pull all the forms that have all available platform resources 
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, "add_platform_resources.php", $urlParameter);
        ?>    
    </div>
    <!--/row-->
    
   <div class="form-actions fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-offset-5 col-md-7">
                    <button type="submit" class="btn blue button-submit">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

