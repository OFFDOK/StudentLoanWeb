<?php
session_start();
include 'connect.php';
?>
<?php
if (!$conn) {
    echo $conn->connect_error;
    exit();
}
if (isset($_GET["ID"])) {
    $query = "SELECT * FROM tb_document 
    LEFT JOIN tb_type_of_document ON tb_document.type_of_document_id = tb_type_of_document.type_of_document_id
    WHERE tb_document.`ID` = '" . $_GET["ID"] . "' AND tb_document.`type_of_document_id` ='" . $_GET["Type"] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>