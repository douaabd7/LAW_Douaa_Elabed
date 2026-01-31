<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recipe App</title>
</head>
<body>
<header>
    <h1>Recipe App</h1>
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>Welcome: <?php echo $_SESSION['user_name']; ?> (<?php echo $_SESSION['role']; ?>)</p>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> | 
        <a href="register.php">Register</a>
    <?php endif; ?>
</header>
<hr>
