<?php

/** 
 * This menu is used to list all resource within the inventory module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = STRMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Store Overview
    "store_overview" => array(
        'name' => '<i class="fa fa-empire"></i> Store Overview',
        'controller' => $zvs_controller,
        'action' => 'store_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Suppliers
    "store_suppliers" => array(
        'name' => '<i class="fa fa-cubes"></i> Suppliers/Vendors',
        'controller' => $zvs_controller,
        'action' => 'store_suppliers',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Setup
    "store_setup" => array(
        'name' => '<i class="fa fa-cogs"></i> Store Setup',
        'controller' => $zvs_controller,
        'action' => 'store_setup',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Assignment
    "store_assignment" => array(
        'name' => '<i class="fa fa-yelp"></i> Store Assignment',
        'controller' => $zvs_controller,
        'action' => 'store_assignment',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Recieving
    "store_receiving" => array(
        'name' => '<i class="fa fa-indent"></i> Store Receiving',
        'controller' => $zvs_controller,
        'action' => 'store_receiving',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Issuing
    "store_issuing" => array(
        'name' => '<i class="fa fa-outdent"></i> Store Issuing',
        'controller' => $zvs_controller,
        'action' => 'store_issuing',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Store Report
    "store_reports" => array(
        'name' => '<i class="fa fa-line-chart"></i> Store Reports',
        'controller' => $zvs_controller,
        'action' => 'store_reports',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of store module-->
<li class="<?php if ($zvs_action == "store_overview" || $zvs_action == "store_suppliers" || $zvs_action == "store_setup" || $zvs_action == "store_assignment" || $zvs_action == "store_receiving" || $zvs_action == "store_issuing" || $zvs_action == "store_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-institution"></i>
        <span class="title"> Store Module </span>
        <?php if ($zvs_action == "store_overview" || $zvs_action == "store_suppliers" || $zvs_action == "store_setup" || $zvs_action == "store_assignment" || $zvs_action == "store_receiving" || $zvs_action == "store_issuing" || $zvs_action == "store_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "store_overview" || $zvs_action == "store_suppliers" || $zvs_action == "store_setup" || $zvs_action == "store_assignment" || $zvs_action == "store_receiving" || $zvs_action == "store_issuing" || $zvs_action == "store_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_SUPPLIERS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_suppliers") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_suppliers']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_SETUP, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_setup") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_setup']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_ASSIGNMENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_assignment") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_assignment']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_RECEIVING, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_receiving") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_receiving']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_ISSUING, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_issuing") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_issuing']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(STORE_REPORTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "store_reports") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['store_reports']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
