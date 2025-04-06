<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register Form</title>
    <link rel="stylesheet" href="../../assets/css/RegisterStyle.css"/>
</head>
<body>
    <div class="login-container">
        <h1>Create an Account</h1>

        <!-- Display registration error message if exists -->
        <?php if (isset($_SESSION['register_error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
        <?php endif; ?>

        <form action="/register" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required/>
            </div>

            <div class="form-group">
        <label for="captcha">Captcha: Please enter the number below</label>
        <div class="captcha-container">
            <div class="captcha-display"><?php echo htmlspecialchars($captcha); ?></div>
            <input type="text" id="captcha" name="captcha" required class="captcha-input"/>
        </div>

        </div>
            <button type="submit">Register</button>
        </form>

        <div class="extra-links">
            <a href="/login">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
