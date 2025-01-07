<?php session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity <= 0) {
        // Remove the product if the quantity is set to zero or less
        unset($_SESSION['cart'][$product_id]);
    } else {
        // Update the quantity
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header('Location: cart.php');
    exit;
}
?>