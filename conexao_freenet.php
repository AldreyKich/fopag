
<?php
function conectar() {
    return new PDO("mysql:host=sql301.infinityfree.com;dbname=if0_39469460_fopag;charset=utf8", "if0_39469460", "Deuscomigo2025", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
?>
