<?php
$nom_cookie = "contador_visites";
$visites = 0;
$missatge_descompte = "";

if (isset($_COOKIE[$nom_cookie])) {
    $visites = $_COOKIE[$nom_cookie] + 1;
} else {
    $visites = 1;
}

setcookie($nom_cookie, $visites, time() + (86400 * 30));

if ($visites >= 10) {
    $missatge_descompte = "Oferta exclusiva sols per a tu! Utilitza el codi BOTIGA50 per obtenir un 50% de descompte en les teves primeres compres a la botiga";
} elseif ($visites >= 5) {
    $missatge_descompte = "Oferta exclusiva! Utilitza el codi BOTIGA20 per obtenir un 20% de descompte en les teves primeres compres a la botiga";
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptador de Visites</title>
</head>
<body>
    <h1>Benvingut a la nostra botiga ^-^ </h1>

    <p>Has visitat aquesta pàgina <strong><?php echo $visites; ?></strong> vegada/es.</p>

    <?php if (!empty($missatge_descompte)) : ?>
        <p style="color: green; font-weight: bold;"><?php echo $missatge_descompte; ?></p>
    <?php endif; ?>

    <form action="comptador_visites.php" method="POST">
        <label for="codi_descompte">Introdueix el codi de descompte:</label>
        <input type="text" id="codi_descompte" name="codi_descompte" required>
        <button type="submit">Comprar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["codi_descompte"])) {
            echo "<p style='color: red;'>Has d'introduir un codi.</p>";
        } else {
            $codi_usuari = $_POST["codi_descompte"];

            if ($codi_usuari === "BOTIGA20" && $visites >= 5 && $visites < 10) {
                echo "<p style='color: blue;'>Descompte aplicat: 20%</p>";
            } elseif ($codi_usuari === "BOTIGA50" && $visites >= 10) {
                echo "<p style='color: blue;'>Descompte aplicat: 50%</p>";
            } else {
                echo "<p style='color: red;'>Codi de descompte invàlid o no aplicable.</p>";
            }
        }
    }
    ?>
</body>
</html>
