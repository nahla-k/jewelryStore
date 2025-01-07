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

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" rel="stylesheet">
    <title>Update My Details - Jewelry Store</title>
    <style>
        body {
            background: #1a1a1a;
            color: #f5f5f5;
            font-family: 'Mulish', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(29, 31, 52, 0.9);
            backdrop-filter: blur(10px);
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
             border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-size: 14px;
            color: #ccc;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            background: #141329;
            border: 1px solid #303000;
            border-radius: 5px;
            color: #fff;
            font-size: 14px;
        }

        input:focus, textarea:focus {
            border-color: #666;
            outline: none;
        }

        .button {
            background-color: #DAA520;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            max-width: 170px;
            margin: auto;
            transition: background-color 0.3s ease-in-out;
        }

        .button:hover {
            background-color: #555;
        }

        .button:active {
            background-color: #666;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<link href="menu.css" rel="stylesheet">
<title>Jewelry Store</title>  
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
    <div class="container" class="bg-[#1e1f34] p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1>Update My Details</h1>
        <form action="updateDetails.php" method="POST">
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
    </div>
</body>
</html>
