<?php 
	$username = "FSIB";
	$password = "FSIB";
	$database = "172.25.116.61:1521/FSIB";
	$conn_oracle = oci_connect($username, $password, $database);
	if (!$conn_oracle){
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	else {
		
	}
	//oci_close($conn_oracle);
 ?>