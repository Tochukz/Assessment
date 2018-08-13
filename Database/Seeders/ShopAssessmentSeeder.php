<?php
namespace Database\Seeders;

use PDO;

class ShopAssessmentSeeder extends Seeder
{
    public function seedShopAssessmentsTable()
    {    
       $fileDir = appDir()."Storage/retailer-competency-assessment.csv";       
       $fileHandle = fopen($fileDir, 'r');    
       $keys = ['3'=>'awareness', '4'=>'knowledge', '5'=>'skill', '6'=>'mastery', '7'=>'develop new'];     
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
           $record['assessment'] = json_encode($assessment);
           $record['created_date'] = date("Y-m-d H:i:s");
           //var_dump($record); 
           //echo "\n";        
           $this->seedTable('shop_assessments', $record);

       }
       fclose($fileHandle);
      
    }   
}