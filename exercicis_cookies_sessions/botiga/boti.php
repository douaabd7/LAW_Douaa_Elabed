<?php
if(isset($_POST['afegir'])) {
    setcookie('producte1', $_POST['producte1'], time()+3600);
    setcookie('preu1', $_POST['preu1'], time()+3600);
    setcookie('quantitat1', $_POST['quantitat1'], time()+3600);

    setcookie('producte2', $_POST['producte2'], time()+3600);
    setcookie('preu2', $_POST['preu2'], time()+3600);
    setcookie('quantitat2', $_POST['quantitat2'], time()+3600);

    echo "<script>alert('Productes afegits a la cistella'); window.location.href='index.html';</script>";
}

if(isset($_POST['finalitzar'])) {
    $total1 = $_COOKIE['preu1'] * $_COOKIE['quantitat1'];
    $total2 = $_COOKIE['preu2'] * $_COOKIE['quantitat2'];
    $total = $total1 + $total2;
    echo "<h2>Resum de la compra</h2>";
    echo "<p>".$_COOKIE['producte1']." x ".$_COOKIE['quantitat1']." = $total1 €</p>";
    echo "<p>".$_COOKIE['producte2']." x ".$_COOKIE['quantitat2']." = $total2 €</p>";
    echo "<p><strong>Total: $total €</strong></p>";

    echo '<form method="post"><button name="confirmar">Confirmar compra</button></form>';

    if(isset($_POST['confirmar'])) {
        setcookie('producte1','',time()-3600);
        setcookie('preu1','',time()-3600);
        setcookie('quantitat1','',time()-3600);
        setcookie('producte2','',time()-3600);
        setcookie('preu2','',time()-3600);
        setcookie('quantitat2','',time()-3600);
        echo "<p>Compra confirmada!</p>";
    }
}
?>
