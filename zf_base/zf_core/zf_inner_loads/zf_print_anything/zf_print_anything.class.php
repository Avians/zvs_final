<?php

/**
 * -----------------------------------------------------------------------------
 * THIS CLASS FILE IS ESSENTIAL FOR LOADING THE CHARTS THAT HAVE BEEN GENERATED
 * USING THE FUSIONCHARTS PLUGIN.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  25th/December/2013  Time: 21:40 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */

class Zf_Print_Anything {
    
    //This is a variable that holds an instance of the currency conversion class.
    protected $print;




    /**
     * -------------------------------------------------------------------------
     * THIS THE CLASS CONSTRUCTOR, IT RUNS BY DEFAULT WHENEVER THE CLASS IS
     * INITIALISED.
     * -------------------------------------------------------------------------
     * 
     */
    public function __construct() {
        
        $this->print = new Zf_PrintAnything();
            
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR CREATING A SPECIFIC PRINT CONTEXT
     * -------------------------------------------------------------------------
     */
    public static function zf_addPrintContext($printData, $printCSS = NULL){
        
        /**
         * Check to see that conversion parameters data is not emtpy
         */
            
        $print = new self;

        $printContext = $print->print->addPrintContext($printData, $printCSS = NULL);

        return $printContext;
 
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR PREPARING A SPECIFIC PRINT DATA
     * FROM A SEPARATE FILE
     * -------------------------------------------------------------------------
     */
    public static function zf_readPrintBody($printFile){
            
        $print = new self;
        
        $printData = $print->print->readBody($printFile);
        
        return $printData;
 
    }
        
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR CREATING A PRINT BUTTON
     * -------------------------------------------------------------------------
     */
    public static function zf_showPrintButton($printContext, $buttonLabel, $buttonAttributes = NULL){
           
        $print = new self;
        
        $printButton = $print->print->showPrintButton($printContext, $buttonLabel, $buttonAttributes);
        
        return $printButton;
 
    }
        
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR CREATING A PRINT LINK
     * -------------------------------------------------------------------------
     */
    public static function zf_showPrintLink($printContext, $linkLabel, $linkAttributes = NULL){
         
        $print = new self;
        
        $printLink = $print->print->showPrintLink($printContext, $linkLabel, $linkAttributes = NULL);
        
        return $printLink;
 
    }
        
    
    
}

?>