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
    
    
    //This link helps us to assign subjects to teachers. 
    "subject_details" => array(
        'name' => '<i class="fa fa-object-group"></i> Subject Details',
        'controller' => $zvs_controller,
        'action' => 'subject_details',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //This link helps us to assign subjects to teachers. 
    "assign_subjects_to_teachers" => array(
        'name' => '<i class="fa fa-flickr"></i> Assign Subjects',
        'controller' => $zvs_controller,
        'action' => 'assign_subjects_to_teachers',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>

<!-- This menu item manages all aspects subjects module-->
<li class="<?php if ($zvs_action == "subject_details" || $zvs_action == "assign_subjects_to_teachers") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-book"></i>
        <span class="title"> Subjects Module </span>
        <?php if ($zvs_action == "subject_details" || $zvs_action == "assign_subjects_to_teachers") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "subject_details" || $zvs_action == "assign_subjects_to_teachers") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "subject_details") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['subject_details']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "assign_subjects_to_teachers") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['assign_subjects_to_teachers']); ?>
            </li>
        <?php } ?>
    </ul>
</li>

