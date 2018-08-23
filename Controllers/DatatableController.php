<?php
namespace Controllers;

use Models\DB;

class DatatableCOntroller    
{
    public function test()
    {
       $books = DB::table('books')->take(100);
       return view('test', ['books'=>$books]);        
    }
}