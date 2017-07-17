<?php

/** 
 * This menu is used to list all resource within the parent module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = PARMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;



$main_menu = array(
    
    
    //Parent Profile
    "parent_profile" => array(
        'name' => '<i class="fa fa-users"></i> Parent Profile',
        'controller' => $zvs_controller,
        'action' => 'parent_profile',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
);
?>

<!-- This menu item manages all aspects of parent module-->
<li class="<?php if ($zvs_action == "parent_profile") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Parent Module</span>
        <?php if ($zvs_action == "parent_profile") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "parent_profile") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(PARENT_PROFILE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "parent_profile") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['parent_profile']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

