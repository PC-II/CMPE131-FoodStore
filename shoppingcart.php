<?php

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:shoppingcart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:shoppingcart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:shoppingcart.php');
}

if(isset($_POST['order_btn'])){

  $name = $_POST['name'];
  $number = $_POST['number'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $code = $_POST['code'];

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
  $price_total = 0;
  if(mysqli_num_rows($cart_query) > 0){
     while($product_item = mysqli_fetch_assoc($cart_query)){
        $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
        $product_price = number_format($product_item['price'] * $product_item['quantity'], 2);
        $grand_total += $product_price;
     };
  };

  $total_product = implode(', ',$product_name);
  $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, address, city, state, code, total_product, grand_total) VALUES('$name', '$number', '$email', '$address', '$city', '$state', '$code', '$total_product', '$grand_total')") or die('query failed');

  if($cart_query && $detail_query){
     echo "
     <div class='order-message-container'>
     <div class='message-container'>
        <h3>thank you for shopping!</h3>
        <div class='order-detail'>
           <span>".$total_product."</span>
           <span class='total'> total : $".$grand_total."  </span>
        </div>
        <div class='customer-details'>
           <p> your name : <span>".$name."</span> </p>
           <p> your number : <span>".$number."</span> </p>
           <p> your email : <span>".$email."</span> </p>
           <p> your address : <span>".$address.", ".$city.", ".$state.", ".$code."</span> </p>
        </div>
           <a href='productpage.php' class='btn'>continue shopping</a>
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
   <title>shopping cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

  <div class="space"></div>

</body>
<script src="JS/index.js" type="module" defer></script>

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>weight</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>total weight</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         $total_weight = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo number_format($fetch_cart['weight'], 2); ?></td>
            <td>$<?php echo number_format($fetch_cart['price'], 2); ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'], 2); ?></td>
            <td><?php echo $sub_weight = number_format($fetch_cart['weight'] * $fetch_cart['quantity'], 2); ?> lbs</td>
            <td><a href="shoppingcart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $total_weight += $sub_weight;
           $grand_total += $sub_total;  
            if($total_weight > 20) {
              $grand_total += 5;
            }
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="productpage.php" class="option-btn" style="margin-top: 0;">Back to Product Page</a></td>
            <td colspan="1">Total Weight</td>
            <td><?php echo $total_weight; ?></td> 
            <td colspan="2">grand total</td>
            <td colspan="2">$<?php echo $grand_total; ?></td>
            <td><a href="shoppingcart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

</section>

</div>

<section class="checkout-form">

   <form action="" method="post">

      <div class="flex">
         <div class="inputBox">
            <span>name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address</span>
            <input type="text" placeholder="ex: 1st Washington Street" name="address" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="ex: San Jose" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="ex: CA" name="state" required>
         </div>
         <div class="inputBox">
            <span>area code</span>
            <input type="text" placeholder="ex: 95112" name="code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>
   
<script src="js/script.js"></script>

</body>
</html>