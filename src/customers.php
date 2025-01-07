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
  <div class="p-6 bg-[#322f3133] min-h-screen">
  <h1 class="text-2xl font-semibold text-white mb-6">Customer Management</h1>
  <div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Search and Filter -->
    <div class="flex justify-between items-center mb-4">
      <input
        type="text"
        placeholder="Search customers..."
        class="border border-gray-300 rounded p-2 w-1/3"
      />
      <select class="border border-gray-300 rounded p-2">
        <option value="all">All Customers</option>
        <option value="vip">VIP Customers</option>
        <option value="recent">Recently Added</option>
      </select>
    </div>
    <!-- Customer Table -->
    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">Customer Name</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Total Orders</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Row -->
        <tr>
          <td class="border border-gray-300 px-4 py-2">Jane Doe</td>
          <td class="border border-gray-300 px-4 py-2">jane.doe@example.com</td>
          <td class="border border-gray-300 px-4 py-2">+1 234 567 890</td>
          <td class="border border-gray-300 px-4 py-2">12</td>
          <td class="border border-gray-300 px-4 py-2">
            <button class="text-blue-500">View</button>
            <button class="text-red-500 ml-2">Delete</button>
          </td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">John Smith</td>
          <td class="border border-gray-300 px-4 py-2">john.smith@example.com</td>
          <td class="border border-gray-300 px-4 py-2">+1 345 678 901</td>
          <td class="border border-gray-300 px-4 py-2">5</td>
          <td class="border border-gray-300 px-4 py-2">
            <button class="text-blue-500">View</button>
            <button class="text-red-500 ml-2">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
