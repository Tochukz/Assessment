<?php
namespace Console;

use Database\Seeders\UserSeeder;

class SeederCommand
{
  /**
   * This will get all the seeder method defined in the seeder classes and run them to seed the database.
   * Seeder method must be defined using the naming convention: seed{TableName}Table.
   * 
   * @return void
   */
  public function runAllSeeder()
  {
    $seederClassNames = getAllClasses("Database/Seeders");
    foreach($seederClassNames as $seederClassName){
      if($seederClassName == 'Database\Seeders\Seeder'){
        //Seeder is an abstract class
        continue;
      }
      $seederObj = new $seederClassName();
      $seederMethods = get_class_methods($seederClassName);
      foreach($seederMethods as $seederMethod){
        //Only method that following the naming convention will be called.
        if(stristr($seederMethod, 'seed') && stristr($seederMethod, 'Table')){
          $seederObj->$seederMethod();
        }      
      }
    }
  }


}