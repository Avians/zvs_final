<?php

/** 
 * This menu is used by a school main admin
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;

$main_menu = array(
    
    //Main dashboard
    "main_dashboard" => array(
        'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
        'controller' => $zvs_controller,
        'action' => 'main_dashboard',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //School Profile
    "school_profile" => array(
        'name' => '<i class="fa fa-institution"></i> <span class="title">School Profile </span><span class="selected"></span>',
        'controller' => $zvs_controller,
        'action' => 'school_profile',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Classess
    "manage_classes" => array(
        'name' => '<i class="fa fa-building-o"></i> Manage Classes',
        'controller' => $zvs_controller,
        'action' => 'manage_classes',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Departments
    "manage_departments" => array(
        'name' => '<i class="fa fa-sitemap"></i> Manage Departments ',
        'controller' => $zvs_controller,
        'action' => 'manage_departments',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Hostels
    "manage_hostels" => array(
        'name' => '<i class="fa fa-hospital-o"></i> Manage Hostels ',
        'controller' => $zvs_controller,
        'action' => 'manage_hostels',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Teachers
    "manage_teachers" => array(
        'name' => '<i class="fa fa-group"></i> Manage Teachers ',
        'controller' => $zvs_controller,
        'action' => 'manage_teachers',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Students
    "manage_students" => array(
        'name' => '<i class="fa fa-graduation-cap"></i> Manage Students ',
        'controller' => $zvs_controller,
        'action' => 'manage_students',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Sub Staff
    "manage_substaff" => array(
        'name' => '<i class="fa fa-male"></i> Manage Sub-Staff ',
        'controller' => $zvs_controller,
        'action' => 'manage_substaff',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Fees
    "manage_fees" => array(
        'name' => '<i class="fa fa-money"></i> Manage Fees ',
        'controller' => $zvs_controller,
        'action' => 'manage_fees',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Subjects
    "manage_subjects" => array(
        'name' => '<i class="fa fa-book"></i> Manage Subjects ',
        'controller' => $zvs_controller,
        'action' => 'manage_subjects',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Exams
    "manage_exams" => array(
        'name' => '<i class="fa fa-print"></i> Manage Examination ',
        'controller' => $zvs_controller,
        'action' => 'manage_exams',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Marksheet
    "manage_marksheet" => array(
        'name' => '<i class="fa fa-check-square-o"></i> Manage Marksheet ',
        'controller' => $zvs_controller,
        'action' => 'manage_marksheet',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Timetable
    "manage_timetable" => array(
        'name' => '<i class="fa fa-clock-o"></i> Manage Timetable ',
        'controller' => $zvs_controller,
        'action' => 'manage_timetable',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Notice Board
    "manage_notice_board" => array(
        'name' => '<i class="fa fa-comments-o"></i> Manage Notice Board ',
        'controller' => $zvs_controller,
        'action' => 'manage_notice_board',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Calender
    "manage_calendar" => array(
        'name' => '<i class="fa fa-calendar"></i> Manage Calendar ',
        'controller' => $zvs_controller,
        'action' => 'manage_calendar',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Roles
    "manage_roles" => array(
        'name' => '<i class="fa fa-user-plus"></i> Manage Roles',
        'controller' => $zvs_controller,
        'action' => 'manage_roles',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Resources
    "manage_resources" => array(
        'name' => '<i class="fa fa-sliders"></i> Manage Resources ',
        'controller' => $zvs_controller,
        'action' => 'manage_resources',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Affiliates
    "manage_affiliates" => array(
        'name' => '<i class="fa fa-share-square-o"></i> Manage Affiliates ',
        'controller' => $zvs_controller,
        'action' => 'manage_affiliates',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Affiliates Directory
    "affiliates_directory" => array(
        'name' => '<i class="fa fa-th-list"></i> Affiliates Directory ',
        'controller' => $zvs_controller,
        'action' => 'affiliates_directory',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!--This is the menu item links to the ZVS main school admin dashboard-->
<li class="start <?php if (($zvs_controller == "school_main_admin" && empty($zvs_action)) || $zvs_action == "main_dashboard") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['main_dashboard']); ?>
</li>


<!-- This menu item helps in getting the ZVS school profile-->
<li class="<?php if ($zvs_controller== "school_main_admin" && $zvs_action == "school_profile") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['school_profile']); ?>
</li>


<!-- This menu item manages all aspects of ZVS School structure-->
<li class="<?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-th"></i>
        <span class="title"> School Structure </span>
        <?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_classes") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_classes']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_departments") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_departments']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_hostels") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_hostels']); ?>
        </li>
    </ul>
</li>


<!-- This menu item manages all aspects of ZVS School admissions-->
<li class="<?php if ($zvs_action == "manage_teachers" || $zvs_action == "manage_students" || $zvs_action == "manage_substaff") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-sign-in"></i>
        <span class="title"> School Admissions </span>
        <?php if ($zvs_action == "manage_teachers" || $zvs_action == "manage_students" || $zvs_action == "manage_substaff") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_teachers" || $zvs_action == "manage_students" || $zvs_action == "manage_substaff") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_teachers") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_teachers']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_students") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_students']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_substaff") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_substaff']); ?>
        </li>
    </ul>
</li>


<!-- This menu item manages all aspects of ZVS School Entities-->
<li class="<?php if ($zvs_action == "manage_fees" || $zvs_action == "manage_subjects" || $zvs_action == "manage_exams" || $zvs_action == "manage_marksheet") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-th-list"></i>
        <span class="title"> School Entities </span>
        <?php if ($zvs_action == "manage_fees" || $zvs_action == "manage_subjects" || $zvs_action == "manage_exams" || $zvs_action == "manage_marksheet") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_fees" || $zvs_action == "manage_subjects" || $zvs_action == "manage_exams" || $zvs_action == "manage_marksheet") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_fees") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_fees']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_subjects") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_subjects']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_exams") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_exams']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_marksheet") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_marksheet']); ?>
        </li>
    </ul>
</li>


<!-- This menu item manages all aspects of ZVS School Communication-->
<li class="<?php if ($zvs_action == "manage_timetable" || $zvs_action == "manage_notice_board" || $zvs_action == "manage_calendar") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-bullhorn"></i>
        <span class="title"> School Communication </span>
        <?php if ($zvs_action == "manage_timetable" || $zvs_action == "manage_notice_board" || $zvs_action == "manage_calendar") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_timetable" || $zvs_action == "manage_notice_board" || $zvs_action == "manage_calendar") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_timetable") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_timetable']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_notice_board") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_notice_board']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_calendar") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_calendar']); ?>
        </li>
    </ul>
</li>


<!-- This menu item manages all aspects of ZVS School Roles and Resources -->
<li class="<?php if ($zvs_action == "manage_roles" || $zvs_action == "manage_resources") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-yelp"></i>
        <span class="title"> Roles &AMP; Resources </span>
        <?php if ($zvs_action == "manage_roles" || $zvs_action == "manage_resources") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_roles" || $zvs_action == "manage_resources") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_roles") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_roles']); ?>
        </li>
        <li class="<?php if ($zvs_action == "manage_resources") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_resources']); ?>
        </li>
    </ul>
</li>


<!-- This menu item manages all aspects of ZVS School Affiliations -->
<li class="<?php if ($zvs_action == "manage_affiliates" || $zvs_action == "affiliates_directory") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-cubes"></i>
        <span class="title"> School Affiliates </span>
        <?php if ($zvs_action == "manage_affiliates" || $zvs_action == "affiliates_directory") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_affiliates" || $zvs_action == "affiliates_directory") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "manage_affiliates") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_affiliates']); ?>
        </li>
        <li class="<?php if ($zvs_action == "affiliates_directory") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['affiliates_directory']); ?>
        </li>
    </ul>
</li>