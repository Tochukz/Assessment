<?php
namespace App\View;
class View
{
    static $instance = null;

    private function __constructor()
    {
        
    }
    public static function getInstance()
    {
       if(is_null(self::$instance)){
          $this->instance = new View();
       }
       return self::$instance;
    }

}