<?php

/** 
 * This menu is used to list all resource within the student module
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = STUMOD; $zvs_action = $activeURL[1]; 
$zvs_parameter = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($activeURL[2]))[0];

//This external widget data 
$zvs_allowedResources = $zf_externalWidgetData;


$main_menu = array(
    
    //Student details
    "student_details" => array(
        'name' => '<i class="fa fa-users"></i> Student Details',
        'controller' => $zvs_controller,
        'action' => 'student_details',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Register new student
    "register_student" => array(
        'name' => '<i class="fa fa-user-plus"></i> Register Students',
        'controller' => $zvs_controller,
        'action' => 'register_student',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Shift students
    "shift_students" => array(
        'name' => '<i class="fa fa-exchange"></i> Shift Students',
        'controller' => $zvs_controller,
        'action' => 'shift_students',
        'parameter' => $zvs_parameter,
        'title' => '',
        'style' => '',
        'id' => ''
    )
    
    
);
?>


<!-- This menu item manages all aspects of ZVS admin users-->
<li class="<?php if ($zvs_action == "student_details" || $zvs_action == "register_student" || $zvs_action == "shift_students") { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title"> Student Module </span>
        <?php if ($zvs_action == "student_details" || $zvs_action == "register_student" || $zvs_action == "shift_students") {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if ($zvs_action == "student_details" || $zvs_action == "register_student" || $zvs_action == "shift_students") { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "student_details") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['student_details']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(REGISTER_STUDENT, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "register_student") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['register_student']); ?>
            </li>
        <?php } ?>
        <?php if(Zf_Core_Functions::Zf_recursiveArray(SHIFT_STUDENTS, $zvs_allowedResources)){ ?>
            <li class="<?php if ($zvs_action == "shift_students") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['shift_students']); ?>
            </li>
        <?php } ?>
    </ul>
</li>
