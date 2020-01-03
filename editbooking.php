<?php
session_start();
include 'connect.php';
$txtadmin = $_SESSION["admin_id"];
$txtid = $_POST['edit-id'];
$txtdatestart = $_POST['edit-open-date'];
$timestart = $_POST['edit-start_time'];
$timeend = $_POST['edit-end_time'];
$count = $_POST['edit-count'];
?>
    <?php
    if (!$conn) {
        echo $conn->connect_error;
        exit();
    }
    $strSQL = "UPDATE `tb_define_booking` SET `define_booking_date_start`='" . $txtdatestart . "',`define_booking_time_start`='" . $timestart . "',`define_booking_time_end`='" . $timeend . "',`maximum_queue`='" . $count . "',`admin_id`='" . $txtadmin . "' WHERE `define_booking_id` ='" . $txtid . "'";

    $objQuery = mysqli_query($conn, $strSQL);
    mysqli_close($conn);
    ?>