<?php 
    session_start();  
    include 'connect.php'; 
    $txtadmin = $_SESSION["admin_id"];
    $open_queue_date = $_POST['open-date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $count = $_POST['count'];
    ?>
<?php
    if (!$conn) {
        echo $conn->connect_error;    
        exit();
       } 

    $strSQL = "INSERT INTO `tb_define_booking`(`define_booking_date_start`,`define_booking_time_start`,`define_booking_time_end`,`maximum_queue`,`admin_id`)VALUES ('".$open_queue_date."','".$start_time."','".$end_time."','".$count."','".$txtadmin."');";
    $objQuery = mysqli_query($conn,$strSQL);
    mysqli_close($conn);
?>


