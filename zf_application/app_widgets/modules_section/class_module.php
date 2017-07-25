<?php

/** 
 * This menu is used to list all resource within the class module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = CLSMOD; $zvs_action = $activeURL[1]; 

$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //View Classes
    "view_classes" => array(
        'name' => '<i class="fa fa-cubes"></i> View Classes',
        'controller' => $zvs_controller,
        'action' => 'view_classes',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Class Details
    "class_details" => array(
        'name' => '<i class="fa fa-id-badge"></i> Class Details',
        'controller' => $zvs_controller,
        'action' => 'class_details',
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
    ),
    
    //Class Register
    "class_register" => array(
        'name' => '<i class="fa fa-calendar-check-o"></i> Class Register',
        'controller' => $zvs_controller,
        'action' => 'class_register',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
);
?>

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "class_module" || $zvs_action == "view_classes" || $zvs_action == "class_details" || $zvs_action == "view_streams" || $zvs_action == "stream_profile" || $zvs_action == "class_register") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-building-o"></i>
        <span class="title"> Class Module </span>
        <?php if ($zvs_action == "class_module" ||$zvs_action == "view_classes" || $zvs_action == "class_details" || $zvs_action == "view_streams" || $zvs_action == "stream_profile" || $zvs_action == "stream_profile" || $zvs_action == "class_register") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "class_module" ||$zvs_action == "view_classes" || $zvs_action == "class_details" || $zvs_action == "view_streams" || $zvs_action == "stream_profile" || $zvs_action == "stream_profile" || $zvs_action == "class_register") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_CLASSES, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_classes") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_classes']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CLASS_DETAILS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "class_details") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['class_details']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_STREAMS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_streams") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_streams']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STREAM_DETAILS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "stream_details") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['stream_details']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CLASS_REGISTER, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "class_register") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['class_register']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
