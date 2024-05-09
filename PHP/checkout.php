<?php
session_start();
include 'config.php';
include 'retrieve_account.php';
$customer_id = $_SESSION["user"];






$name = $data['first_name'].' '.$data['last_name'];
$number = $data['phone'];
$email = $data['email'];
$street_name = $data['street_name'];
$apartment_number = $data['apartment_number'];
$city = $data['city'];
$state = $data['state'];
$zipcode = $data['zipcode'];


if(isset($_POST['order_btn'])){

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_query = mysqli_query($conn, "UPDATE store_inventory SET item_quantity = item_quantity - ". $product_item['quantity']. " WHERE item_name = '". $product_item['name']. "'") or die('query failed');
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders_history`(customer_id, name, number, email, street_name, apartment_number, city, state, zipcode, total_product, total_price) VALUES('$customer_id','$name', '$number', '$email', '$street_name', '$apartment_number', '$city', '$state', '$zipcode', '$total_product', '$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      mysqli_query($conn, "DELETE FROM `cart`");
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your phone number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$street_name.", ".$apartment_number.", ".$city.", ".$state.", ".$zipcode."</span> </p>
         </div>
            <a href='../PHP/productpage.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../CSS/index.css"></link>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/topbar.js"></script>
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

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?></span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>Credit Card name</span>
            <input type="text" placeholder="Name on Card" name="payment_name" required>
         </div>
         <div class="inputBox">
            <span>Credit Card number</span>
            <input type="number" placeholder="Credit/Debit Card Number" name="payment_number" required>
         </div>
         <div class="inputBox">
            <span>CCV</span>
            <input type="number" placeholder="Credit/Debit Card CCV" name="payment_ccv" required>
         </div>
         
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>