<?php

/** 
 * This menu is used to list all resource within the library module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = LIBMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Library Overview
    "library_overview" => array(
        'name' => '<i class="fa fa-empire"></i> Library Overview',
        'controller' => $zvs_controller,
        'action' => 'library_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Library Setup
    "library_setup" => array(
        'name' => '<i class="fa fa-cogs"></i> Library Setup',
        'controller' => $zvs_controller,
        'action' => 'library_setup',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Library Issuing
    "library_issuing" => array(
        'name' => '<i class="fa fa-outdent"></i> Library Issuing',
        'controller' => $zvs_controller,
        'action' => 'library_issuing',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Library Recieving
    "library_receiving" => array(
        'name' => '<i class="fa fa-indent"></i> Library Receiving',
        'controller' => $zvs_controller,
        'action' => 'library_receiving',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Library Report
    "library_reports" => array(
        'name' => '<i class="fa fa-line-chart"></i> Library Reports',
        'controller' => $zvs_controller,
        'action' => 'library_reports',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of library module-->
<li class="<?php if ($zvs_action == "library_module" || $zvs_action == "library_overview" || $zvs_action == "library_setup" || $zvs_action == "library_issuing" || $zvs_action == "library_receiving" || $zvs_action == "library_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-trello"></i>
        <span class="title"> Library Module </span>
        <?php if ($zvs_action == "library_module" || $zvs_action == "library_overview" || $zvs_action == "library_setup" || $zvs_action == "library_issuing" || $zvs_action == "library_receiving" || $zvs_action == "library_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "library_module" || $zvs_action == "library_overview" || $zvs_action == "library_setup" || $zvs_action == "library_issuing" || $zvs_action == "library_receiving" || $zvs_action == "library_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "library_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['library_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_SETUP, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "library_setup") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['library_setup']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_ISSUING, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "library_issuing") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['library_issuing']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_RECEIVING, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "library_receiving") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['library_receiving']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(LIBRARY_REPORTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "library_reports") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['library_reports']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

