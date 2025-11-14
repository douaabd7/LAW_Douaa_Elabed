<?php
$majoredat = $_COOKIE['majoredat'] ?? '';
$idioma = $_COOKIE['idioma'] ?? '';
$moneda = $_COOKIE['moneda'] ?? '';

if ($majoredat === 'no') {
    $messages = [
        'catala' => "No et podem vendre alcohol si ets menor d’edat.",
        'espanyol' => "No podemos venderte alcohol si eres menor de edad.",
        'angles' => "We cannot sell alcohol if you are underage."
    ];
    $message = $messages[$idioma] ?? "No et podem vendre alcohol si ets menor d’edat.";
} else {
    $prices = [
        'catala' => ['euro' => "39 €", 'lliura' => "33 £", 'dolar' => "45 $"],
        'espanyol' => ['euro' => "39 €", 'lliura' => "33 £", 'dolar' => "45 $"],
        'angles' => ['euro' => "39 €", 'lliura' => "33 £", 'dolar' => "45 $"]
    ];
    $productMessages = [
        'catala' => "T’oferim el vi 'Les Terrasses' a un preu de",
        'espanyol' => "Te ofrecemos el vino 'Les Terrasses' a un precio de",
        'angles' => "We offer the wine 'Les Terrasses' at a price of"
    ];
    $price = $prices[$idioma][$moneda] ?? "39 €";
    $message = ($productMessages[$idioma] ?? $productMessages['catala']) . " " . $price . ".";
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Informació del Producte</title>
</head>
<body>
    <h1>Informació del Producte</h1>
    <p><?php echo $message; ?></p>
    <a href="bodega.php">Canvia la configuració</a>
</body>
</html>