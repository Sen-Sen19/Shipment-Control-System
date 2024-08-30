<?php 
require "../../vendor/fpdf/fpdf.php";
require "../conn.php";

$transaction_id = 1;
$admin_id = 1;
$is_lock = 0;

$user_id = "USER-001";
$user_account_id = "ACCT-001";
$user_account_name = "TESTING";
$user_email = "testing@example.com";
$user_cellphone_number = "09123456789";
$barangay_name = "BRGY";
$report_id = "REP-001";
$report_name = "May Concern Ako";
$report_type_name = "Concern";
$report_details = "BASTA";
$upload_set_id = "001";
$dept_name = "Municipal Health Office";
$admin_name = "Ako";
$is_resolved = "pending";
$is_anonymous = 0;
$transaction_end_date = "2023-10-28 11:22:00";
$transaction_array = array();

function get_starred($str) {
    $len = strlen($str);
    return substr($str, 0, 1).str_repeat('*', $len - 2);
}

function get_starred_phone($str) {
    $len = strlen($str);
    return str_repeat('*', $len - 2).substr($str, $len - 1, 1);
}

function hide_mail($email) {
    $mail_segments = explode("@", $email);
    $mail_segments[0] = str_repeat("*", strlen($mail_segments[0]));

    return implode("@", $mail_segments);
}

if ($is_anonymous == 1) {
    $user_account_name = get_starred($user_account_name);
    $user_email = hide_mail($user_email);
    if ($user_cellphone_number != "") {
        $user_cellphone_number = get_starred_phone($user_cellphone_number);
    }
}

$transaction_end_date = date("Y-m-d h:iA", strtotime($transaction_end_date));

class ReportPDF extends FPDF {
    /**
     * Declaration of Variables
     */
    private $report_id;
    
    function getUserId() {
        return $this -> report_id;
    }
    function setUserId($report_id) {
        $this -> report_id = $report_id;
    }

    function header() {
        $this -> Image('../../dist/img/user.png', 10, 6, 30, 30);
        $this -> Image('../../dist/img/logo.png', 177.5, 6, 30, 30);
        $this -> SetFont('Times','B',12);
        $this -> Cell(197.5, 7, 'Republic of the Philippines', 0, 2, 'C');
        $this -> Cell(197.5, 7, 'Province of Batangas', 0, 2, 'C');
        $this -> Cell(197.5, 7, 'Municipality of Malvar', 0, 2, 'C');
        $this -> SetFont('Times','',12);
        $this -> Cell(197.5, 7, 'Malvar Municipal Hall', 0, 0, 'C');
        $this -> Ln(20);
    }
    function footer() {
        $this -> SetY(-15);
        $this -> SetFont('Times','',8);
        $this -> Cell(0,10,'Page '.$this -> PageNo(). '/{nb}', 0, 0, 'C');
    }
}

$report_pdf = new ReportPDF();
$report_pdf -> setUserId($report_id);
$report_pdf -> SetTitle("CARE_" . $report_type_name . "Report_" . $report_id . "-" . $transaction_id . "-" . $user_id, true);
$report_pdf -> SetAuthor("CARE", true);
$report_pdf -> SetCreator("CARE", true);
$report_pdf -> SetSubject($report_type_name . " Report", true);
$report_pdf -> AliasNbPages();
$report_pdf -> AddPage('P','Letter',0);

// report id
$report_pdf -> SetFont('Times','B',12);
$report_pdf -> Cell(197.5, 5, 'Report ID : ' . $report_pdf -> getUserId(), 0, 2, 'L');
$report_pdf -> Cell(197.5, 10, 'Transaction ID : ' . $transaction_id, 0, 2, 'L');
$report_pdf -> Ln(5);

// resident info
$report_pdf -> SetFont('Times','B',12);
$report_pdf -> Cell(197.5, 5, 'Resident Information', 0, 0, 'L');

$report_pdf -> Ln(10);
$report_pdf -> SetFont('Times','',12);
$report_pdf -> Cell(197.5, 5, 'User ID : ' . $user_id, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Resident Name : ' . $user_account_name, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Barangay Name : ' . $barangay_name, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Email : ' . $user_email, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Cellphone Number : ' . $user_cellphone_number, 0, 2, 'L');
$report_pdf -> Ln(10);

// body
$report_pdf -> SetFont('Times','B',12);
$report_pdf -> Cell(197.5, 5, $report_type_name . ' Report Information', 0, 0, 'L');

$report_pdf -> Ln(10);
$report_pdf -> SetFont('Times','',12);
$report_pdf -> Cell(197.5, 5, 'Report Name : ' . $report_name, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Date : ' . $transaction_end_date, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Department Involved : ' . $dept_name, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Admin Involved : ' . $admin_name, 0, 2, 'L');
$report_pdf -> Cell(197.5, 5, 'Report Status : ' . $is_resolved, 0, 2, 'L');
$report_pdf -> Ln(10);
$report_pdf -> SetFont('Times','B',12);
$report_pdf -> Cell(197.5, 5, 'Report Details', 0, 2, 'L');
$report_pdf -> Ln(5);
$report_pdf -> SetFont('Times','',12);
//$report_pdf -> Cell(197.5, 5, '     ' . $report_details, 0, 2, 'L');
$report_pdf -> MultiCell(197.5, 5,'     ' . $report_details, 0,'L');
$report_pdf -> Ln(10);
$report_pdf -> SetFont('Times','B',12);
$report_pdf -> Cell(197.5, 5, 'Uploads', 0, 2, 'L');
$report_pdf -> Ln(5);
$report_pdf -> Cell(30, 5, 'Upload ID', 1, 0, 'C');
$report_pdf -> Cell(30, 5, 'Upload Set ID', 1, 0, 'C');
$report_pdf -> Cell(137.5, 5, 'Upload Filename', 1, 0, 'C');
$report_pdf -> Ln();
$report_pdf -> SetFont('Times','',12);

$report_pdf -> Cell(30, 5, 'UPLOAD ID', 1, 0, 'C');
$report_pdf -> Cell(30, 5, $upload_set_id, 1, 0, 'C');
$report_pdf -> Cell(137.5, 5, 'filename', 1, 0, 'C');
$report_pdf -> Ln();

/*$report_pdf -> Cell(197.5, 5, "No Files Uploaded", 1, 0, 'C');
$report_pdf -> Ln();*/

// execute output
$report_pdf -> Output();

$conn -> close();

?>