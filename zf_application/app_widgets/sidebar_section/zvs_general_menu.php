<?php

/** 
 * This general menu by all system user except the banned and the guests
 */

//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This are the active controller, action and parameter if any.
$zvs_controller = $activeURL[0]; $zvs_action = $activeURL[1]; $zvs_parameter = Zf_SecureData::zf_decode_data($activeURL[2]);

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;

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
    )
    
    
);

?>

<li>
    <a href="javascript:;">
        <i class="fa fa-envelope"></i>
        <span class="title"> Email Client </span><span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="#"> <i class="fa fa-edit"></i> Compose Email </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-inbox"></i> Inbox </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-mail-reply"></i> Outbox </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-save"></i> Draft </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-trash-o"></i> Trash </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;">
        <i class="fa fa-comment"></i> 
        <span class="title"> SMS Client </span><span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="#"> <i class="fa fa-edit"></i> Compose SMS </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-inbox"></i> SMS Inbox </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-mail-reply"></i> SMS Outbox </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-save"></i> SMS Draft </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-trash-o"></i> SMS Trash </a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-archive"></i> SMS History </a>
        </li>
    </ul>
</li>
<li>
    <a href="#">
        <i class="fa fa-home"></i> <span class="title"> Friends Section </span>
    </a>
</li>
<li>
    <a href="#">
        <i class="fa fa-home"></i> <span class="title"> Reports Generator </span>
    </a>
</li>
<li>
    <a href="#">
        <i class="fa fa-home"></i> <span class="title"> Inter School Comm. </span>
    </a>
</li>