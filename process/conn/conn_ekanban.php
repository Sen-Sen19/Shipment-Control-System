<?php
date_default_timezone_set('Asia/Manila');
$serverName = "172.25.114.162\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( 'Database'=>'new_ekanban', 'UID'=>'SA', 'PWD'=>'SystemGroup2018');
$conn_sqlsrv = sqlsrv_connect( $serverName, $connectionInfo);

if($conn_sqlsrv) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>