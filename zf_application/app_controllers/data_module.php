<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE INDEX CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING ALL ACTIONS
 * THAT RELATE TO INDEX MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  14th/August/2013  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class data_moduleController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    //Executes the view for managing student data
    public function actionManage_student_data($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_student_data',$zf_actionData);
        
    }
    
    
    //Executes the view for managing staff data
    public function actionManage_staff_data($identificationCode){
        
        $zf_actionData = Zf_SecureData::zf_decode_data($identificationCode);
        
        Zf_View::zf_displayView('manage_staff_data', $zf_actionData);
        
    }
    
    
    //This public method downloads all data templates
    public function actionDownload_data_templates($zvs_parameter){
        
        $dataTemplate =  Zf_SecureData::zf_decode_url($zvs_parameter);
        
        //Download the actual data template
        $zf_file_path = APP_VIEWS.'data_module'.DS.'view_client'.DS.'zf_view_global'.DS.'view_files'.DS.'data_templates'.DS.$dataTemplate; 
        
        
        $zf_fileName  = Zf_SecureData::zf_decode_url($zvs_parameter);
        $zf_mime_type = "application/xls";
        
        Zf_FileDownload::zf_downloadFile($zf_file_path, $zf_fileName, $zf_mime_type); 
        
    }
    
    
    //This public methoduplloads all data templates
    public function actionUpload_data_templates($zvs_parameter){
        
        $data_sheet = Zf_SecureData::zf_decode_url($zvs_parameter);
        
        //echo $data_sheet; exit();
        
        if($data_sheet == "student_data_template"){
            
            //This method uploads all student data in bulk
            $this->zf_targetModel->uploadStudentData();
            
        }else if($data_sheet == "staff_data_template"){
           
            //This method uploads all staff data in bulk
            $this->zf_targetModel->uploadStaffData();
            
        }
        
        
    }
    
  

}
?>
