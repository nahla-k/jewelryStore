<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Manage Products</title>
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
      <h1 class="text-2xl font-semibold">Manage Products</h1>
      <p class="text-gray-400">Add, edit, or remove products in your inventory.</p>
    </div>

    <!-- Add Product Button -->
    <div class="flex justify-end mb-6">
      <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg" onclick="toggleModal('addModal')">
        + Add Product
      </button>
    </div>
    <!-- Add Product Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
    <h2 class="text-lg font-semibold mb-4">Add Product</h2>
    <form>
      <label class="block mb-2">Product Name</label>
      <input type="text" class="w-full border border-gray-300 rounded p-2 mb-4" />
      <label class="block mb-2">Price</label>
      <input type="number" class="w-full border border-gray-300 rounded p-2 mb-4" />
      <label class="block mb-2">Stock Quantity</label>
      <input type="number" class="w-full border border-gray-300 rounded p-2 mb-4" />
      <div class="flex justify-end space-x-4">
        <button type="button" class="bg-gray-300 px-4 py-2 rounded" onclick="toggleModal('addModal')">
          Cancel
        </button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
          Add
        </button>
      </div>
    </form>
  </div>
</div>
    <!-- Products Table -->
    <div class="bg-[#1f1d1d] rounded-xl shadow-md p-6 overflow-auto">
      <table class="table-auto w-full text-sm text-left text-gray-400">
        <thead>
          <tr class="bg-gray-800 text-gray-300">
            <th class="px-4 py-3">Product Name</th>
            <th class="px-4 py-3">Category</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Stock</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Example Product Row -->
          <tr class="border-b border-gray-700">
            <td class="px-4 py-3">Diamond Ring</td>
            <td class="px-4 py-3">Rings</td>
            <td class="px-4 py-3">$1,200</td>
            <td class="px-4 py-3">15</td>
            <td class="px-4 py-3">
              <button class="text-blue-400 hover:text-blue-500">Edit</button>
              <span class="mx-2">|</span>
              <button class="text-red-400 hover:text-red-500">Delete</button>
            </td>
          </tr>
          <tr class="border-b border-gray-700">
            <td class="px-4 py-3">Gold Necklace</td>
            <td class="px-4 py-3">Necklaces</td>
            <td class="px-4 py-3">$900</td>
            <td class="px-4 py-3">20</td>
            <td class="px-4 py-3">
              <button class="text-blue-400 hover:text-blue-500">Edit</button>
              <span class="mx-2">|</span>
              <button class="text-red-400 hover:text-red-500">Delete</button>
            </td>
          </tr>
          <tr>
            <td class="px-4 py-3">Platinum Bracelet</td>
            <td class="px-4 py-3">Bracelets</td>
            <td class="px-4 py-3">$700</td>
            <td class="px-4 py-3">12</td>
            <td class="px-4 py-3">
              <button class="text-blue-400 hover:text-blue-500">Edit</button>
              <span class="mx-2">|</span>
              <button class="text-red-400 hover:text-red-500">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script>
  function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
  }
</script>
</body>
</html>
