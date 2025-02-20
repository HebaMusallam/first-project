<?php

use Illuminate\Support\Facades\Route;

Route::get('/', action:function (){
    return view('welcome');
});
Route::get(uri:'/about',action:function(){
    $name = 'Heba';
    $departments = [
       '1' => 'Technical',
       '2' => 'Financial',
       '3' => 'Sales'
    ];
    //return View('about',['name' => $name]);
    //return View('about')->with('name',$name);
    return view(view:'about',data:compact('name','departments'));

});
Route::post(uri:'/about',action:function(){
   $name= $_POST['name'];
   $departments = [
     '1' => 'Technical',
     '2' => 'Financial',
     '3' => 'Sales'
   ];
   return view(view:'about',data:compact(var_name:'name'));
});
Route::get('tasks',function(){
   return view('tasks');
});
?>
