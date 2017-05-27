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
    defined('ZF_DESKTOP_LAPTOP')   ? null : define('ZF_DESKTOP_LAPTOP' ,  ZF_CLIENT.'zf_desktop_laptop'.DS);
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
    
    //Zilas Virtual School - School Main Admin
    defined('SCHOOL_MAIN_ADMIN') ?   null : define('SCHOOL_MAIN_ADMIN'         ,  209);
        
    //Zilas Virtual School User constants
    defined('ZVS_SCHOOL_STAFF')         ?   null : define('ZVS_SCHOOL_STAFF'       ,  110);
    defined('ZVS_SCHOOL_STUDENT')       ?   null : define('ZVS_SCHOOL_STUDENT'     ,  109);
    defined('ZVS_SCHOOL_PARENT')        ?   null : define('ZVS_SCHOOL_PARENT'      ,  108);
    defined('ZVS_EXTERNAL_ASSOCIATES')  ?   null : define('ZVS_EXTERNAL_ASSOCIATES',  107);
    
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
    
    
    //Platform Student Status
    defined('STUDENT_CONTINUING')       ?   null : define('STUDENT_CONTINUING'   ,  1);
    defined('STUDENT_ALUMNI')       ?   null : define('STUDENT_ALUMNI'  ,  0);
    
    
    //Platform Staff Status
    defined('STAFF_CONTINUING')       ?   null : define('STAFF_CONTINUING'   ,  1);
    
    

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE MAIN CONNECTOR FOR ZILAS FRAMEWORK
 * -----------------------------------------------------------------------------
 */    
    defined('CONNECT') ? null : define('CONNECT' , '[`^`]');


/**
 * -----------------------------------------------------------------------------
 * THESE HOLDS ALL PLATFORM MODULES WITHIN ZILAS VIRTUAL SCHOOLS
 * -----------------------------------------------------------------------------
 */    
    //Class Module and resources
    defined('CLSMOD') ? null : define('CLSMOD' , 'class_module');
    defined('CLASS_MODULE') ? null : define('CLASS_MODULE' , 'ClsMod');
    
        //These constant are a set of resources that are usable within the class module
        defined('VIEW_CLASSES') ? null : define('VIEW_CLASSES' , 'ClsMod'.CONNECT.'ViewClasses');
        defined('CLASS_DETAILS') ? null : define('CLASS_DETAILS' , 'ClsMod'.CONNECT.'ClassDetails');
        defined('VIEW_STREAMS') ? null : define('VIEW_STREAMS' , 'ClsMod'.CONNECT.'ViewStreams');
        defined('STREAM_DETAILS') ? null : define('STREAM_DETAILS' , 'ClsMod'.CONNECT.'StreamDetails');
    
    //Department Module and resources
    defined('DEPMOD') ? null : define('DEPMOD' , 'department_module');
    defined('DEPARTMENT_MODULE') ? null : define('DEPARTMENT_MODULE' , 'DepMod');
        
        //These constant are a set of resources that are usable within the department module
        defined('VIEW_DEPARTMENTS') ? null : define('VIEW_DEPARTMENTS' , 'DepMod'.CONNECT.'ViewDepartments');
        defined('DEPARTMENT_PROFILE') ? null : define('DEPARTMENT_PROFILE' , 'DepMod'.CONNECT.'DepartmentProfile');
        defined('VIEW_SUB_DEPARTMENTS') ? null : define('VIEW_SUB_DEPARTMENTS' , 'DepMod'.CONNECT.'ViewSubDepartments');
        defined('SUB_DEPARTMENT_PROFILE') ? null : define('SUB_DEPARTMENT_PROFILE' , 'DepMod'.CONNECT.'SubDepartmentProfile');
    
    
    //Finance Module and resources
    defined('FINMOD') ? null : define('FINMOD' , 'finance_module');
    defined('FINANCE_MODULE') ? null : define('FINANCE_MODULE' , 'FinMod');
    
        //These constant are a set of resources that are usable within the finance module
        defined('CREATE_FEES') ? null : define('CREATE_FEES' , 'FinMod'.CONNECT.'CreateFees');
        defined('COLLECT_FEES') ? null : define('COLLECT_FEES' , 'FinMod'.CONNECT.'CollectFees');
        defined('FINANCE_STATUS') ? null : define('FINANCE_STATUS' , 'FinMod'.CONNECT.'FinanceStatus');
        defined('CREATE_BUDGET') ? null : define('CREATE_BUDGET' , 'FinMod'.CONNECT.'CreateBudget');
        defined('ALLOCATE_FINANCES') ? null : define('ALLOCATE_FINANCES' , 'FinMod'.CONNECT.'AllocateFinances');
        defined('FEE_STRUCTURE') ? null : define('FEE_STRUCTURE' , 'FinMod'.CONNECT.'FeeStructure');
        defined('FEE_DEFAULTERS') ? null : define('FEE_DEFAULTERS' , 'FinMod'.CONNECT.'FeeDefaulters');
        defined('FEE_REFUNDS') ? null : define('FEE_REFUNDS' , 'FinMod'.CONNECT.'FeeRefunds');
    
    
    //Student Module and resources
    defined('STUMOD') ? null : define('STUMOD' , 'student_module');
    defined('STUDENT_MODULE') ? null : define('STUDENT_MODULE' , 'StuMod');
    
        //These constant are a set of resources that are usable within the students module
        defined('STUDENT_DETAILS') ? null : define('STUDENT_DETAILS' , 'StuMod'.CONNECT.'StudentDetails');
        defined('REGISTER_STUDENT') ? null : define('REGISTER_STUDENT' , 'StuMod'.CONNECT.'RegisterStudent');
        defined('SHIFT_STUDENTS') ? null : define('SHIFT_STUDENTS' , 'StuMod'.CONNECT.'ShiftStudents');
    
    
    //Staff Module and resources
    defined('STFMOD') ? null : define('STFMOD' , 'staff_module');
    defined('STAFF_MODULE') ? null : define('STAFF_MODULE' , 'StfMod');
    
        //These constant are a set of resources that are usable within the staff module
        defined('STAFF_DETAILS') ? null : define('STAFF_DETAILS' , 'StfMod'.CONNECT.'StaffDetails');
        defined('REGISTER_STAFF') ? null : define('REGISTER_STAFF' , 'StfMod'.CONNECT.'RegisterStaff');
        defined('STAFF_DIRECTORY') ? null : define('STAFF_DIRECTORY' , 'StfMod'.CONNECT.'StaffDirectory');
    
    
    //Parent Module and resources
    defined('PARMOD') ? null : define('PARMOD' , 'parent_module');
    defined('PARENT_MODULE') ? null : define('PARENT_MODULE' , 'ParMod');
    
    
    //BOG Module and resources
    defined('BOGMOD') ? null : define('BOGMOD' , 'bog_module');
    defined('BOG_MODULE') ? null : define('BOG_MODULE' , 'BogMod');
    
    
    //Subject Module and resources
    defined('SUBMOD') ? null : define('SUBMOD' , 'subject_module');
    defined('SUBJECT_MODULE') ? null : define('SUBJECT_MODULE' , 'SubMod');
    
        //These constant are a set of resources that are usable within the subjects module
        defined('SUBJECT_OVERVIEW') ? null : define('SUBJECT_OVERVIEW' , 'SubMod'.CONNECT.'SubjectOverview');
        defined('SUBJECT_SETUP') ? null : define('SUBJECT_SETUP' , 'SubMod'.CONNECT.'SubjectSetup');
        defined('SUBJECT_REPORTS') ? null : define('SUBJECT_REPORTS' , 'SubMod'.CONNECT.'SubjectReports');
    
    
    //Examination Module and resources
    defined('EXMMOD') ? null : define('EXMMOD' , 'examination_module');
    defined('EXAMINATION_MODULE') ? null : define('EXAMINATION_MODULE' , 'ExmMod');
    
    
    //Marksheet Module and resources
    defined('GRDMOD') ? null : define('GRDMOD' , 'grade_module');
    defined('GRADE_MODULE') ? null : define('GRADE_MODULE' , 'GrdMod');
    
    
    //Timetable Module and resources
    defined('TTBMOD') ? null : define('TTBMOD' , 'timetable_module');
    defined('TIMETABLE_MODULE') ? null : define('TIMETABLE_MODULE' , 'TtbMod');
    
    //These constant are a set of resources that are usable within the time-table module
        defined('CREATE_TIME_TABLE') ? null : define('CREATE_TIME_TABLE' , 'TtbMod'.CONNECT.'createTimeTable');
    
    
    //Noticeboard Module and resources
    defined('NTCMOD') ? null : define('NTCMOD' , 'noticeboard_module');
    defined('NOTICEBOARD_MODULE') ? null : define('NOTICEBOARD_MODULE' , 'NtcMod');
    
    
    //Library Module and resources
    defined('LIBMOD') ? null : define('LIBMOD' , 'library_module');
    defined('LIBRARY_MODULE') ? null : define('LIBRARY_MODULE' , 'LibMod');
    
        //These constant are a set of resources that are usable within the library module
        defined('LIBRARY_OVERVIEW') ? null : define('LIBRARY_OVERVIEW' , 'LibMod'.CONNECT.'LibraryOverview');
        defined('LIBRARY_SETUP') ? null : define('LIBRARY_SETUP' , 'LibMod'.CONNECT.'LibrarySetup');
        defined('LIBRARY_RECEIVING') ? null : define('LIBRARY_RECEIVING' , 'LibMod'.CONNECT.'LibraryReceiving');
        defined('LIBRARY_ISSUING') ? null : define('LIBRARY_ISSUING' , 'LibMod'.CONNECT.'LibraryIssuing');
        defined('LIBRARY_REPORTS') ? null : define('LIBRARY_REPORTS' , 'LibMod'.CONNECT.'LibraryReports');
    
    
    //Transport Module and resources
    defined('TRNMOD') ? null : define('TRNMOD' , 'transport_module');
    defined('TRANSPORT_MODULE') ? null : define('TRANSPORT_MODULE' , 'TrnMod');
    
        //These constant are a set of resources that are usable within the transport module
        defined('TRANSPORT_OVERVIEW') ? null : define('TRANSPORT_OVERVIEW' , 'TrnMod'.CONNECT.'TransportOverview');
        defined('TRANSPORT_SETUP') ? null : define('TRANSPORT_SETUP' , 'TrnMod'.CONNECT.'TransportSetup');
        defined('TRANSPORT_VEHICLES') ? null : define('TRANSPORT_VEHICLES' , 'TrnMod'.CONNECT.'TransportVehicles');
        defined('TRANSPORT_ASSIGN_DRIVERS') ? null : define('TRANSPORT_ASSIGN_DRIVERS' , 'TrnMod'.CONNECT.'AssignDrivers');
        defined('TRANSPORT_ASSIGN_STUDENTS') ? null : define('TRANSPORT_ASSIGN_STUDENTS' , 'TrnMod'.CONNECT.'AssignStudents');
        defined('TRANSPORT_REPORTS') ? null : define('TRANSPORT_REPORTS' , 'TrnMod'.CONNECT.'TransportReports');
    
    
    //Kitchen Module and resources
    defined('KTNMOD') ? null : define('KTNMOD' , 'kitchen_module');
    defined('KITCHEN_MODULE') ? null : define('KITCHEN_MODULE' , 'KtnMod');
    
    
    //Health Module and resources
    defined('HTHMOD') ? null : define('HTHMOD' , 'health_module');
    defined('HEALTH_MODULE') ? null : define('HEALTH_MODULE' , 'HthMod');
    
    
    //Hostel Module and resources
    defined('HOSMOD') ? null : define('HOSMOD' , 'hostel_module');
    defined('HOSTEL_MODULE') ? null : define('HOSTEL_MODULE' , 'HosMod');
    
    
    //Asset Module and resources
    defined('ASSMOD') ? null : define('ASSMOD' , 'asset_module');
    defined('ASSET_MODULE') ? null : define('ASSET_MODULE' , 'AssMod');
    
        //These constant are a set of resources that are usable within the asset module
        defined('ASSET_OVERVIEW') ? null : define('ASSET_OVERVIEW' , 'AssMod'.CONNECT.'AssetOverview');
        defined('ASSET_SETUP') ? null : define('ASSET_SETUP' , 'AssMod'.CONNECT.'AssetSetup');
        defined('ASSET_INVENTORY') ? null : define('ASSET_INVENTORY' , 'AssMod'.CONNECT.'AssetInventory');
        defined('ASSET_ITEMS') ? null : define('ASSET_ITEMS' , 'AssMod'.CONNECT.'AssetItems');
        defined('ASSET_REPORTS') ? null : define('ASSET_REPORTS' , 'AssMod'.CONNECT.'AssetReports');
    
    
    
    //Store Module and resources
    defined('STRMOD') ? null : define('STRMOD' , 'store_module');
    defined('STORE_MODULE') ? null : define('STORE_MODULE' , 'StrMod');
    
        //These constant are a set of resources that are usable within the store module
        defined('STORE_OVERVIEW') ? null : define('STORE_OVERVIEW' , 'StrMod'.CONNECT.'StoreOverview');
        defined('STORE_SUPPLIERS') ? null : define('STORE_SUPPLIERS' , 'StrMod'.CONNECT.'StoreSuppliers');
        defined('STORE_SETUP') ? null : define('STORE_SETUP' , 'StrMod'.CONNECT.'StoreSetup');
        defined('STORE_ASSIGNMENT') ? null : define('STORE_ASSIGNMENT' , 'StrMod'.CONNECT.'StoreAssignment');
        defined('STORE_ITEMS') ? null : define('STORE_ITEMS' , 'StrMod'.CONNECT.'StoreItems');
        defined('STORE_RECEIVING') ? null : define('STORE_RECEIVING' , 'StrMod'.CONNECT.'StoreReceiving');
        defined('STORE_ISSUING') ? null : define('STORE_ISSUING' , 'StrMod'.CONNECT.'StoreIssuing');
        defined('STORE_REPORTS') ? null : define('STORE_REPORTS' , 'StrMod'.CONNECT.'StoreReports');
    
    
    
    //Data Management Module and resources
    defined('DTAMOD') ? null : define('DTAMOD' , 'data_module');
    defined('DATA_MODULE') ? null : define('DATA_MODULE' , 'DtaMod');
    
        //These constant are a set of resources that are usable within the data module
        defined('MANAGE_STUDENT_DATA') ? null : define('MANAGE_STUDENT_DATA' , 'DtaMod'.CONNECT.'ManageStudentData');
        defined('MANAGE_STAFF_DATA') ? null : define('MANAGE_STAFF_DATA' , 'DtaMod'.CONNECT.'ManageStaffData');
   

?>
