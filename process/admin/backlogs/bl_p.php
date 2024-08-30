<?php
require '../../server_date_time.php';
require '../../conn2.php';
require '../../conn_ircs.php';
require '../../conn_fsib.php';

$method = $_POST['method'];

// Get Section Dropdown
if ($method == 'get_section_dropdown_search') {
	$sql = "SELECT Section FROM bk_t_palletconfirm_h GROUP BY Section ORDER BY Section ASC";
	$stmt = $conn -> prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt -> execute();
	if ($stmt -> rowCount() > 0) {
		echo '<option selected value="">All</option>';
		foreach($stmt -> fetchAll() as $row) {
			echo '<option value="'.htmlspecialchars($row['Section']).'">'.htmlspecialchars($row['Section']).'</option>';
		}
	} else {
		echo '<option selected value="">All</option>';
	}
}

// Get Line No Dropdown
if ($method == 'get_line_no_dropdown_search') {
	$sql = "SELECT Line FROM bk_t_palletconfirm_h GROUP BY Line ORDER BY Line ASC";
	$stmt = $conn -> prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt -> execute();
	if ($stmt -> rowCount() > 0) {
		echo '<option selected value="">All</option>';
		foreach($stmt -> fetchAll() as $row) {
			echo '<option value="'.htmlspecialchars($row['Line']).'">'.htmlspecialchars($row['Line']).'</option>';
		}
	} else {
		echo '<option selected value="">All</option>';
	}
}

function count_lot($lot, $date_time_from, $date_time_to, $conn_ircs) {
	$date_time_from = urldecode($date_time_from); // Decode url parameter date time value
	$date_time_to = urldecode($date_time_to);

	$total = 0;

	$query = "SELECT COUNT(*) AS TOTAL FROM T_PRODUCTWK WHERE LOT = '$lot' AND REGISTDATETIME BETWEEN TO_DATE('$date_time_from', 'yyyy-MM-dd HH24:MI:SS') AND TO_DATE('$date_time_to', 'yyyy-MM-dd HH24:MI:SS')";
	
	$stmt = oci_parse($conn_ircs, $query);
	oci_execute($stmt);
	while ($row = oci_fetch_object($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		$total = $row->TOTAL;
	}

	return strval($total);
}

function count_scanned($lot, $product_no, $conn_fsib) {
	$lot = strtoupper($lot);
	$product_no = strtoupper($product_no);

	$total = 0;

	$query = "SELECT SUM(L_SUU) AS NO_INVOICED FROM T_YUSYUTDAT 
			WHERE C_FAPHINBAN LIKE '$product_no%' AND C_LOTNO = '$lot'AND C_INVNO IS NULL";
	
	$stmt = oci_parse($conn_fsib, $query);
	oci_execute($stmt);
	while ($row = oci_fetch_object($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		$total = $row->NO_INVOICED;
	}

	return strval($total);
}

if ($method == '') {
	
}

oci_close($conn_fsib);
oci_close($conn_ircs);
$conn = null;