<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../CSS/index.css"></link>
  <title>Food Store</title>
</head>

<body>
  <div class="top-bar-1" data-dark-mode="background">
    <div class="bumper">
      <p data-dark-mode="text">Shop and Enjoy our free delivery with orders 20lbs and under!</p>
      <div class="switch" id="theme-toggle-button">
        <span class="selector"></span>
        <i class='bx bxs-sun'></i>
        <i class='bx bxs-moon'></i>
      </div>
    </div>
  </div>

  <div class="top-bar-2">
    <div class="bumper">
      <img src="../IMAGES/OGS_logo.png" alt="OGS logo" id="logo-button">
      <section class="right">
  
        <section class="search-bar">
          <input type="text" placeholder="What can we help you find?" maxlength="20">
          <i class='bx bx-search-alt' id="search-button"></i>
        </section>
  
        <i class='bx bx-cart' id="cart-button" data-dark-mode="text"></i>
        <i class='bx bx-user-circle' id="account-button" data-dark-mode="text" ></i>
  
        <?php if (isset($_SESSION["user"])): ?>
          <h2 id="logout-button" data-dark-mode="text">Log Out</h2>
        <?php else: ?>
          <h2 id="login-button" data-dark-mode="text">Log In</h2>
        <?php endif; ?>
      </section>
    </div>
  </div>

  <nav data-dark-mode="both">
    <div class="bumper">
      <h2 id="home-button">HOME</h2>
      <h2 id="explore-button">EXPLORE</h2>
      <h2 id="categories-button">CATEGORIES<i class='bx bx-chevron-down'></i></h2>
      <div class="dropdown hidden" data-dark-mode="both">
        <ul>
          <li>Meat & Seafood</li>
          <li>Vegetables</li>
          <li>Fruits</li>
          <li>Dairy</li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="space"></div>

</body>
<script src="../JS/index.js" type="module" defer></script>
<script src="../JS/topbar.js" type="module" defer></script>
</html>
