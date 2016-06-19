<?php

/** 
 * This menu is used to list all resource within the finance module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
    //New platform user
    "new_user" => array(
        'name' => '<i class="fa fa-user"></i> New User',
        'controller' => $zvs_controller,
        'action' => 'new_user',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Admin directory
    "admin_directory" => array(
        'name' => '<i class="fa fa-list"></i> Admin Users Directory',
        'controller' => $zvs_controller,
        'action' => 'admin_directory',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Admin reports
    "admin_reports" => array(
        'name' => '<i class="fa fa-bar-chart"></i> Admin Reports',
        'controller' => $zvs_controller,
        'action' => 'admin_reports',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage resources
    "manage_resources" => array(
        'name' => '<i class="fa fa-yelp"></i> Manage Resources <span class="selected"></span>',
        'controller' => $zvs_controller,
        'action' => 'manage_resources',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Finance Module </span>
        <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "new_user" || $zvs_action == "admin_directory" || $zvs_action == "admin_reports") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CREATE_FEES, $zvs_allowedResources)){ ?>
               Create Fees<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ALLOCATE_FINANCES, $zvs_allowedResources)){ ?>
               Allocate Finances<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(COLLECT_FEES, $zvs_allowedResources)){ ?>
               Collect Fees<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_STRUCTURE, $zvs_allowedResources)){ ?>
               Fee Structure<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_DEFAULTERS, $zvs_allowedResources)){ ?>
               Fee Defaulters<br>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_REFUNDS, $zvs_allowedResources)){ ?>
               Fee Refunds<br>
        <?php } ?>
    </ul>
</li>

