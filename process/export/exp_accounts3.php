<?php
session_name("Shipment_Control");
session_start();


require '../conn2.php';
require '../conn_ircs.php';
require '../conn_fsib.php';

// Retrieve search parameters from GET request
$section = isset($_GET['section']) ? $_GET['section'] : '';
$line_num = isset($_GET['line_no']) ? $_GET['line_no'] : '';
$product_no = isset($_GET['product_no']) ? $_GET['product_no'] : '';
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';

// Convert date formats if not empty
if (!empty($date_from)) {
    $date_from = date_create($date_from);
    $date_from = date_format($date_from, "Y/m/d H:i:s");
}

if (!empty($date_to)) {
    $date_to = date_create($date_to);
    $date_to = date_format($date_to, "Y/m/d H:i:s");
}

$delimiter = ",";
$datenow = date('Y-m-d');
$filename = "Export_Accounts_3_" . $datenow . ".csv";

// Create a file pointer 
$f = fopen('php://memory', 'w'); 

// UTF-8 BOM for special character compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers 
$fields = array('Line', 'Product No', 'Lot', 'Order Qty', 'Due Date', 'Container', 'Destination', 'PD Output', 'Scanned', 'Remaining Qty', 'Production Date', 'Poly Size', 'Packing Qty', 'No of Poly', 'Date Encode', 'Remarks', 'Container_No', 'Section'); 
fputcsv($f, $fields, $delimiter); 

// Construct the SQL query
$query = "SELECT * FROM bk_t_palletconfirm_h";
$conditions = [];

if (!empty($date_from) && !empty($date_to)) {
    $conditions[] = "Production_Date BETWEEN '$date_from' AND '$date_to'";
}
if (!empty($section)) {
    $conditions[] = "Section LIKE '$section%'";
}
if (!empty($line_num)) {
    $conditions[] = "Line LIKE '$line_num%'";
}
if (!empty($product_no)) {
    $conditions[] = "Product_No LIKE '$product_no%'";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " ORDER BY Production_Date, Destination DESC";
//fputcsv($f, array($query,), $delimiter);

$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($j = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $oci_lot = $j['Lot'];
            $oci_product_no = $j['Product_No'];
            $oci_date = $j['Date_Encode'];

            $ircs_q = "SELECT COUNT(LOT) AS TOTAL 
                FROM T_PACKINGWK 
                WHERE LOT = '$oci_lot' AND PARTSNAME LIKE '$oci_product_no%' 
                AND PACKINGBOXCARDJUDGMENT = '1' 
                AND REGISTDATETIME >= TO_DATE('$oci_date', 'yyyy-MM-dd HH24:MI:SS')";
            
            $stmt_q = oci_parse($conn_ircs, $ircs_q);
	        oci_execute($stmt_q);

            while (($row = oci_fetch_array($stmt_q, OCI_BOTH)) != false) {
                $pd_out = $row['TOTAL'];
            }

            $fsib_q = "SELECT SUM(L_SUU) AS NO_INVOICED FROM T_YUSYUTDAT 
			WHERE C_FAPHINBAN LIKE '$oci_product_no%' AND C_LOTNO = '$oci_lot' AND C_INVNO IS NULL";
	
            $stmt_q = oci_parse($conn_fsib, $fsib_q);
            oci_execute($stmt_q);

            while ($row = oci_fetch_array($stmt_q, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $scanned = isset($row['NO_INVOICED']) ? $row['NO_INVOICED'] : '0';
            }

        // Calculate date difference for row class
        $production_date = date_create($j['Production_Date']);
        $date_encode = date_create($j['Date_Encode']);
        $date_diff = date_diff($production_date, $date_encode)->days;

        if ($date_diff == 0) {
            $row_class = 'bg-light';
        } else if ($production_date > $date_encode) {
            $row_class = 'bg-danger';
        } else if ($date_diff <= 3) {
            $row_class = 'bg-warning';
        } else {
            $row_class = 'bg-danger';
        }

        // Output row data
        $lineData = array(
            $j['Line'], $j['Product_No'], $j['Lot'], $j['Order_Qty'], $j['Due_Date'],
            $j['Container'], $j['Destination'], $pd_out, $scanned, $j['Remaining_Qty'],
            $j['Production_Date'], $j['Poly_Size'], $j['Packing_Qty'], $j['No_of_Poly'],
            $j['Date_Encode'], $j['Remarks'], $j['Container_No'], $j['Section']
        );
        fputcsv($f, $lineData, $delimiter);
    }
} else {
    // echo '<tr>';
    // echo '<td colspan="18" style="text-align:center; color:red;">No Result !!!</td>';
    // echo '</tr>';
}

// Move back to the beginning of the file 
fseek($f, 0);

// Set headers to download the file rather than display it
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');
// Output all remaining data on a file pointer 
fpassthru($f);

$conn = null;
?>