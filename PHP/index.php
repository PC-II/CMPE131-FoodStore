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
    <img src="" alt="">
    <h1 class="title">OGS</h1>
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

  <div class="top-bar-2">
    <h2>HOME</h2>
    <h2 id="explore-button">EXPLORE</h2>
    <h2 id="categories-button">CATEGORIES</h2>
    <h2 id="about-us-button">ABOUT US</h2>
    <h2 id="contact-button">CONTACT US</h2>



  </div>

  <div class="main">
    <img src="../IMAGES/main_placeholder.png" alt="">
  </div>

</body>
<script src="../JS/index.js"></script>
</html>