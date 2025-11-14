<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setcookie('majoredat', $_POST['majoredat'], time() + (86400 * 30), "/");
    setcookie('idioma', $_POST['idioma'], time() + (86400 * 30), "/");
    setcookie('moneda', $_POST['moneda'], time() + (86400 * 30), "/");
    header('Location: info.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Bodega</title>
</head>
<body>
    <h1>Benvingut a la Bodega</h1>
    <form action="bodega.php" method="POST">
        <p>Ets major d'edat?
            <input type="radio" name="majoredat" value="si" required> Sí
            <input type="radio" name="majoredat" value="no" required> No
        </p>
        <p>Idioma:
            <select name="idioma" required>
                <option value="catala">Català</option>
                <option value="espanyol">Español</option>
                <option value="angles">English</option>
            </select>
        </p>
        <p>Moneda:
            <select name="moneda" required>
                <option value="euro">Euro</option>
                <option value="lliura">Lliura</option>
                <option value="dolar">Dòlar</option>
            </select>
        </p>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>