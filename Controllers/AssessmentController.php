<?php
namespace Controllers;

use Models\RetailerAssessment;
use Models\ShopRetailers;

class AssessmentController
{
    public function shop()    
    {        
        $assessment = new RetailerAssessment();
        $data = $assessment->getWhere('place', 'shop');            
        return view('index', ['data'=>$data, 'place'=>'Shop']);
    }

    public function forecourt()    
    {        
        $assessment = new RetailerAssessment();
        $data = $assessment->getWhere('place', 'forecourt');            
        return view('index', ['data'=>$data, 'place'=>'Forecourt']);
    }

    public function process()
    {
        return view('process');
    }
}