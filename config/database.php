<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "howl@sheni13775",
    "vehicle_rentals"
);

if (!$conn)
    {
        die("Database connection failed");
    }

mysqli_set_charset($conn, "utf8mb4");
?>