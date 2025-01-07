<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Validate and sanitize inputs
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Do not sanitize password; use it as is for hashing

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Check if email is already in use
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $error = "Email is already registered.";
        } else {
            // Hash password and insert user into database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (last_name, first_name, email, password) VALUES (:last_name, :first_name, :email, :password)");
            $stmt->execute([
                'last_name' => $lastName,
                'first_name' => $firstName,
                'email' => $email,
                'password' => $hashedPassword,
            ]);
            $user_id = $pdo->lastInsertId();

            // Automatically log in the user
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;

            // Redirect to the account page after successful signup and login
            header("Location: account.php");
            exit();
        }
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
      <a href="index.php" class="text-2xl font-cinzel">Jewelry Store</a>
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
    </div>
  </nav>

  <!-- Signup Form -->
  <div class="form-container max-w-md w-full px-8 rounded-lg shadow-lg text-white">
    <h2 class="text-3xl font-cinzel text-center mb-6">Sign Up</h2>
    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="signup.php" method="POST">
      <div class="mb-4">
        <label for="last_name" class="block mb-2 text-sm">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <div class="mb-4">
        <label for="first_name" class="block mb-2 text-sm">First Name</label>
        <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <div class="mb-4">
        <label for="email" class="block mb-2 text-sm">Email Address</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block mb-2 text-sm">Password</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg bg-black text-white border border-gray-600 focus:outline-none focus:border-gold" required>
      </div>
      <button type="submit" class="w-full bg-gold text-black py-2 rounded-lg hover:bg-[#F6B906] transition-colors">Sign Up</button>
    </form>
    <p class="mt-6 text-center text-sm">
      Already have an account? 
      <a href="login.php" class="text-gold hover:underline">Log In</a>
    </p>
  </div>

</body>
</html>
