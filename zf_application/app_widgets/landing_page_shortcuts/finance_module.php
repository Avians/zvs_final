<?php

/** 
 * This menu is used to list all resource within the finance module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = FINMOD;  $zvs_action = "finance_module"; 

$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


?>

<!--Manage School Classes-->
<a href="<?php Zf_GenerateLinks::basic_internal_link($zvs_controller, $zvs_action, $zvs_parameter)?>">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <div class="lp-shortcut-wrapper">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: auto !important; text-align: center !important">
                <img src="<?php echo ZF_ROOT_PATH.ZF_DATASTORE."zvs_module_images".DS."finance.png"; ?>" width=" 80% " height=" 80%" alt="Finance Module" >
                <div class="clearfix"></div>
                <h6 class="features-title" style="font-size: 11px !important;">Finance Module</h6>
                <div class="clearfix"><br></div>
            </div>
        </div>
    </div>
</a>


