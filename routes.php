<?php
namespace YourBB;

Classes\Route::set('index', function() {
    Controllers\IndexController::CreateView('index');
});

Classes\Route::set('test', function() {
    Controllers\IndexController::CreateView('test');
});

?>
