<?php

/** 
 * This menu used by system platform administrators
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
    
    
    //New School
    "new_school" => array(
        'name' => '<i class="fa fa-sign-in"></i> New School',
        'controller' => $zvs_controller,
        'action' => 'new_school',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Schools Directory
    "schools_directory" => array(
        'name' => '<i class="fa fa-folder-open"></i> Schools Directory',
        'controller' => $zvs_controller,
        'action' => 'schools_directory',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    

    //Confirmed Schools
    "confirmed_schools" => array(
        'name' => '<i class="fa fa-check-square-o"></i> Confirmed Schools',
        'controller' => $zvs_controller,
        'action' => 'confirmed_schools',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    

    //Suspended Schools
    "suspended_schools" => array(
        'name' => '<i class="fa fa-ban"></i> Suspended Schools',
        'controller' => $zvs_controller,
        'action' => 'suspended_schools',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    

    //Schools  Report
    "schools_report" => array(
        'name' => '<i class="fa fa-bar-chart-o"></i> Schools Report',
        'controller' => $zvs_controller,
        'action' => 'schools_report',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    

    //Scheduled Tasks
    "scheduled_tasks" => array(
        'name' => '<i class="fa fa-clock-o"></i> Scheduled Tasks',
        'controller' => $zvs_controller,
        'action' => 'scheduled_tasks',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage resources
    "manage_resources" => array(
        'name' => '<i class="fa fa-yelp"></i> Manage Resources <span class="selected"></span>',
        'controller' => $zvs_controller,
        'action' => 'manage_resources',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!--This is the menu item links to the main dashboard-->
<li class="start <?php if (($zvs_controller == "zvs_platform_admin" && empty($zvs_action)) || $zvs_action == "main_dashboard") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['main_dashboard']); ?>
</li>

<!-- This menu item manages all the aspects of a school-->
<li class="<?php if ($zvs_action == "new_school" || $zvs_action == "schools_directory" || $zvs_action == "confirmed_schools" || $zvs_action == "suspended_schools" || $zvs_action == "schools_report" || $zvs_action == "scheduled_tasks") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-sitemap"></i>
        <span class="title"> Manage Schools </span>
        <?php if ($zvs_action == "new_school" || $zvs_action == "schools_directory" || $zvs_action == "confirmed_schools" || $zvs_action == "suspended_schools" || $zvs_action == "schools_report" || $zvs_action == "scheduled_tasks") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "new_school" || $zvs_action == "schools_directory" || $zvs_action == "confirmed_schools" || $zvs_action == "suspended_schools" || $zvs_action == "schools_report" || $zvs_action == "scheduled_tasks") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "new_school") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_school']); ?>
        </li>
        <li class="<?php if ($zvs_action == "schools_directory") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['schools_directory']); ?>
        </li>
        <li class="<?php if ($zvs_action == "confirmed_schools") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['confirmed_schools']); ?>
        </li>
        <li class="<?php if ($zvs_action == "suspended_schools") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['suspended_schools']); ?>
        </li>
        <li class="<?php if ($zvs_action == "schools_report") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['schools_report']); ?>
        </li>
        <li class="<?php if ($zvs_action == "scheduled_tasks") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['scheduled_tasks']); ?>
        </li>
    </ul>
</li>

<!--This is the menu item links to management of resources allocated to schools-->
<li class="<?php if ($zvs_action == "manage_resources") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_resources']); ?>
</li>

