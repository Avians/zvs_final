<?php

/** 
 * This menu is used to list all resource within the transport module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = TRNMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Transport Zones
    "transport_overview" => array(
        'name' => '<i class="fa fa-empire"></i> Transport Overview',
        'controller' => $zvs_controller,
        'action' => 'transport_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Transport Setup
    "transport_setup" => array(
        'name' => '<i class="fa fa-cogs"></i> Transport Setup',
        'controller' => $zvs_controller,
        'action' => 'transport_setup',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Assign Students
    "assign_drivers" => array(
        'name' => '<i class="fa fa-users"></i> Assign Drivers',
        'controller' => $zvs_controller,
        'action' => 'assign_drivers',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Assign Students
    "assign_students" => array(
        'name' => '<i class="fa fa-users"></i> Assign Students',
        'controller' => $zvs_controller,
        'action' => 'assign_students',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Transport Reports
    "transport_reports" => array(
        'name' => '<i class="fa fa-line-chart"></i> Transport Reports',
        'controller' => $zvs_controller,
        'action' => 'transport_reports',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of transport module-->
<li class="<?php if ($zvs_action == "transport_overview" || $zvs_action == "transport_setup" || $zvs_action == "assign_drivers" || $zvs_action == "assign_students" || $zvs_action == "transport_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-bus"></i>
        <span class="title"> Transport Module </span>
        <?php if ($zvs_action == "transport_overview" || $zvs_action == "transport_setup" || $zvs_action == "assign_drivers" || $zvs_action == "assign_students" || $zvs_action == "transport_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "transport_overview" || $zvs_action == "transport_setup" || $zvs_action == "assign_drivers" || $zvs_action == "assign_students" || $zvs_action == "transport_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "transport_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['transport_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_SETUP, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "transport_setup") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['transport_setup']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_ASSIGN_DRIVERS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "assign_drivers") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['assign_drivers']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_ASSIGN_STUDENTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "assign_students") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['assign_students']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(TRANSPORT_REPORTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "transport_reports") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['transport_reports']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
