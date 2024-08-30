<?php

include '../../process/login.php';

if (!isset($_SESSION['username'])) {
  header('location:../../');
  exit;
} else if ($_SESSION['type'] == 'admin') {
  header('location: ../../page/admin/admin.php');
  exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shipment Control</title>

  <link rel="icon" href="../../dist/img/shipment.png" type="image/x-icon" />
  
  <link rel="stylesheet" href="../../dist/css/font.min.css">

  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

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

    .table th,
    .table td {
      padding: 15px !important;
      vertical-align: middle;
    }

    .table tbody tr td {
      padding: 8px 15px;
    }


    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(1080deg);
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../dist/img/shipment.png" alt="logo" height="60" width="60">
      <noscript>
        <br>
        <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
        <br>
        <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
      </noscript>
    </div>

    <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #4D85FF;">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color:white;"><i
              class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color:white;">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      
      </ul>
    </nav>