<?php 
require '../../conn2.php';
require '../../conn_ircs.php';
require '../../conn_fsib.php';

$method = $_POST['method'];


if ($method == 'backlog_list') {
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $rowsPerPage = isset($_POST['rows_per_page']) ? (int)$_POST['rows_per_page'] : 100;
    $offset = ($page - 1) * $rowsPerPage;
    
    // Query to get total count of rows
    $totalCountQuery = "SELECT COUNT(*) AS TotalCount FROM [live_pmd_db].[dbo].[bk_t_palletconfirm_h]";
    $totalCountStmt = $conn->prepare($totalCountQuery);
    $totalCountStmt->execute();
    $totalCount = $totalCountStmt->fetchColumn();
    
    // Query to fetch rows with pagination
    $query = "SELECT * 
              FROM [live_pmd_db].[dbo].[bk_t_palletconfirm_h] 
              ORDER BY Destination DESC 
              OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->bindParam(':limit', $rowsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = '';
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchAll() as $j) {

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
    
            $production_date = date_create($j['Production_Date']);
            $date_encode = date_create($j['Date_Encode']);
            $date_diff = date_diff($production_date, $date_encode)->days;
    
            // Determine row class based on date difference
            if ($date_diff == 0) {
                $row_class = 'bg-light';
            } elseif ($production_date > $date_encode) {
                $row_class = 'bg-danger';
            } elseif ($date_diff <= 3) {
                $row_class = 'bg-warning';
            } else {
                $row_class = 'bg-danger';
            }
    
            // Output the row with appropriate class
            $data .= '<tr class="' . $row_class . '" style="cursor:pointer;">';
            $data .= '<td>' . $j['Line'] . '</td>';
            $data .= '<td>' . $j['Product_No'] . '</td>';
            $data .= '<td>' . $j['Lot'] . '</td>';
            $data .= '<td>' . $j['Order_Qty'] . '</td>';
            $data .= '<td>' . $j['Due_Date'] . '</td>';
            $data .= '<td>' . $j['Container'] . '</td>';
            $data .= '<td>' . $j['Destination'] . '</td>';
            $data .= '<td>' . $j['Remaining_Qty'] . '</td>';
            $data .= '<td>' . $pd_out . '</td>';
            $data .= '<td>' . $scanned . '</td>';
            $data .= '<td>' . $j['Production_Date'] . '</td>';
            $data .= '<td>' . $j['Poly_Size'] . '</td>';
            $data .= '<td>' . $j['Packing_Qty'] . '</td>';
            $data .= '<td>' . $j['No_of_Poly'] . '</td>';
            $data .= '<td>' . $j['Date_Encode'] . '</td>';
            $data .= '<td>' . $j['Remarks'] . '</td>';
            $data .= '<td>' . $j['Container_No'] . '</td>';
            $data .= '<td>' . $j['Section'] . '</td>';
            $data .= '</tr>';
        }
    } else {
        $data .= '<tr>';
        $data .= '<td colspan="18" style="text-align:center; color:red;">No Result !!!</td>';
        $data .= '</tr>';
    }
    
    // Check if there are more rows beyond the current page
    $has_more = ($offset + $rowsPerPage) < $totalCount;
    
    echo json_encode(['html' => $data, 'has_more' => $has_more]);
}

if ($method == 'search_backlog_list') {
    $pages = isset($_POST['page1']) ? (int)$_POST['page1'] : 1;
    $rowsPerPage1 = isset($_POST['rows_per_page']) ? (int)$_POST['rows_per_page'] : 10;
    $offset = ($pages - 1) * $rowsPerPage1;

    // Query to get total count of rows
    $totalCountQuery = "SELECT COUNT(*) AS TotalCount FROM [live_pmd_db].[dbo].[bk_t_palletconfirm_h]";
    $totalCountStmt = $conn->prepare($totalCountQuery);
    $totalCountStmt->execute();
    $totalCount = $totalCountStmt->fetchColumn();

    $section = $_POST['section'];
    $line_num = $_POST['line_num'];
    $product_no = $_POST['product_no'];
    $date_from = $_POST['date_from'];
    if (!empty($date_from)) {
        $date_from = date_create($date_from);
        $date_from = date_format($date_from, "Y/m/d H:i:s");
    }

    $date_to = $_POST['date_to'];
    if (!empty($date_to)) {
        $date_to = date_create($date_to);
        $date_to = date_format($date_to, "Y/m/d H:i:s");
    }

    $c = 0;

    $query = "SELECT * FROM bk_t_palletconfirm_h";
    if ((!empty($date_from) && !empty($date_to)) || !empty($section) || !empty($line_num) || !empty($product_no)) {
        $query .= " WHERE";

        if (!empty($date_from) && !empty($date_to)) {
            $query .= " Production_Date BETWEEN '$date_from' AND '$date_to'";

            if (!empty($section)) {
                $query .= " AND Section LIKE '$section%'";
            }

            if (!empty($line_num)) {
                $query .= " AND Line LIKE '$line_num%'";
            }

            if (!empty($product_no)) {
                $query .= " AND Product_No LIKE '$product_no%'";
            }

        } else {
            if (!empty($section)) {
                $query .= " Section LIKE '$section%'";
            } elseif (!empty($line_num)) {
                $query .= " Line LIKE '$line_num%'";
            } elseif (!empty($product_no)) {
                $query .= " Product_No LIKE '$product_no%'";
            }
        }
    }

    // Data will be displayed in ascending order
    $query .= " ORDER BY Production_Date, Destination DESC OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->bindParam(':limit', $rowsPerPage1, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = '';
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchAll() as $j) {
            $c++;

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

            $pd_out = 0;
            while (($row = oci_fetch_array($stmt_q, OCI_BOTH)) != false) {
                $pd_out = $row['TOTAL'];
            }

            $fsib_q = "SELECT SUM(L_SUU) AS NO_INVOICED FROM T_YUSYUTDAT 
                WHERE C_FAPHINBAN LIKE '$oci_product_no%' AND C_LOTNO = '$oci_lot' AND C_INVNO IS NULL";

            $stmt_q = oci_parse($conn_fsib, $fsib_q);
            oci_execute($stmt_q);

            $scanned = 0;
            while ($row = oci_fetch_array($stmt_q, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $scanned = isset($row['NO_INVOICED']) ? $row['NO_INVOICED'] : '0';
            }

            $production_date = date_create($j['Production_Date']);
            $date_encode = date_create($j['Date_Encode']);
            $date_diff = date_diff($production_date, $date_encode)->days;

            if ($date_diff == 0) {
                $row_class = 'bg-light';
            } elseif ($production_date > $date_encode) {
                $row_class = 'bg-danger';
            } elseif ($date_diff <= 3) {
                $row_class = 'bg-warning';
            } else {
                $row_class = 'bg-danger';
            }
            $data .= '<tr style="cursor:pointer;" class="' . $row_class . '">';
            $data .= '<td>' . $j['Line'] . '</td>';
            $data .= '<td>' . $j['Product_No'] . '</td>';
            $data .= '<td>' . $j['Lot'] . '</td>';
            $data .= '<td>' . $j['Order_Qty'] . '</td>';
            $data .= '<td>' . $j['Due_Date'] . '</td>';
            $data .= '<td>' . $j['Container'] . '</td>';
            $data .= '<td>' . $j['Destination'] . '</td>';
            $data .= '<td>' . $j['Remaining_Qty'] . '</td>';
            $data .= '<td>' . $pd_out . '</td>';
            $data .= '<td>' . $scanned . '</td>';
            $data .= '<td>' . $j['Production_Date'] . '</td>';
            $data .= '<td>' . $j['Poly_Size'] . '</td>';
            $data .= '<td>' . $j['Packing_Qty'] . '</td>';
            $data .= '<td>' . $j['No_of_Poly'] . '</td>';
            $data .= '<td>' . $j['Date_Encode'] . '</td>';
            $data .= '<td>' . $j['Remarks'] . '</td>';
            $data .= '<td>' . $j['Container_No'] . '</td>';
            $data .= '<td>' . $j['Section'] . '</td>';
            $data .= '</tr>';
        }
    } else {
        $data .= '<tr>';
        $data .= '<td colspan="18" style="text-align:center; color:red;">No Result !!!</td>';
        $data .= '</tr>';
    }

    $has_more = ($offset + $rowsPerPage1) < $totalCount;

    echo json_encode(['html' => $data, 'has_more' => $has_more]);
}
?>
