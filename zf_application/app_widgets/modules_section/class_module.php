<?php

/** 
 * This menu is used to list all resource within the class module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;
//echo "<pre>";
//print_r($zvs_allowedResources);
//echo "</pre>";

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
    
    
    //New platform user
    "new_user" => array(
        'name' => '<i class="fa fa-user"></i> New User',
        'controller' => $zvs_controller,
        'action' => 'new_user',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Admin directory
    "admin_directory" => array(
        'name' => '<i class="fa fa-list"></i> Admin Users Directory',
        'controller' => $zvs_controller,
        'action' => 'admin_directory',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Admin reports
    "admin_reports" => array(
        'name' => '<i class="fa fa-bar-chart"></i> Admin Reports',
        'controller' => $zvs_controller,
        'action' => 'admin_reports',
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


<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Class Module </span>
        <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_CLASSES, $zvs_allowedResources)){ ?>
               View Classes<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CLASS_PROFILE, $zvs_allowedResources)){ ?>
               Class Profile<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_STREAMS, $zvs_allowedResources)){ ?>
               View Streams<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STREAM_PROFILE, $zvs_allowedResources)){ ?>
               Stream Profile<br>
        <?php } ?>
    </ul>
</li>

<!--        <li class="<?php if ($zvs_action == "new_user") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_user']); ?>
        </li>
        <li class="<?php if ($zvs_action == "admin_directory") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['admin_directory']); ?>
        </li>
        <li class="<?php if ($zvs_action == "admin_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['admin_reports']); ?>
        </li>-->