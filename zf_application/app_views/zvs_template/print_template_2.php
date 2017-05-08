<?php

    //Here we load transport module model for viewing transport reports
    $zf_controller->Zf_loadModel("transport_module", "transport_reports");
    
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
                <h3 class="page-title">Transport Reports</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-line-chart"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Print Test<br>
                 
                    <!--<img src="<?=ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin".DS."TestImage.jpg";?>" width="100px">-->
                
                <?php
                   
                    //$urlx = '<img src="'.ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin".DS."TestImage.jpg".'" width="100px">';
                    
                    //echo $urlx;
                    //$url1 = Zf_Print_Anything::zf_readPrintBody($url);
                    
                    $css = array (
                        '.stylel' => 'color: blue;',
                        '.style2' => 'border: 1px solid red !important;'
                    );
                    
                
                    $printData0 = '
                        <div id="printableTable">
                                <div class="image"><img src="'.ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS."zvs_super_admin".DS."TestImage.jpg".'" width="100px"></div>
                                <div class="style2">
                                        <table style="border: 1px solid #000; padding: 10px !important">
                                                <tr style="border: 1px solid #000;"><td>Fee Items</td><td>Amount Paid</td><td>Comment</td></tr>
                                                <tr style="border: 1px solid #000;"><td>Tuition</td><td>32,000</td><td></td></tr>
                                                <tr style="border: 1px solid #000;"><td>Accommodation</td><td>15,000</td><td></td></tr>
                                                <tr style="border: 1px solid #000;"><td>Insurance</td><td>1,000</td><td></td></tr>
                                                <tr style="border: 1px solid #000;"><td>Sports</td><td>2,000</td><td></td></tr>
                                        </table>
                                </div>
                        </div>';
                
                    $context1 = Zf_Print_Anything::zf_addPrintContext($printData0, $css);
                    $btnCss = 'style="padding: 5px 8px 5px 8px;'
                            . 'text-align: center;float: right;'
                            . 'background-color: #02A6D8;'
                            . 'color: #fff;text-decoration: none;'
                            . 'margin: 10px; border: 0px !important;"'
                            . 'font-family: Roboto-Thin !important;';
                    
                    $printButton = Zf_Print_Anything::zf_showPrintButton($context1, 'Print Table', $btnCss);
                    
                ?>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

