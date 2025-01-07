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
