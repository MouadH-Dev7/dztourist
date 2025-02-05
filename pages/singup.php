<?php
session_start(); 

require_once "../php_pages/Location.php";
$location = new Location();
$wilayas = $location->getWilayas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Tourist Places</title>
    <link rel="stylesheet" href="../css/singup.css">
</head>
<body>
    <div class="signup-container">
        <h2>Sign U</h2>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <p><?php echo $_SESSION['error_message']; ?></p>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

   
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <p><?php echo $_SESSION['success_message']; ?></p>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <form action="../php_pages/signup_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="text" name="phone_number" placeholder="Phone Number">
            <input type="date" name="date_of_birth">
            
            <select name="gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

    
            <select id="wilaya" name="wilaya">
                <option value="">اختر ولاية</option>
                <?php foreach ($wilayas as $wilaya): ?>
                    <option value="<?= $wilaya['id'] ?>"><?=$wilaya['code']. "  " . $wilaya['name_ar'] . " - " . $wilaya['name_en'] ?></option>
                <?php endforeach; ?>
            </select>

     
            <select id="daira" name="daira">
                <option value="">اختر دائرة</option>
            </select>

 
            <select id="commune" name="commune">
                <option value="">اختر بلدية</option>
            </select>

            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.html">Login</a></p>
    </div>

    <script>
        document.getElementById("wilaya").addEventListener("change", function() {
            var wilaya_id = this.value;
            var dairaSelect = document.getElementById("daira");

            if (wilaya_id) {
                fetch("../php_pages/get_dairas.php", {
                    method: "POST",
                    body: new URLSearchParams({ "wilaya_id": wilaya_id }),
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }
                })
                .then(response => response.text())
                .then(data => {
                    dairaSelect.innerHTML = data;
                    document.getElementById("commune").innerHTML = "<option value=''>اختر بلدية</option>";
                });
            }
        });

        document.getElementById("daira").addEventListener("change", function() {
            var daira_id = this.value;
            var communeSelect = document.getElementById("commune");

            if (daira_id) {
                fetch("../php_pages/get_communes.php", {
                    method: "POST",
                    body: new URLSearchParams({ "daira_id": daira_id }),
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }
                })
                .then(response => response.text())
                .then(data => communeSelect.innerHTML = data);
            }
        });
    </script>

</body>
</html>
