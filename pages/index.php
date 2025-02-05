<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js" defer></script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>


        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php endif; ?>

        <form action="../php_pages/login.php" method="POST">
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required />
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required />
                <span class="password-toggle" onclick="togglePassword()">👁</span>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="register-link">
            Don't have an account? <a href="./singup.php">Sign up</a>
        </p>
    </div>
</body>
</html>
