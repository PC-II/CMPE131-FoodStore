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
          <input type="text" placeholder="What can we help you find?">
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
  
  <main>
    <div class="bumper">
      <section class="hero-delivery">
        <div data-dark-mode="text">
          <h1>Try our <span>brand new</span> delivery service!</h1>
          <h2>Fast, Simple, and Affordable.</h2>
          <button>Get started <i class='bx bx-right-arrow-alt'></i></button>
        </div>
        <img src="../IMAGES/food_delivery.png" alt="food being delivered">
      </section>
      
      <section class="carousel">
        <!-- images -->
        <div class="slides" data-dark-mode="background">
          <div><img src="../IMAGES/free_delivery_ad.png" alt="OGS free delivery ad"></div>
          <div><img src="../IMAGES/food_delivery.png" alt="2"></div>
          <div><img src="../IMAGES/OGS_logo.png" alt="3"></div>
          <div><img src="../IMAGES/image_four.jpg" alt="4"></div>
          <div><img src="../IMAGES/image_five.png" alt="5"></div>
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
  
      <section class="chat-bot">
        <div class="greeting">
          <h1 data-dark-mode="text"><span>Welcome,</span><br>How can I help you?</h1>
        </div>
        <div class="suggestions">
          <div class="box"><p>What are some popular foods I can make for dinner?</p></div>
          <div class="box"><p>Im making chiliqueles tonight, what are some ingredients I might need?</p></div>
          <div class="box"><p>What spices pair well with chicken parmesian?</p></div>
        </div>
        <form class="user-field" data-dark-mode="background">
          <textarea placeholder="Type your prompt here..." name="user-input" id="user-input" rows="1"></textarea>
          <i class='bx bx-send' id="bot-submit-button" data-dark-mode="text"></i>
        </form>
        <div class="bot-response">

        </div>
      </section>

    </div>
  </main>

  <footer data-dark-mode="both">
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