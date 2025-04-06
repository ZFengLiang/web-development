<?php
Route::add('/service', function () {
    require_once(__DIR__ . '/../controllers/ServiceController.php');
    $controller = new ServiceController();
    $controller->showServices();
});
