<?php
$serverName = "172.25.115.167\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "live_shipment_control_db",
    "Uid" => "sa",
    "PWD" => '#Sy$temGr0^p|115167'
);

 
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
