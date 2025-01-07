<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewelrystore";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$first_name = $_POST['firstName'] ?? 'Guest'; // Default to 'Guest' if not provided
$last_name = $_POST['lastName'] ?? 'User';
$email = $_POST['email'] ?? 'guest@example.com';
$phone_number = $_POST['phone'] ?? '';
$shipping_address = $_POST['shippingAddress'] ?? '';
$cart = $_SESSION['cart'] ?? [];

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Logged-in user
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = createGuestUser($conn, $first_name, $last_name, $email, $phone_number, $shipping_address);
}

// Check if the cart has items
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total_amount = 0;
    $shipping_address = $_POST['shippingAddress'];  // Guest user shipping address

    // Insert order into 'orders' table
    $sql = "INSERT INTO orders (customer_id, total_amount, shipping_address, status) 
            VALUES (?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $user_id, $total_amount, $shipping_address);
    $stmt->execute();
    $order_id = $stmt->insert_id;  // Get the inserted order ID

    // Insert order items into 'order_items' table
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $quantity = $cart[$product_id];
        $sql = "SELECT price FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($price_at_order);
        $stmt->fetch();
        $stmt->close();
        $total_amount += $price_at_order * $quantity;

        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price_at_order) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price_at_order);
        $stmt->execute();
    }

    // Update the total amount of the order
    $sql = "UPDATE orders SET total_amount = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $total_amount, $order_id);
    $stmt->execute();

    // Clear the cart after order is processed
    unset($_SESSION['cart']);

    // Redirect or show order confirmation
    echo "Order placed successfully!";
} else {
    echo "Your cart is empty!";
}

// Function to create a guest user
function createGuestUser($conn, $first_name, $last_name, $email, $phone_number, $shipping_address) {
    $password = '';  // Guest user doesn't have a password
    $type = 'GUEST';

    // Insert guest user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password, type, phone_number, shipping_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $password, $type, $phone_number, $shipping_address);
    $stmt->execute();

    return $stmt->insert_id; // Return the guest user ID
}

$conn->close();
?>
