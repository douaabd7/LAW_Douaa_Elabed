<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if(!empty($username) && $username === $password) {
    $_SESSION['username'] = $username;
    header("Location: page1.php");
    exit();
} else {
    echo "<script>alert('Usuari o contrasenya incorrectes'); window.location.href='index.html';</script>";
    exit();
}
?>
