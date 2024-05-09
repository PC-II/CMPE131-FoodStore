<?php
session_start();
include 'config.php';

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
      $message[] = (string)$product_quantity.' '. $product_name.' added to cart succesfully. (Update Quantity in shopping cart)';
   }

}

// Get categories from database
$categories = mysqli_query($conn, "SELECT DISTINCT item_category FROM store_inventory");
$category_list = array();
while ($category = mysqli_fetch_assoc($categories)) {
    $category_list[] = $category['item_category'];
}

// Get products from database
$products = mysqli_query($conn, "SELECT * FROM store_inventory");

// Create an array to store products by category
$products_by_category = array();
while ($product = mysqli_fetch_assoc($products)) {
    $category = $product['item_category'];
    if (!isset($products_by_category[$category])) {
        $products_by_category[$category] = array();
    }
    $products_by_category[$category][] = $product;
}

?>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" data-dark-mode ="text"><span>'.$message.'</span> <i class="fas fa-times" onclick="$(this).parent().hide();"></i> </div>';
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

  <main class="products" data-dark-mode="text">
    <h1 class="heading" data-dark-mode="text" style="margin-top:20px ;">latest products</h1>
    <h1 class="heading" data-dark-mode="text" id="category-heading"></h1>
   
    <div class="box-container">
      <?php foreach ($products as $product) {
      if ($product['item_quantity'] > 0) {?>
          <form action="" method="post" >
              <div class="box" >
                  <img src="../IMAGES/<?php echo $product['item_image'];?>" height="100%" width="100%" alt="">
                  <h3><?php echo $product['item_name'];?></h3>
                  <div class="price">Price: $<?php echo $product['item_price'];?></div>
                  <div class="quantity">Quantity: <?php echo $product['item_quantity'];?> items left</div>
                  <input type="hidden" name="product_name" value="<?php echo $product['item_name'];?>">
                  <input type="hidden" name="product_price" value="<?php echo $product['item_price'];?>">
                  <input type="hidden" name="product_weight" value="<?php echo $product['item_weight'];?>">
                  <input type="hidden" name="product_image" value="<?php echo $product['item_image'];?>">
                  <input type="submit" class="btn" value="add to cart" name="add_to_cart">
              </div>
          </form>
      <?php } else {?>
          <div class="box">
              <h3><?php echo $product['item_name'];?></h3>
              <div class="quantity">Out of Stock</div>
          </div>
      <?php }
        }?>
    </div>

  </main>

  <footer data-dark-mode="both">
      <div class="bumper">
        <p>© 2024 <a href="./index.php">OGS Marketplace™</a>. All Rights Reserved.</p>
        <div>
          <ul>
            <li id="about-button">About</li>
            <li id="privacy-policy-button">Privacy Policy</li>
            <li id="licensing-button">Licensing</li>
            <li id="contact-button">Contact</li>
          </ul>
        </div>
      </div>
    </footer>
</body>

  <script>

$(document).ready(function(){
  const searchInput = document.querySelector('.search-bar input');
  const main = document.querySelector('main');
  const searchSuggestions = document.querySelector('.search-suggestions');
  const suggestionDropdown = searchSuggestions.querySelector('ul');
  searchInput.addEventListener('input', () => {
    // dim the main section
    suggestionDropdown.innerHTML = ``;
    if(searchInput.value.length > 0)
    {
      main.style.opacity = '0.3';
      searchSuggestions.classList.remove('hidden');
      searchSuggestions.style.maxHeight = `none`;
      const results = queryDb(searchInput.value);
      if(results.length == 0)
      {
        suggestionDropdown.insertAdjacentHTML(`beforeend`, `<li style="color: gray;">Could not find result for "${searchInput.value}"</li>`)
      }
      else
      {
        results.forEach((result, i) => {
          if(i > 9) return;
          suggestionDropdown.insertAdjacentHTML(`beforeend`, `<li>${result}</li>`)
        });

        const suggestions = $('.search-suggestions li');
          suggestions.each(function() {
            $(this).on('click', function() {
              product = $(this).text();
              const productsContainer = $('.box-container');
              productsContainer.html('');
              if (product.item_quantity > 0) {
                var productHTML = `
                  <form action="" method="post">
                    <div class="box" data-dark-mode="text">
                        <img src="../images/${product.item_image}" height="100%" width="100%" alt="">
                        <h3 data-dark-mode="text">${product.item_name}</h3>
                        <div class="price">Price: $${product.item_price}</div>
                        <div class="quantity">Quantity: ${product.item_quantity} items left</div>
                        <input type="hidden" name="product_name" value="${product.item_name}">
                        <input type="hidden" name="product_price" value="${product.item_price}">
                        <input type="hidden" name="product_weight" value="${product.item_weight}">
                        <input type="hidden" name="product_image" value="${product.item_image}">
                        <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                    </div>
                  </form>
                `;
              } else {
                var productHTML = `
                  <div class="box">
                      <h3>${product.item_name}</h3>
                      <div class="quantity">Out of Stock</div>
                  </div>
                `;
              }
              productsContainer.append(productHTML);
            });
          });
      }
    }
    else
    {
      main.style.opacity = ``;
      searchSuggestions.classList.add('hidden');
    }
  });


  const queryDb = (q) => {
    let list = [];
    q = q.toLowerCase();
    const qList = q.split(' ');
    qList.forEach(qItem => {
      if(qItem == '') return;
      testDb.forEach(entry => {
        const words = entry.toLowerCase().split(' ');
        words.forEach(word => {
          if(list.includes(entry)) return;
          if(word.startsWith(qItem))
            list.push(entry);
        });
      });
    });

    const releventItems = list.filter(item => item.toLowerCase().startsWith(q)).sort();
    const nonReleventItems = list.filter(item => !item.toLowerCase().startsWith(q)).sort();
    list = [...releventItems, ...nonReleventItems];

    return list;
  }


  let testDb = [
  'Banana',
  'Lemon',
  'Lime',
  'Orange',
  'Strawberries',
  'Blueberries',
  'Raspberries',
  'Blackberries',
  'Mango',
  'Pineapples',
  'Pink Lady Apples',
  'Cucumber',
  'Red Bell Peppers',
  'Yellow Onion',
  'Red Onion',
  'Broccoli',
  'Garlic',
  'Roma Tomato',
  'Ginger Root',
  'Carrot',
  'Cauliflower',
  'Gold potato',
  'Cabbage',
  'Chicken Breast',
  'Chicken Thighs Boneless',
  'Ground Beef',
  'Bacon',
  'Salmon Fillet Portion',
  'Ribeye Steak',
  'Frozen Shrimp',
  'Cage free Large Grade A Eggs 12',
  'Pasture-Raised Eggs 18',
  'Tofu',
  'Oat Milk', 
  'Butter',
  'Whole Milk gallon',
  'Cream Cheese',
  'Greek Yogurt Cup',
  'Cottage Cheese',
  ]

  // Make an AJAX request to the PHP script
  fetch('get_products.php')
    .then(response => response.json())
    .then(productNames => {
          // Update the testDb array
          testDb = productNames;
          console.log('Updated testDb:', testDb);
      })
    .catch(error => console.error('Error:', error));
    

  
  

  $('.dropdown li').click(function(){
    var category = $(this).text();
    var productsContainer = $('.box-container');
    productsContainer.html('');

    var productsByCategory = <?php echo json_encode($products_by_category);?>;
    var products = productsByCategory[category];
    $("#category-heading").text('');
    $("#category-heading").text(category);
    products.forEach(function(product){
      if (product.item_quantity > 0) {
        var productHTML = `
          <form action="" method="post">
            <div class="box" data-dark-mode="text">
                <img src="../images/${product.item_image}" height="100%" width="100%" alt="">
                <h3 data-dark-mode="text">${product.item_name}</h3>
                <div class="price">Price: $${product.item_price}</div>
                <div class="quantity">Quantity: ${product.item_quantity} items left</div>
                <input type="hidden" name="product_name" value="${product.item_name}">
                <input type="hidden" name="product_price" value="${product.item_price}">
                <input type="hidden" name="product_weight" value="${product.item_weight}">
                <input type="hidden" name="product_image" value="${product.item_image}">
                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            </div>
          </form>
        `;
      } else {
        var productHTML = `
          <div class="box">
              <h3>${product.item_name}</h3>
              <div class="quantity">Out of Stock</div>
          </div>
        `;
      }
      productsContainer.append(productHTML);
});  
});
});
  

</script>






</body>

</html>