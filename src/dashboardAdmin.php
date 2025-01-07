<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Jewelry Store Dashboard</title>
  <style>
    .item {
      background-color: rgba(30, 31, 52, 0.3);
      backdrop-filter: blur(10px);
      border-radius: 10px;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background-color: white;
      min-width: 250px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }
    .dropdown:hover .dropdown-content {
      display: block;
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
          <a href="dashboardAdmin.php" class="flex items-center px-6 py-3 bg-blue-500 rounded-lg relative">  
          <span class="absolute right-0 h-full w-1 bg-blue-300"></span>

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
            <i class="mr-3">💎</i> Manage Products
          </a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="flex-1">
    <!-- Header -->
    <header class="flex justify-between items-center bg-[#322f3133] p-6 shadow-md">
      <div>
        <h1 class="text-2xl font-semibold">Dashboard Overview</h1>
        <p class="text-gray-400">A quick look at your jewelry store's key metrics.</p>
      </div>
      <div class="relative flex items-center">
        <!-- Notification Bell -->
        <div class="dropdown relative">
          <button class="text-white text-2xl mr-4">
            <img src="..\icons\icons8-bell-50.png" class="w-8 h-8"></>
          </button>
          <!-- Dropdown Content -->
          <div class="dropdown-content bg-white text-black p-4 rounded-md shadow-lg">
            <h3 class="font-semibold text-gray-800 mb-2">Notifications</h3>
            <ul>
              <li class="py-2 border-b border-gray-300 text-sm">
                <span class="font-medium">Order #12345</span> needs attention.
              </li>
              <li class="py-2 border-b border-gray-300 text-sm">
                <span class="font-medium">Product A</span> is low on stock.
              </li>
              <li class="py-2 text-sm">
                <span class="font-medium">Shipping Update:</span> Order #67890 shipped.
              </li>
            </ul>
          </div>
        </div>
        <img src="https://via.placeholder.com/40" alt="Admin Avatar" class="w-10 h-10 rounded-full">
      </div>
    </header>

    <!-- Content Grid -->
    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Active Order Section -->
      <div class="item  p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-2">Active Order</h2>
        <p class="text-gray-400 mb-4">Order #13024 - 12 products</p>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition">
          View Details
        </button>
      </div>

      <!-- Sales Performance Section -->
      <div class="item  p-6 shadow-md lg:col-span-2">
        <h2 class="text-xl font-semibold mb-2">Sales Performance</h2>
        <p class="text-gray-400 mb-4">Track your sales and revenue over time.</p>
        <div class="h-40 bg-[#322f3133] rounded-lg flex items-center justify-center">
          <p class="text-gray-500">[Chart Placeholder]</p>
        </div>
      </div>
            <!-- Shipping Section -->
            <div class="item  p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-2">Shipping</h2>
        <p class="text-gray-400 mb-4">25 open shipments</p>
        <ul class="space-y-2">
          <li class="flex justify-between text-gray-300">
            <span>Floyd Miles</span>
            <span>13/09/2022</span>
          </li>
          <li class="flex justify-between text-gray-300">
            <span>Arlene McCoy</span>
            <span>13/09/2022</span>
          </li>
          <li class="flex justify-between text-gray-300">
            <span>Dianne Russell</span>
            <span>13/09/2022</span>
          </li>
        </ul>
      </div>

      <!-- Credit Balance Section -->
      <div class="item p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-2">Credit Balance</h2>
        <h3 class="text-3xl font-bold text-blue-400 mb-4">$21,000.00</h3>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition">
          View Details
        </button>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
