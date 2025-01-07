<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    /* General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1F2A48, #121A32);
      color: #FFFFFF;
      margin: 0;
      display: flex;
      height: 100vh;
    }

    /* Sidebar Styling */
    .sidebar {
      width: 250px;
      background: rgba(31, 42, 72, 0.8);
      backdrop-filter: blur(10px);
      border-right: 1px solid rgba(255, 255, 255, 0.1);
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 2px solid #1E90FF;
    }

    .sidebar .nav-links {
      list-style: none;
      padding: 0;
      margin: 0;
      width: 100%;
    }

    .sidebar .nav-links li {
      width: 100%;
      margin: 10px 0;
    }

    .sidebar .nav-links a {
      text-decoration: none;
      font-size: 16px;
      color: #FFFFFF;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      border-radius: 8px;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .sidebar .nav-links a:hover {
      background: rgba(0, 191, 255, 0.2);
      transform: translateX(5px);
    }

    .sidebar .nav-links i {
      font-size: 18px;
    }

    /* Main Content Styling */
    .container {
      flex: 1;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .glass-card {
      background: rgba(31, 42, 72, 0.7);
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .section-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .info {
      margin: 10px 0;
      font-size: 14px;
      color: #ADB5BD;
    }

    .button-glow {
      background: linear-gradient(45deg, #00BFFF, #1E90FF);
      color: #FFFFFF;
      padding: 10px 20px;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 191, 255, 0.4);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .button-glow:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 12px rgba(0, 191, 255, 0.6);
    }

    .card-title {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 8px;
    }
  </style>
  <title>Jewelry Store Dashboard</title>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="path/to/profile-pic.jpg" alt="Profile Picture">
    <ul class="nav-links">
      <li><a href="#"><i>🏠</i> Dashboard</a></li>
      <li><a href="#"><i>📦</i> Orders</a></li>
      <li><a href="#"><i>🎨</i> Design</a></li>
      <li><a href="#"><i>🚚</i> Shipping</a></li>
      <li><a href="#"><i>📊</i> Analytics</a></li>
      <li><a href="#"><i>⚙️</i> Settings</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="container">
    <!-- Header -->
    <header class="glass-card">
      <h1 class="section-title">Good Morning, Ahmed</h1>
      <p class="info">Here's the latest overview of your jewelry store</p>
    </header>

    <!-- Main Dashboard -->
    <section class="grid">
      <!-- Active Order -->
      <div class="glass-card">
        <h2 class="section-title">Active Order</h2>
        <p class="info">Order #13024 - 12 products</p>
        <button class="button-glow">View Details</button>
      </div>

      <!-- Design Section -->
      <div class="glass-card">
        <h2 class="section-title">Design</h2>
        <p class="info">9 products in Design</p>
        <div class="grid">
          <div>
            <img src="path/to/your-image.jpg" alt="Product" style="width: 100%; border-radius: 12px;">
            <h3 class="card-title">Product Name</h3>
            <p class="info">Color: Blue</p>
          </div>
        </div>
      </div>

      <!-- Shipping Section -->
      <div class="glass-card">
        <h2 class="section-title">Shipping</h2>
        <p class="info">25 open shipments</p>
        <ul>
          <li>Floyd Miles - 13/09/2022</li>
          <li>Arlene McCoy - 13/09/2022</li>
          <li>Dianne Russell - 13/09/2022</li>
        </ul>
      </div>

      <!-- Credit Balance -->
      <div class="glass-card">
        <h2 class="section-title">Credit Balance</h2>
        <h3 style="font-size: 36px; font-weight: 700;">$21,000.00</h3>
        <button class="button-glow">View Details</button>
      </div>
    </section>
  </div>
</body>
</html>
