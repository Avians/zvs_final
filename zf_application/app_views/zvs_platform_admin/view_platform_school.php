    <?php
        
        $activeURL = Zf_Core_Functions::Zf_URLSanitize();

        //This is the controller
        $zvs_controller = $activeURL[0];
        
        //This is unique code for each school
        $systemSchoolCode = Zf_SecureData::zf_decode_url($zf_actionData);
        
        //This model holds all user information details
        $zf_controller->Zf_loadModel("zvs_school_details", "platformSchoolDetails");
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
        
    ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">Platform School Profile</h3>
                    <div class="page-breadcrumb breadcrumb">
                        <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
                    </div>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            
            <div class="clearfix"></div>
            <?php 
            
                $adminInformation = $zf_controller->zf_targetModel->getAdminInformation($systemSchoolCode);

                foreach ($adminInformation as $value) {
                    
                    $designation = $value['designation']; $userName = $value['firstName']." ".$value['lastName']; $mobileNumber = $value['mobileNumber']; $gender = $value['gender']; $dateCreated = date(" jS M, Y", strtotime($value['dateCreated']));
                    $address = $value['boxAddress']; $idNumber = strtoupper($value['idNumber']); $userStatus = $value['userStatus']; $adminImage = $value['imagePath'];
                    $status = ($userStatus == 1 ? "Active" : "Inactive"); $createdBy = $value['createdBy'];

                } 
                
                $schoolInformation = $zf_controller->zf_targetModel->getSchoolInformation($systemSchoolCode);

                foreach ($schoolInformation as $value) {
                    
                    $schoolName = $value['schoolName']; $schoolRegDate = date(" jS M, Y", strtotime($value['dateCreated'])); $dateOfEstablishment = $value['dateOfEstablishment']; $schoolType =  $value['schoolType']; $schoolStatus = $value['schoolStatus'];
                    $schoolLevel = $value['schoolLevel']; $schoolGender = $value['schoolGender']; $schoolCategory = strtolower($value['schoolCategory']); $countryCode = $value['schoolCountry']; $localityCode = $value['schoolLocality'];
                    $schoolMobileNumber = $value['schoolMobileNumber']; $schoolPhoneNumber = $value['schoolPhoneNumber']; $schoolBoxAddress = $value['schoolBoxAddress']; $schoolEmail = $value['schoolEmail']; $schoolWebsite = $value['schoolWebsite']; $schoolMotto = $value['schoolMotto'];
                    
                    $schoolStatus = ($schoolStatus == 1 ? "Active" : "Inactive"); $schoolLogo = $value['schoolLogoPath'];
                    
                    if($schoolLevel == "Primary School"){ $schoolLevel = "primary";}else if($schoolLevel == "Secondary School"){$schoolLevel = "secondary";}else if($schoolLevel == "Tertiary College"){$schoolLevel = "college";}else if($schoolLevel == "Polytechnic"){$schoolLevel = "polytechnic";}                   
                    if($schoolGender == "Boys School"){$schoolGender = "boys'";}else if($schoolGender == "Girls School"){$schoolGender = "girls'";}
                    if($schoolType == "Public School"){$schoolType = "publicly";}else if($schoolType == "Private School"){$schoolType = "privately";}
                    
                    $schoolLocality = $zf_controller->zf_targetModel->getSchoolLocation($countryCode, $localityCode);
                    
                } 

            ?>
            <!-- BEGIN INNER CONTENT -->
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="portlet box zvs-content-blocks">
                        <div class="zvs-content-titles">
                            <h3>School Administrator Profile</h3>
                        </div>
                        <div class="portlet-body">
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-10 margin-bottom-20">
                                    <?php if(empty($adminImage) || $adminImage == NULL){ ?>
                                        <div class="zvs-circular">   
                                           <i class="fa fa-user" style="font-size: 80px; padding-top: 30px !important; color: #e5e5e5 !important;"></i>
                                        </div>
                                    <?php }else{
                                        $zf_controller->zf_targetModel->getUserImage($adminImage, $userName); 
                                    }?>
                                    <div class="margin-top-10"><span style="color: #32B9E4;"><i class="fa fa-check-circle-o zvs-user-profile" style="color: #32B9E4;"></i>Admin <?=$status;?></span></div>
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
                    <div class="portlet box zvs-content-blocks">
                        <div class="zvs-content-titles">
                            <h3>Platform Administrator Details</h3>
                        </div>
                        <div class="portlet-body-short" style="border: 0px solid #000 !important;">
                            <?php 
                            if($identificationCode == $createdBy){ ?>
                                <?=$schoolName;?> was registered to Zilas Virtual Schools<sup style='font-size: 8px !important; font-style: normal;'>TM</sup> by me.    
                                <div class="row margin-top-10">
                                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                        <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "my_profile", "$identificationCode"); ?>">
                                            <button type="button" class="btn pull-right zvs-buttons" style="color: #ffffff !important;">
                                                <i  style="color: #ffffff !important;" class="fa fa-arrow-circle-left"></i> &nbsp;My Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            <?php }else{ 
                                print_r($zf_controller->zf_targetModel->getPlatformAdminInformation($createdBy, $schoolName));
                                if(Zf_Core_Functions::Zf_DecodeIdentificationCode($createdBy)[3] != ZVS_SUPER_ADMIN){
                            ?> 
                                <div class="row margin-top-10">
                                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                        <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "my_profile", "$identificationCode"); ?>">
                                            <button type="button" class="btn pull-right zvs-buttons" style="color: #ffffff !important;">
                                                <i  style="color: #ffffff !important;" class="fa fa-user"></i> &nbsp;Admin Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>  
                            <?php }}?>
                        </div>
                    </div>
 
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="portlet box zvs-content-blocks">
                        <div class="zvs-content-titles">
                            <h3>School History</h3>
                        </div>
                        <div class="portlet-body" style="text-align: justify;">
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p><?= $schoolName; ?> has been registered on Zilas Virtual Schools<sup style='font-size: 8px !important; font-style: normal;'>TM</sup>, since <?=$schoolRegDate;?>. Established in <?=$dateOfEstablishment;?>, the <?=$schoolType;?> administered school is located in <?=$schoolLocality;?>, and is a <?=$schoolLevel;?> <?=$schoolGender;?> <?=$schoolCategory;?></p>
                                    <p><b><u>Other School Information</u></b></p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-top-20 margin-bottom-20">
                                            <?php if(empty($schoolLogo) || $schoolLogo == NULL){ ?>
                                                <div class="zvs-circular margin-top-10">   
                                                   <i class="fa fa-sun-o" style="font-size: 80px; padding-top: 35px !important; color: #e5e5e5 !important;"></i>
                                                </div>
                                            <?php }else{
                                                $zf_controller->zf_targetModel->getSchoolLogo($schoolLogo, $schoolName); 
                                            }?>
                                            <div class="margin-top-10" style="text-align: center !important;"><span style="color: #32B9E4;"><i class="fa fa-check-circle-o zvs-user-profile" style="color: #32B9E4;"></i>&nbsp;&nbsp;School <?=$schoolStatus;?></span></div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-bordered table-responsive table-hover">
                                                    <tbody>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-mobile-phone zvs-user-profile"></i></td><td><?=$schoolMobileNumber; ?></td></tr>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-phone zvs-user-profile"></i></td><td><?=$schoolPhoneNumber; ?></td></tr>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-envelope zvs-user-profile"></i></td><td><?=$schoolBoxAddress; ?></td></tr>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-edit zvs-user-profile"></i></td><td><?=$schoolEmail; ?></td></tr>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-link zvs-user-profile"></i></td><td><?=$schoolWebsite; ?></td></tr>
                                                        <tr><td style="text-align: center !important;"><i class="fa fa-ellipsis-h zvs-user-profile"></i></td><td><?=$schoolMotto; ?></td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top-20">
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 margin-top-10">
                                    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "new_school", "$identificationCode"); ?>">
                                        <button type="button" class="btn pull-right zvs-buttons" style="color: #ffffff !important;">
                                            <i  style="color: #ffffff !important;" class="fa fa-arrow-circle-left"></i> &nbsp;Back to School
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

