<?php
Route::add('/loginView', function () {
    // homepage is simply loading a static page
    // view the user routes for example following the MVC pattern
    require(__DIR__ . "/../views/pages/loginView.php");
});