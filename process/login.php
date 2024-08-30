<?php
session_name("shipment_control");
session_start();

include 'conn3.php';

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username, type FROM account WHERE username = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        if (sqlsrv_has_rows($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $type = $result['type'];
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['type'] = $type;

            if ($type == 'user') {
                header('location: page/user/production_plan.php');
                exit;
          
            } elseif ($type == 'admin') { 
                header('location: page/admin/admin.php');
                exit;
            }
        } else {
            echo '<script>alert("Sign In Failed. Maybe an incorrect credential or account not found")</script>';
        }
    } else {
        echo '<script>alert("Sign In Failed. Error in preparing or executing SQL query.")</script>';
    }
}

if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('location: /shipment_control/');
    exit;
}
?>
