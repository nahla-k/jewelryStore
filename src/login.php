<?php
session_start();

// Database connection
$host = 'localhost'; // Update with your DB host
$db = 'jewelrystore'; // Update with your DB name
$user = 'root'; // Update with your DB user
$pass = ''; // Update with your DB password
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Do not sanitize password; use it as is for hashing

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Check credentials in the database
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id']; // Store user ID for future use
        $_SESSION['user_email'] = $email;

        // Redirect to account page
        header("Location: account.php");
        exit();
    } else {
        // Login failed
        echo "<p style='color:red;'>Invalid email or password.</p>";
    }
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
    .form-container {
      background-color: rgba(50, 47, 49, 0.5);
      backdrop-filter: blur(10px);
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
  <div class="form-container max-w-md w-full p-8 rounded-lg shadow-lg text-white">
    <h2 class="text-3xl font-cinzel text-center mb-6">Login</h2>
    <form action="login.php" method="POST">
      <div class="mb-4">
        <label for="email" class="block mb-2 text-sm">Email Address</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block mb-2 text-sm">Password</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <button type="submit" class="w-full bg-gold text-black py-2 rounded-lg hover:bg-[#F6B906] transition-colors">Log In</button>
    </form>
    <p class="mt-6 text-center text-sm">
      Don't have an account? 
      <a href="signup.php" class="text-gold hover:underline">Sign Up</a>
    </p>
  </div>

</body>
</html>
