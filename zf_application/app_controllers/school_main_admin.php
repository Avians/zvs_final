<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE SCHOOL_MAIN_ADMIN CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING
 * ALL ACTIONS THAT RELATE TO SCHOOL MAIN ADMINISTRATOR MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  11th/February/2015  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class School_main_adminController extends Zf_Controller {
   
    
    public $zf_defaultAction = "main_dashboard";


    /**
     * This is the class constructor
     */
    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
   
    

    
    /**
     * This action executes the main dashboard view
     */
    public function actionMain_dashboard(){
        
        Zf_View::zf_displayView('main_dashboard');
        
    }
   
    

    
    /**
     * This action executes the school profile view
     */
    public function actionSchool_profile(){
        
        Zf_View::zf_displayView('school_profile');
        
    }
   
    

    
    /**
     * This action executes the manage classes view
     */
    public function actionManage_classes($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_classes', $zf_actionData);
        
    }
    
    
    
    
   /**
     * This action executes the viewing of class details
     */
    public function actionView_class_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_class_details', $zf_actionData);
        
    }
    
    
    
    
   /**
     * This action executes the viewing of stream details
     */
    public function actionView_stream_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_stream_details', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage departments view
     */
    public function actionManage_departments($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_departments', $zf_actionData);
        
    }
    
    
    
    
   /**
     * This action executes the viewing of department details
     */
    public function actionView_department_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_department_details', $zf_actionData);
        
    }
    
    
    
    
   /**
     * This action executes the viewing of sub department details
     */
    public function actionView_subDepartment_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_subDepartment_details', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage hostels view
     */
    public function actionManage_hostels($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_hostels', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the viewing of hostel details
     */
    public function actionView_hostel_details($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('view_hostel_details', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage teachers view
     */
    public function actionManage_teachers(){
        
        Zf_View::zf_displayView('manage_teachers');
        
    }
   
    

    
    /**
     * This action executes the manage students view
     */
    public function actionManage_students(){
        
        Zf_View::zf_displayView('manage_students');
        
    }
   
    

    
    /**
     * This action executes the manage substaff view
     */
    public function actionManage_substaff(){
        
        Zf_View::zf_displayView('manage_substaff');
        
    }
   
    

    
    /**
     * This action executes the manage fees view
     */
    public function actionManage_fees($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_fees', $zf_actionData);
        
    }
    
    
    
    /**
     * This action executes the manage classes view
     */
    public function actionConfigure_budget($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('configure_budget', $zf_actionData);
        
    }
    

    
    /**
     * This action executes the manage subjects view
     */
    public function actionManage_subjects($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_subjects', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage exams view
     */
    public function actionManage_exams($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_exams', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage marksheet view
     */
    public function actionManage_grades($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_grades', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the configuration of school attendance
     */
    public function actionConfigure_attendance($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('configure_attendance', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the view that is used to configure school timetable
     */
    public function actionConfigure_timetable($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('configure_timetable', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage notice board view
     */
    public function actionManage_notice_board(){
        
        Zf_View::zf_displayView('manage_notice_board');
        
    }
   
    

    
    /**
     * This action executes the manage calendar view
     */
    public function actionManage_calendar(){
        
        Zf_View::zf_displayView('manage_calendar');
        
    }
   
    

    
    /**
     * This action executes the manage roles view
     */
    public function actionManage_roles($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_roles', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes view_roles view
     */
    public function actionView_role_details($roleDetails){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($roleDetails);
        
        Zf_View::zf_displayView('view_role_details', $zf_actionData);
        
    }
    
    
   
    /**
     * This action executes view_resource view
     */
    public function actionView_role_resources($roleResources){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($roleResources);
        
        Zf_View::zf_displayView('view_role_resources', $zf_actionData);
        
    }
   
    

    
    /**
     * This action executes the manage resources view
     */
    public function actionManage_resources($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_resources', $zf_actionData);
       
    }
    
 
    
    /**
     * This action executes the manage affiliates view
     */
    public function actionManage_affiliates(){
        
        Zf_View::zf_displayView('manage_affiliates');
        
    }
   
    

    
    /**
     * This action executes the affiliates directory view
     */
    public function actionAffiliates_directory(){
        
        Zf_View::zf_displayView('affiliates_directory');
        
    }
    
    
   
    
    /**
     * This action executes the personal profile view
     */
    public function actionMy_profile($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_url($identificationCode);
        
        Zf_View::zf_displayView('my_profile', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the profile update view
     */
    public function actionUpdate_profile($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_url($identificationCode);
        
        Zf_View::zf_displayView('update_profile', $zf_actionData);
        
    }
    
    
    
    
    /**
     * This action executes the calendar view
     */
    public function actionMy_calendar(){
        
        Zf_View::zf_displayView('my_calendar');
        
    }
    
    
    
    
    /**
     * This action executes the inbox view
     */
    public function actionMy_inbox(){
        
        Zf_View::zf_displayView('my_inbox');
        
    }
    
    
    
    
    /**
     * This action executes the tasks view
     */
    public function actionMy_tasks(){
        
        Zf_View::zf_displayView('my_tasks');
        
    }
 
    
 
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A CLASS AND A STREAM.
     */
    public function actionNewClassRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_class"){
            
            //Register a class to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewClass();
            
        }else if($filterDataUrl == "new_stream"){
            
            //Register a stream into a school class on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewStream();
            
        }
        
    }
     
    
 
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A DEPARTMENT AND A SUB DEPRTMENT.
     */
    public function actionNewDepartmentRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_department"){
            
            //Register a department to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewDepartment();
            
        }else if($filterDataUrl == "new_sub_department"){
            
            //Register a sub department into a school department on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewSubDepartment();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A HOSTEL.
     */
    public function actionNewHostelRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_hostel"){
            
            //Register a class to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewHostel();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE A METHOD THAT IS USED TO REGISTER A NEW FINANCIAL YEAR INTO THE SCHOOL
     */
    public function actionNewFinancialYearRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_financial_year"){
            
            //Register a new financial year for the acting school
            $this->zf_targetModel->registerNewFinancialYear();
            
        }
        
    }
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A CLASS AND A STREAM.
     */
    public function actionNewBudgetCategoriesRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_budget_category"){
            
            //Register a budget category for the acting school
            $this->zf_targetModel->registerNewBudgetCategory();
            
        }else if($filterDataUrl == "new_budget_sub_category"){
            
            //Register a budget sub-category for the acting school
            $this->zf_targetModel->registerNewBudgetSubCategory();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A SUBJECT.
     */
    public function actionNewFeeItemRegistration($zvs_parameter){
       
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        
        if($filterDataUrl == "new_feeItem"){
            
            //Register a new subject to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewFeeItem();
            
        }else if($filterDataUrl == 'fee_payment_schedule'){
            
            //Register a new fee payment schedule
            $this->zf_targetModel->registerFeePaymentSchedule();
            
        }else if($filterDataVariable == 'process_year'){
            
            //Get the periods related to the selected year for the school
            $this->zf_targetModel->getPeriodDetails();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A SUBJECT.
     */
    public function actionNewSubjectRegistration($zvs_parameter){
       
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_subject"){
            
            //Register a new subject to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewSubject();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF AN EXAM.
     */
    public function actionNewExamRegistration($zvs_parameter){
       
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_exam"){
            
            //Register a new exam to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewExam();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF AN MARKSHEET.
     */
    public function actionNewGradeRegistration($zvs_parameter){
       
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_grade"){
            
            //Register a new grade to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewGrade();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR THE CREATION OF A NEW ATTENDANCE.
     */
    public function actionNewAttendanceRegistration($zvs_parameter){
       
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_attendance"){
            
            //Register a new attendance to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewAttendance();
            
        }
        
    }
    
    
    
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR CREATION OF NEW ROLES AND MAPPING RESOURCES TO THOSE ROLES
     */
    
    //This method is helpful in creation of a new role into the school.
    public function actionNewRoleRegistration($zvs_parameter){
        
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataUrl == "new_role"){
            
            //Register a new role to a school on Zilas Virtual Schools platform 
            $this->zf_targetModel->registerNewRole();
            
        }
        if($filterDataUrl == "edit_role"){
            
            //This method edits an existing school role 
            $this->zf_targetModel->editSchoolRole();
            
        }
        
    }
    
    
    
    
    //This method is helpful in mapping of resources to roles that are in a given school.
    public function actionNewResourcesRolesMapper($zvs_parameter){
        
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($zvs_parameter));
        
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($filteredData[0]);
        $filterAction = $filteredData[1];//This is any other intended action
       
        
        if($filterAction == "mapResources"){
            
            //map roles to existing school resources
            $this->zf_targetModel->resourcesRolesMapper($filteredData[0]);
            
        }
        
        if($filterAction == "deleteResources"){
            
            //deletes resources from the selected roles
            $this->zf_targetModel->rolesResourceDelete($filteredData[0]);
            
        }
        
        
    }
    
    
    
    //This method process dynamic fee charts
    public function actionProcessDynamicFeesCharts($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_data($zvs_parameter);
        
        if($filteredData == "generalPieChart"){
            
            //This method plots the dynamic pie chart for general school fees
            $this->zf_targetModel->plotDynamicGeneralPieChart();
        
        }else if($filteredData == "generalBarChart"){
            
            //This method plots the dynamic bar chart for general school fees
            $this->zf_targetModel->plotDynamicGeneralBarChart();
            
        }else if($filteredData == "classPieChart"){
            
            //This method plots the dynamic pie chart for class school fees
            $this->zf_targetModel->plotDynamicClassPieChart();
            
        }else if($filteredData == "classBarChart"){
            
            //This method plots the dynamic bar chart for class school fees
            $this->zf_targetModel->plotDynamicClassBarChart();
            
        }
        
    }
    
    
    
    
    //This method process dynamic fee charts
    public function actionProcessAttendanceSchedule($zvs_parameter){
        
        $filteredData = Zf_SecureData::zf_decode_data($zvs_parameter);
        
        if($filteredData == "attendanceSchedule"){
            
            //This method processes annual attendance schedule
            $this->zf_targetModel->processAnnualAttendanceSchedule();
        
        }
    }
    
   
    
    /**
     * THIS SECTION, WE HAVE METHODS THAT ARE USED TO PUSH DATA FOR CREATION OF NEW TIMETABLE ITEMS
     */
    
    /**
     * This action sends the class information to the model for processing
     */
    public function actionTimeTableInformation($zvs_parameter){
        
        $filterDataVariable =  Zf_SecureData::zf_decode_data($zvs_parameter);
        $filterDataUrl = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        if($filterDataVariable == 'process_streams'){
            
            //Get the streams related a selected class
            $this->zf_targetModel->getStreamDetails();
            
        }
        
    }
    
    

}
?>
