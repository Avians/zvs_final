<?php
error_reporting((E_ALL & ~E_NOTICE) & 0);
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE APPLICATION GENERAL HEADER THAT IS RENDERED WHEN THE APPLICATION
 * IS ENABLED AND IS NOT UNDER CONSTRUCTION OR WHEN THE APPLICATION UNDER  
 * CONSTRUCTION AND THE CONSTRUCTION INDICATOR IS SET TO CUSTOM
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  16th/February/2015  Time: 16:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en" class="no-js">
    <head>
        
        <!-- <meta charset="UTF-8">-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            
        <?php
        
            /**
             * This loads all the SEO files depending on whether the SEO ability
             * of the framework has been enabled or not. If the SEO ability is
             * enabled then the SEO files are view specific if and only if they
             * exist in the particular view.
             */
            Zf_GenerateSEO::zf_load_seo();    
            
            /**
             * This is loads all the CSS and Javascript files that are global to
             * the application and even those that are specific to a given view 
             * of the application
             */
            Zf_ClientAutoload::Zf_loadCssScriptsFonts($zf_currentController, $zf_targetView);
            
            //This gets back an array of the currently active URL
            $activeURL = Zf_Core_Functions::Zf_URLSanitize();
            
        ?>        
    </head>
    
    <!-- BEGIN BODY -->
    <body 
<?php
    if (empty($activeURL[0]) || ($activeURL[0] == "initialize" && empty($activeURL[1])) || ($activeURL[0] == "initialize" && ($activeURL[1] == "authentication" || $activeURL[1] == "forgot_password"))) {
        
        echo ' class="login" ';
        
    } else {
        
        echo ' class="page-header-fixed" ';
        
    }
?> 
    >
        <?php
        
        if(empty($activeURL[0]) || ($activeURL[0] == "initialize" && empty($activeURL[1])) || ($activeURL[0] == "initialize" && ($activeURL[1] == "authentication" || $activeURL[1] == "forgot_password"))){
            
            //Login form header is held in this widget file
            Zf_ApplicationWidgets::zf_load_widget("initialize", "form_header.php");
            
        }else{
            
            //Dashboard header is held in this widget file.
            Zf_ApplicationWidgets::zf_load_widget("header_section", "dashboard_header.php");
            
        }
            
        ?>