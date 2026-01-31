<?php
include 'db_connect.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['comment'])){
    $recipe_id = $_POST['recipe_id'];
    $content = mysqli_real_escape_string($conn,$_POST['comment']);
    if(!empty($content)){
        mysqli_query($conn,"INSERT INTO comments (content,user_id,recipe_id) VALUES ('$content',".$_SESSION['user_id'].",$recipe_id)");
    }
    header("Location: recipes.php");
    exit();
}

if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $res = mysqli_query($conn,"SELECT * FROM comments WHERE id=$comment_id");
    $comment = mysqli_fetch_assoc($res);
    if($comment['user_id']==$_SESSION['user_id']){
        mysqli_query($conn,"DELETE FROM comments WHERE id=$comment_id");
    }
    header("Location: recipes.php");
    exit();
}
?>
