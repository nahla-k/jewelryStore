<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewelrystore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get order_id from the request
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if ($order_id > 0) {
    // Fetch order items for the given order_id
    $sql = "SELECT oi.product_id, p.name, p.image_url, oi.quantity, oi.price_at_order
            FROM order_items oi
            JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If there are items in the order
    if ($result->num_rows > 0) {
        echo '<h1 class="text-2xl font-semibold mb-6">Your Order Items</h1>';
        echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';

        while ($item = $result->fetch_assoc()) {
            // Prepare the product details with images and information
            echo '<div class="bg-[#2a2d45] rounded-lg shadow-md p-4 flex flex-col items-center">';
            echo '<img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['name']) . '" class="w-32 h-32 object-cover rounded-md mb-4">';
            echo '<h2 class="text-lg font-semibold text-white">' . htmlspecialchars($item['name']) . '</h2>';
            echo '<p class="text-gray-400">Quantity: ' . $item['quantity'] . '</p>';
            echo '<p class="text-gray-400">$' . number_format($item['price_at_order'], 2) . '</p>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<p class="text-gray-400 text-center w-full">You have no items in this order.</p>';
    }
} else {
    echo '<p class="text-gray-400 text-center w-full">Invalid order ID.</p>';
}

$conn->close();
