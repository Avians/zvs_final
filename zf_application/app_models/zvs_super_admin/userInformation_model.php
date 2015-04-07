<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class userInformation_Model extends Zf_Model {
    

    private $_errorResult = array();
    private $_validResult = array();
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
            
    }
    
    
    
    
    /**
     * This method fetches all user information
     */
    public function getUserInformation($identificationCode){
      
        $zvs_sqlValueUserCode["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $zvs_fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect("zvs_super_admin", $zvs_sqlValueUserCode);
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
     * Register new super administrators
     */
    public function registerNewSuperAdmin(){
        
        //Chain the form's posted data
        $this->zf_formController
                ->zf_postFormData('email')
                ->zf_validateFormData('zf_maximumLength', 120, 'Your email')
                ->zf_validateFormData('zf_minimumLength', 5, 'Your email')
                ->zf_validateFormData('zf_checkEmail')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Email')
                
                ->zf_postFormData('password')
                ->zf_validateFormData('zf_maximumLength', 120, 'Your password')
                ->zf_validateFormData('zf_minimumLength', 5, 'Your password')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Password');
        

        //This array holds all error data
        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        //This array holds all valid data. 
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        
        if(empty($this->_errorResult)){
            
        }else{
            
        }
        
    }
    
    
    
    
    /**
     * Register new platform administrators
     */
    public function registerNewPlatformAdmin(){
        
        echo "We are about to register a new platform admin."; exit();
        
    }
    
    
    
    /**
     * This method is used to select Admin localities
     */
    public function getAdminLocality(){
        
        $countryCode = $_POST['countryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($countryCode); 
        $zf_selectLocality = Zf_QueryGenerator::BuildSQLSelect('zvs_school_locality', $zf_valueCountryCode);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocality)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectLocality}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->localityCode."' >".$fetchRow->localityName." ".$fetchRow->localityType."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
            }
        }
        
        
    }
    
    
}

?>
