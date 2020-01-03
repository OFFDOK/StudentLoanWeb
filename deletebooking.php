<?php 
    include 'connect.php'; 
    $txtid = $_GET["define_booking_id"];
    ?>
 
<?php
    if (!$conn) {
        echo $conn->connect_error;    
        exit();
       } 
    $strSQL = "DELETE FROM `tb_define_booking` WHERE `define_booking_id` ='".$txtid."'";
    $objQuery = mysqli_query($conn,$strSQL);
    mysqli_close($conn);
?>