<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_weight = $_POST['product_weight'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $product_category = $_POST['product_category'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, weight, image, quantity, category) VALUES('$product_name', '$product_price', '$product_weight', '$product_image', '$product_quantity', '$product_category')");
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

  <div class="space"></div>

</body>

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php

      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
        if((mysqli_num_rows($select_products) > 0)){
          while($fetch_product = mysqli_fetch_assoc($select_products)){
      
      if($fetch_product['category'] = "Meat" || "M" || "meat" || "m") {
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="images/<?php echo $fetch_product['image']; ?>" width="300" height="300" display="block" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Price: $<?php echo $fetch_product['price']; ?></div>
            <div class="weight">Weight: <?php echo $fetch_product['weight']; ?> lbs</div>
            <div class="quantity">Quantity: <?php echo $fetch_product['quantity']; ?> items left</div>
            <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" step="any" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" step="any" name="product_weight" value="<?php echo $fetch_product['weight']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
          };
         };
      };
      ?>

   </div>

</section>

</div>


</body>
</header>
</html>