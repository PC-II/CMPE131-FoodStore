<?php
session_start();
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
   <link rel="stylesheet" href="../CSS/style.css">

</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> </link>
  <script src="../JS/topbar.js"></script>
  <link rel="stylesheet" href="../CSS/index.css"></link>
  <title>Food Store</title>

  <style>
</style>

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

        <div class="search-suggestions" data-dark-mode="both">
          <ul>
            <!-- suggestions are placed here depending on input field -->
          </ul>
        </div>

        <form class="search-bar">
          <input type="text" placeholder="What can we help you find?" maxlength="40">
          <!-- <i class='bx bx-search-alt' id="search-button"></i> -->
        </form>
  
        <i class='bx bx-cart' id="cart-button" data-dark-mode="text"></i>
        <i class='bx bx-user-circle' id="account-button" data-dark-mode="text" ></i>
  
        <?php if (isset($_SESSION["user"])):?>
          <h2 id="logout-button" data-dark-mode="text">Log Out</h2>
        <?php else:?>
          <h2 id="login-button" data-dark-mode="text">Log In</h2>
        <?php endif;?>
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
          <li id="Meat & Seafood">Meat & Seafood</li>
          <li id="Vegetables">Vegetables</li>
          <li id="Fruits">Fruits</li>
          <li id="Dairy">Dairy</li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="space"></div>

</body>
<script src="../SRC/index.js" type="module" defer></script>


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

         $select_cart = mysqli_query($conn, "SELECT * FROM cart");
         $store_inventory = mysqli_query($conn, "SELECT * FROM store_inventory");
         $fetch_products = mysqli_fetch_assoc($store_inventory);
         $grand_total = 0;
         $total_weight = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="../IMAGES/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo number_format($fetch_cart['weight'], 2); ?></td>
            <td>$<?php echo number_format($fetch_cart['price'], ); ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1" max="<?php echo ($fetch_cart['name'] && $fetch_products['item_quantity']); ?>"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'], 2); ?></td>
            <td><?php echo $sub_weight = number_format($fetch_cart['weight'] * $fetch_cart['quantity'], 2); ?> lbs</td>
            <td><a href="shoppingcart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
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
            <td><?php echo $total_weight = number_format($total_weight, 2); ?> lbs</td> 
            <td colspan="2">grand total</td>
            <td colspan="2">$<?php echo $grand_total = number_format($grand_total, 2); ?></td>
            <td><a href="shoppingcart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src = "../js/shoppingcart.js"></script>

</body>
</html>