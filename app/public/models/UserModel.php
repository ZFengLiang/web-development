<?php

require_once(__DIR__ . "/BaseModel.php");

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fetch user by username
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = self::$pdo->prepare($sql);  
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // Verify password
    public function verifyPassword($inputPassword, $storedPassword)
    {
        return password_verify($inputPassword, $storedPassword); 
    }
    
    public function usernameExists($username) {
        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    public function emailExists($email) {
        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function login($username, $password)
    {
        // Query to get the user by username
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = self::$pdo->prepare($query);  
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user exists, check password
        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }

        return false; 
    }

    // Method to register a new user
    public function register($username, $password, $email, $role)
    {
        // Check if the username already exists
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = self::$pdo->prepare($query);  
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            // If username already exists, return false
            return false;
        }

        // Insert new user into the database
        $query = "INSERT INTO user (username, password, email, user_type) 
                  VALUES (:username, :password, :email, :role)";
        $stmt = self::$pdo->prepare($query);  // Use self::$pdo
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);

        if ($stmt->execute()) {
            return true; 
        }

        return false; 
    }
    
    public function getAllBarbers()
    {
    $stmt = self::$pdo->prepare("SELECT user_id, username FROM user WHERE user_type = 'barber'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
