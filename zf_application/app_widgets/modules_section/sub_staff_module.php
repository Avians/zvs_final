<?php

/** 
 * This menu is used to list all resource within the sub-staff module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
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

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> ZVS Admin Users </span>
        <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "new_user") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_user']); ?>
        </li>
        <li class="<?php if ($zvs_action == "admin_directory") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['admin_directory']); ?>
        </li>
        <li class="<?php if ($zvs_action == "admin_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['admin_reports']); ?>
        </li>
    </ul>
</li>

