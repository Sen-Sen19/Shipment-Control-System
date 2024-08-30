<?php
// Include your session handling script
include '../../process/login.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('location: ../../'); // Redirect to login page
    exit;
} else if ($_SESSION['type'] == 'pvc') {
    header('location: ../../page/pvc/pstart_point.php'); 
    exit;
} else if ($_SESSION['type'] == 'cot') {
    header('location: ../../page/cot/dashboard.php');
    exit;
}
// Database connection details for MS SQL Server
$serverName = "172.25.116.188";
$username = "sa";
$password = "SystemGroup@2022";
$database = "tube_inspection_db"; 
try {
    // Establish connection to MS SQL Server using PDO
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * FROM sp_cotdb");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process the fetched data as needed
    foreach ($result as $row) {
        // Process each row of data here
        // Example: echo $row['column_name'];
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage(); // Output any errors that occur during execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tube Inspection</title>

  <link rel="icon" href="../../dist/img/tir-logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Sweet Alert -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.min.css">
  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #536A6D;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;   
      cursor: inherit;
      display: block;
    }
    .table th, .table td {
        padding: 15px !important;
        vertical-align: middle;
    }
    .table tbody tr td {
        padding: 8px 15px;
    }
 
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(1080deg); }
    } 
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/tir-logo.png" alt="logo" height="60" width="60">
    <noscript>
      <br>
      <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
      <br>
      <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
    </noscript>
  </div>

  <nav class="main-header navbar navbar-expand navbar-teal navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color:white;"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button"  style="color:white;">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      
    </ul>
  </nav>



