<?php

/** 
 * This menu is used to list all resource within the finance module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = FINMOD; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    
    //Create fees
    "create_fees" => array(
        'name' => '<i class="fa fa-user"></i> Create Fees',
        'controller' => $zvs_controller,
        'action' => 'create_fees',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Collect fees
    "collect_fees" => array(
        'name' => '<i class="fa fa-bar-chart"></i> Collect Fees',
        'controller' => $zvs_controller,
        'action' => 'collect_fees',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Finance Status
    "finance_status" => array(
        'name' => '<i class="fa fa-list"></i> Finance Status',
        'controller' => $zvs_controller,
        'action' => 'finance_status',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Create Budget
    "create_budget" => array(
        'name' => '<i class="fa fa-cogs"></i> Create Budget',
        'controller' => $zvs_controller,
        'action' => 'create_budget',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    
    //Allocate finances
    "allocate_finances" => array(
        'name' => '<i class="fa fa-snowflake-o"></i> Allocate Finances',
        'controller' => $zvs_controller,
        'action' => 'allocate_finances',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Fee structure
    "fee_structure" => array(
        'name' => '<i class="fa fa-table"></i> Fee Structure',
        'controller' => $zvs_controller,
        'action' => 'fee_structure',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Fee defaulters
    "fee_defaulters" => array(
        'name' => '<i class="fa fa-yelp"></i> Fee Defaulters',
        'controller' => $zvs_controller,
        'action' => 'fee_defaulters',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Fee refunds
    "fee_refunds" => array(
        'name' => '<i class="fa fa-yelp"></i> Fee Refunds',
        'controller' => $zvs_controller,
        'action' => 'fee_refunds',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "create_fees" || $zvs_action == "allocate_finances" ||  $zvs_action == "create_budget" || $zvs_action == "collect_fees"  || $zvs_action == "finance_status" || $zvs_action == "fee_structure" || $zvs_action == "fee_defaulters" || $zvs_action == "fee_refunds") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-money"></i>
        <span class="title"> Finance Module </span>
        <?php if ($zvs_action == "create_fees" || $zvs_action == "allocate_finances" || $zvs_action == "create_budget" || $zvs_action == "collect_fees"  || $zvs_action == "finance_status" || $zvs_action == "fee_structure" || $zvs_action == "fee_defaulters" || $zvs_action == "fee_refunds") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "create_fees" || $zvs_action == "allocate_finances" ||  $zvs_action == "create_budget" || $zvs_action == "collect_fees" || $zvs_action == "fee_structure" || $zvs_action == "fee_defaulters" || $zvs_action == "fee_refunds") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FINANCE_STATUS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "finance_status") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['finance_status']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CREATE_FEES, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "create_fees") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['create_fees']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_STRUCTURE, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "fee_structure") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['fee_structure']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(COLLECT_FEES, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "collect_fees") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['collect_fees']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(CREATE_BUDGET, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "create_budget") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['create_budget']); ?>
            </li>
        <?php } ?>    
        <?php if(Zf_Core_Functions::Zf_recursiveArray(ALLOCATE_FINANCES, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "allocate_finances") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['allocate_finances']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_DEFAULTERS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "fee_defaulters") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['fee_defaulters']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(FEE_REFUNDS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "fee_refunds") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['fee_refunds']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

