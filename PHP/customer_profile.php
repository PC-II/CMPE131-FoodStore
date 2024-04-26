<?php
    session_start();

    if (isset($_SESSION["user"])) {
        $customer_id = $_SESSION["user"];
        // Create connection to store database
        $conn = mysqli_connect("localhost", "root", "", "store_database");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind to protect against SQL injection
        $select_sql = "SELECT email, first_name, last_name, phone, street_name, apartment_number, city, state, zipcode FROM customer_info WHERE customer_id = ?";
        $select_stmt = $conn->prepare($select_sql);
        $select_stmt->bind_param("s", $customer_id);

        // Execute the query
        $select_stmt->execute();
        $select_result = $select_stmt->get_result();

        if ($select_result->num_rows > 0) {
            $customer = $select_result->fetch_assoc();
            $email = $customer["email"];
            $first_name = $customer["first_name"];
            $last_name = $customer["last_name"];
            $phone = $customer["phone"];
            $street_name = $customer["street_name"];
            $apartment_number = $customer["apartment_number"];
            $city = $customer["city"];
            $state = $customer["state"];
            $zipcode = $customer["zipcode"];
        }
    } 
    else {
        echo "User Not Signed in";
        echo "<script>window.location.href='/HTML/customer_login.html';</script>";
        exit();
    }
    //closes connections 
    $select_stmt->close();
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/index.css"></link>
    
    <title>contact Information Page</title>
    <style>

        .account-container {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100%;
        }

        main {
            position: relative;
            height: 100%;
            width: 100%;
            box-sizing: border-box;
            margin: 0;

        }

        .view-account {
            height: 100%;
            position: relative;
            box-sizing: border-box;
        }

        .greeting {
            display: flex;
            justify-content: center;
            font-size: 15px;
            padding: 40px;
        }

        .greeting h1 span {
            -webkit-background-clip: text;
            background-clip: text;
            font-size: 40px;
            background-image: linear-gradient(45deg, var(--ogs-green), #41f1e2);
            color: transparent;
        }

        #table-header {
            font-weight: 400;
            
        }

        .sidebar {
            width: 225px;
            background-color: #333;
            position: fixed;
            border: 5px #300;
            height: 100%;
            box-shadow: 1px 0px 5px rgba(0, 0, 0, 0.5); 
            z-index: 1;
            padding-top: 15px; 
            
        }

        .sidebar p.header {
            display: block;
            color: white;
            padding: 15px 10px;
            font-size: 20px;
            
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 20px 0px 20px 50px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s linear;
        }

        .sidebar a.active {
            background-color: var(--ogs-green);
            color: white;
        }

        .sidebar a:hover {
            background-color: #eee;
            color: var(--ogs-green);
        }

        .sidebar-wrapper {
            display: flex;
            width: 225px;
            vertical-align: top;
            z-index: 1;
        }

        .content {
            padding: 20px;
        }

        .info-container {
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
            padding: 10px;
            margin-top: 10px;

        }

        .contact-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            padding: 20px;


        }

        .contact-info input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12.5px;
            border: 1px solid #43A047;
            background-color: #43A047;
            cursor: pointer;
            margin-top: 30px;
            font-size: 12px;
            color: white;
            line-height: 1.33;
            transition: background-color 0.3s, color 0.3s linear;
        }

        .contact-info input[type="submit"]:hover {
            background-color: #43a04834;
            color: var(--ogs-green);
            
        }

        

        .delivery-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            padding: 20px;

        }

        .delivery-info input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12.5px;
            border: 1px solid #43A047;
            background-color: #43A047;
            cursor: pointer;
            margin-top: 30px;
            font-size: 12px;
            color: white;
            line-height: 1.33;
            transition: background-color 0.3s, color 0.3s linear;
        }

        .delivery-info input[type="submit"]:hover {
            background-color: #43a04834;
            color: var(--ogs-green);
        }

        .past-order-info {
            margin: 20px;
        }

        #entry-li{
            list-style: none;
            margin: 1rem 0;
        }

        #entry-li input{
            width: 100%;
            
        }

        #entry-ul
        {
            display: flex;
            flex-direction: column;
            padding: 0;
            margin: 0;
        }

        ul input{
            width: 100%;
        }

        .text-box {
            width: 200px;
            padding: 10px;

        }

        .text-box-contact, .text-box-delivery {
            width: 200px;
            padding: 10px;

        }

        .table-label {
            font-style: italic;
            font-size: 15px;
            font-weight: bold;
        }


        .link {
            text-align: center;
            margin-top: 10px;
        }

        .link a {
            color: #388022;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .error-message {
            text-align: center;
            margin-top: 10px;
            color: rgba(255, 0, 0, 0.74);
        }
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
    
    <div class="space"  style="box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.25); "></div>
    

    <main>
        <div class="view-account">
            <div class="account-container">
                <div class="sidebar-wrapper">
                    <div class="sidebar" data-dark-mode="both">
                    
                        <p class = "header">Profile</p>
                        <a href="#contact-info" class="active">Contact Details</a>
                        <a href="#delivery-info">Delivery Information</a>
                        <a href="#past-order-info">Past Orders</a>
                        <a href="#home-button">Home</a>
                        
                        
                    </div>
                </div>

                <div class="content">
                    <!--contact Contact Details  -->
                    <div class="contact-info" data-dark-mode="both">
                        <h1 id="table-header">Contact Details</h1>
                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">First Name </p>
                            </div>
                            <div class="text-box-contact" id="first_name">
                                <p><?= $first_name ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">Last Name </p>
                            </div>
                            <div class="text-box-contact" id="last_name">
                                <p><?= $last_name ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">Email </p>
                            </div>
                            <div class="text-box-contact" id="email">
                                <p><?= $email ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label" >Mobile Phone</p>
                            </div>
                            <div class="text-box-contact" id="mobile_phone">
                                <p><?= $phone ?></p>
                            </div>
                        </li>
                        <input type="submit" value="Edit Contact Details" class="edit-contact-info">
                    </div>

                    <!-- contact Delivery Information -->
                    <div class="delivery-info" data-dark-mode="both">
                        <h1 id="table-header" >Delivery Information</h1>
                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">Street Name/Number </p>
                            </div>
                            <div class="text-box-delivery" id="street_name">
                                <p><?= $street_name ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">Apartment Number </p>
                            </div>
                            <div class="text-box-delivery" id="apartment_number">
                                <p><?= $apartment_number ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">City </p>
                            </div>
                            <div class="text-box-delivery" id="city">
                                <p><?= $city ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">State </p>
                            </div>
                            <div class="text-box" id="state">
                                <p><?= $state ?></p>
                            </div>
                        </li>

                        <li class="info-container">
                            <div class="text-box">
                                <p class="table-label">Postal Code </p>
                            </div>
                            <div class="text-box-delivery" id="zipcode">
                                <p><?= $zipcode ?></p>
                            </div>
                        </li>

                        <input type="submit" value="Edit Delivery Information" class="edit-delivery-info">
                    </div>


                </div>
            </div>

        </div>
    </main>

    <footer data-dark-mode="both">
    <div class="bumper">
      <p>© 2024 <a href="../PHP/index.php">OGS Marketplace™</a>. All Rights Reserved.</p>
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
        // Retrieve the error message from the query parameter
        queryString = window.location.search;
        urlParams = new URLSearchParams(queryString);
        errorMessage = urlParams.get('error');

        // Display the error message on the page
        if (errorMessage) {
            errorMessageElement = $('registration-error-message');
            errorMessageElement.innerText = errorMessage;
        }

        //update info and sidebar functionality
        $(document).ready(function() {
            var contact_text_saved = true;
            var delivery_text_saved = true;

            //Initialize page to show contact info by default
            $('.delivery-info').hide();
            $('.past-order-info').hide();
            $('.contact-info').show();

            //update contact info function
            $(".edit-contact-info").click(function() {

                if (contact_text_saved === true) {
                    $(".text-box-contact").attr("contenteditable", "true");
                    $(".text-box-contact").css({
                        "border": "1px solid #000000",
                    });

                    $(this).val("Save Changes");
                    contact_text_saved = false;

                } else if (contact_text_saved === false) {
                    var first_name = $("#first_name").text().trim();
                    var last_name = $("#last_name").text().trim();
                    var email = $("#email").text().trim();
                    var phone = $("#mobile_phone").text().trim();

                    event.preventDefault();
                    fetch("update_contact_info.php", {
                            method: "POST",
                            body: JSON.stringify({
                                first_name: first_name,
                                last_name: last_name,
                                email: email,
                                phone: phone
                            }),
                            headers: {
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $(".edit-contact-info").val("Edit Contact Details");
                                $(".text-box-contact").attr("contenteditable", "false");
                                $(".text-box-contact").css({
                                    "border": "none"
                                })
                                contact_text_saved = true;

                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            alert("An error has occured: " + error);
                        });
                }
            })

            //update delivery info function
            $(".edit-delivery-info").click(function() {

                if (delivery_text_saved === true) {
                    $(".text-box-delivery").attr("contenteditable", "true");
                    $(".text-box-delivery").css({
                        "border": "1px solid #000000",
                    });

                    $(this).val("Save Changes");
                    delivery_text_saved = false;

                } else if (delivery_text_saved === false) {
                    var street_name = $("#street_name").text().trim();
                    var apartment_number = $("#apartment_number").text().trim();
                    var city = $("#city").text().trim();
                    var zipcode = $("#zipcode").text().trim();

                    event.preventDefault();
                    fetch("update_delivery_info.php", {
                            method: "POST",
                            body: JSON.stringify({
                                street_name: street_name,
                                apartment_number: apartment_number,
                                city: city,
                                zipcode: zipcode
                            }),
                            headers: {
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $(".edit-delivery-info").val("Edit Delivery Information");
                                $(".text-box-delivery").attr("contenteditable", "false");
                                $(".text-box-delivery").css({
                                    "border": "none"
                                })
                                delivery_text_saved = true;

                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            alert("An error has occured: " + error);
                        });
                }
            })

            // Sidebar functionality
            $('.sidebar a').click(function() {

                $('.sidebar a.active').removeClass('active');
                $(this).addClass('active');
                var tab = $(this).attr('href').slice(1);

                if (tab === 'contact-info') {
                    $('.delivery-info').hide();
                    $('.past-order-info').hide();
                    $('.contact-info').show();
                } else if (tab === 'delivery-info') {
                    $('.contact-info').hide();
                    $('.past-order-info').hide();
                    $('.delivery-info').show();
                } else if (tab === 'past-order-info') {
                    $('.delivery-info').hide();
                    $('.contact-info').hide();
                    $('.past-order-info').show();
                } else if (tab === 'home-button') {
                    location.assign("../PHP/index.php");
                }

            });
        });
    </script>
    <script src="../JS/topbar.js"></script>

</html>