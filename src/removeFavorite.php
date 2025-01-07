<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get favorite_id from POST data
$favorite_id = $input['favorite_id'] ?? null;

if (!$favorite_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid favorite ID']);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "jewelrystore");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Delete the favorite from the wishlist table
$sql = "DELETE FROM wishlist WHERE id = ? AND customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $favorite_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Favorite removed']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove favorite']);
}

$stmt->close();
$conn->close();
exit;



