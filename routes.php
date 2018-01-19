<?php
namespace YourBB;
//Route::set('page1/page2', 'hook1/hook2', callback)
Classes\Route::set('index', '/index','HelloWorld', function() {
    Classes\View::CreateView('index');
});

Classes\Route::set('test', 'test', '', function() {
    Classes\View::CreateView('test');
});

Classes\Route::check();
//  Routher
//    Controler/Action V
//    ->View           <-Data
