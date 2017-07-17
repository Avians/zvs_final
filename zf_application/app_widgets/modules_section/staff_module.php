<?php

/** 
 * This menu is used to list all resource within the finance module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = STFMOD; $zvs_action = $activeURL[1];
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;



$main_menu = array(
    
    
    //Staff Details
    "staff_details" => array(
        'name' => '<i class="fa fa-users"></i> Staff Details',
        'controller' => $zvs_controller,
        'action' => 'staff_details',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    //Register Staff
    "register_staff" => array(
        'name' => '<i class="fa fa-user-plus"></i> Register Staff',
        'controller' => $zvs_controller,
        'action' => 'register_staff',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Staff directory
    "staff_directory" => array(
        'name' => '<i class="fa fa-list"></i> Staff Directory',
        'controller' => $zvs_controller,
        'action' => 'staff_directory',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of staff module-->
<li class="<?php if ($zvs_action == "staff_module" || $zvs_action == "staff_details" || $zvs_action == "register_staff" || $zvs_action == "staff_directory") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-user-circle"></i>
        <span class="title"> Staff Module </span>
        <?php if ($zvs_action == "staff_module" || $zvs_action == "staff_details" || $zvs_action == "register_staff" || $zvs_action == "staff_directory") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "staff_module" || $zvs_action == "staff_details" || $zvs_action == "register_staff" || $zvs_action == "staff_directory") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STAFF_DETAILS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "staff_details") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['staff_details']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STAFF, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "register_staff") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['register_staff']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STAFF_DIRECTORY, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "staff_directory") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['staff_directory']); ?>
            </li>
        <?php } ?>
        
    </ul>
</li>

