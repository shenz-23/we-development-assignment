<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicle_name = trim($_POST['vehicle_name']);
    $vehicle_type = trim($_POST['vehicle_type']);
    $brand = trim($_POST['brand']);
    $daily_rate = $_POST['daily_rate'];
    $status = $_POST['status'];

    if (
        $vehicle_name == "" ||
        $vehicle_type == "" ||
        $brand == "" ||
        !is_numeric($daily_rate) ||
        $daily_rate <= 0
    ) {
        $message = "Please enter valid vehicle details.";
    } else {

        $sql = "INSERT INTO vehicles
                (vehicle_name, vehicle_type, brand, daily_rate, status)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssds",
            $vehicle_name,
            $vehicle_type,
            $brand,
            $daily_rate,
            $status
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: vehicles.php");
            exit();
        } else {
            $message = "Error adding vehicle.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Vehicle</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 650px;
            margin-top: 25px;
        }

        .form-container label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;