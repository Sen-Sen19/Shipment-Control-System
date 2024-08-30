<?php
// error_reporting(0);
require '../conn.php';

$start_row = 1;
$insertsql = "INSERT INTO user_accounts (id_number, full_name, username, password, section, role) VALUES";
$subsql = "";

function count_row ($file) {
    $linecount = -2;
    $handle = fopen($file, "r");
    while(!feof($handle)){
      $line = fgets($handle);
      $linecount++;
    }

    fclose($handle);

    return $linecount;
}

// Remove UTF-8 BOM
function removeBomUtf8($s){
    if (substr($s,0,3) == chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))) {
        return substr($s,3);
    } else {
        return $s;
    }
}

function check_csv($file, $conn) {

    //READ FILE
    $csv_file = fopen($file,'r');

    // SKIP FIRST LINE
    $first_line = fgets($csv_file);

    // Remove UTF-8 BOM from First Line
    $first_line = removeBomUtf8($first_line);

    $hasError = 0; $hasBlankError = 0; $isExistsOnDb = 0; $isDuplicateOnCsv = 0;
    $hasBlankErrorArr = array();
    $isExistsOnDbArr = array();
    $isDuplicateOnCsvArr = array();
    $dup_temp_arr = array();

    $message = "";
    $check_csv_row = 0;

    $first_line = preg_replace('/[\t\n\r]+/', '', $first_line);
    $valid_first_line1 = '"ID Number","Full Name",Username,Password,Section,Role';
    $valid_first_line2 = "ID Number,Full Name,Username,Password,Section,Role";
    if ($first_line == $valid_first_line1 || $first_line == $valid_first_line2) {
        while (($line = fgetcsv($csv_file)) !== false) {
            // Check if the row is blank or consists only of whitespace
            if (empty(implode('', $line))) {
                $check_csv_row++;
                continue; // Skip blank lines
            }

            $check_csv_row++;

            $id_number = $line[0];
            $full_name = $line[1];
            $username = $line[2];
            $password = $line[3];
            $section = $line[4];
            $role = $line[5];
            
            // CHECK IF BLANK DATA
            if ($id_number == '' || $full_name == '' || $username == '' || $password == '' || $section == '' || $role == '') {
                // IF BLANK DETECTED ERROR += 1
                $hasBlankError++;
                $hasError = 1;
                array_push($hasBlankErrorArr, $check_csv_row);
            } 

            // Joining all row values for checking duplicated rows
            $whole_line = join(',', $line);

            // CHECK ROWS IF IT HAS DUPLICATE ON CSV
            if (isset($dup_temp_arr[$whole_line])) {
                $isDuplicateOnCsv = 1;
                $hasError = 1;
                array_push($isDuplicateOnCsvArr, $check_csv_row);
            } else {
                $dup_temp_arr[$whole_line] = 1;
            }

            // CHECK ROWS IF EXISTS
            $sql = "SELECT id FROM user_accounts 
                    WHERE id_number = ? AND full_name = ? AND username = ? 
                    AND section = ? AND role = ?";
            $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $params = array($id_number, $full_name, $username, $section, $role);
            $stmt->execute($params);
            if ($stmt->rowCount() > 0) {
                $isExistsOnDb = 1;
                $hasError = 1;
                array_push($isExistsOnDbArr, $check_csv_row);
            }
            
        }
    } else {
        $message = $message . 'Invalid CSV Table Header. Maybe an incorrect CSV file or incorrect CSV header ';
    }
    
    fclose($csv_file);

    if ($hasError == 1) {
        if ($isExistsOnDb == 1) {
            $message = $message . 'Data Already Recorded on row/s ' . implode(", ", $isExistsOnDbArr) . '. ';
        }
        if ($hasBlankError >= 1) {
            $message = $message . 'Blank Cell/s Exists on row/s ' . implode(", ", $hasBlankErrorArr) . '. ';
        }
        if ($isDuplicateOnCsv == 1) {
            $message = $message . 'Duplicated Record/s on row/s ' . implode(", ", $isDuplicateOnCsvArr) . '. ';
        }
    }
    return $message;
}

$mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

if (!empty($_FILES['file']['name'])) {

    if (in_array($_FILES['file']['type'], $mimes)) {

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            $row_count = count_row($_FILES['file']['tmp_name']);

            $chkCsvMsg = check_csv($_FILES['file']['tmp_name'], $conn);

            if ($chkCsvMsg == '') {
                
                if (($csv_file = fopen($_FILES['file']['tmp_name'], "r")) !== false) {

                    $temp_count = 0;
                    fgets($csv_file);  // read one line for nothing (skip header / first row)
                    while (($read_data = fgetcsv($csv_file, 1000, ",")) !== false) {
                        // Check if the row is blank or consists only of whitespace
                        if (empty(implode('', $read_data))) {
                            $temp_count++;
                            continue; // Skip blank lines
                        }

                        $column_count = count($read_data);
                        $subsql = $subsql . " (";
                        $temp_count++;
                        $start_row++;
                        for ($c = 0; $c < $column_count; $c++) {
                            $subsql = $subsql . '\'' . $read_data[$c] . '\',';
                        }
                        $subsql = substr($subsql, 0, strlen($subsql) - 2);
                        $subsql = $subsql . '\')' . " , ";
                        if ($temp_count % 250 == 0) {
                            $subsql = substr($subsql, 0, strlen($subsql) - 3);
                            $insertsql = $insertsql . $subsql . ";";
                            $insertsql = substr($insertsql, 0, strlen($insertsql));
                            $stmt = $conn->prepare($insertsql);
                            $stmt->execute();
                            $insertsql = "INSERT INTO user_accounts (id_number, full_name, username, password, section, role) VALUES ";
                            $subsql = "";
                        } else if ($temp_count == $row_count) {
                            $subsql = substr($subsql, 0, strlen($subsql) - 3);
                            $insertsql2 = $insertsql . $subsql . ";";
                            $insertsql2 = substr($insertsql2, 0, strlen($insertsql2));
                            $stmt = $conn->prepare($insertsql2);
                            $stmt->execute();
                        }
                    }

                    fclose($csv_file);

                } else {
                    echo 'Reading CSV file Failed! Try Again or Contact IT Personnel if it fails again';
                }

            } else {
                echo $chkCsvMsg;
            }

        } else {
            echo 'Upload Failed! Try Again or Contact IT Personnel if it fails again';
        }

    } else {
        echo 'Invalid file format';
    }

} else {
    echo 'Please upload a CSV file';
}

// KILL CONNECTION
$conn = null;
?>