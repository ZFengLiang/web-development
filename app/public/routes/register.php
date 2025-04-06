<?php
Route::add('/register', function () {
    require_once(__DIR__ . "/../controllers/UserController.php");
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $userController->processRegistration($_POST['username'], $_POST['password'], $_POST['email'], $_POST['captcha']);
        } catch (Exception $e) {
            $_SESSION['register_error'] = $e->getMessage();
            header('Location: /register');
            exit();
        }
    } else {
        $captcha = $userController->generateCaptcha();
        // Pass the captcha to the view
        include(__DIR__ . "/../views/pages/register.php");
    }
}, ["get", "post"]);