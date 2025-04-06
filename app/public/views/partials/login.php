<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Form</title>
    <link rel="stylesheet" href="../../assets/css/LoginStyle.css"/>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        
        <!-- Display login error message if exists -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
        <?php endif; ?>

        <form action="/login" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required/>
            </div>
            <button type="submit">Login</button>
        </form>

        <div class="extra-links">
            <a href="/register">Create an Account</a>
        </div>
    </div>
</body>
</html>