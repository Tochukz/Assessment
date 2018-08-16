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
        return view('process');
    }
}