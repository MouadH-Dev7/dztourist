<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, Admin <?php echo $_SESSION['username']; ?> 👨‍💼</h2>
        <p>This is your admin dashboard.</p>
        <a href="../php_pages/logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
