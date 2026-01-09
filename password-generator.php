<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// HATI-HATI: Script ini hanya untuk development/testing!
// JANGAN digunakan di production!

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        echo "Password plain: " . htmlspecialchars($password) . "<br>";
        echo "Password hashed: " . htmlspecialchars($hashed_password) . "<br>";
        echo "SQL untuk update: <br>";
        echo "<code>UPDATE tabel_user SET password = '" . htmlspecialchars($hashed_password) . "' WHERE username = 'username_anda';</code>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Password Hash</title>
</head>
<body>
    <h2>Generate Password Hash</h2>
    <form method="POST">
        <label>Password: </label>
        <input type="text" name="password" required>
        <button type="submit">Generate Hash</button>
    </form>
</body>
</html>