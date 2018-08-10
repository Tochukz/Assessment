<?php
namespace Controllers;

use Models\User;

class Assessment
{
    public function index()    
    {
        //$user = (new User)->find(3);
        $user = (new User)->get();
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        //return view("index", ['name'=>'Tochukwu', 'Position'=>'Senior Developer Multi-Lingual']);
    }
}