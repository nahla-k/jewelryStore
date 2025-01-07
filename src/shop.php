<?php
session_start();
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
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      function fetchProducts() {
        const searchInput = document.getElementById('search');
        const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';

        const params = new URLSearchParams();
        if (searchQuery) params.append('search', searchQuery);

        fetch('fetch_products.php?' + params.toString())
          .then(response => {
            if (!response.ok) throw new Error('Failed to fetch products');
            return response.text();
          })
          .then(data => {
            const productsContainer = document.getElementById('products-container');
            if (productsContainer) {
              productsContainer.innerHTML = data; // Insert only the product cards
            }
          })
          .catch(error => console.error('Error fetching products:', error));
      }

      const searchInput = document.getElementById('search');
      if (searchInput) {
        searchInput.addEventListener('input', fetchProducts);
      }
    });
  </script>
  <style>
    .filter-circle {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      cursor: pointer;
      border: 2px solid transparent;
      transition: border-color 0.3s;
    }

    .filter-circle:hover,
    .filter-circle.active {
      border-color: #ffffff;
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

  <div class="max-w-7xl mx-auto mt-8 px-5 ">
    <div class="relative">
      <input type="text" id="search" placeholder="Search Products..." class="w-full p-4 pl-12 rounded-lg bg-opacity-50  text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold bg-[#322f3133]">
      <img src="../icons/search-icon.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400">
    </div>
  </div>
  <div class="max-w-6xl mx-auto px-8 md:px-16">
    <div id="products-container" class="mt-12 mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4 md:px-8">
      <?php
      $host = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jewelryStore";
      $port = 3306;

      $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
      $pdo = new PDO($dsn, $username, $password);

      $category = isset($_GET['category']) ? $_GET['category'] : '';
      $material = isset($_GET['material']) ? $_GET['material'] : '';
      $search = isset($_GET['search']) ? $_GET['search'] : '';

      $sql = "SELECT product_id, name, description, price, category, material, stock_quantity, image_url FROM Products WHERE 1=1";

      $params = [];

      if (!empty($search)) {
        $sql .= " AND (name LIKE :search OR description LIKE :search)";
        $params[':search'] = '%' . $search . '%';
      }
      if (!empty($category)) {
        $sql .= " AND category = :category";
        $params[':category'] = $category;
      }

      if (!empty($material)) {
        $sql .= " AND material = :material";
        $params[':material'] = $material;
      }

      // Prepare and execute the query
      $stmt = $pdo->prepare($sql);
      $stmt->execute($params);



      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $product_id = $row["product_id"];
          $name = $row["name"];
          $description = $row["description"];
          $price = $row["price"];
          $category = $row["category"];
          $material = $row["material"];
          $stock_quantity = $row["stock_quantity"];
          $image_url = $row["image_url"];
      ?>
          <div class="product-card text-white rounded-lg shadow-lg p-6">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>" class="w-full h-48 object-cover rounded-t-lg">
            <div class="product-details mt-4">
              <h3 class="text-xl font-semibold"><?php echo $name; ?></h3>
              <p class="text-gray-500"><?php echo $description; ?></p>
              <p class="mt-2 text-lg font-semibold">$<?php echo number_format($price, 2); ?></p>
              <p class="text-gray-400 mt-1">Stock: <?php echo $stock_quantity; ?> available</p>
              <div class="mt-4">
                <a href="productDetail.php?id=<?php echo $product_id; ?>" class="bg-black text-white py-2 px-4 rounded-lg">View Product</a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No products available.</p>";
      }
      ?>
    </div>
  </div>
  <footer class="text-white text-center py-4 mt-12">
    <p>&copy; 2024 Jewelry Store. All rights reserved.</p>
  </footer>

</body>

</html>