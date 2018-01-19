<?php
namespace YourBB;
use YourBB\Classes\Route as Route;
use YourBB\Classes\View as View;
//Route::set('page1/page2', 'hook1/hook2', callback)
Route::set('index', '/index','HelloWorld', function() {
    echo View::CreateView('index');
});

Route::set('auth', 'auth','login/register/logout', function() {
    echo View::CreateView('auth');
});

Route::set('forum', 'forum','list/create/view', function() {
    echo View::CreateView('forum');
});

Route::check();
//  Routher
//    Controler/Action V
//    ->View           <-Data
