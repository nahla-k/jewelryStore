<?php
// Start the session to track user
session_start();

// Database connection using PDO
$host = "localhost";
$username = "root";
$password = "";
$dbname = "jewelryStore";
$port = 3306;
$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch product ID from URL
$product_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    echo "Invalid product ID.";
    exit;
}

// Fetch product details from the database
$stmt = $pdo->prepare("
    SELECT product_id, name, description, price, category, material, stock_quantity, image_url 
    FROM Products 
    WHERE product_id = :product_id
");
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}

// Check if the product is in the user's favorites
$is_favorite = false;

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $user_id = $_SESSION['user_id'];

    $is_favorite_sql = "SELECT COUNT(*) FROM wishlist WHERE customer_id = :customer_id AND product_id = :product_id";
    $is_favorite_stmt = $pdo->prepare($is_favorite_sql);
    $is_favorite_stmt->bindParam(':customer_id', $user_id, PDO::PARAM_INT);
    $is_favorite_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $is_favorite_stmt->execute();

    $is_favorite = $is_favorite_stmt->fetchColumn() > 0;
}

// The `$product` array now contains product details.
// The `$is_favorite` variable indicates whether the product is in the user's favorites.
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* Flex container to arrange the image and details side by side */
    .product-detail-container {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 30px; /* space between image and details */
      margin-top: 20px;
    }

    /* Product image styling */
    .product-image {
      flex: 1;
      max-width: 400px; /* Maximum width for the image */
      height: auto;
    }

    .product-image img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 10px;
    }

    /* Product details container */
    .product-details {
      flex: 2;
      max-width: 600px;
      text-align: left;
      color: white;
    }

    /* Quantity buttons */
    .product-quantity {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 20px;
    }

    .quantity-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 30px;
      height: 30px;
      background-color: #333;
      color: white;
      border-radius: 50%;
      cursor: pointer;
    }

    .quantity-input {
      width: 50px;
      text-align: center;
      background-color: #222;
      color: white;
      border-radius: 8px;
      border: none;
      padding: 5px;
    }

    .add-to-cart-btn {
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #000;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
    }

    .add-to-cart-btn:hover {
      background-color: #444;
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
  <div class="max-w-7xl mx-auto px-5 text-white">
    <div class="breadcrumb">
      <a href="index.php">Home</a> > <a href="shop.php">Shop</a> > <span><?php echo htmlspecialchars($product['name']); ?></span>
    </div>
  </div>
  <div class="max-w-7xl mx-auto mt-12 px-5">
    <div class="product-detail-container">
      <!-- Product Image -->
      <div class="product-image">
        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
      </div>

      <!-- Product Details -->
      <div class="product-details">
        <h2 class="text-3xl font-semibold"><?php echo $product['name']; ?></h2>
        <p class="text-lg mt-4"><?php echo $product['description']; ?></p>
        <p class="mt-4 text-xl font-semibold">$<?php echo number_format($product['price'], 2); ?></p>
        <p class="text-lg mt-2">Category: <span class="font-medium"><?php echo ucfirst($product['category']); ?></span></p>
        <p class="text-lg">Material: <span class="font-medium"><?php echo ucfirst($product['material']); ?></span></p>
        <p class="text-lg">Stock: <span class="font-medium"><?php echo $product['stock_quantity']; ?> available</span></p>

        <!-- Quantity Selector -->
        <div class="product-quantity">
          <span class="quantity-btn" onclick="decreaseQuantity()">-</span>
          <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>">
          <span class="quantity-btn" onclick="increaseQuantity()">+</span>
        </div>

        <!-- Add to Cart Button -->
  
        <!-- Add to Cart and Favorite Buttons -->
<div class="flex flex-wrap items-center gap-8 mt-6">
  <!-- Add to Cart Button -->
  <button class="flex-grow bg-black text-white py-2 px-4 rounded-lg hover:bg-gray-800 transition-colors addToCartButton" 
          data-id="<?php echo $product['product_id']; ?>" 
          onclick="addToCart(<?php echo $product['product_id']; ?>, 'quantity')">
    Add to Cart
  </button>

  <!-- Favorite Icon -->
<!-- Favorite Icon -->
<div id="favoriteIcon<?php echo $product['product_id']; ?>" 
     class="w-12 h-12 rounded-full flex items-center justify-center cursor-pointer transition-colors <?php echo $is_favorite ? 'bg-red-500' : 'bg-[#322f3133]'; ?>" 
     onclick="toggleFavorite(<?php echo $product['product_id']; ?>, <?php echo $is_favorite ? 'true' : 'false'; ?>)">
  <svg id="heartIcon<?php echo $product['product_id']; ?>" xmlns="http://www.w3.org/2000/svg" fill="<?php echo $is_favorite ? 'red' : 'none'; ?>" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
  </svg>
</div>


</div>

      </div>
    </div>
  </div>

  <footer class="text-white text-center py-4 mt-12">
    <p>&copy; 2024 Jewelry Store. All rights reserved.</p>
  </footer>

  <script>
function toggleFavorite(productId, isFavorite) {
    const url = isFavorite ? 'removeFavorite.php' : 'addToFavorites.php';
    const data = isFavorite ? { favorite_id: productId } : { product_id: productId };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const iconDiv = document.getElementById(`favoriteIcon${productId}`);
            const heartIcon = document.getElementById(`heartIcon${productId}`);
            
            if (isFavorite) {
                iconDiv.classList.remove('bg-red-500');
                iconDiv.classList.add('bg-[#322f3133]');
                heartIcon.setAttribute('fill', 'none');
            } else {
                iconDiv.classList.remove('bg-[#322f3133]');
                iconDiv.classList.add('bg-red-500');
                heartIcon.setAttribute('fill', 'red');
            }
        } else {
            alert(data.message || 'An error occurred.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
}


function increaseQuantity() {
  let quantityInput = document.getElementById('quantity');
  let quantity = parseInt(quantityInput.value);
  let maxQuantity = <?php echo $product['stock_quantity']; ?>;
  if (quantity < maxQuantity) {
    quantityInput.value = quantity + 1;
  }
}

function decreaseQuantity() {
  let quantityInput = document.getElementById('quantity');
  let quantity = parseInt(quantityInput.value);
  if (quantity > 1) {
    quantityInput.value = quantity - 1;
  }
}

  </script>
<script>

function addToCart(productId, quantityInputId) {
    const quantity = document.getElementById(quantityInputId).value;

    if (quantity <= 0) {
        alert('Please enter a valid quantity.');
        return;
    }

    // Send POST request to addToCart.php
    fetch('addtoCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${quantity}`,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message);
                console.log('Cart:', data.cart);
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An error occurred while adding the product to the cart.');
        });
}



</script>
</body>
</html>
