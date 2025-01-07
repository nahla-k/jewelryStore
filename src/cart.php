<?php
session_start();

$host = 'localhost';
$dbname = 'jewelrystore';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $cart = $_SESSION['cart'] ?? [];
  $products = [];

  if (!empty($cart)) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $query = "SELECT * FROM products WHERE product_id IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array_keys($cart)); // Use product IDs as keys
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  // Calculate subtotal and total
  $subtotal = 0;
  foreach ($products as $product) {
    $product_id = $product['product_id'];
    $quantity = $cart[$product_id];
    $subtotal += $product['price'] * $quantity;
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
}

$user_details = [
  'first_name' => '',
  'last_name' => '',
  'email' => '',
  'phone_number' => '',
  'shipping_address' => ''
];

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jewelrystore";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch user details using session user_id
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT first_name, last_name, email, phone_number, shipping_address FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If a user is found, populate user details
  if ($result->num_rows > 0) {
    $user_details = $result->fetch_assoc();
  }

  // Handle cases where phone_number or shipping_address might be null
  $user_details['phone_number'] = $user_details['phone_number'] ?? ' ';
  $user_details['shipping_address'] = $user_details['shipping_address'] ?? '';
}
?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <style>
    .summary-container {
      width: 30%;
      /* Adjust the width as needed */
    }

    .products-container {
      width: 70%;
      /* Adjust the width as needed */
    }

    #checkoutModal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.7);
      /* Dim background */
      z-index: 1000;
      width: 100%;
      height: 100%;
      display: none;
      /* Hidden by default */
      align-items: center;
      justify-content: center;
    }

    /* Modal content */
    #checkoutModal>div {
      background-color: #1e1e2f;
      /* Dark background matching site theme */
      border-radius: 0.75rem;
      padding: 2rem;
      width: 90%;
      max-width: 500px;
      /* Responsive max width */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      color: white;
      font-family: 'Mulish', sans-serif;
      /* Consistent font */
    }

    /* Form fields */
    input,
    textarea {
      width: 100%;
      border: 1px solid #444;
      background-color: #2a2a3a;
      /* Match background color */
      color: white;
      border-radius: 0.5rem;
      padding: 1rem;
      font-size: 1rem;
    }

    input::placeholder,
    textarea::placeholder {
      color: #bbb;
    }

    /* Buttons */
    button {
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
    }

    /* Cancel Button */
    #cancelButton {
      background-color: #444;
      color: white;
      transition: background-color 0.3s;
    }

    #cancelButton:hover {
      background-color: #666;
    }

    /* Confirm Button */
    #checkoutModal button[type="submit"] {
      background-color: #0c0b15;
      color: white;
      transition: background-color 0.3s;
    }

    #checkoutModal button[type="submit"]:hover {
      background-color: #1c5d99;
    }
  </style>


</head>

<body style="background-image: url('../icons/Texture.png'); background-color: #141329; background-blend-mode: overlay;" class="font-mulish bg-cover min-h-screen">

  <!-- Navigation Bar -->

  <nav class="text-white bg-[#322f3133] p-5">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <!-- Logo -->
      <a href="index.php" class="text-2xl font-cinzel">Jewelry Store</a>

      <!-- Navigation Links -->
      <ul class="flex space-x-10">
        <li><a href="index.php" class="hover:text-gold">Home</a></li>
        <li><a href="shop.php" class="hover:text-gold">Shop</a></li>
        <li><a href="#" class="hover:text-gold">About</a></li>
        <li><a href="#" class="hover:text-gold">Contact</a></li>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
          <li><a href="account.php" class="hover:text-gold">My Account</a></li>
        <?php else: ?>
          <li><a href="login.php" class="hover:text-gold">Log In</a></li>
        <?php endif; ?>
      </ul>

      <!-- Shopping Cart -->
      <div class="relative">
        <a href="cart.php" id="viewCartButton" class="text-2xl">
          <img src="../icons/fi-rr-shopping-cart.png" alt="Shopping Cart" class="w-6 h-6">
        </a>
      </div>
    </div>
  </nav>
  <div class="container mx-auto p-8 text-white">
    <h1 class="text-3xl font-bold mb-6">My Cart (<?php echo count($cart); ?> Items)</h1>
    <div class="flex flex-wrap lg:flex-nowrap">
      <!-- Products Section -->
      <div class="products-container w-full lg:w-3/4 p-6">
        <?php
        if (!empty($products)) {
          foreach ($products as $product) {
            $quantity = $cart[$product['product_id']];
            $totalPrice = $product['price'] * $quantity;
            echo "<div class='flex items-center justify-between bg-[#322f31] p-4 rounded-lg mb-4'>";
            echo "<div class='flex items-center'>";
            echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' style='width: 150px; height: 200px; object-fit: cover; border-radius: 8px;'>";
            echo "<div class='ml-4'>";
            echo "<h3 class='text-xl font-bold'>" . htmlspecialchars($product['name']) . "</h3>";
            echo "<p class='text-gray-400'>SKU: " . htmlspecialchars($product['product_id']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<div class='text-right'>";
            echo "<p class='text-lg font-semibold'>\$" . number_format($product['price'], 2) . "</p>";
            echo "<p class='text-gray-400'>Qty: " . htmlspecialchars($quantity) . "</p>";
            echo "<p class='font-bold'>Total: \$" . number_format($totalPrice, 2) . "</p>";
            echo "<div class='mt-2'>"; ?>
            <form method="POST" action="update_cart.php">
              <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
              <input type="hidden" name="quantity" value="0">
              <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
            </form>
        <?php echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>Your cart is empty.</p>";
        }
        ?>
      </div>

      <!-- Summary Section -->
      <div class="summary-container bg-[#322f31] p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Summary</h2>
        <div class="flex justify-between text-lg mb-2">
          <span>Total</span>
          <span>$<?php echo number_format($subtotal, 2); ?></span>
        </div>

        <br>
        <div class="flex justify-between text-lg mb-2">
          <span>Shipping</span>
          <span>Free</span>
        </div>
        <br>
        <div class="border-t border-gray-600 my-4"></div>
        <br>
        <div class="flex justify-between text-lg font-bold">
          <span>Total</span>
          <span>\$<?php echo number_format(array_sum(array_map(function ($product) use ($cart) {
                    return $product['price'] * $cart[$product['product_id']];
                  }, $products)), 2); ?></span>
          <br>
        </div>

        <button class="w-full bg-[#0c0b15] text-white py-3 mt-6 rounded-lg hover:bg-[#1c5d99]" id="checkoutButton" onclick="showModal()">
          Checkout
        </button>


      </div>
    </div>
  </div>
  <!-- Modal -->
  <div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg p-6 w-11/12 max-w-lg">
      <h2 class="text-2xl font-bold mb-4">Checkout</h2>
      <form action="processOrder.php" method="POST">
        <div class="mb-4">
          <label for="firstName" class="block textwhite">First Name</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($user_details['first_name']); ?>" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
          <label for="lastName" class="block text-white">Last Name</label>
          <input type="text" id="lastName" name="lastName" class="w-full border rounded px-3 py-2" value="<?php echo htmlspecialchars($user_details['last_name']); ?>" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-white">Email</label>
          <input type="email" id="email" name="email" class="w-full border rounded px-3 py-2" value="<?php echo htmlspecialchars($user_details['email']); ?>" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-white">Phone Number</label>
          <input type="text" id="phone" name="phone" class="w-full border rounded px-3 py-2" value="<?php echo htmlspecialchars($user_details['phone_number']); ?>" required>
        </div>
        <div class="mb-4">
          <label for="shippingAddress" class="block text-white">Shipping Address</label>
          <textarea id="shippingAddress" name="shippingAddress" class="w-full border rounded px-3 py-2" <?php echo isset($_SESSION['user_id']) ? '' : 'disabled'; ?>><?php echo htmlspecialchars($user_details['shipping_address']); ?></textarea>
        </div>
        <div class="flex justify-end space-x-4">
          <button type="button" id="cancelButton" onclick="closeModal()">Cancel</button>
          <button type="submit">Confirm</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function closeModal() {
      document.getElementById('checkoutModal').classList.add('hidden');
    }

    document.getElementById('checkoutModal').addEventListener('click', function(event) {
      if (event.target === this) {
        closeModal();
      }
    });


    const modal = document.getElementById('checkoutModal');

    // Show the modal
    function showModal() {
      modal.style.display = 'flex'; // Set display to flex to make it visible
    }

    // Hide the modal
    function hideModal() {
      modal.style.display = 'none'; // Set display to none to hide it
    }

    // Add event listeners to open and close buttons
    document.getElementById('checkoutButton').addEventListener('click', showModal);
    document.getElementById('cancelButton').addEventListener('click', hideModal);
  </script>

</body>

</html>