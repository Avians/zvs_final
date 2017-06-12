<?php

/** 
 * This menu is used to list all resource within the department module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = DEPMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
    //View departments
    "view_departments" => array(
        'name' => '<i class="fa fa-user"></i> View Departments',
        'controller' => $zvs_controller,
        'action' => 'view_departments',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Department profile
    "department_profile" => array(
        'name' => '<i class="fa fa-list"></i> Department Profile',
        'controller' => $zvs_controller,
        'action' => 'department_profile',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //View sub-department
    "view_sub_departments" => array(
        'name' => '<i class="fa fa-bar-chart"></i> View Sub Departments',
        'controller' => $zvs_controller,
        'action' => 'view_sub_departments',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Sub-department profile
    "sub_department_profile" => array(
        'name' => '<i class="fa fa-yelp"></i> Sub Department Profile',
        'controller' => $zvs_controller,
        'action' => 'sub_department_profile',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "department_module" || $zvs_action == "view_departments" || $zvs_action == "department_profile" || $zvs_action == "view_sub_departments" || $zvs_action == "sub_department_profile") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Department Module </span>
        <?php if ($zvs_action == "department_module" || $zvs_action == "view_departments" || $zvs_action == "department_profile" || $zvs_action == "view_sub_departments" || $zvs_action == "sub_department_profile") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "department_module" || $zvs_action == "view_departments" || $zvs_action == "department_profile" || $zvs_action == "view_sub_departments" || $zvs_action == "sub_department_profile") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_DEPARTMENTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_departments") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_departments']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(DEPARTMENT_PROFILE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "department_profile") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['department_profile']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(VIEW_SUB_DEPARTMENTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "view_sub_departments") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['view_sub_departments']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(SUB_DEPARTMENT_PROFILE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "sub_department_profile") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['sub_department_profile']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

