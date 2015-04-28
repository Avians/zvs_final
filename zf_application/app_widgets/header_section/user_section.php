<?php
//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This is the controller
$zvs_controller = $activeURL[0];

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;
    
//returns an array holding the user details
$userDetails = $zf_model_data->zf_getUserDetails($identificationCode);

//Here we prepare Order Maker details
foreach ($userDetails as $value) {

    $userName = $value['firstName']." ".$value['lastName'];
    
    $imagePath = $value['imagePath'];

}


$user_menu = array(
    
        //user profile
        "my_profile" => array(
            'name' => '<i class="fa fa-user"></i> My Profile',
            'controller' => $zvs_controller,
            'action' => 'my_profile',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //update profile
        "update_profile" => array(
            'name' => '<i class="fa fa-edit"></i> Update Profile',
            'controller' => $zvs_controller,
            'action' => 'update_profile',
            'parameter' => $identificationCode, //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //user calendar
        "my_calender" => array(
            'name' => '<i class="fa fa-calendar"></i> My Calendar',
            'controller' => $zvs_controller,
            'action' => 'my_calendar',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //user inbox emails
        "my_inbox" => array(
            'name' => '<i class="fa fa-envelope"></i> My Inbox<span class="badge badge-danger">3</span>',
            'controller' => $zvs_controller,
            'action' => 'my_inbox',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //user tasks
        "my_tasks" => array(
            'name' => '<i class="fa fa-tasks"></i> My Tasks<span class="badge badge-success">7</span>',
            'controller' => $zvs_controller,
            'action' => 'my_tasks',
            'parameter' => $identificationCode, //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //lock account
        "lock_user" => array(
            'name' => '<i class="fa fa-lock"></i> Lock Screen',
            'controller' => $zvs_controller,
            'action' => 'lock_user',
            'parameter' => $identificationCode, //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
        //user logout
        "logout" => array(
            'name' => '<i class="fa fa-power-off"></i> Log Out',
            'controller' => 'initialize',
            'action' => 'logout',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
    
);
?>
<li class="dropdown user">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <?php if(empty($imagePath) || $imagePath == NULL){ ?>
            <div class="">   
               <i class="fa fa-user user-section-image" style="font-size: 28px;  color: #e5e5e5 !important; padding-top: 7px;"></i>
               <span class="username"><?php echo $userName; ?></span><i class="fa fa-angle-down"></i>
            </div>
        <?php }else{ ?>
            <?php $zf_model_data->getUserImage($imagePath, $userName); ?>
            <span class="username"><?php echo $userName; ?></span><i class="fa fa-angle-down"></i>
        <?php }?>
   
    </a>
    <ul class="dropdown-menu">
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_profile']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['update_profile']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_calender']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_inbox']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_tasks']); ?>
        </li>
        <li class="divider"></li>
        <li>
            <a href="javascript:;" id="trigger_fullscreen">
                <i class="fa fa-arrows"></i> Full Screen
            </a>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['lock_user']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['logout']); ?>
        </li>
    </ul>
</li>