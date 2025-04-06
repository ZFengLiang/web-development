<?php
// Dashboard
Route::add('/dashboard', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->showCustomerDashboard();
});

// Cancel appointment
Route::add('/appointment/cancel', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->cancelAppointment();
}, 'post');

Route::add('/barber/dashboard', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->showBarberDashboard();
});
