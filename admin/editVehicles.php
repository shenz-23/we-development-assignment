<?php

include 'config/database.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $status = $_POST['status'];

    $sql = "UPDATE vehicles SET
            type='$type',
            brand='$brand',
            seats='$seats',
            status='$status',
            WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        header("Location: viewVehicles.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>