<?php
use App\Route;

Route::get("/assessment/index", "AssessmentController@index");
Route::post("/assessment/process", "AssessmentController@process");
// Route::get("/assessment/index/{person}", "AssessmentController@person");
// Route::get('/assessment/index/age/why', 'AssessmentController@why');
// Route::get("/assessment/index/{person}/{id}", "AssessmentController@personId");