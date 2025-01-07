<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Jewelry Store Dashboard</title>
  <style>
    .item{
    background-color: rgba(30, 31, 52, 0.3);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    }
  </style>
</head>
<body style="background-image: url('../icons/Texture.png'); background-color: #141329; background-blend-mode: overlay;" class="text-white font-poppins flex h-screen">

  <!-- Sidebar -->
  <div class="item w-64  backdrop-blur-md shadow-lg flex flex-col">
    <div class="flex flex-col items-center py-6">
      <img src="https://via.placeholder.com/80" alt="Profile" class="w-20 h-20 rounded-full border-2 border-blue-500 mb-4">
      <p class="text-lg font-semibold">Good Morning, Ahmed</p>
      <p class="text-sm text-gray-400">Administrator</p>
    </div>
    <nav class="mt-6">
      <ul class="space-y-4">
        <li>
          <a href="dashboardAdmin.php" class="flex items-center px-6 py-3 bg-blue-500 rounded-lg">  
          <i class="mr-3">🏠</i> Dashboard
          </a>
        </li>
        <li>
          <a href="orders.php" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-lg">
            <i class="mr-3">📦</i> Orders
          </a>
        </li>
        <li>
          <a href="shipping.php" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-lg">
            <i class="mr-3">🚚</i> Shipping
          </a>
        </li>
        <li>
          <a href="analytics.php" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-lg">
            <i class="mr-3">📊</i> Analytics
          </a>
        </li>
        <li>
          <a href="products.php" class="flex items-center px-6 py-3 text-white hover:bg-gray-700 rounded-lg relative">
            <span class="absolute left-0 h-full w-1 bg-blue-300"></span>
            <i class="mr-3">💎</i> Manage Products
          </a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6 overflow-auto">
    <!-- Header -->
    <div class="p-6 bg-[#322f3133] min-h-screen">
  <h1 class="text-2xl font-semibold text-white mb-6">Stock Management</h1>
  <div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Search and Filter -->
    <div class="flex justify-between items-center mb-4">
      <input
        type="text"
        placeholder="Search for a product..."
        class="border border-gray-300 rounded p-2 w-1/3"
      />
      <button class="bg-blue-500 text-white px-4 py-2 rounded-md">
        Add New Product
      </button>
    </div>
    <!-- Stock Table -->
    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">Product</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Stock Level</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Row -->
        <tr>
          <td class="border border-gray-300 px-4 py-2">Gold Necklace</td>
          <td class="border border-gray-300 px-4 py-2">Necklaces</td>
          <td class="border border-gray-300 px-4 py-2">5</td>
          <td class="border border-gray-300 px-4 py-2 text-red-500">Low Stock</td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">Silver Bracelet</td>
          <td class="border border-gray-300 px-4 py-2">Bracelets</td>
          <td class="border border-gray-300 px-4 py-2">25</td>
          <td class="border border-gray-300 px-4 py-2 text-green-500">In Stock</td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">Platinum Ring</td>
          <td class="border border-gray-300 px-4 py-2">Rings</td>
          <td class="border border-gray-300 px-4 py-2">2</td>
          <td class="border border-gray-300 px-4 py-2 text-red-500">Low Stock</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
  </div>
</body>