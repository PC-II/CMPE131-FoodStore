<?php
session_start();

// if (!isset($_SESSION["admin"])) {
//     echo "User Not Signed in";
//     echo "<script>window.location.href='/HTML/employee_login.html';</script>";
//     exit();
//  }
//  else {
//     include 'config.php';
//  }

 include 'config.php';
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


<a href="../PHP/index.php" id = "admin-back" class="btn">Back to Home</a>
<a href="../PHP/admin.php" class="btn">Back to Admin Page</a>
<div class="container">

<section>


</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>name</th>
         <th>email</th>
         <th>subject</th>
         <th>message</th>
      </thead>

      <tbody>
         <?php

            $select_messages = mysqli_query($conn, "SELECT * FROM messages");
            if(mysqli_num_rows($select_messages) > 0){
               while($row_s = mysqli_fetch_assoc($select_messages)){
         ?>

         <tr>
            <td><?php echo $row_s['Name']; ?></td>
            <td><?php echo $row_s['Email']; ?></td>
            <td><?php echo $row_s['Subject']; ?></td>
            <td><?php echo $row_s['Message']; ?></td>
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

</div>

</section>

<script src="../JS/script.js"></script>

<script>
    $(document).ready(function() {
        
        $("#admin-back").onclick(function() {
            <?php
                unset($_SESSION["admin"]);
            ?>
        })
    });
</script>
</body>
</html>