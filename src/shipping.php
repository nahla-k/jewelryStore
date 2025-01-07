<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Shipping Management</title>
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
      <h1 class="text-2xl font-semibold">Manage Shipping</h1>
      <p class="text-gray-400">Track, update, and manage all shipments and deliveries.</p>
    </div>

    <!-- Shipping Table -->
    <div class="bg-[#1f1d1d] rounded-xl p-6 shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Shipping Overview</h2>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition">
          Add Shipment
        </button>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-sm">
          <thead>
            <tr class="bg-[#2a292a] text-left text-gray-400 uppercase tracking-wider">
              <th class="py-3 px-4">Tracking ID</th>
              <th class="py-3 px-4">Customer Name</th>
              <th class="py-3 px-4">Address</th>
              <th class="py-3 px-4">Date</th>
              <th class="py-3 px-4">Status</th>
              <th class="py-3 px-4">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700">
            <tr class="hover:bg-[#3a3839]">
              <td class="py-3 px-4">#T12345</td>
              <td class="py-3 px-4">Floyd Miles</td>
              <td class="py-3 px-4">4517 Washington Ave, MK 39495</td>
              <td class="py-3 px-4">13/09/2022</td>
              <td class="py-3 px-4">
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Delivered</span>
              </td>
              <td class="py-3 px-4">
                <button class="text-blue-400 hover:underline mr-3">View</button>
                <button class="text-yellow-400 hover:underline">Update</button>
              </td>
            </tr>
            <tr class="hover:bg-[#3a3839]">
              <td class="py-3 px-4">#T12346</td>
              <td class="py-3 px-4">Kristin Watson</td>
              <td class="py-3 px-4">2464 Royal Ln, Mesa, NJ 45463</td>
              <td class="py-3 px-4">14/09/2022</td>
              <td class="py-3 px-4">
                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs">In Transit</span>
              </td>
              <td class="py-3 px-4">
                <button class="text-blue-400 hover:underline mr-3">View</button>
                <button class="text-yellow-400 hover:underline">Update</button>
              </td>
            </tr>
            <tr class="hover:bg-[#3a3839]">
              <td class="py-3 px-4">#T12347</td>
              <td class="py-3 px-4">Dianne Russell</td>
              <td class="py-3 px-4">8502 Preston Rd, IM 98380</td>
              <td class="py-3 px-4">15/09/2022</td>
              <td class="py-3 px-4">
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">Cancelled</span>
              </td>
              <td class="py-3 px-4">
                <button class="text-blue-400 hover:underline mr-3">View</button>
                <button class="text-yellow-400 hover:underline">Update</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
