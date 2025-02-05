<?php
session_start();

require_once "../class/user.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = " Please enter your email and password.";
        header("Location: ../pages/index.php");
        exit();
    }

    $userObj = new User();
    $user = $userObj->login($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../pages/admin_dashboard.php");
        } else {
            header("Location: ../pages/user_dashboard.php");
        }
        exit();
    } else {
        $_SESSION['error'] = " Incorrect email or password.";
        header("Location: ../pages/index.php");
        exit();
    }
}
?>
