<?php

    //Here we generate the active URL
    $activeURL = Zf_Core_Functions::Zf_URLSanitize(); $zvs_controller = $activeURL[0];

    //We get the active identification from the user session.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");

?>
<div class="row">
    
    <!--Create New School-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "new_user", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-user-plus fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        New Admin
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Registered Schools-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "admin_directory", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-users fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Platform Admins
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Confirmed Schools-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "new_school", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-sign-in fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        New School
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Suspended School-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "schools_directory", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-cubes fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Platform Schools
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Mail Listing-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_resources", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-yelp fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Platform Resources
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Mail Listing-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "my_profile", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-user fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        User Profile
                    </div>
                </div>
            </div>
        </div>
    </a>
    
</div>