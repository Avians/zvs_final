/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
    //Manage Classes
    NewClassFormWizard.init();
    NewStreamFormWizard.init();
    
    //Manage School Fees
    NewFeeItemFormWizard.init();
    PaymentScheduleFormWizard.init();
    
    //Configure School Budget Items
    NewBugdetCategoryFormWizard.init();
    NewBudgetSubCategoryFormWizard.init();
    
    //Manage Subjects
    NewSubjectFormWizard.init();
    
    //Manage Exams
    NewExamFormWizard.init();
    
    //Manage Grades
    NewGradeFormWizard.init();
    
    //Configure Attendance
    NewAttendanceFormWizard.init();
    
    //Configure Timetable
    //NewTimeTableFormWizard.init();
    
    //Manage Departments
    NewDepartmentFormWizard.init();
    NewSubDepartmentFormWizard.init();
    
    //Manage Hostels
    NewHostelFormWizard.init();
 
    //Manage Role
    NewRoleFormWizard.init();
    EditModuleFormWizard.init();
    
    //Components Picker
    ComponentsPickers.init();
    
    
});
