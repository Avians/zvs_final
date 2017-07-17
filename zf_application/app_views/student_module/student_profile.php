<?php

    //Access to pull all administrator information.
    $zf_controller->Zf_loadModel("student_module", "studentProfile");
    
    //This is user identification code
    $identificationCode = Zf_SecureData::zf_decode_data($zf_actionData[0]);
    
    //This is the student admission number
    $studentAdmissionNumber = $zf_actionData[1];
    
    //Zf_SessionHandler::zf_setSessionVariable("sessionIdentificationCode", $identificationCode);
  
    
?>
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Student Profile</h3>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a>General student profile</a></li>
                    </ul>

                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Student Personal Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class="" style="color: #21B4E2 !important;">Student Details</h3>
                                        </div>
                                        <?php
                                            $zf_controller->zf_targetModel->fetchStudentProfile($zf_actionData);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: -5px !important;">
                                    <div class="portlet box zvs-content-blocks" style="min-height: 350px !important;">
                                        <!--Guardian Details-->
                                        <div class="zvs-content-titles">
                                            <h3 class=""style="color: #21B4E2 !important;">Guardian Details</h3>
                                        </div>
                                        <?php
                                            $zf_controller->zf_targetModel->fetchGuardianProfile($zf_actionData);
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class='row'>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-20" style="padding-left: 7% !important;">
                                            <?php

                                                    $css = array (
                                                        '.stylel' => 'color: blue;',
                                                        '.style2' => 'border: 1px solid red !important;'
                                                    );


                                                    $printData = '<div class="table-responsive" style="width: 50% !important; margin-left: 25%; border: 1px solid #EDEDED !important;">
                                                                    <div style="color: #21b4e2 !important; padding-top: 3px;">Form One Fees Structure - 2016</div>
                                                                    <table class="table table-striped table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 60%;"> Fee Item Name</th><th style="width: 35%; text-align: right; padding-right: 10px;">Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr><td>Tuition</td><td style="text-align: right; padding-right: 10px;">4,000.00</td></tr>
                                                                            <tr><td>Boarding</td><td style="text-align: right; padding-right: 10px;">32,300.00</td></tr>
                                                                            <tr><td>Insurance</td><td style="text-align: right; padding-right: 10px;">1,050.00</td></tr>
                                                                            <tr><td>Medical</td><td style="text-align: right; padding-right: 10px;">500.00</td></tr>
                                                                            <tr><td>Activity</td><td style="text-align: right; padding-right: 10px;">800.00</td></tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th style="width: 60%;"> Totals</th><th style="width: 35%; text-align: right; padding-right: 10px;">38,650.00</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>';

                                                    $dataContext = Zf_Print_Anything::zf_addPrintContext($printData, $css);
                                                    $dataContextx = Zf_Print_Anything::zf_addPrintContext();
                                                    $btnCss = 'style="padding: 5px 5px 5px 5px !important;'
                                                            . 'text-align: center;float: right;'
                                                            . 'background-color: #02A6D8;'
                                                            . 'color: #fff;text-decoration: none;'
                                                            . 'border: 0px !important; width: 130px !important;'
                                                            . 'font-family: Roboto-Thin !important;'
                                                            . 'font-size: 12px !important;';

                                                ?>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-top-10 center" id="printButton">
                                                    <?=Zf_Print_Anything::zf_showPrintButton($dataContextx, 'Print Student Details', $btnCss);?>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-top-10 center" id="printButton">
                                                    <?=Zf_Print_Anything::zf_showPrintButton($dataContextx, 'Print Guardian Details', $btnCss);?>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-top-10 center" id="printButton">
                                                    <?=Zf_Print_Anything::zf_showPrintButton($dataContextx, 'Generate Student Card', $btnCss);?>
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

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

   
 
