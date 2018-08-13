<?php
namespace Controllers;

use Models\ShopAssessment;

class AssessmentController
{
    public function index()    
    {        
        $assessment = new ShopAssessment();
        $data = $assessment->get();
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        return View('index', ['data'=>$data]);
    }
}