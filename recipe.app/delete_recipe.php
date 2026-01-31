<?php
include 'db_connect.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$recipe_id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * FROM recipes WHERE id=$recipe_id");
$recipe = mysqli_fetch_assoc($res);

if($_SESSION['user_id']==$recipe['user_id'] || $_SESSION['role']=='chef'){
    mysqli_query($conn,"DELETE FROM recipes WHERE id=$recipe_id");
}

header("Location: recipes.php");
exit();
?>
