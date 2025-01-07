<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Analytics</title>
</head>
<body style="background-image: url('../icons/Texture.png'); background-color: #141329; background-blend-mode: overlay;" class="text-white font-poppins flex h-screen">
  <!-- Sidebar -->
  <div class="w-64 bg-[#1f1d1d] backdrop-blur-md shadow-lg flex flex-col">
    <div class="flex flex-col items-center py-6">
      <img src="https://via.placeholder.com/80" alt="Profile" class="w-20 h-20 rounded-full border-2 border-blue-500 mb-4">
      <p class="text-lg font-semibold">Good Morning, Ahmed</p>
      <p class="text-sm text-gray-400">Administrator</p>
    </div>
    <nav class="mt-6">
      <ul class="space-y-4">
        <li>
          <a href="dashboardAdmin.php" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-lg">
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
          <a href="products.php" class="flex items-center px-6 py-3 text-white bg-blue-500 rounded-lg relative">
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
    <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md mb-6">
      <h1 class="text-2xl font-semibold">Analytics</h1>
      <p class="text-gray-400">Monitor your store’s performance with insights and trends.</p>
    </div>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
      <!-- Card 1 -->
      <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
        <p class="text-gray-400 text-sm">Total Sales</p>
        <h2 class="text-3xl font-bold mt-2">$120,000</h2>
        <p class="text-green-500 text-sm mt-1">+15% from last month</p>
      </div>
      <!-- Card 2 -->
      <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
        <p class="text-gray-400 text-sm">Orders Completed</p>
        <h2 class="text-3xl font-bold mt-2">1,245</h2>
        <p class="text-green-500 text-sm mt-1">+10% from last month</p>
      </div>
      <!-- Card 3 -->
      <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
        <p class="text-gray-400 text-sm">New Customers</p>
        <h2 class="text-3xl font-bold mt-2">340</h2>
        <p class="text-red-500 text-sm mt-1">-5% from last month</p>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md mb-6">
      <h2 class="text-xl font-semibold mb-4">Sales Performance</h2>
      <img src="https://via.placeholder.com/600x300" alt="Chart Placeholder" class="rounded-lg w-full">
    </div>

    <!-- Customer Insights -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Top Products -->
      <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-4">Top Products</h2>
        <ul class="space-y-3">
          <li class="flex justify-between">
            <span>Diamond Ring</span>
            <span>$12,000</span>
          </li>
          <li class="flex justify-between">
            <span>Gold Necklace</span>
            <span>$8,000</span>
          </li>
          <li class="flex justify-between">
            <span>Platinum Bracelet</span>
            <span>$5,500</span>
          </li>
        </ul>
      </div>
      <!-- Active Customers -->
      <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-4">Active Customers</h2>
        <ul class="space-y-3">
          <li class="flex justify-between">
            <span>Floyd Miles</span>
            <span>$1,200</span>
          </li>
          <li class="flex justify-between">
            <span>Arlene McCoy</span>
            <span>$980</span>
          </li>
          <li class="flex justify-between">
            <span>Dianne Russell</span>
            <span>$750</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
