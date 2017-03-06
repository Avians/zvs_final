 <?php

class user_section_Model extends Zf_Model {

    /**
     * This is the class constructor
     */
    public function __construct() {
        
        parent::__construct();
        
    }

    
    
    
    /**
     * This method fetches the active user details
     * @param type $identificationCode
     * @return int
     */
    public function zf_getUserDetails($identificationCode) {
        
        $platformUserRole = $this->zf_fetchZilasUserRole($identificationCode);

        
        if(ZVS_SUPER_ADMIN == $platformUserRole){
            
            $zvs_table = "zvs_super_admin";
            
        }else if(ZVS_ADMIN == $platformUserRole){
            
            $zvs_table = "zvs_platform_admin";
            
        }else if(SCHOOL_MAIN_ADMIN == $platformUserRole){
            
            $zvs_table = "zvs_school_admin";
            
        }else if(ZVS_SCHOOL_STAFF == $platformUserRole){
           
            $zvs_table = "zvs_staff_personal_details";
            
        }else if(ZVS_SCHOOL_STUDENT == $platformUserRole){
            
            $zvs_table = "zvs_students_personal_details";
            
        }else if(ZVS_SCHOOL_PARENT == $platformUserRole){
            
            $zvs_table = "zvs_students_guardian_details";
            
        }
        
        
        $zvs_sqlValueUserCode["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $zvs_fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect($zvs_table, $zvs_sqlValueUserCode);
        $zvs_executeFetchUserDetails = $this->Zf_AdoDB->Execute($zvs_fetchUserDetails);

        if(!$zvs_executeFetchUserDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvs_executeFetchUserDetails->RecordCount() > 0){

                while(!$zvs_executeFetchUserDetails->EOF){
                    
                    $results = $zvs_executeFetchUserDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
    


    
    /**
     * This method fetches the user profile image
     */
    public function getUserImage($imagePath, $userName, $identificationCode){
        
        //Get the user role held in a session variable.
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        $systemSchoolCode = Zf_Core_Functions::Zf_CleanName($identificationArray[2]);
        
        $platformUserRole = $this->zf_fetchZilasUserRole($identificationCode);

        
        if(ZVS_SUPER_ADMIN == $platformUserRole){
            
            $image_directory = "zvs_super_admin";
            
        }else if(ZVS_ADMIN == $platformUserRole){
            
            $image_directory = "zvs_platform_admin";
            
        }else if(SCHOOL_MAIN_ADMIN == $platformUserRole){
    
            $image_directory = "zvs_school_admin".DS.$systemSchoolCode;

        }else if(ZVS_SCHOOL_STAFF == $platformUserRole){
           
            $image_directory = "zvs_school_staff".DS.$systemSchoolCode;
            
        }else if(ZVS_SCHOOL_STUDENT == $platformUserRole){
            
            $image_directory = "zvs_school_student".DS.$systemSchoolCode;
            
        }else if(ZVS_SCHOOL_PARENT == $platformUserRole){
            
            $image_directory = "zvs_school_guardian".DS.$systemSchoolCode;
            
        }
         
        $user_image = ZF_ROOT_PATH.ZF_DATASTORE."zvs_user_images".DS.$image_directory.DS.$imagePath;
                   
        $image = "";
        $image .= '<img src=" '.$user_image.'" title=" '.$userName.' " class="active-user-section-image" height="40px" width="40px" >';

        echo  $image;
      
    }
    
    
    
    
    
    
    /**
     * This public method fetches the current user platform role
     */
    public function zf_fetchZilasUserRole($identificationCode){
        
        $zvs_sqlUserValue['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode); 
        $zf_selectUserRole = Zf_QueryGenerator::BuildSQLSelect('zvs_application_users', $zvs_sqlUserValue);

        if(!$this->Zf_QueryGenerator->Query($zf_selectUserRole)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectUserRole}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    
                    return $fetchRow->zvs_platform_role;

                }

            }
        }
        
    }
    
    
    
}
?>
