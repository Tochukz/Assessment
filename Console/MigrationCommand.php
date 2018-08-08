<?php
namespace Console;

class MigrationCommand
{

    /**
     * This will migrate all the migration classes defined in the Database/Migrations directory.
     *     
     * @return void
     */
    public function migrateAll()
    {
        $migrationClassNames = getAllClasses("Database/Migrations");
        foreach($migrationClassNames as $migrationClassName){
            if($migrationClassName == "Database\Migrations\Migration"){
                //Migration is an abtract class. 
                continue;
            }
            $this->createRequiredTables($migrationClassName);
        }
    }

    /**
     * Creates tables whose schema is defined in a class that extends Database\Migrations\Migration class.
     * 
     * @param string $className
     */
    function createRequiredTables($className)
    {     
        $class = new $className();
        $classMethods = get_class_methods($class);
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
        
            $tableCreate = str_replace($upperCases, $lowerCases, $methodName);
            $tableName = str_replace(["create_", "_table"], "", $tableCreate);
            $tableNames[] = $tableName;
            
            try{           
                echo "Calling $methodName method to create the $tableName table...\n";
                //$install->$methodName();  
                $class->$methodName();        
            }catch(Exception $ex){                   
                echo $ex->getMessage()."\n";
                echo "Dropping tables:\n";
                // $install->rollBackTables($tableNames);   
                $class->rollBackTables($tableNames);         
            }

        }
    }
}