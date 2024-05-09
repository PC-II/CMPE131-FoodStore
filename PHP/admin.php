<?php
session_start();


@include 'config.php';
// if (!isset($_SESSION["admin"])) {
//    echo "Admin Not Signed in";
//    echo "<script>window.location.href='/HTML/employee_login.html';</script>";
//    sleep(3);
//    exit();
// }
// else {


if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_weight = $_POST['p_weight'];
   $p_quantity = $_POST['p_quantity'];
   $p_category= $_POST['p_category'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = '../IMAGES/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `store_inventory`(item_name, item_price, item_weight, item_quantity, item_category, item_image) VALUES('$p_name', '$p_price', '$p_weight', '$p_quantity', '$p_category', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `store_inventory` WHERE item_id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_weight = $_POST['update_p_weight'];
   $update_p_quantity = $_POST['update_p_quantity'];
   $update_p_category = $_POST['update_p_category'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = '../images/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `store_inventory` SET item_name = '$update_p_name', item_price = '$update_p_price', 
                     item_weight = '$update_p_weight', item_quantity = '$update_p_quantity', item_category = '$update_p_category', item_image = '$update_p_image' WHERE item_id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee Page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="../CSS/style.css">

</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>
<a href="../PHP/index.php" id="admin-back" class="btn">Back to Home</a>
<a href="../PHP/display_messages.php" class="btn">To Contact Messages</a>
<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Add new item</h3>
   <input type="text" name="p_name" id = "p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" step="0.01" placeholder="enter the product price" class="box" required>
   <input type="number" name="p_weight" min="0" step="0.01" placeholder="enter the product weight" class="box" required>
   <input type="number" name="p_quantity" min="0" placeholder="enter the product quantity" class="box" required>
   <select name="p_category" class="box" required>
      <option value="" selected disabled>Select a category</option>
      <option value="Meat & Seafood">Meat & Seafood</option>
      <option value="Vegetables">Vegetables</option>
      <option value="Fruits">Fruits</option>
      <option value="Dairy">Dairy</option>
   </select>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>product weight</th>
         <th>product quantity</th>
         <th>product category</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `store_inventory`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="../images/<?php echo $row['item_image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['item_name']; ?></td>
            <td>$<?php echo $row['item_price']; ?>/-</td>
            <td><?php echo $row['item_weight']; ?> lbs</td>
            <td><?php echo $row['item_quantity']; ?> /100</td>
            <td><?php echo $row['item_category']; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['item_id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['item_id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `store_inventory` WHERE item_id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="../images/<?php echo $fetch_edit['item_image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['item_id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['item_name']; ?>">
      <input type="number" min="0" step="0.01" class="box" required name="update_p_price" value="<?php echo $fetch_edit['item_price']; ?>">
      <input type="number" min="0" step="0.01" class="box" required name="update_p_weight" value="<?php echo $fetch_edit['item_weight']; ?>">
      <input type="number" min="0" class="box" required name="update_p_quantity" value="<?php echo $fetch_edit['item_quantity']; ?>">
      <select name="update_p_category" class="box" required>
         <option value="" selected disabled><?php echo $fetch_edit['item_category']; ?></option>
         <option value="Meat & Seafood">Meat & Seafood</option>
         <option value="Vegetables">Vegetables</option>
         <option value="Fruits">Fruits</option>
         <option value="Dairy">Dairy</option>
      </select>
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the product" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

</section>

<script src="../JS/script.js"></script>
<script src = "../JS/search.js"></script>

<script>
   $(document).ready(function() {

      let name = $("#p_name").text();

      testDB.push(name);

      $("#admin-back").onclick(function() {
         <?php
            unset($_SESSION["admin"]);
         ?>
      });
   });

</script>

</body>
</html>