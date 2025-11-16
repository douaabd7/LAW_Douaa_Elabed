<?php include('validate.php'); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Pagina 2</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p>La segona pagina d'informació.</p>
    <a href="page1.php">Tornar a la pagina 1</a><br>
    <a href="logout.php">Sortir</a>
</body>
</html>
