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
} else {

    
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
     <!-- downloads jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <title>contact Information Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: left;
            align-items: left;
            height: 100vh;
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

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .bottom-bar a {
            color: #fff;
            text-decoration: none;
            margin: 0 5px;
        }

        .bottom-bar a:hover {
            color: #ccc;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #4CAF50;
            color: white;
        }

        .sidebar a:hover {
            background-color: #111;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }


        .contact-info {
            box-sizing: border-box;
            width: 100%;
            padding: 20px;
            margin-bottom: 10px;
            
        }

                        

        .contact-info input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #75e254;
            color: #fff;
            cursor: pointer;
        }

        .contact-info input[type="submit"]:hover {
            background-color: #2baa04;
        }

        .delivery-info {
            box-sizing: border-box;
            width: 100%;
            padding: 20px;
            margin-bottom: 10px;
            
        }

        .delivery-info input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #75e254;
            color: #fff;
            cursor: pointer;
        }

        .delivery-info input[type="submit"]:hover {
            background-color: #2baa04;
        }

        .past-order-info{
            margin: 20px;
        }

        .text-box {
            width: 200px;
            padding: 10px;

        }

        .info-container {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: start;
            padding: 10px;
            
        }

    </style>
</head>

<body>
    

    <div class="sidebar">
        <a href="#contact-info" class="active">Contact Details</a>
        <a href="#delivery-info">Delivery Information</a>
        <a href="#past-order-info">Past Orders</a>
    </div>

    <div class="container">
        <div class="content">
            <!--contact Contact Details  -->
            <div class="contact-info">
                <h1>Contact Details</h1>
                <li class = "info-container">
                    <div class="text-box">
                        <p>First Name </p>
                    </div>
                    <div class="text-box">
                        <p><?= $first_name ?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>Last Name </p>
                    </div>
                    <div class="text-box">
                        <p><?= $last_name ?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>Email </p>
                    </div>
                    <div class="text-box">
                        <p><?= $email ?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>Mobile Phone</p>
                     </div>
                    <div class="text-box">
                         <p><?= $phone ?></p>
                    </div>
                </li>

                <input type="submit" value="Edit Contact Details" class="edit-contact-info">
                
            </div>

            <!-- contact Delivery Information -->
            <div class="delivery-info">
                <h1>Delivery Information</h1>
                <li class = "info-container">
                    <div class="text-box">
                        <p>Street Name/Number </p>
                    </div>
                    <div class="text-box">
                        <p><?= $street_name ?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>Apartment Number </p>
                    </div>
                    <div class="text-box">
                        <p><?= $apartment_number?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>City </p>
                    </div>
                    <div class="text-box">
                        <p><?= $city?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>State </p>
                     </div>
                    <div class="text-box">
                         <p><?= $state ?></p>
                    </div>
                </li>

                <li class = "info-container">
                    <div class="text-box">
                        <p>Postal Code </p>
                     </div>
                    <div class="text-box">
                         <p><?= $zipcode ?></p>
                    </div>
                </li>

                <input type="submit" value="Edit Delivery Information">
            </div>

            
        </div>
    </div>


    <div class="bottom-bar">
        <a href="aboutpage.html">Need Support?</a>
    </div>




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

        $(document).ready(function()
        {   
            //Initialize page to show contact info by default
            $('.delivery-info').hide();    
            $('.past-order-info').hide();
            $('.contact-info').show();

            $(".edit-contact-info").click(function(){
                $(".contact-info.text-box p").attr("contenteditable", true);
            });

            // Sidebar functionality
            $('.sidebar a').click(function()
            {
                $('.sidebar a.active').removeClass('active');
                $(this).addClass('active');
                var tab = $(this).attr('href').slice(1);

                if (tab === 'contact-info') 
                {   
                    $('.delivery-info').hide();    
                    $('.past-order-info').hide();
                    $('.contact-info').show();
                }
                else if (tab === 'delivery-info') 
                {
                    $('.contact-info').hide();
                    $('.past-order-info').hide();
                    $('.delivery-info').show();  
                }   
                else if (tab === 'past-order-info') 
                {
                    $('.delivery-info').hide();   
                    $('.contact-info').hide();
                    $('.past-order-info').show();
                }
            });
        });


             
            
    </script>




</body>

</html>