

<?php
$servername = '172.25.115.167\SQLEXPRESS'; $username = 'sa'; $password = '#Sy$temGr0^p|115167';
// $servername = 'DESKTOP-TRJMO4S\SQLEXPRESS'; $username = 'web_template'; $password = 'SystemGroup2018';

try {
    $conn = new PDO ("sqlsrv:Server=$servername;Database=live_shipment_control_db",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'NO CONNECTION'.$e->getMessage();
}
?>

