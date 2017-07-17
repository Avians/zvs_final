<?php

/** 
 * This menu is used to list all resource within the student module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = HOSMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Hostel overview
    "hostel_overview" => array(
        'name' => '<i class="fa fa-users"></i> Hostel overview',
        'controller' => $zvs_controller,
        'action' => 'hostel_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Register new students
    "hostel_register_student" => array(
        'name' => '<i class="fa fa-user-plus"></i> Register Students',
        'controller' => $zvs_controller,
        'action' => 'hostel_register_student',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of hostel module-->
<li class="<?php if ($zvs_action == "hostel_module" || $zvs_action == "hostel_overview" || $zvs_action == "hostel_register_student") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Hostel Module</span>
        <?php if ($zvs_action == "hostel_module" || $zvs_action == "hostel_overview" || $zvs_action == "hostel_register_student") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "hostel_module" || $zvs_action == "hostel_overview" || $zvs_action == "hostel_register_student") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(HOSTEL_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "hostel_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['hostel_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(HOSTEL_REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "hostel_register_student") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['hostel_register_student']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
