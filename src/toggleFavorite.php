<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'] ?? null;

if (!$product_id) {
    echo json_encode(['success' => false, 'message' => 'Product ID is required']);
    exit;
}

$conn = new mysqli("localhost", "root", "", "jewelrystore");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM whislist WHERE customer_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove from favorites
    $delete_sql = "DELETE FROM whislist WHERE customer_id = ? AND product_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $user_id, $product_id);
    $success = $delete_stmt->execute();
    $delete_stmt->close();

    echo json_encode(['success' => $success, 'is_favorite' => false]);
} else {
    // Add to favorites
    $insert_sql = "INSERT INTO whislist (customer_id, product_id) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $product_id);
    $success = $insert_stmt->execute();
    $insert_stmt->close();

    echo json_encode(['success' => $success, 'is_favorite' => true]);
}

$stmt->close();
$conn->close();
?>
