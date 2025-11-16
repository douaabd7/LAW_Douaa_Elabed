<?php include('validate_ampl.php'); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Pagina 2</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p> la segona pagina d'informacia.</p>
    <a href="page1.php">Tornar a la pagina 1</a> | 
    <a href="logout.php" style="color:red;">Tancar sessio</a>
</body>
</html>
