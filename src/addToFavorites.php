<?php
session_start();
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'] ?? null;

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get the product ID

if (!$product_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "jewelrystore");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Check if the product is already in favorites
$user_id = $_SESSION['user_id'];
$sql = "SELECT w.id 
        FROM wishlist w
        WHERE w.customer_id = ? AND w.product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Product already in favorites
    echo json_encode(['success' => false, 'message' => 'Product already in favorites']);} else {
    $favorites = [];
    while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
}
    // Add to favorites
    $insert_sql = "INSERT INTO wishlist (customer_id, product_id) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $product_id);
    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Favorite added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add favorite']);
    }
    
    $insert_stmt->close();
}


$stmt->close();
$conn->close();
exit;
?>
