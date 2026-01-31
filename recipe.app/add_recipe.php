<?php
include 'db_connect.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $ingredients = $_POST['ingredients']; 

    if(empty($title) || empty($description)){
        $error = "Title and description are required.";
    } else {
        
        mysqli_query($conn, "INSERT INTO recipes (title, description, user_id) VALUES ('$title', '$description', {$_SESSION['user_id']})");
        $recipe_id = mysqli_insert_id($conn);


        if(!empty($ingredients)){
            foreach($ingredients as $ing){
                $ing = mysqli_real_escape_string($conn, $ing);
                if(!empty($ing)){
                    mysqli_query($conn, "INSERT INTO ingredients (name, recipe_id) VALUES ('$ing', $recipe_id)");
                }
            }
        }

        $success = "Recipe added successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>

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
            margin-bottom: 20px;
        }

        input[type="text"], textarea {
            width: 250px;
            padding: 8px;
            margin: 5px;
            border: 1px solid #000;
        }

        button {
            background-color: #2E7D32;
            color: white;
            border: none;
            padding: 8px 20px;
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

        .success {
            color: green;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .ingredient-input {
            display: block;
            margin: 5px auto;
        }
    </style>
</head>
<body>

<h2>Add New Recipe</h2>

<?php 
if(isset($error)) echo "<p class='error'>$error</p>";
if(isset($success)) echo "<p class='success'>$success</p>";
?>

<form method="post">
    <input type="text" name="title" placeholder="Recipe Title"><br>
    <textarea name="description" placeholder="Recipe Description" rows="5"></textarea><br>

    <p>Ingredients:</p>
    <input type="text" name="ingredients[]" placeholder="Ingredient 1" class="ingredient-input"><br>
    <input type="text" name="ingredients[]" placeholder="Ingredient 2" class="ingredient-input"><br>
    <input type="text" name="ingredients[]" placeholder="Ingredient 3" class="ingredient-input"><br>
    <input type="text" name="ingredients[]" placeholder="Ingredient 4" class="ingredient-input"><br>

    <button type="submit">Add Recipe</button>
</form>

<a href="recipes.php">Back to Recipes</a>

</body>
</html>
