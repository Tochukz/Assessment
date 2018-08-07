<?php
namespace Controllers;

class Assessment
{
    public function index()
    {
        return view("index", ['name'=>'Tochukwu', 'Position'=>'Senior Developer Multi-Lingual']);
    }
}