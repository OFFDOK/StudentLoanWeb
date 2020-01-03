<?php 
    include 'connect.php'; 
    $txtid = $_GET["define_upload_id"];
    ?>
 
<?php
    if (!$conn) {
        echo $conn->connect_error;    
        exit();
       } 
    $strSQL = "DELETE FROM `tb_define_upload_date` WHERE `define_upload_date_id` ='".$txtid."'";
    $objQuery = mysqli_query($conn,$strSQL);
    mysqli_close($conn);
?>