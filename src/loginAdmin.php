<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin Login</title>
</head>
<body class="bg-[#141329] text-white font-poppins flex items-center justify-center min-h-screen">
  <div class="bg-[#1e1f34] p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-semibold text-center mb-6">Admin Login</h1>
    <form action="loginHandler.php" method="POST">
      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block mb-2 text-sm font-medium">Email Address</label>
        <input
          type="email"
          name="email"
          id="email"
          class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-[#1e1f34] focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter your email"
          required
        />
      </div>
      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
        <input
          type="password"
          name="password"
          id="password"
          class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-[#1e1f34] focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter your password"
          required
        />
      </div>
      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg shadow-md transition"
      >
        Login
      </button>
    </form>
    <p class="text-sm text-gray-400 text-center mt-4">
      Forgot your password? <a href="#" class="text-blue-400 hover:underline">Reset it</a>
    </p>
  </div>
</body>
</html>
