
<?php
function conectar() {
    return new PDO("mysql:host=localhost;dbname=sistema_fp;charset=utf8", "root", "Masterkey", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
?>
