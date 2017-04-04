<?php

/** 
 * This menu is used to list all resource within the class module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = DTAMOD; $zvs_action = $activeURL[1]; 

$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Manage Student Data
    "manage_student_data" => array(
        'name' => '<i class="fa fa-cloud"></i> Manage Student Data',
        'controller' => $zvs_controller,
        'action' => 'manage_student_data',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Staff Data
    "manage_staff_data" => array(
        'name' => '</i><i class="fa fa-cloud"></i> Manage Staff Data',
        'controller' => $zvs_controller,
        'action' => 'manage_staff_data',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
);
?>


<!-- This menu item manages all aspects of data management-->
<li class="<?php if ($zvs_action == "manage_student_data" || $zvs_action == "manage_staff_data") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-database"></i>
        <span class="title"> Data Management </span>
        <?php if ($zvs_action == "manage_student_data" || $zvs_action == "manage_staff_data") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "manage_student_data" || $zvs_action == "manage_staff_data") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(MANAGE_STUDENT_DATA, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "manage_student_data") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_student_data']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(MANAGE_STAFF_DATA, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "manage_staff_data") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_staff_data']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
