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
    
    
    //View Classes
    "view_classes" => array(
        'name' => '<i class="fa fa-user"></i> View Classes',
        'controller' => $zvs_controller,
        'action' => 'view_classes',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Class Profile
    "class_profile" => array(
        'name' => '<i class="fa fa-user"></i> Class Profile',
        'controller' => $zvs_controller,
        'action' => 'class_profile',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //View Streams
    "view_streams" => array(
        'name' => '<i class="fa fa-user"></i> View Streams',
        'controller' => $zvs_controller,
        'action' => 'view_streams',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Stream Profile
    "stream_profile" => array(
        'name' => '<i class="fa fa-user"></i> Stream Profile',
        'controller' => $zvs_controller,
        'action' => 'stream_profile',
        'parameter' => $zvs_parameter,
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
<li class="<?php if ($zvs_action == "view_classes" || $zvs_action == "class_profile" || $zvs_action == "view_streams" || $zvs_action == "stream_profile") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-building-o"></i>
        <span class="title"> Class Module </span>
        <?php if ($zvs_action == "view_classes" || $zvs_action == "class_profile" || $zvs_action == "view_streams" || $zvs_action == "stream_profile") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "view_classes" || $zvs_action == "class_profile" || $zvs_action == "view_streams" || $zvs_action == "stream_profile") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_CLASSES, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_classes") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_classes']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CLASS_PROFILE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "class_profile") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['class_profile']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_STREAMS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_streams") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_streams']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STREAM_PROFILE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "stream_profile") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['stream_profile']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
