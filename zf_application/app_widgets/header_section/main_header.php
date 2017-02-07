<div class="header navbar navbar-fixed-top">
    
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        
        <!-- BEGIN LOGO -->
        <?php
        
            //This returns the active URL
            $activeURL = Zf_Core_Functions::Zf_URLSanitize();
            
            //This is the identification code held in a session
            $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");

            $platform_title = array(
                'name' => '<div class="zila-logo-name"><p>Zilas Virtual Schools<sup style="font-size: 12px !important; font-style: normal;">TM</sup></p></div>',
                'controller' => $activeURL[0],
                'action' => 'main_dashboard',
                'parameter' => $identificationCode,
                'title' => '',
                'style' => 'navbar-brand',
                'id' => ''
            );
            Zf_GenerateLinks::zf_internal_link($platform_title);
        
        ?>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="<?php echo ZF_ROOT_PATH . ZF_CLIENT . "zf_app_global" . DS . "app_global_files" . DS . "app_global_images" . DS . "main_icons" . DS . "menu-toggler.png"; ?>" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right">
            <?php
            
                //This is the notification widget
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "notifications.php", $identificationCode);

                //This is the messages widget
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "inbox_messages.php", $identificationCode);

                //This is the tasks widget
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "pending_tasks.php", $identificationCode);

                //This is the users section widget
                Zf_ApplicationWidgets::zf_load_widget("header_section", "user_section.php", $identificationCode);
                
           ?> 
        </ul>
        <!-- END TOP NAVIGATION MENU -->

    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>