<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./index.css"></link>
  <title>Shop</title>
  <style>
    .main {
        background-color: white;
        justify-content: center;
    }
    
    .box {
        list-style: none;
        font-size: 20px;
        background-color: rgba(162,203,161,255);
        border: 3px solid none;
        border-radius: 1em;
        padding: 30px;
        margin: 20px; 
    }

    .flexbox_gallery {
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        margin: 0 50px 0 210px;

    }

    img {
        display: block;
        height: 200px;
        width: 200px;
        background-color: white;
        border: 2px solid none;
        border-radius: 1em;
    }

    .Cart {
        margin-top: 15px;
        height: 30px;
        background-color: rgb(199, 165, 15);
        border: 1px solid black;
        border-radius: .2em;
        font-size: 14px;
        font-weight: 700;
    }
    #quantity {
        width: 33px;
        margin-left: 5px;
    }
    h3 {
      width: 200px;
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <section class="left">
      <img src="" alt="">
      <h1>EXPLORE</h1>
      <h1>SAVE</h1>
      <h1>SHOP</h1>
    </section>
    <section class="right">
      <div>
        <h2>Sign In</h2>
        <h2>Cart</h2>
      </div>
        <input type="text" placeholder="What can we help you find?">
        <i class='bx bx-search-alt'></i>
    </section>
  </div>
  <?php

    $conn = mysqli_connect("localhost", "root", "", "store");

    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // select user
    $sql = "SELECT * FROM store_inventory";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<div class='main'>";
        echo "<section class='flexbox_gallery'>";
        while ($row = $result->fetch_assoc()) {        
          echo "<form action='add_to_cart.php' method='post' class='box'>";
          echo "<img src='banana.png'>";
          echo "<h3>" . $row["item_name"] . "</h3>";
          echo "<p><strong>Price: </strong>$" . $row["item_price"] . "</p>";
          echo "<p><strong>Weight: </strong>" . $row["item_weight"] . " lbs</p>";
          echo "<label for='quantity'><strong>Quantity:</strong></label> <input type='number' id='quantity' name='quantity' min='0' max='10'>";
          echo "<br>";
          echo "<input type='submit' value='Add to Cart' class='Cart'>";
          echo "</form>";          
        }      
        echo "</section>";
        echo "</div>";
    } else {
        echo mysqli_error($conn);
    }
    
    $conn->close();

?>

  </div>
</body>
</html>