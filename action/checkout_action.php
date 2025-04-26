<?php
include '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $tour_id = $_POST['tour_id'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'] ?? null;

    // Save booking
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, tour_id, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $user_id, $tour_id, $amount);

    if ($stmt->execute()) {
        $_SESSION['booking_success'] = "Booking placed successfully!";
        header("Location: ../checkout.php?id=$tour_id");
    } else {
        $_SESSION['booking_error'] = "Failed to book tour. Please try again.";
        header("Location: ../checkout.php?id=$tour_id");
    }
    exit;
}
?>
