<?php
namespace Controllers;

use Models\ShopAssessment;
use Models\ShopRetailers;

class AssessmentController
{
    public function index()    
    {        
        $assessment = new ShopAssessment();
        $data = $assessment->get();      
        return View('index', ['data'=>$data]);
    }

    public function process()
    {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
    }

    public function person($per){
        echo $per;
    }

    public function personId($person ,$id){
        echo $person, ' ', $id;
    }

    public function why()
    {
        echo 'Overiddes some';
    }
}