<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_login();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$totalQuery = "SELECT COUNT(*) AS total FROM vehicles";
$totalResult = mysqli_query($conn, $totalQuery);
$totalVehicles = mysqli_fetch_assoc($totalResult)['total'];

$availableQuery = "SELECT COUNT(*) AS total FROM vehicles
                   WHERE status = 'Available'";
$availableResult = mysqli_query($conn, $availableQuery);
$availableVehicles = mysqli_fetch_assoc($availableResult)['total'];

$unavailableVehicles = $totalVehicles - $availableVehicles;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="sidebar">

    <h2>WanderLanka</h2>
    <p class="admin-label">ADMIN PANEL</p>

    <a href="index.php" class="active">Dashboard</a>
    <a href="vehicles.php">Manage Vehicles</a>
    <a href="customers.php">Customers</a>
    <a href="bookings.php">Bookings</a>
    <a href="availability.php">Availability</a>

    <a href="../logout.php" class="logout">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <h2>Dashboard</h2>
        <p>Welcome, Administrator!</p>
    </div>

    <h3>Overview</h3>

    <div class="cards">

        <div class="card">
            <h3>Total Vehicles</h3>
            <p><?php echo $totalVehicles; ?></p>
        </div>

        <div class="card">
            <h3>Available Vehicles</h3>
            <p><?php echo $availableVehicles; ?></p>
        </div>

        <div class="card">
            <h3>Unavailable Vehicles</h3>
            <p><?php echo $unavailableVehicles; ?></p>
        </div>

    </div>

    <div class="welcome-box">
        <h2>Welcome to the Admin Panel</h2>

        <p>
            Manage your rental vehicles, customers,
            bookings and vehicle availability from here.
        </p>

        <a href="vehicles.php" class="btn">
            Manage Vehicles
        </a>
    </div>

</div>

</body>
</html>
