<?php

/** 
 * This menu is used to list all resource within the timetable module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = TTBMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
    //Create new time table item 
    "create_time_table" => array(
        'name' => '<i class="fa fa-indent"></i> Create Time Table',
        'controller' => $zvs_controller,
        'action' => 'create_time_table',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "create_time_table") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-table"></i>
        <span class="title"> TimeTable Module </span>
        <?php if ($zvs_action == "create_time_table") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "create_time_table") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($zvs_action == "create_time_table") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['create_time_table']); ?>
        </li>
    </ul>
</li>

