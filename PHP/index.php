<?php
  session_start();
  ?>
  
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
  <div class="offer-bar">
    Shop and Enjoy our free delivery with orders 20lbs and under!
  </div>

  <div class="top-bar-1">
    <div class="bumper">
      <img src="../IMAGES/OGS_logo.png" alt="OGS logo" id="logo-button">
      <section class="right">
  
        <section class="search-bar">
          <input type="text" placeholder="What can we help you find?">
          <i class='bx bx-search-alt' id="search-button"></i>
        </section>
  
        <i class='bx bx-cart' id="cart-button"></i>
        <i class='bx bx-user-circle' id="account-button" ></i>
  
        <?php if (isset($_SESSION["user"])): ?>
          <h2 id="logout-button">Log Out</h2>
        <?php else: ?>
          <h2 id="login-button">Log In</h2>
        <?php endif; ?>
      </section>
    </div>
  </div>

  <div class="top-bar-2">
    <div class="bumper">
      <h2 id="home-button">HOME</h2>
      <h2 id="explore-button">EXPLORE</h2>
      <h2 id="categories-button">CATEGORIES<i class='bx bx-chevron-down'></i></h2>
      <div class="dropdown hidden">
        <ul>
          <li>Meat & Seafood</li>
          <li>Vegetables</li>
          <li>Fruits</li>
          <li>Dairy</li>
        </ul>
      </div>
      <h2 id="about-us-button">ABOUT US</h2>
      <h2 id="contact-button">CONTACT US</h2>
    </div>
  </div>

  <div class="bumper">
    <div class="main">
      <div class="hero">
        <img src="../IMAGES/food_delivery.png" alt="food being delivered">

      </div>
      <div class="carousel">
      </div>
  
    </div>

  </div>

  <footer>
    <div class="bumper">
      <p>© 2024 <a href="./index.php">OGS Marketplace™</a>. All Rights Reserved.</p>
      <div>
        <ul>
          <li>About</li>
          <li>Privacy Policy</li>
          <li>Licensing</li>
          <li>Contact</li>
        </ul>
      </div>
    </div>
  </footer>


</body>
<script src="../JS/index.js"></script>
</html>