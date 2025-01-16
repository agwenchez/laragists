<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return response('Hello world');
});

Route::get('/posts/{id}', function ($id){
    return response('Post' . $id);
});


Route::get('/search', function (Request $request){
    dd($request -> name . '' . $request -> city);
    return $request -> name . '' . $request -> city;
    // return response('Post' . $id);
});