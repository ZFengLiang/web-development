<?php
Route::add('/login', function () {
    require_once(__DIR__ . "/../controllers/UserController.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        try {
            $userController->processLogin($_POST['username'], $_POST['password']);
        } catch (Exception $e) {
            $_SESSION['login_error'] = $e->getMessage();
            header("Location: /login");
            exit();
        }
    } else {
        require(__DIR__ . "/../views/pages/loginView.php");
    }
}, ["get", "post"]);

Route::add('/logout', function () {
    session_destroy(); // Ends the session
    header('Location: /'); // Redirect to homepage
    exit();
});