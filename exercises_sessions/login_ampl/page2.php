<?php include('validate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pàgina 2</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p>La segona pàgina d'informació.</p>
    <a href="page1.php">Tornar a la pàgina 1</a>
    <br>
    <a href="logout.php" style="color: red;">Tancar sessió</a>
</body>
</html>