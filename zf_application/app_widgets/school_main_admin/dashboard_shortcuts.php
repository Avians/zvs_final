<?php

    //Here we generate the active URL
    $activeURL = Zf_Core_Functions::Zf_URLSanitize(); $zvs_controller = $activeURL[0];

    //We get the active identification from the user session.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");

?>
<div class="row">
    
    <!--Manage School Profile-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "school_profile", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-institution fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        School Profile
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Classes-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_classes", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-building-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Classes
                    </div>
                </div>
            </div>
        </div>
    </a>
        
    <!--Manage School Departments-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_departments", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-sitemap fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Departments
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Hostels-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_hostels", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-hospital-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Hostels
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Library-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_library", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-folder-open-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Library
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Transport-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_transport", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-truck fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Transport
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Teachers-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_teachers", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-group fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Teachers
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Students-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_students", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-graduation-cap fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Students
                    </div>
                </div>
            </div>
        </div>
   </a>
    
    <!--Manage School Sub Staff-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_substaff", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-male fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Sub Staff
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Fees-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_fees", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-money fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage School Fees
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Subjects-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_subjects", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-book fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Subjects
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Examination-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_exams", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-print fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Examination
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Marksheet-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_marksheet", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-check-square-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Marksheet
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Timetable-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_timetable", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-clock-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Timetable
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Notice Board-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_notice_board", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-comments-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Notice Board
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Calender-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_calendar", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-calendar fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Calendar
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage School Affiliates-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "manage_affiliates", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-share-square-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Affiliates
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage Admin Profile-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, "my_profile", $identificationCode)?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-user fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage User Profile
                    </div>
                </div>
            </div>
        </div>
    </a>
    
</div>