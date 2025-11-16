<?php include('validate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pàgina 1</title>
</head>
<body>
    <h1>Benvingut, <?php echo $_SESSION['username']; ?>!</h1>
    <p>La primera pàgina d'informació.</p>
    <a href="page2.php">Anar a la pàgina 2</a>
    <br>
    <a href="logout.php" style="color: red;">Tancar sessió</a>
</body>
</html>