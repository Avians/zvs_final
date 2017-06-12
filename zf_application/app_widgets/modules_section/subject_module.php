    <?php

/** 
 * This menu is used to list all resource within the subject module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = SUBMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
    //Subject Overview 
    "subject_overview" => array(
        'name' => '<i class="fa fa-empire"></i> Subject Overview',
        'controller' => $zvs_controller,
        'action' => 'subject_overview',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Subject Setup 
    "subject_setup" => array(
        'name' => '<i class="fa fa-cogs"></i> Subject Setup',
        'controller' => $zvs_controller,
        'action' => 'subject_setup',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Subject Reports 
    "subject_reports" => array(
        'name' => '<i class="fa fa-line-chart"></i> Subject Reports',
        'controller' => $zvs_controller,
        'action' => 'subject_reports',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects subjects module-->
<li class="<?php if ($zvs_action == "subject_module" || $zvs_action == "subject_overview" || $zvs_action == "subject_setup" || $zvs_action == "subject_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-book"></i>
        <span class="title"> Subjects Module </span>
        <?php if ($zvs_action == "subject_module" || $zvs_action == "subject_overview" || $zvs_action == "subject_setup" || $zvs_action == "subject_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "subject_module" || $zvs_action == "subject_overview" || $zvs_action == "subject_setup" || $zvs_action == "subject_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(SUBJECT_OVERVIEW, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "subject_overview") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['subject_overview']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(SUBJECT_SETUP, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "subject_setup") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['subject_setup']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(SUBJECT_REPORTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "subject_reports") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['subject_reports']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

