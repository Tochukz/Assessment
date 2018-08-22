<?php
namespace Database\Seeders;

use PDO;

class RetailerAssessmentSeeder extends Seeder
{
    public function seedRetailerAssessmentsTable()
    {    
       $fileDir = appDir()."Storage/shop-retailer-assessment.csv"; 
       //$fileDir = appDir()."Storage/forecourt-retailer-assessment.csv";       
       $fileHandle = fopen($fileDir, 'r');    
       $keys = ['3'=>'awareness', '4'=>'knowledge', '5'=>'skill', '6'=>'mastery', '7'=>'develop new'];  
       $x = 0;   
       while(!feof($fileHandle)){
           $line = fgets($fileHandle);     
           if(!$line){
               break;
           }     
           $array = explode("|", $line);
           $record = [];
           $assessment = [];
           for($i=0; $i<count($array); $i++){
               if($i == 1){
                   $record['competency'] = $array[$i];
               }elseif($i == 2){
                   $record['min_requirement'] = $array[$i];
               }elseif($i > 2){

                   $assessment[] = [$keys[$i], $array[$i]];
               } 
           }
           $record['question_no'] = ++$x;
           $record['assessment'] = json_encode($assessment);
           $record['shop_or_forecourt'] = 'shop';
           //$record['shop_or_forecourt'] = 'forecourt';
           $record['created_date'] = date("Y-m-d H:i:s");                  
           $this->seedTable('retailer_assessments', $record);

       }
       fclose($fileHandle);
      
    }   
}