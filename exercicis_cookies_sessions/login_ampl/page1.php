<?php include('validate_ampl.php'); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Pagina 1</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p> la primera pagina d'informacia.</p>
    <a href="page2.php">Anar a la pagina 2</a> | 
    <a href="logout.php" style="color:red;">Tancar sessio</a>
</body>
</html>
