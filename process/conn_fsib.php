<?php
//header("Content-type: text/html;charset=Shift-JIS");
$username = "FSIB";
$password = "FSIB";
$database = "172.25.116.61:1521/FSIB";
$conn_fsib = oci_connect($username, $password, $database);
if (!$conn_fsib) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}