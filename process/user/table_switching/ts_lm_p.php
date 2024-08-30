<?php
include '../../conn2.php';

$method = $_POST['method'];

function count_t_t1_data($conn)
{
    $query = "SELECT count(id) AS total FROM t_t1";
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchALL() as $row) {
            $total = $row['total'];
        }
    } else {
        $total = 0;
    }
    return $total;
}

function count_t_t2_data($search_arr, $conn)
{
    $query = "SELECT count(id) AS total FROM t_t2 WHERE c1 = '" . $search_arr['c1'] . "'";
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchALL() as $row) {
            $total = $row['total'];
        }
    } else {
        $total = 0;
    }
    return $total;
}

if ($method == 'load_t_t1_data_last_page') {
    $results_per_page = 10;

    $number_of_result = intval(count_t_t1_data($conn));

    //determine the total number of pages available  
    $number_of_page = ceil($number_of_result / $results_per_page);

    echo $number_of_page;
}

if ($method == 'count_t_t1_data') {
    echo count_t_t1_data($conn);
}

if ($method == 'load_t_t1_data') {
    $current_page = intval($_POST['current_page']);
    $c = 0;

    $results_per_page = 10;

    //determine the sql LIMIT starting number for the results on the displaying page
    $page_first_result = ($current_page - 1) * $results_per_page;

    $c = $page_first_result;

    $query = "SELECT * FROM t_t1 ORDER BY id ASC OFFSET ".$page_first_result." ROWS FETCH NEXT ".$results_per_page." ROWS ONLY";

    // 1st Approach using SQL Server DB when using Select Query
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchALL() as $row) {
            $c++;
            echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;' . $row['id'] . '~!~' . $row['c1'] . '&quot;)">';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $row['c1'] . '</td>';
            echo '<td>' . $row['c2'] . '</td>';
            echo '<td>' . $row['c3'] . '</td>';
            echo '<td>' . $row['c4'] . '</td>';
            echo '<td>' . $row['date_updated'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
        echo '</tr>';
    }
}

if ($method == 'load_t_t2_data_last_page') {
    $c1 = $_POST['c1'];

    $search_arr = array(
        "c1" => $c1
    );

    $results_per_page = 10;

    $number_of_result = intval(count_t_t2_data($search_arr, $conn));

    //determine the total number of pages available  
    $number_of_page = ceil($number_of_result / $results_per_page);

    echo $number_of_page;
}

if ($method == 'count_t_t2_data') {
    $c1 = $_POST['c1'];

    $search_arr = array(
        "c1" => $c1
    );

    echo count_t_t2_data($search_arr, $conn);
}

if ($method == 'load_t_t2') {
    $c1 = $_POST['c1'];
    $current_page = intval($_POST['current_page']);

    $c = 0;

    $results_per_page = 10;

    //determine the sql LIMIT starting number for the results on the displaying page
    $page_first_result = ($current_page - 1) * $results_per_page;

    $c = $page_first_result;

    $query = "SELECT * FROM t_t2 WHERE c1 = '$c1' ORDER BY id ASC OFFSET ".$page_first_result." ROWS FETCH NEXT ".$results_per_page." ROWS ONLY";

    // 1st Approach using SQL Server DB when using Select Query
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchALL() as $row) {
            $c++;
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $row['c1'] . '</td>';
            echo '<td>' . $row['d1'] . '</td>';
            echo '<td>' . $row['d2'] . '</td>';
            echo '<td>' . $row['d3'] . '</td>';
            echo '<td>' . $row['date_updated'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
        echo '</tr>';
    }
}

$conn = NULL;
?>