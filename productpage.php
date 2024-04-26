<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_weight = $_POST['product_weight'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, weight, image, quantity) VALUES('$product_name', '$product_price', '$product_weight', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="CSS/index.css"></link>
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
      <img src="images/OGS_logo.png" alt="OGS logo" id="logo-button">
      <section class="right">
  
        <section class="search-bar">
          <input type="text" placeholder="What can we help you find?" maxlength="20">
          <i class='bx bx-search-alt' id="search-button"></i>
        </section>
  
        <a href="shoppingcart.php" class="bx bx-cart" id="cart-button"></a>
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
<script src="JS/index.js" type="module" defer></script>

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="images/<?php echo $fetch_product['image']; ?>" height="100" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Price: $<?php echo $fetch_product['price']; ?></div>
            <div class="quantity">Quantity: <?php echo $fetch_product['quantity']; ?> items left</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_weight" value="<?php echo $fetch_product['weight']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<script src="js/script.js"></script>

</body>
</header>
</html>