<?php
require_once('bootstrap.php');
function createRequiredTables()
{
    $install = new Installs\Install();
    $classMethods = get_class_methods($install);
    $upperCases = ['A','B','C','D','E','F','G','H','I','J','K','L','M',
       'N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    $lowerCases = array_map(function($letter){ 
        return '_'.strtolower($letter); 
    }, $upperCases);
    $tableNames = [];
    foreach($classMethods as $methodName){
       if(!preg_match("/(create)[a-zA-Z]+(Table)/", $methodName)){
         continue;
       }    
       //echo $methodName;   
       $tableCreate = str_replace($upperCases, $lowerCases, $methodName);
       $tableName = str_replace(["create_", "_table"], "", $tableCreate);
       $tableNames[] = $tableName;
     
       try{           
           echo "Calling $methodName method to create the $tableName table...\n";
           $install->$methodName();         
       }catch(Exception $ex){                   
           echo $ex->getMessage()."\n";
           echo "Dropping tables:\n";
           $install->rollBackTables($tableNames);           
       }
     
       //echo $tableName."\n";
    }
}

//function createTable()
createRequiredTables();
