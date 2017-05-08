<?php

/** 
 * This menu is used to list all resource within the inventory module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = ASSMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Asset Overview
    "asset_overview" => array(
        'name' => '<i class="fa fa-empire"></i> Asset Overview',
        'controller' => $zvs_controller,
        'action' => 'asset_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Asset setup
    "asset_setup" => array(
        'name' => '<i class="fa fa-cogs"></i> Asset Setup',
        'controller' => $zvs_controller,
        'action' => 'asset_setup',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Asset Inventory
    "asset_inventory" => array(
        'name' => '<i class="fa fa-file-text-o"></i> Asset Inventory',
        'controller' => $zvs_controller,
        'action' => 'asset_inventory',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Asset Items
    "asset_items" => array(
        'name' => '<i class="fa fa-cubes"></i> Asset Items',
        'controller' => $zvs_controller,
        'action' => 'asset_items',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Asset Reports
    "asset_reports" => array(
        'name' => '<i class="fa fa-line-chart"></i> Asset Reports',
        'controller' => $zvs_controller,
        'action' => 'asset_reports',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "asset_overview" || $zvs_action == "asset_setup" || $zvs_action == "asset_inventory" || $zvs_action == "asset_items" || $zvs_action == "asset_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-connectdevelop"></i>
        <span class="title"> Assets Module </span>
        <?php if ($zvs_action == "asset_overview" || $zvs_action == "asset_setup" || $zvs_action == "asset_inventory" || $zvs_action == "asset_items" || $zvs_action == "asset_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "asset_overview" || $zvs_action == "asset_setup" || $zvs_action == "asset_inventory" || $zvs_action == "asset_items" || $zvs_action == "asset_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ASSET_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "asset_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['asset_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ASSET_SETUP, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "asset_setup") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['asset_setup']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ASSET_INVENTORY, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "asset_inventory") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['asset_inventory']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ASSET_ITEMS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "asset_items") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['asset_items']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ASSET_REPORTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "asset_reports") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['asset_reports']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
