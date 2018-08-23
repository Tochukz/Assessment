<?php
use App\Route;

Route::get("/assessment/shop", "AssessmentController@shop");
Route::get("/assessment/forecourt", "AssessmentController@forecourt");
Route::post("/assessment/process", "AssessmentController@process");
Route::get("/datatable/test", "DatatableController@test");
// Route::get('/assessment/index/age/why', 'AssessmentController@why');
// Route::get("/assessment/index/{person}/{id}", "AssessmentController@personId");