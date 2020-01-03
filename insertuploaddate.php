<?php
session_start();
include 'connect.php';
$txtadmin = $_SESSION["admin_id"];
$dateopen = $_POST['format-open-upload-date'];
$dateclose = $_POST['format-close-upload-date'];
$txtterm = $_POST['semester-name'];
$txtstatus = $_POST['define_upload_date_status'];
?>
<?php
if (!$conn) {
    echo $conn->connect_error;
    exit();
}
$strSQL = "INSERT INTO `tb_define_upload_date`(`semester_name`,`define_upload_date_start`,`define_upload_date_end`,`define_upload_date_status`,`admin_id`)VALUES ('" . $txtterm . "','" . $dateopen . "','" . $dateclose . "','" . $txtstatus . "','" . $txtadmin . "');";
$objQuery = mysqli_query($conn, $strSQL);

mysqli_close($conn);
?>


