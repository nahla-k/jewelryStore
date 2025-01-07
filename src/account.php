<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

// Database connection (replace with your actual DB credentials)
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
$user_details = $result->fetch_assoc();

if (!$user_details) {
  die("User details not found.");
}
// Handle cases where phone_number or shipping_address might be null
$user_details['phone_number'] = $user_details['phone_number'] ?? ' ';
$user_details['shipping_address'] = $user_details['shipping_address'] ?? '';

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <link href="./output.css" rel="stylesheet">
  <link href="menu.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Account - Jewelry Store</title>
  <style>
    body {
      background-image: url('../icons/Texture.png');
      background-color: #141329;
      background-blend-mode: overlay;
      font-family: 'Mulish', sans-serif;
      color: #ffffff;
    }

    .account-container {
      display: flex;
      margin: 2rem auto;
      max-width: 1200px;
      gap: 2rem;
    }

    .sidebar {
      flex: 1;
      background: rgba(30, 31, 52, 0.8);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .sidebar a {
      display: block;
      margin: 1rem 0;
      padding: 1rem;
      border-radius: 8px;
      text-align: center;
      background: rgba(50, 50, 50, 0.5);
      font-weight: bold;
      transition: all 0.3s ease;
      text-decoration: none;
      color: #ffffff;
    }

    .sidebar a:hover {
      background: linear-gradient(90deg, #0077ff, #00bfff);
      color: #ffffff;
      box-shadow: 0 4px 10px rgba(0, 191, 255, 0.6);
    }

    .sidebar .logout-btn {
      background: #ff4d4d;
      color: white;
    }

    .content {
      flex: 3;
      background: rgba(30, 31, 52, 0.8);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .content h1 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      border-bottom: 2px solid rgba(255, 255, 255, 0.2);
      padding-bottom: 0.5rem;
    }

    .form-container label {
      font-size: 1rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
      display: block;
    }

    .form-container input,
    .form-container textarea {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      background: rgba(40, 40, 40, 0.9);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: #ffffff;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-container input:focus,
    .form-container textarea:focus {
      border-color: #00bfff;
      outline: none;
      box-shadow: 0 0 8px rgba(0, 191, 255, 0.6);
    }

    .form-container button {
      padding: 0.8rem 1.5rem;
      border-radius: 8px;
      background: linear-gradient(90deg, #0077ff, #00bfff);
      color: #ffffff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      border: none;
      transition: all 0.3s ease;
    }

    .form-container button:hover {
      background: linear-gradient(90deg, #0059b3, #0080c4);
      box-shadow: 0 4px 10px rgba(0, 191, 255, 0.6);
    }

    form {
      display: grid;
      gap: 20px;
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
          <!-- Dropdown Menu -->
          <li class="dropdown">
            <a href="account.php" class="hover:text-gold">My Account</a>
            <div id="accountDropdown" class="dropdown-content">
              <a href="orders.php">My Orders</a>
              <a href="favorites.php">My Favorites</a>
              <a href="details.php">My Details</a>
              <a href="logout.php">Log Out</a>
            </div>
          </li>
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

  <!-- Main Account Section -->
  <div class="account-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <a href="?section=details">User Details</a>
      <a href="?section=orders">My Orders</a>
      <a href="?section=favorites">My Favorites</a>
      <a href="logout.php" class="logout-btn">Log Out</a>
    </div>

    <!-- Content -->
    <div class="content">
      <?php
      // Determine which section to show
      $section = $_GET['section'] ?? 'details';
      if ($section === 'details') {
      ?>
        <h1>Update My Details</h1>
        <form action="updateDetails.php" method="POST" class="form-container">
          <div>
            <label for="first_name">First Name <span style="color:#901010;"> *</span></label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user_details['first_name']); ?>" required>
          </div>
          <div>
            <label for="last_name">Last Name <span style="color:#901010;"> *</span></label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user_details['last_name']); ?>" required>
          </div>
          <div>
            <label for="email">Email <span style="color:#901010;"> *</span></label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_details['email']); ?>" required>
          </div>
          <div>
            <label for="phone_number">Phone</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user_details['phone_number']); ?>">
          </div>
          <div>
            <label for="shipping_address">Shipping Address</label>
            <textarea id="shipping_address" name="shipping_address" rows="3"><?php echo htmlspecialchars($user_details['shipping_address']); ?></textarea>
          </div>
          <button type="submit" class="button">Save Changes</button>
        </form>
      <?php
      } elseif ($section === 'orders') {


        // Fetch orders for the logged-in user
        $orders_sql = "SELECT order_id, order_date, delivery_date, total_amount, shipping_address, status 
                       FROM orders 
                       WHERE customer_id = ?";
        $stmt = $conn->prepare($orders_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $orders_result = $stmt->get_result();
      ?>
        <h1>My Orders</h1>
        <div class="overflow-auto bg-[#2a2d45] rounded-lg p-6 shadow-md">
          <?php if ($orders_result->num_rows > 0): ?>
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-[#1f2235] text-white text-sm uppercase tracking-wide">
                  <th class="py-3 px-4">Order ID</th>
                  <th class="py-3 px-4">Order Date</th>
                  <th class="py-3 px-4">Delivery Date</th>
                  <th class="py-3 px-4">Total Amount</th>
                  <th class="py-3 px-4">Status</th>
                  <th class="py-3 px-4">Actions</th>
                </tr>
              </thead>
              <tbody class="text-gray-300">
                <?php while ($order = $orders_result->fetch_assoc()): ?>
                  <tr class="border-b border-gray-700 hover:bg-[#1f2235] transition">
                    <td class="py-3 px-4"><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td class="py-3 px-4"><?php echo date("d M Y", strtotime($order['order_date'])); ?></td>
                    <td class="py-3 px-4">
                      <?php
                      if (is_null($order['delivery_date'])) {
                        echo "-";
                      } else {
                        echo date("d M Y", strtotime($order['delivery_date']));
                      }
                      ?>
                    </td>
                    <td class="py-3 px-4">$<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td class="py-3 px-4">
                      <span class="py-1 px-2 rounded-full text-xs 
                        <?php echo $order['status'] === 'Completed' ? 'bg-green-500' : ($order['status'] === 'Pending' ? 'bg-yellow-500' : 'bg-red-500'); ?>">
                        <?php echo htmlspecialchars($order['status']); ?>
                      </span>
                    </td>
                    <td class="py-3 px-4">
                      <button
                        class="text-blue-400 hover:text-blue-300 underline"
                        onclick="viewItems(<?php echo $order['order_id']; ?>)">View Items</button>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p class="text-gray-400">You have no orders yet.</p>
          <?php endif; ?>
        </div>

        <!-- Modal for Viewing Order Items -->
        <div id="orderItemsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
          <div class="bg-[#2a2d45] text-white rounded-lg shadow-lg p-6 w-2/3 max-w-4xl">
            <h2 class="text-xl font-semibold mb-4">Order Items</h2>
            <div id="modalContent" class="overflow-auto">
              <!-- Dynamic content will be loaded here -->
            </div>
            <button class="mt-4 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg" onclick="closeModal()">Close</button>
          </div>
        </div>

        <script>
          async function viewItems(orderId) {
            const modal = document.getElementById("orderItemsModal");
            const modalContent = document.getElementById("modalContent");
            modalContent.innerHTML = "<p>Loading...</p>";
            modal.classList.remove("hidden");

            try {
              const response = await fetch(`fetchOrderItems.php?order_id=${orderId}`);
              const data = await response.text();
              modalContent.innerHTML = data;
            } catch (error) {
              modalContent.innerHTML = "<p>Error loading order items.</p>";
            }
          }

          function closeModal() {
            const modal = document.getElementById("orderItemsModal");
            modal.classList.add("hidden");
          }
        </script>

      <?php      } elseif ($section === 'favorites') {
        // Fetch favorite products for the logged-in user
        $favorites_sql = "SELECT f.id, p.product_id, p.name, p.price, p.image_url 
                              FROM wishlist f
                              JOIN products p ON f.product_id = p.product_id
                              WHERE f.customer_id = ?";
        $stmt = $conn->prepare($favorites_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $favorites_result = $stmt->get_result();
      ?>
        <h1>My Favorites</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php if ($favorites_result->num_rows > 0): ?>
            <?php while ($favorite = $favorites_result->fetch_assoc()): ?>
              <div class="bg-[#2a2d45] rounded-lg shadow-md p-4 flex flex-col items-center">
                <img src="<?php echo htmlspecialchars($favorite['image_url']); ?>" alt="<?php echo htmlspecialchars($favorite['name']); ?>" class="w-32 h-32 object-cover rounded-md mb-4">
                <h2 class="text-lg font-semibold text-white"><?php echo htmlspecialchars($favorite['name']); ?></h2>
                <p class="text-gray-400">$<?php echo number_format($favorite['price'], 2); ?></p>
                <div class="flex space-x-4 mt-4">
                  <a href="product.php?id=<?php echo $favorite['product_id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">View</a>
                  <form action="removeFavorite.php" method="POST" class="inline">
                    <input type="hidden" name="favorite_id" value="<?php echo $favorite['id']; ?>">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">Remove</button>
                  </form>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-gray-400 text-center w-full">You have no favorite products yet.</p>
          <?php endif; ?>
        </div>
      <?php
        $stmt->close();
      }
      ?>
    </div>
  </div>

</body>

</html>