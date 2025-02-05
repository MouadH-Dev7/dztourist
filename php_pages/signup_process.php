<?php
session_start(); // تبدأ الجلسة لتخزين رسائل الخطأ

require_once "../database/database.php";

if (isset($_POST['register'])) {
  
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $wilaya_id = $_POST['wilaya'];
    $daira_id = $_POST['daira'];
    $commune_id = $_POST['commune'];

    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header("Location: ../pages/singup.php");
        exit();
    }

    $db = new Database();
    $conn = $db->connect();

    // التحقق من وجود username أو email أو رقم الهاتف
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ? OR phone_number = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->execute([$username, $email, $phone_number]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        $_SESSION['error_message'] = ''; // نعيد تعيين الرسالة في كل مرة
        if ($existing_user['username'] === $username) {
            $_SESSION['error_message'] = "Username already exists.";
        } elseif ($existing_user['email'] === $email) {
            $_SESSION['error_message'] = "Email already exists.";
        } elseif ($existing_user['phone_number'] === $phone_number) {
            $_SESSION['error_message'] = "Phone number already exists.";
        }
        header("Location: ../pages/singup.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (username, email, password, phone_number, date_of_birth, gender, id_commune, is_active) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $hashed_password, $phone_number, $date_of_birth, $gender, $commune_id]);

    // رسالة نجاح
    $_SESSION['success_message'] = "User registered successfully!";
    header("Location: ../pages/index.php");
    exit();
}
?>
