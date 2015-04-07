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
        
        //Get the user role held in a session variable.
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);

        $userRole = $identificationArray[3];
        
        if($userRole == ZVS_SUPER_ADMIN){
            
            $zvs_table = "zvs_super_admin";
            
        }else if($userRole == ZVS_ADMIN){
            
            $zvs_table = "zvs_platform_admin";
            
        }else if($userRole == SCHOOL_MAIN_ADMIN){
            
            $zvs_table = "zvs_school_main_admin";
            
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
    
}
?>
