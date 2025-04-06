<?php

require_once(__DIR__ . "/../models/UserModel.php");

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function processLogin($username, $password)
    {
        $user = $this->userModel->login($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            header("Location: /dashboard"); 
            exit();
        } else {
            throw new Exception('Invalid username or password.');
        }
    }

  // Add a method to generate and store CAPTCHA
    public function generateCaptcha() {
    $captcha = mt_rand(100, 999); 
    $_SESSION['captcha'] = $captcha;
    return $captcha;
}

    // Updated registration method that includes CAPTCHA validation
    public function processRegistration($username, $password, $email, $captchaInput)
    {
    // Validate CAPTCHA first
    if ($captchaInput != $_SESSION['captcha']) {
        throw new Exception("CAPTCHA verification failed. Please try again.");
    }
    if ($this->userModel->usernameExists($username)) {
        throw new Exception("The username already exists. Please choose a different username.");
    }
    if ($this->userModel->emailExists($email)) {
        throw new Exception("The email address is already registered. Please use a different email or log in.");
    }

    $role = 'customer';
    
    // Validate the input
    if (empty($username) || empty($password) || empty($email)) {
        throw new Exception("All fields are required.");
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    $user = $this->userModel->register($username, $hashedPassword, $email, $role);
    
    if ($user) {
        header('Location: /login');
        exit();
    } else {
        throw new Exception('Registration failed. Please try again.');
    }
    
    }

}
?>