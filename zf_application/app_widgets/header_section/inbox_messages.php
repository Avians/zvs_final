<?php
//This holds an array of the active URL
$activeURL = Zf_Core_Functions::Zf_URLSanitize();

//This is the controller
$zvs_controller = $activeURL[0];

//User identification code. This code is also stored in a session variable
$identificationCode = $zf_externalWidgetData;

?>

<li class="dropdown" id="header_inbox_bar">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="fa fa-envelope"></i>
        <span class="badge">
            5
        </span>
    </a>
    <ul class="dropdown-menu extended inbox">
        <li>
            <p>
                You have 12 new messages
            </p>
        </li>
        <li>
            <ul class="dropdown-menu-list scroller" style="height: 250px;">
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo">
                            <img src="./assets/img/avatar2.jpg" alt=""/>
                        </span>
                        <span class="subject">
                            <span class="from">
                                Lisa Wong
                            </span>
                            <span class="time">
                                Just Now
                            </span>
                        </span>
                        <span class="message">
                            Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh...
                        </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo">
                            <img src="./assets/img/avatar3.jpg" alt=""/>
                        </span>
                        <span class="subject">
                            <span class="from">
                                Richard Doe
                            </span>
                            <span class="time">
                                16 mins
                            </span>
                        </span>
                        <span class="message">
                            Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
                        </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo">
                            <img src="./assets/img/avatar1.jpg" alt=""/>
                        </span>
                        <span class="subject">
                            <span class="from">
                                Bob Nilson
                            </span>
                            <span class="time">
                                2 hrs
                            </span>
                        </span>
                        <span class="message">
                            Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh...
                        </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo">
                            <img src="./assets/img/avatar2.jpg" alt=""/>
                        </span>
                        <span class="subject">
                            <span class="from">
                                Lisa Wong
                            </span>
                            <span class="time">
                                40 mins
                            </span>
                        </span>
                        <span class="message">
                            Vivamus sed auctor 40% nibh congue nibh...
                        </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo">
                            <img src="./assets/img/avatar3.jpg" alt=""/>
                        </span>
                        <span class="subject">
                            <span class="from">
                                Richard Doe
                            </span>
                            <span class="time">
                                46 mins
                            </span>
                        </span>
                        <span class="message">
                            Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="external">
            <a href="inbox.html">
                See all messages <i class="m-icon-swapright"></i>
            </a>
        </li>
    </ul>
</li>