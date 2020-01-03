<?php
session_start();
include 'connect.php';
$txtadmin = $_SESSION["admin_id"];
$txtid = $_POST['edit-id'];
$txtname = $_POST['edit-semester-name'];
$txtstatus = $_POST['edit-define_upload_date_status'];
$dateopen = $_POST['edit-format-open-upload-date'];
$dateclose = $_POST['edit-format-close-upload-date'];
?>
    <?php
    if (!$conn) {
        echo $conn->connect_error;
        exit();
    }
    $strSQL = "UPDATE `tb_define_upload_date` SET `semester_name`='" . $txtname . "',`define_upload_date_start`='" . $dateopen . "',`define_upload_date_end`='" . $dateclose . "',`define_upload_date_status`='" . $txtstatus . "',`admin_id` ='" . $txtadmin . "' WHERE `define_upload_date_id` ='" . $txtid . "'";

    $objQuery = mysqli_query($conn, $strSQL);
    mysqli_close($conn);
    ?>