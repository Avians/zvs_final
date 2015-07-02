    <?php
        
        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the controller
        $zvs_controller = $activeURL[0];
        
        //This is user identificationCode
        $identificationCode = $zf_actionData;
        
        //This model holds all user information details
        $zf_controller->Zf_loadModel("zvs_platform_admin", "userInformation");
        
    ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">Platform Administrator's Profile</h3>
                    <div class="page-breadcrumb breadcrumb">
                        <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                    </div>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            
            <div class="clearfix"></div>
            <?php 
                $userInformation = $zf_controller->zf_targetModel->getUserInformation($identificationCode);

                foreach ($userInformation as $value) {

                    $designation = $value['designation']; $userName = $value['firstName']." ".$value['lastName']; $mobileNumber = $value['mobileNumber']; $gender = $value['gender']; $dateCreated = date(" jS M, Y", strtotime($value['dateCreated']));
                    $address = $value['boxAddress']; $imagePath = $value['imagePath']; $idNumber = strtoupper($value['idNumber']); $userStatus = $value['userStatus'];

                    if($gender == "Male"){

                        $referrer = "His"; $referrer2 = "he";

                    }else if($gender == "Female"){

                        $referrer = "Her"; $referrer2 = "she";

                    }

                    $status = ($userStatus == 1 ? "Active" : "Inactive");

                }   
            ?>
            
            <!-- BEGIN INNER CONTENT -->
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="portlet box zvs-content-blocks">
                        <div class="zvs-content-titles">
                            <h3>Platform Administrator's Profile</h3>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-10 margin-bottom-20">
                                    <?php if(empty($imagePath) || $imagePath == NULL){ ?>
                                        <div class="zvs-circular">   
                                           <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                        </div>
                                    <?php }else{
                                        $zf_controller->zf_targetModel->getUserImage($imagePath, $userName); 
                                    }?>
                                    <div class="margin-top-10"><span style="color: #32B9E4;"><i class="fa fa-check-circle-o zvs-user-profile" style="color: #32B9E4;"></i>&nbsp;&nbsp;User <?=$status;?></span></div>
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
                                
                        </div>
                    </div>          
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="portlet box zvs-content-blocks">
                        <div class="zvs-content-titles">
                            <h3>Administrator's Story</h3>
                        </div>
                        <div class="portlet-body" style="text-align: justify;">
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p><?= $designation." ".$userName; ?> is a Platform Administrator at Zilas Virtual Schools<sup style='font-size: 8px !important; font-style: normal;'>TM</sup>. <?=$referrer;?> platform ID Number is <span style='color: #32B9E4; '><?=$idNumber;?></span> and I have been registered since <?=$dateCreated;?>.</p>
                                    <p>As a Platform Administrator <?=$referrer2;?> registers new schools on the platform and ensures that their IT administrator are able to access platform resources and construct a virtual school from scratch. In addition, <?=$referrer2; ?> she has the power to confirm or suspend a school that faults platform regulations. </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 margin-bottom-5">
                                    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "new_user", "$identificationCode"); ?>">
                                        <button type="button" class="btn pull-right zvs-buttons" style="color: #ffffff !important;">
                                            <i  style="color: #ffffff !important;" class="fa fa-arrow-circle-left"></i> &nbsp;Back to Administrators
                                        </button>
                                    </a>
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

