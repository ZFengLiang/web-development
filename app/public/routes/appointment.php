<?php
Route::add('/appointment', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->showAppointmentForm();
});

Route::add('/appointment/available-slots', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    
    $barberId = $_GET['barber_id'];
    $date = $_GET['date'];

    $controller = new AppointmentController();
    $controller->getAvailableSlots($barberId, $date);
});

Route::add('/appointment/save', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');

    $controller = new AppointmentController();
    $controller->saveAppointment();
}, 'post');

Route::add('/appointment/success', function () {
    require_once(__DIR__ . '/../views/pages/booking_success.php');
});

// Show reschedule form
Route::add('/appointment/reschedule', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->showRescheduleForm();
}, ['get']);

Route::add('/appointment/reschedule', function () {
    require_once(__DIR__ . '/../controllers/AppointmentController.php');
    $controller = new AppointmentController();
    $controller->saveReschedule();
}, 'post');