<?php
session_start();
include 'connect.php';
?>
<?php
if (!$conn) {
    echo $conn->connect_error;
    exit();
}
if (isset($_GET["define_booking_id"])) {
    $query = "SELECT * FROM tb_define_booking WHERE define_booking_id = '" . $_GET["define_booking_id"] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>