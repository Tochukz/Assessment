<?php
use App\Route;

Route::get("/assessment/index", "AssessmentController@index");
Route::post("/assessment/process", "AssessmentController@process");