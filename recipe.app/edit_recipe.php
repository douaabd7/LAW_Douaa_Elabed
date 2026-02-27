<?php
include 'db_connect.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
include 'header.php';

$recipe_id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * FROM recipes WHERE id=$recipe_id");
$recipe = mysqli_fetch_assoc($res);

if($_SESSION['user_id']!=$recipe['user_id'] && $_SESSION['role']!='chef'){
    echo "<p style='color:red; text-align:center;'>You do not have permission to edit this recipe.</p>";
    exit();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $ingredients = $_POST['ingredients'];

    mysqli_query($conn,"UPDATE recipes SET title='$title', description='$description' WHERE id=$recipe_id");
    mysqli_query($conn,"DELETE FROM ingredients WHERE recipe_id=$recipe_id");

    foreach($ingredients as $ing){
        if(!empty($ing)){
            $ing = mysqli_real_escape_string($conn,$ing);
            mysqli_query($conn,"INSERT INTO ingredients (name,recipe_id) VALUES ('$ing',$recipe_id)");
        }
    }

    header("Location: recipes.php");
    exit();
}

$ing_res = mysqli_query($conn,"SELECT * FROM ingredients WHERE recipe_id=$recipe_id");
$ingredients = [];
while($row = mysqli_fetch_assoc($ing_res)){
    $ingredients[] = $row['name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <style>
        body {
            background-color: #ffffff;
            color: #000000; 
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px 20px;
        }
        h2 {
            color: #2E7D32; 
        }
        input[type="text"], textarea {
            width: 300px;
            padding: 8px;
            margin: 5px;
            border: 1px solid #2E7D32;
        }
        input[type="submit"] {
            background-color: #2E7D32;
            color: white;
            padding: 10px 20px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #1B5E20;
        }
        .ingredients {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Edit Recipe</h2>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $recipe['title']; ?>"><br>

        <label>Description:</label>
        <textarea name="description" rows="4" cols="50"><?php echo $recipe['description']; ?></textarea><br>

        <label>Ingredients:</label>
        <div class="ingredients">
            <?php for($i=0;$i<5;$i++): ?>
                <input type="text" name="ingredients[]" value="<?php echo $ingredients[$i] ?? ''; ?>"><br>
            <?php endfor; ?>
        </div>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
