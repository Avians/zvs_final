<?php

/** 
 * This menu is used to list all resource within the student module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = STUMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Register new student
    "register_student" => array(
        'name' => '<i class="fa fa-user-plus"></i> Register Students',
        'controller' => $zvs_controller,
        'action' => 'register_student',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "register_student") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Student Module </span>
        <?php if ($zvs_action == "register_student") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "register_student") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "register_student") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['register_student']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
