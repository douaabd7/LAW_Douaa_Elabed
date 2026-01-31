<?php
include 'db_connect.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $error = "Fill in all fields";
    } else {
        $res = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($res) == 1){
            $user = mysqli_fetch_assoc($res);
            if(password_verify($password,$user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                header("Location: recipes.php");
                exit();
            } else {
                $error = "Wrong password";
            }
        } else {
            $error = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 120px;
        }

        h2 {
            color: #2E7D32; /* أخضر */
            margin-bottom: 20px;
        }

        input {
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

<h2>Login</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post">
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

<!-- الرابط تحت الفورم -->
<a href="register.php">Don’t have an account? Register</a>

</body>
</html>
