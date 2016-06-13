<?php

    $activeURL = Zf_Core_Functions::Zf_URLSanitize();

    //This is the controller
    $zvs_controller = $activeURL[0];
    
    //This is the parameter
    $urlParameter = Zf_SecureData::zf_decode_url($activeURL[2]);
    
    $urlParameterArray = explode(ZVSS_CONNECT, $urlParameter);
    
    $identificationCode = $urlParameterArray[0];
    $schoolStreamCode = $urlParameterArray[1].ZVSS_CONNECT.$urlParameterArray[2].ZVSS_CONNECT.$urlParameterArray[3];
    
    //echo $identificationCode; exit();
    
    //We are accessing the model that holds all class details
    $zf_controller->Zf_loadModel("school_main_admin", "manageSchoolClasses");
    
    $actualStreamDetails = $zf_controller->zf_targetModel->zvs_fetchStreamOuterDetails($schoolStreamCode);
    
    foreach ($actualStreamDetails as $streamDetails) {
        
        $streamName = $streamDetails['schoolStreamName']; $streamCapacity = $streamDetails['schoolStreamCapacity']; $streamOccupancy = $streamDetails['schoolStreamOccupancy'];
        $streamAvailability = $streamCapacity-$streamOccupancy;
    }
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Class Details</h3>
                <div class="page-breadcrumb breadcrumb">
                    <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                </div>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                <div id="tabbed-nav">
                    <ul class="z-tabs-titles">
                        <li><a><?=$streamName;?> Overview</a></li>
                        <li><a><i class="fa fa-edit"></i>Edit <?=$streamName;?></a></li>
                    </ul>
                    
                    <div class="z-content-inner">
                        <div>
                            <div class="row margin-top-10">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Class Teacher Profile</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <?php 
                                                $zf_controller->Zf_loadModel("school_main_admin", "userInformation");
                                                $userInformation = $zf_controller->zf_targetModel->getUserInformation($identificationCode);

                                                foreach ($userInformation as $value) {

                                                    $designation = $value['designation']; $userName = $value['firstName']." ".$value['lastName']; $mobileNumber = $value['mobileNumber']; $gender = $value['gender']; $dateCreated = date("M j, Y", strtotime($value['dateCreated'])); $address = $value['boxAddress']; $imagePath = $value['imagePath'];

                                                } 
                                                
                                                
                                                if($userInformation == 0){ 
                                                    
                                                ?>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="portlet-body">
                                                                <div class=" zvs-content-warnings" style="text-align: center !important; padding-top: 15% !important;">
                                                                    <i class="fa fa-warning" style="color: #B94A48 !important;font-size: 18px !important;"></i>
                                                                    <div class="content-view-errors" >
                                                                        No class teacher assigned to this class at the moment. Details will be populated once a class teacher has been assigned.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                <?php }else if($userInformation != 0){ ?>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-10 margin-bottom-20">
                                                            <?php if(empty($imagePath) || $imagePath == NULL){ ?>
                                                                <div class="zvs-circular">   
                                                                   <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                                                </div>
                                                            <?php }else{
                                                                $zf_controller->zf_targetModel->getUserImage($imagePath, $userName); 
                                                            }?>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-condensed table-responsive table-hover">
                                                                    <tbody>
                                                                        <tr><td><i class="fa fa-user zvs-user-profile"></i></td><td><?= $designation." ".$userName; ?></td></tr>
                                                                        <tr><td><i class="fa fa-phone zvs-user-profile"></i></td><td><?= $mobileNumber; ?></td></tr>
                                                                        <tr><td><i class="fa fa-envelope zvs-user-profile"></i></td><td><?= $address; ?></td></tr>
                                                                        <tr><td><i class="fa fa-transgender zvs-user-profile"></i></td><td><?= $gender; ?></td></tr>
                                                                        <tr><td><i class="fa fa-calendar-o zvs-user-profile"></i></td><td><?= $dateCreated." (Date Created)"; ?></td></tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                               <?php } ?>
                                        </div>
                                    </div>  
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Scheduled Events</h3>
                                        </div>
                                        <div class="portlet-body-short" style="border: 0px solid #000 !important;">
                                            Data goes here
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="portlet box zvs-content-blocks">
                                        <div class="zvs-content-titles">
                                            <h3>Stream Details</h3>
                                        </div>
                                        <div class="portlet-body" style="text-align: justify;">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Capacity</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        <?=$streamCapacity;?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Occupancy</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        <?=$streamOccupancy;?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Availability</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        <?=$streamAvailability;?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 5px auto 5px auto !important;"><hr /></div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Total Fee Balance</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        KES 180,000.00
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Average Performance</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        B+
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 5px auto 5px auto !important;"><hr /></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="zvs-inner-content-titles">
                                                        <h3>Gender Segmentation</h3>
                                                    </div>
                                                    <div class="portlet-inner-body-short" style="border: 0px solid #000 !important;">
                                                        <!--This section will hold data about the percentage of students that are male against female-->
                                                        <?=$classStreams;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-5">
                                                    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_classes", "$identificationCode"); ?>">
                                                        <button type="button" class="btn pull-right zvs-buttons" style="color: #ffffff !important;">
                                                            <i  style="color: #ffffff !important;" class="fa fa-building"></i> &nbsp;Manage Classes
                                                        </button>
                                                    </a>
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
                                            form for editing {form_name} goes here.
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

