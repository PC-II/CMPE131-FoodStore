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
  <div class="top-bar-1">
    <div class="bumper">
      <p>Shop and Enjoy our free delivery with orders 20lbs and under!</p>
      <div class="switch">
        <span class="selector"></span>
        <i class='bx bxs-sun' id="sun-button"></i>
        <i class='bx bxs-moon' id="moon-button"></i>
      </div>
    </div>
  </div>

  <div class="top-bar-2">
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

  <nav>
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
    </div>
  </nav>

  <div class="space"></div>
  
  <main>
    <div class="bumper">
      <section class="hero-delivery">
        <div>
          <h1>Try our <span>brand new</span> delivery service!</h1>
          <h2>Fast, Simple, and Affordable.</h2>
          <button>Get started <i class='bx bx-right-arrow-alt'></i></button>
        </div>
        <img src="../IMAGES/food_delivery.png" alt="food being delivered">
        </section>
      
      <section class="carousel">
        <!-- images -->
        <div class="slides">
          <div><img src="../IMAGES/free_delivery.png" alt="OGS free delivery ad"></div>
          <div><img src="../IMAGES/food_delivery.png" alt="2"></div>
          <div><img src="../IMAGES/OGS_logo.png" alt="3"></div>
          <div><img src="" alt="4"></div>
          <div><img src="" alt="5"></div>
        </div>
        <!-- left and right arrows -->
        <div class="arrows">
          <button id="carousel-left-button"><i class='bx bx-chevron-left' ></i></button>
          <button id="carousel-right-button"><i class='bx bx-chevron-right' ></i></button>
        </div>
        <!-- Current image buttons -->
        <div class="buttons">
          <button></button>
          <button></button>
          <button></button>
          <button></button>
          <button></button>
        </div>
      </section>
  
      
    </div>
  </main>

  <footer>
    <div class="bumper">
      <p>© 2024 <a href="./index.php">OGS Marketplace™</a>. All Rights Reserved.</p>
      <div>
        <ul>
          <li id="about-button">About</li>
          <li>Privacy Policy</li>
          <li>Licensing</li>
          <li id="contact-button">Contact</li>
        </ul>
      </div>
    </div>
  </footer>


</body>
<script src="../JS/index.js" defer></script>
</html>