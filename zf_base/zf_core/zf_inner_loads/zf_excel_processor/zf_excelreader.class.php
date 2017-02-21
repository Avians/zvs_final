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

class Zf_ExcelReader {
    
    //This is a variable that holds an instance of the currency conversion class.
    public $zf_sheetData;
    
    
    /**
     * ------------------------------------------------------------------------- 
     * THIS STATIC METHOD IS RESPONSIBLE FOR INSTANTIATING THE SPREADSHEET 
     * READER CLASS
     * ------------------------------------------------------------------------- 
     */
    public static function zf_launchSpreadSheetReader($zf_spreadsheetName){
        
        return new Spreadsheet_Excel_Reader($zf_spreadsheetName);
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR RETRUNING THE NUMBER OF SHEETS IN
     * AN EXCEL WORKBOOK
     * -------------------------------------------------------------------------
     */
    public static function zf_numberOfSheets($zf_spreadsheetName){
        
        $zf_sheetData = self::zf_launchSpreadSheetReader($zf_spreadsheetName);
        
        //This returns the number of sheets in the spreadsheet selected
        $numberOfSheets = sizeof($zf_sheetData->sheets);
        
        return $numberOfSheets;
        
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR RETRUNING THE NUMBER OF ROWS IN
     * A SELECTED EXCEL WORKSHEET
     * -------------------------------------------------------------------------
     */
    public static function zf_numberOfRows($zf_spreadsheetName, $sheetNumber){
        
        $zf_sheetData = self::zf_launchSpreadSheetReader($zf_spreadsheetName);
       
        //This returns the number of rows in a selected sheet
        $numberOfRows = $zf_sheetData->rowcount($sheet=$sheetNumber);
        
        return $numberOfRows;
        
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR RETRUNING THE NUMBER OF COLUMNS IN
     * A SELECTED EXCEL WORKSHEET
     * -------------------------------------------------------------------------
     */
    public static function zf_numberOfColumns($zf_spreadsheetName, $sheetNumber){
        
        $zf_sheetData = self::zf_launchSpreadSheetReader($zf_spreadsheetName);
        
        //This returns the number of columns in a selected sheet
        $numberOfCols = $zf_sheetData->colcount($sheet=$sheetNumber);
        
        return $numberOfCols;
        
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR RETRUNING THE ACTUAL DATA ELEMENT
     * IN A SELECTED/TARGET SHEET CELL
     * -------------------------------------------------------------------------
     */
    public static function zf_cellData($zf_spreadsheetName, $targetSheet, $targetRow, $targetCol){
        
        $zf_sheetData = self::zf_launchSpreadSheetReader($zf_spreadsheetName);
        
        //This returns the actual data in a target sheet cell
        $cellData = $zf_sheetData->sheets[$targetSheet]['cells'][$targetRow][$targetCol];
        
        return $cellData;
        
    }
    

    
}

?>