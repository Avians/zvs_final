<?php

/** 
 * This menu is used by a school student
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;

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
    )
    
    
);
?>

<!--This is the actual menu-->
<li class="start <?php if ($zvs_action == "main_dashboard") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['main_dashboard']); ?>
</li>
