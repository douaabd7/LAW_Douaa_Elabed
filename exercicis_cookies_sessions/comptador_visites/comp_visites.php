<?php
date_default_timezone_set('Europe/Paris');

$contador = 1;
$ultima_visita = "Primer accés";

if(isset($_COOKIE['contador'])) {
    $contador = $_COOKIE['contador'] + 1;
    $ultima_visita = $_COOKIE['ultima_visita'];
}

setcookie('contador', $contador, time() + 86400*30);
setcookie('ultima_visita', date('d/m/Y H:i:s'), time() + 86400*30);
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Comptador de visites</title>
</head>
<body>
    <h1>Benvingut!</h1>
    <p>Has visitat aquesta pagina <strong><?php echo $contador; ?></strong> vegada/es.</p>
    <p>ultima visita: <?php echo $ultima_visita; ?></p>
</body>
</html>
