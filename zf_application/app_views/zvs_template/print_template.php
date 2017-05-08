<?php

    //Here we load transport module model for transport overview
    $zf_controller->Zf_loadModel("transport_module", "");
    
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
                <h3 class="page-title">Transport Overview</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-empire"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-test-wrapper">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 80px;border: solid 2px #333;text-align: center; padding: 5px;">
                            <h1>This is a header section</h1>
                        </div>
                        <div class="clearfix"><br></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-test-content" style="height: 300px;border: solid 2px #333;text-align: center; padding: 5px; margin-top: 10px;">
                            <h1>This is a main content section</h1>
                            <div> 
                                <img src="<?=ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin".DS."TestImage.jpg";?>" style="float: left;overflow: hidden;width: 200px;margin-right: 15px;margin-bottom: 8px;">
                                <p style="text-align: left;">CodexWorld was formed to provide web developers and programmers with a single destination to get web development and programming resources. Our mission is to provide developers with all resources they need to help them in their day to day programming, as well as helping them keep up to date with the latest technologies. Learn PHP, MySQL, JavaScript, jQuery, Ajax, WordPress, Drupal, CodeIgniter, CakePHP, Web Development with CodexWorld tutorials. View live demo and download scripts.</p>
                            </div>
                        </div>
                        <div class="clearfix"><br></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 80px;border: solid 2px #333;text-align: center; padding: 5px; margin-top: 10px;">
                            <h1>This is a footer section</h1>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button"">
                        <a href="javascript:void(0);" id="print_button1" style=" padding: 5px 8px 5px 8px;text-align: center;float: right;background-color: #02A6D8;color: #fff;text-decoration: none; margin: 10px;">Print Full Page</a>
                        <a href="javascript:void(0);" id="print_button2" style=" padding: 5px 8px 5px 8px;text-align: center;float: right;background-color: #02A6D8;color: #fff;text-decoration: none; margin: 10px;">Print Main Content</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

<script type="text/javascript">
    
    $(document).ready(function(){
            $("#print_button1").click(function(){
                    var mode = 'iframe'; // popup
                    var close = mode == "popup";
                    var options = { mode : mode, popClose : close};
                    $("div.main-test-wrapper").printArea( options );
            });
            $("#print_button2").click(function(){
                    var mode = 'iframe'; // popup
                    var close = mode == "popup";
                    var options = { mode : mode, popClose : close};
                    $("div.main-test-content").printArea( options );
            });
    });

</script> 