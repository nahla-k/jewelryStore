<?php
session_start();
$host = 'localhost';
$dbname = 'jewelrystore';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $latestCollectionQuery = "
        SELECT p.product_id, p.name, p.description, p.price, p.image_url 
        FROM products p
        INNER JOIN collections c ON p.collection_id = c.collection_id
        ORDER BY c.collection_id DESC LIMIT 4
    ";
    $stmt = $pdo->prepare($latestCollectionQuery);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" rel="stylesheet">
  <script src="script.js"></script>
  <style>
  /* Modal Styles */
  .modal {
    display: none; 
    position: fixed;
    z-index: 1000; /* Ensure it's on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Overlay */
    justify-content: center;
    align-items: center;
}


  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    text-align: center;
  }

  /* Close Button */
  .close-button {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 5px;
    right: 10px;
    cursor: pointer;
  }

  .close-button:hover,
  .close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
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
            <a href="account.php?section=orders">My Orders</a>
            <a href="account.php?section=favorites">My Favorites</a>
            <a href="account.php?section=details">My Details</a>
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
  

  <!-- Hero Section -->
  <header  class=" text-white py-20">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div>
        <h1 class="text-5xl font-cinzel">Exquisite Jewelry for Every Occasion</h1>
        <p class="mt-4 text-lg">Indulge in the timeless beauty of our jewelry, elevate your style and make every special moment even more unforgettable, Find the perfect piece that suits your style.</p>
        <button class="mt-6 bg-black hover:bg-gray-800 text-white py-2 px-6 rounded-lg">Shop Now</button>
      </div>
      <!-- Image Section -->
      <div class="ml-8 relative">
       
        <img src="../icons/necklaces.png" alt="Jewelry Image" class="w-100 h-auto object-cover rounded-lg">
      
      </div>
    </div>
  </header>
  <br>
  <div class="flex justify-center">
    <img src="../icons/line.png" alt="Line Separator" class="w-auto h-auto object-cover">
  </div>
  <br>
  <!-- Newest Collection Section -->
<section class="py-20 text-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-3xl font-bold">Newest Collection</h2>
    <p class="mt-4 text-lg">Explore the latest pieces from our exclusive collection</p>
    <div id="productCollection" class="mt-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <?php if (count($products) > 0): ?>
    <?php foreach ($products as $product) : ?>
      <a href="productDetail.php?id=<?php echo $product['product_id']; ?>" class="block group">
        <div class="relative group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105">
            <h3 class="text-center mt-4 text-lg font-medium text-white"><?php echo htmlspecialchars($product['name']); ?></h3>
            <p class="text-center mt-2 text-xl font-semibold text-gray-700">$<?php echo number_format($product['price'], 2); ?></p>
        </div>
      </a>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center text-lg text-gray-300">No products found in the latest collection.</p>
<?php endif; ?>

  
    </div>
    <div class="flex justify-center">
      <button class="mt-8 bg-black hover:bg-gray-800 text-white py-2 px-6 rounded-lg">
        Shop New Collection
      </button>
    </div>
</section>

<section class="py-20 text-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-3xl font-bold">Shop by Category</h2>
    <p class="mt-4 text-lg">Find your perfect jewelry by category</p>
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Rings -->
      <a href="shop.php?category=ring" class="block group">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/blue ring.png" alt="Rings" class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105">
          <h3 class="text-center mt-4 text-lg font-medium">Rings</h3>
        </div>
      </a>
      <!-- Necklaces -->
      <a href="shop.php?category=necklace" class="block group">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/necklaces.png" alt="Necklaces" class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105">
          <h3 class="text-center mt-4 text-lg font-medium">Necklaces</h3>
        </div>
      </a>
      <!-- Bracelets -->
      <a href="shop.php?category=bracelet" class="block group">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/braclet1.png" alt="Bracelets" class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105">
          <h3 class="text-center mt-4 text-lg font-medium">Bracelets</h3>
        </div>
      </a>
      <!-- Earrings -->
      <a href="shop.php?category=earring" class="block group">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/earings1.png" alt="Earrings" class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105">
          <h3 class="text-center mt-4 text-lg font-medium">Earrings</h3>
        </div>
      </a>
    </div>
  </div>
</section>
<section class="py-20 text-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-3xl font-bold">Shop by Material</h2>
    <p class="mt-4 text-lg">Discover pieces in your preferred material</p>
    <!-- Flexbox or Grid Layout -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
      <!-- Gold -->
      <a href="shop.php?material=Gold" class="block text-center">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/gold.png" alt="Gold" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
          <h4 class="mt-2 text-lg font-medium">Gold</h4>
        </div>
      </a>
      <!-- Silver -->
      <a href="shop.php?material=Silver" class="block text-center">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/silver.png" alt="Silver" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
          <h4 class="mt-2 text-lg font-medium">Silver</h4>
        </div>
      </a>
      <!-- Platinum -->
      <a href="shop.php?material=Platinum" class="block text-center">
        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <img src="../icons/platinum.png" alt="Platinum" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
          <h4 class="mt-2 text-lg font-medium">Platinum</h4>
        </div>
      </a>
    </div>
  </div>
</section>
<section class="testimonials py-12">
    <h2 class="text-3xl text-center text-white mb-8">What Our Customers Say</h2>
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="testimonial text-white rounded-lg shadow-lg p-6">
            <p>"I absolutely love my new necklace! The quality is amazing, and the design is stunning!"</p>
            <p class="mt-4 text-lg font-semibold">Jessica R.</p>
        </div>
        <div class="testimonial text-white rounded-lg shadow-lg p-6">
            <p>"The best shopping experience I've had. The rings are beautifully crafted!"</p>
            <p class="mt-4 text-lg font-semibold">Michael T.</p>
        </div>
        <div class="testimonial text-white rounded-lg shadow-lg p-6">
            <p>"Great quality jewelry at reasonable prices. I will definitely buy again!"</p>
            <p class="mt-4 text-lg font-semibold">Sarah M.</p>
        </div>
    </div>
</section>



  <!-- Footer -->
  <footer class=" text-white text-center py-4 mt-12 ">
    <p>&copy; 2024 Jewelry Store. All rights reserved.</p>
  </footer>
<script>document.addEventListener("DOMContentLoaded", () => {
  const dropdown = document.querySelector(".dropdown");
  const dropdownContent = document.getElementById("accountDropdown");

  let timeout;

  dropdown.addEventListener("mouseenter", () => {
    clearTimeout(timeout); // Cancel any pending hide action
    dropdownContent.style.visibility = "visible";
    dropdownContent.style.opacity = "1";
  });

  dropdown.addEventListener("mouseleave", () => {
    timeout = setTimeout(() => {
      dropdownContent.style.visibility = "hidden";
      dropdownContent.style.opacity = "0";
    }, 300); // Delay hiding by 300ms
  });

  dropdownContent.addEventListener("mouseenter", () => {
    clearTimeout(timeout); // Keep it visible if mouse enters the dropdown content
  });

  dropdownContent.addEventListener("mouseleave", () => {
    timeout = setTimeout(() => {
      dropdownContent.style.visibility = "hidden";
      dropdownContent.style.opacity = "0";
    }, 300); // Delay hiding when leaving the dropdown content
  });
});
</script>
</body>
</html>