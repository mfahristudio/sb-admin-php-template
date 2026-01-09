<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once "core.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header('Location: index.php?error=empty_fields');
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, username, password FROM tabel_user WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        header('Location: container.php');
        exit();
    }
} catch (PDOException $e) {
    error_log('Login error: ' . $e->getMessage());
}


header('Location: index.php?error=invalid_credentials');
exit();
