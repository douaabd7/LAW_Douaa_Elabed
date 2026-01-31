<?php 
include 'db_connect.php'; 
session_start(); 

if(!isset($_SESSION['user_id'])){
    header("Location: login.php"); 
    exit();
}

// البحث
$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

// جلب الوصفات مع المكونات
$query = "SELECT recipes.*, users.name as chef_name,
          GROUP_CONCAT(ingredients.name SEPARATOR ', ') AS ingredients_list
          FROM recipes
          JOIN users ON recipes.user_id = users.id
          LEFT JOIN ingredients ON ingredients.recipe_id = recipes.id
          WHERE title LIKE '%$search%' OR description LIKE '%$search%'
          GROUP BY recipes.id
          ORDER BY created_at DESC";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recipes</title>
    <style>
        body {
            background-color: #ffffff; /* أبيض */
            color: #000000; /* أسود */
            font-family: 'Merriweather', serif;
            text-align: center;
            padding: 40px 20px;
        }

        h2 {
            color: #2E7D32; /* أخضر */
        }

        input[type="text"] {
            width: 220px;
            padding: 8px;
            margin: 8px;
            border: 1px solid #000;
        }

        button, a.add-btn {
            background-color: #2E7D32;
            color: white;
            border: none;
            padding: 8px 20px;
            margin: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        button:hover, a.add-btn:hover {
            background-color: #1B5E20;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2E7D32;
            color: white;
        }

        a.action-btn {
            background-color: #2E7D32;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            margin: 2px;
            border-radius: 3px;
        }

        a.action-btn:hover {
            background-color: #1B5E20;
        }

        .search-form {
            margin-bottom: 15px;
        }

        a.logout {
            display: inline-block;
            margin-top: 15px;
            color: #000;
            text-decoration: none;
        }

        a.logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Recipes</h2>

<div class="search-form">
    <form method="get">
        <input type="text" name="search" placeholder="Search..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<a class="add-btn" href="add_recipe.php">Add New Recipe</a>
<a class="logout" href="logout.php">Logout</a>

<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Chef</th>
        <th>Ingredients</th>
        <th>Actions</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['chef_name']; ?></td>
        <td><?php echo $row['ingredients_list']; ?></td>
        <td>
            <?php if($_SESSION['user_id']==$row['user_id']): ?>
                <a class="action-btn" href="edit_recipe.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="action-btn" href="delete_recipe.php?id=<?php echo $row['id']; ?>">Delete</a>
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
