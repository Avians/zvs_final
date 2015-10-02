<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS A CORE FILE FOR ZILAS FRAMEWORK HOLDING ALL THE CORE CONSTANTS
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  11th/August/2013  Time: 23:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 */

/**
 * -----------------------------------------------------------------------------
 * HERE WE REQUIRE THE ZILAS PHP FRAMEWORK, CORE CONFIGURATION FILE
 * -----------------------------------------------------------------------------
 * 
 */
require_once 'zf_base/zf_configurations/zf_configurations.php';



/**
 * -----------------------------------------------------------------------------
 * THIS HOLDS THE DEFAULT FRAMEWORK PATHS FOR ZILAS PHP FRAMEWORK
 * -----------------------------------------------------------------------------
 */

$zf_defaultPaths = Zf_Configurations::Zf_ConfigurationPaths();

/**
 * -----------------------------------------------------------------------------
 * THIS HOLDS THE VALUE OF THE DIRECTORY SEPARATOR
 * -----------------------------------------------------------------------------
 */
$zf_directorySeparator = Zf_Configurations::Zf_directorySeparator();

/**
 * -----------------------------------------------------------------------------
 * USING BROWSER USER AGENTS, WE GET TO SELECT THE DIRECTORY SEPARATOR
 * -----------------------------------------------------------------------------
 * 
 */
 defined('DS') ? null : define('DS', $zf_directorySeparator);//i.e in this case DS means either "\" for windows or "/" for unix.
 

/**
 * -----------------------------------------------------------------------------
 *  THIS IS THE APPLICATION PATH TO THE ROOT FOLDER OF A GIVEN ZILAS APPLICATION                                                      
 * -----------------------------------------------------------------------------
 */
   defined('ZF_ROOT_PATH') ? null : define('ZF_ROOT_PATH', $zf_defaultPaths['zf_application']); 
    

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO THE "zf_base" directory
 * -----------------------------------------------------------------------------
 */
    defined('ZF_BASE')      ? null : define('ZF_BASE'      , 'zf_base'.DS);
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO DIRECTORIES IN THE zf_base DIRECTORY.
 * -----------------------------------------------------------------------------
 */
    defined('ZF_CLASSES')   ? null : define('ZF_CLASSES'   ,  ZF_BASE.'zf_classes'.DS);
    defined('ZF_CONFIG')    ? null : define('ZF_CONFIG'    ,  ZF_BASE.'zf_configurations'.DS);
    defined('ZF_CONSTANTS') ? null : define('ZF_CONSTANTS' ,  ZF_BASE.'zf_constants'.DS);
    defined('ZF_CORE')      ? null : define('ZF_CORE'      ,  ZF_BASE.'zf_core'.DS);
    defined('ZF_FUNCTIONS') ? null : define('ZF_FUNCTIONS' ,  ZF_BASE.'zf_functions'.DS);
    defined('ZF_PLUGINS')   ? null : define('ZF_PLUGINS'   ,  ZF_BASE.'zf_plugins'.DS);
    defined('ZF_WIDGETS')   ? null : define('ZF_WIDGETS'   ,  ZF_BASE.'zf_widgets'.DS);
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO THE "zf_datastore" directory
 * -----------------------------------------------------------------------------
 */
    defined('ZF_DATASTORE')      ? null : define('ZF_DATASTORE' , 'zf_datastore'.DS);  
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATHS TO THE APPLICATION INSTALLATION FILE AND THE
 * ACTUAL FILE ITSELF.
 * -----------------------------------------------------------------------------
 * 
 */
    defined('INSTALLATION_FILE') ? null : define('INSTALLATION_FILE', ZF_CORE.'zf_install/zf_install.php');
    defined('INSTALLATION_PATH') ? null : define('INSTALLATION_PATH', $zf_defaultPaths['zf_application'].DS.INSTALLATION_FILE);
    
 
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO THE "zf_application" directory
 * -----------------------------------------------------------------------------
 */
    defined('ZF_APPLICATION')  ? null : define('ZF_APPLICATION'  , 'zf_application'.DS);
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO DIRECTORIES IN THE zf_application DIRECTORY.
 * -----------------------------------------------------------------------------
 */
    defined('APP_CONTROLLERS')   ? null : define('APP_CONTROLLERS' ,  ZF_APPLICATION.'app_controllers'.DS);
    defined('APP_MODELS')        ? null : define('APP_MODELS'      ,  ZF_APPLICATION.'app_models'.DS);
    defined('APP_VIEWS')         ? null : define('APP_VIEWS'       ,  ZF_APPLICATION.'app_views'.DS);
    defined('APP_PLUGINS')       ? null : define('APP_PLUGINS'     ,  ZF_APPLICATION.'app_plugins'.DS);
    defined('APP_WIDGETS')       ? null : define('APP_WIDGETS'     ,  ZF_APPLICATION.'app_widgets'.DS);
    defined('APP_LAYOUTS')       ? null : define('APP_LAYOUTS'     ,  ZF_APPLICATION.'app_layouts'.DS);
 
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO DIRECTORIES FOR APPLICATION ASSETS
 * -----------------------------------------------------------------------------
 */
    defined('APP_CONTROLLERS_ASSETS')  ? null : define('APP_CONTROLLERS_ASSETS' ,  APP_CONTROLLERS.'app_assets'.DS);
    defined('APP_MODELS_ASSETS')       ? null : define('APP_MODELS_ASSETS' ,  APP_MODELS.'app_assets'.DS);
    defined('APP_VIEWS_ASSETS')        ? null : define('APP_VIEWS_ASSETS' ,  APP_VIEWS.'app_assets'.DS);
    

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO INNER DIRECTORIES FOR APPLICATION LAYOUTS
 * -----------------------------------------------------------------------------
 */
    defined('APPLICATION_HEADERS')  ? null : define('APPLICATION_HEADERS', APP_LAYOUTS.'app_headers'.DS);
    defined('APPLICATION_FOOTERS')  ? null : define('APPLICATION_FOOTERS', APP_LAYOUTS.'app_footers'.DS);
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO THE "zf_client" directory
 * -----------------------------------------------------------------------------
 */
    defined('ZF_CLIENT')      ? null : define('ZF_CLIENT'      , 'zf_client'.DS);
    
/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ABSOLUTE PATH TO DIRECTORIES IN THE zf_client DIRECTORY.
 * -----------------------------------------------------------------------------
 */
    defined('ZF_APP_GLOBAL')       ? null : define('ZF_APP_GLOBAL' ,  ZF_CLIENT.'zf_app_global'.DS);
    defined('ZF_DESKTOP_LAPTOP')   ? null : define('ZF_DESKTOP_LAPTOPL' ,  ZF_CLIENT.'zf_desktop_laptop'.DS);
    defined('ZF_MOBILE_DEVICE')    ? null : define('ZF_MOBILE_DEVICE' ,  ZF_CLIENT.'zf_mobile_device'.DS);
    defined('ZF_TABLET_DEVICE')    ? null : define('ZF_TABLET_DEVICE' ,  ZF_CLIENT.'zf_tablet_devices'.DS);
    
    
    
/**
 * -----------------------------------------------------------------------------
 * THESE HOLDS THE MAIN ROLES OF USERS WITHIN ZILAS VIRTUAL SCHOOLS
 * -----------------------------------------------------------------------------
 */ 
    //Admin users constants
    defined('ZVS_SUPER_ADMIN')       ?   null : define('ZVS_SUPER_ADMIN'       ,  510);
    defined('ZVS_ADMIN')             ?   null : define('ZVS_ADMIN'             ,  509);
        
    //School community users constants
    defined('SCHOOL_PRINCIPAL')      ?   null : define('SCHOOL_PRINCIPAL'      ,  210);
    defined('SCHOOL_MAIN_ADMIN')     ?   null : define('SCHOOL_MAIN_ADMIN'     ,  209);
    defined('SCHOOL_GENERAL_ADMIN')  ?   null : define('SCHOOL_GENERAL_ADMIN'  ,  208);
    defined('SCHOOL_SUB_STAFF')      ?   null : define('SCHOOL_SUB_STAFF'      ,  207);
    defined('SCHOOL_BOG')            ?   null : define('SCHOOL_BOG'            ,  206);
    defined('SCHOOL_STUDENT')        ?   null : define('SCHOOL_STUDENT'        ,  205);
    defined('SCHOOL_PARENT')         ?   null : define('SCHOOL_PARENT'         ,  204);
    defined('SCHOOL_ALUMNI')         ?   null : define('SCHOOL_ALUMNI'         ,  203);
    
    //Platform restricted users
    defined('ZVS_ACTIVE_USER')       ?   null : define('ZVS_ACTIVE_USER'       ,  1);
    defined('ZVS_INACTIVE_USER')       ?   null : define('ZVS_INACTIVE_USER'   ,  0);
    
    defined('ZVS_GUEST_USER')        ?   null : define('ZVS_GUEST_USER'        ,  -1); 
    defined('ZVS_BANNED_USER')       ?   null : define('ZVS_BANNED_USER'       ,  -5);
    
    
    //Platform restricted schools
    defined('ZVS_ACTIVE_SCHOOL')       ?   null : define('ZVS_ACTIVE_SCHOOL'       ,  1);
    defined('ZVS_INACTIVE_SCHOOL')       ?   null : define('ZVS_INACTIVE_SCHOOL'   ,  0);
    
    defined('ZVS_GUEST_SCHOOL')        ?   null : define('ZVS_GUEST_SCHOOL'        ,  -1); 
    defined('ZVS_BANNED_SCHOOL')       ?   null : define('ZVS_BANNED_SCHOOL'       ,  -5);
    
   

?>
