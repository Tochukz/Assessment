<?php
spl_autoload_register(function($className){  
   if(stristr($className, 'pdo')){
      return true;
   } 
   $classDir = str_replace("\\", "/", $className);
   require_once($classDir.'.php');
});

