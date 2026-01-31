<?php
include 'db_connect.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        $error = "Fill in all fields";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format";
    } elseif($password !== $confirm_password){
        $error = "Passwords do not match";
    } else {
        $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            $error = "Email already exists";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn,"INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$hash','$role')");
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            $_SESSION['role'] = $role;
            header("Location: recipes.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 80px;
        }

        h2 {
            color: #2E7D32; /* أخضر */
            margin-bottom: 20px;
        }

        input, select {
            width: 220px;
            padding: 8px;
            margin: 8px;
            border: 1px solid #000;
        }

        button {
            background-color: #2E7D32;
            color: white;
            border: none;
            padding: 10px 25px;
            margin-top: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1B5E20;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Register</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post">
    <input type="text" name="name" placeholder="Full Name"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password"><br>
    <select name="role">
        <option value="chef">Chef</option>
        <option value="visitor">Visitor</option>
    </select><br>
    <button type="submit">Register</button>
</form>

<!-- الرابط للـ login -->
<a href="login.php">Already have an account? Login</a>

</body>
</html>
