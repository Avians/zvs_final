<?php

/** 
 * This menu is used by school general administrator
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;



//This function runs a recursive treversal of the array.

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}


/**
 * We access the database to retrieve the resources assigned to the current user role. If there are resources assigned in the returned array
 * then we return those resources in an array.
 */

//This array holds all valid resources
$zvs_allowedResources = $zf_model_data->zvs_fetchUserResources($identificationCode);


//print_r($zvs_allowedResources);


/**
 * This is a list of all active controllers that are essential in executing general school views. 
 * They categorised based on how resources are gorped
 *
 */

//1. Class Modules{ClsMod} ==> zvs_classes

//2. Department Modules{DepMod} ==> zvs_departments

//3. Hostel Modules{HosMod} ==> zvs_hostels

//4. Finance Modules{FinMod} ==> zvs_finances

//5. Subject Modules{SubMod} ==> zvs_subjects

//6. Exam Modules{ExmMod} ==> zvs_examinations

//7. Communication Modules{ComMod} ==> zvs_communication

//8. Teachers Modules{TchMod} ==> zvs_teachers

//9. Students Modules{StuMod} ==> zvs_students

//10. Parents Modules{ParMod} ==> zvs_parents

//11. Sub Staff Modules{SstMod} ==> zvs_sub_staff

//12. BOG Modules{BogMod} ==> zvs_bog

//13. Transport Modules{TraMod}  ==> zvs_transport

//14. Stores Modules{StoMod} ==> zvs_stores

//15. Library Modules{LibMod} ==> zvs_library

    


$main_menu = array(
    
    //Main dashboard
    "main_dashboard" => array(
        'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
        'controller' => $zvs_controller,
        'action' => 'main_dashboard',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Classess
    "manage_classes" => array(
        'name' => '<i class="fa fa-building-o"></i> Manage Classes',
        'controller' => $zvs_controller,
        'action' => 'manage_classes',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
    //Manage Departments
    "manage_departments" => array(
        'name' => '<i class="fa fa-sitemap"></i> Manage Departments ',
        'controller' => $zvs_controller,
        'action' => 'manage_departments',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),

    
    //Manage Hostels
    "manage_hostels" => array(
        'name' => '<i class="fa fa-hospital-o"></i> Manage Hostels ',
        'controller' => $zvs_controller,
        'action' => 'manage_hostels',
        'parameter' => $identificationCode,
        'title' => '',
        'style' => '',
        'id' => ''
    ),
    
    
);
?>


<?php if(Zf_Core_Functions::Zf_recursiveArray("DepMod_viewDepartment", $zvs_allowedResources)){ ?>
    <!--This is the actual menu-->
    <li class="start <?php if ($zvs_action == "main_dashboard") { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['main_dashboard']); ?>
    </li> 
<?php }?>
<?php if(Zf_Core_Functions::Zf_recursiveArray("ClsMod_viewClasses", $zvs_allowedResources)){ ?>
    <li class="<?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") { echo "active";} ?>">
        <a href="javascript:;">
            <i class="fa fa-th"></i>
            <span class="title"> School Structure </span>
            <?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") {?><span class="selected"></span><?php } ?>
            <span class="arrow <?php if ($zvs_action == "manage_classes" || $zvs_action == "manage_departments" || $zvs_action == "manage_hostels") { echo "open";} ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($zvs_action == "manage_classes") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_classes']); ?>
            </li>
            <li class="<?php if ($zvs_action == "manage_departments") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_departments']); ?>
            </li>
            <li class="<?php if ($zvs_action == "manage_hostels") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_hostels']); ?>
            </li>
        </ul>
    </li>
<?php }?>