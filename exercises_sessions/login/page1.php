<?php include('validate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 1</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p> La primera pagina d'informacio.</p>
    <a href="page2.php">Anar a la pagina 2</a>
    <br>
    <a href="logout.php">Sortir</a>
</body>
</html>