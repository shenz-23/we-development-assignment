<?php

require 'config/database.php';

require_login();

// Get vehicle ID
$id = filter_input(INPUT_GET, 'vehicle_id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: vehicles.php');
    exit;
}

// Get vehicle details
$sql = "SELECT * FROM vehicles
        WHERE vehicle_id = ?
        AND availability = 'Available'";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$vehicle = $stmt->fetch();

// Check vehicle availability
if (!$vehicle) {
    http_response_code(404);
    exit("Vehicle is not available.");
}

$pageTitle = "Book Vehicle";

require 'includes/header.php';

?>

<div class="form-card">

    <h1>Book <?php echo e($vehicle['vehicle_name']); ?></h1>

    <p class="price">
        LKR <?php echo number_format($vehicle['price_per_day'], 2); ?> per day
    </p>

    <form action="create-booking.php" method="POST">

        <input type="hidden" name="csrf_token"
               value="<?php echo e(csrf_token()); ?>">

        <input type="hidden" name="vehicle_id"
               value="<?php echo (int)$vehicle['vehicle_id']; ?>">

        <label>Pickup Date</label>
        <input type="date" name="pickup_date" required>

        <label>Return Date</label>
        <input type="date" name="return_date" required>

        <label>Pickup Location</label>
        <input type="text" name="pickup_location"
               placeholder="Enter pickup location"
               maxlength="150" required>

        <p class="muted">
            The total rental price will be calculated automatically.
        </p>

        <button type="submit">Submit Booking</button>

    </form>

</div>

<?php require 'includes/footer.php'; ?>