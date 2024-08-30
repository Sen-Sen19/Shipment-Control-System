<?php
header("Content-type: text/html;charset=Shift-JIS");
$username = "ircs";
$password = "ircs";
$database = "172.25.119.1:1521/fsib";
$conn3 = oci_connect($username, $password, $database);
if (!$conn3) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}