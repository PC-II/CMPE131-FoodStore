<?php
session_start();

if (!isset($_SESSION["user"])) {
    echo "User Not Signed in";
    echo "<script>window.location.href='/HTML/customer_login.html';</script>";
    exit();
}
else {
include 'config.php';

$customer_id = $_SESSION["user"];
$query = "SELECT * FROM customer_info WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $customer_id);
$stmt->execute(); 
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   $fetch_account = $result->fetch_assoc();
    
} else {
    echo "No customer found with this ID.";
    echo $customer_id;
}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/account.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> </link>
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

    <div class="space" style="box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.25); "></div>


<main>
        <div class="view-account">
            <div class="account-container">
                <!-- Sidebar -->
                <div class="sidebar-wrapper">
                    <div class="sidebar" data-dark-mode="both">
                        <p class="header">Profile</p>
                        <a href="#account-info" class="active">Account</a>
                        <a href="#contact-info">Contact Details</a>
                        <a href="#delivery-info">Delivery Information</a>
                        <a href="#past-order-info">Past Orders</a>
                        <a href="#home-button">Home</a>
                    </div>
                </div>
                

                <div class="content">
                    <!-- Account Info (static) -->
                    <div class="account-info" id="account-info-static" data-dark-mode="both">
                        <h1 id="table-header">Account</h1>
                        <form id ="update_password" action='update_password.php' method="post" onsubmit="return validatePassword()">
                        <ul class='entry-ul'>
                            <li class="info-container">
                            <div class="entry-div" data-dark-mode="text-box">
                                <label for="old_password">Old Password</label>
                                <input type="password" name="old_password" id="old_password" placeholder="Old password" required>
                            </div>
                            </li>
                            <li class="info-container">
                            <div class="entry-div" data-dark-mode="text-box">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="New password" required>
                            </div>
                            </li>
                            <li class="info-container">
                            <div class="entry-div" data-dark-mode="text-box">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
                            </div>
                            </li>
                            <li class="info-container">
                            <input type="submit" id="change-password" name="change-password" value="Save Password">
                            </li>
                            <li class="info-container">
                            <div class="entry-div" data-dark-mode="text-box">
                                <p id="error-message"></p>
                            </div>
                            </li>
                        </ul>
                        </form>
                    </div> 
                
                    <div class="contact-info" id="contact-info-update" data-dark-mode="both" style="display: none;">
                        <h1 id="table-header">Contact Details</h1>
                        

                        <form   id="contact-info-form" method='post'>
                            <ul id='entry-ul'>
                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">First Name </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="first_name" value="<?php echo $fetch_account['first_name'];?>" required>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Last Name </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id = "last_name" value="<?php echo $fetch_account['last_name'];?>" required>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Email </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id = "email" value="<?php echo $fetch_account['email'];?>" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="ex: yourEmail@gmail.com" required>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Mobile Phone</p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="phone" value="<?php echo $fetch_account['phone'];?>" pattern="\(\d{3}\)\d{3}-\d{4}" title="ex: (999)999-9999" required>
                                    </div>
                                </li>
                                <li class="info-container">
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <p id="contact-error-message"></p>
                                    </div>
                                </li>
                            </ul>
                            <input type="submit" value="Save Changes" class="save-contact-info" name="save-contact-btn">
                        </form>
                    </div>

                    <!--Delivery Information (update)-->
                    <div class="delivery-info" id="delivery-info-update" data-dark-mode="both" style="display: none;">
                        <h1 id="table-header">Delivery Information</h1>

                        <form id="delivery-info-form" method="post">
                            <ul id='entry-ul'>
                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Street Name/Number </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="street_name" value="<?php echo $fetch_account['street_name']?>" required>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Apartment Number </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="apartment_number" value="<?php echo $fetch_account['apartment_number']?>">
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">City </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="city" value="<?php echo $fetch_account['city']?>" required>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">State </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <p><?php echo $fetch_account['state']?></p>
                                    </div>
                                </li>

                                <li class="info-container">
                                    <div class="text-box">
                                        <p class="table-label">Postal Code </p>
                                    </div>
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <input type="text" id="zipcode" value="<?php echo $fetch_account['zipcode']?>" pattern="[0-9]*" required>
                                    </div>
                                </li>
                                <li class="info-container">
                                    <div class="entry-div" data-dark-mode="text-box">
                                        <p id="delivery-error-message"></p>
                                    </div>
                                </li>
                            </ul>
                            <input type="submit" value="Save Changes" class="save-delivery-info" name="save-delivery-btn">
                        </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    

        function validatePassword() {
            
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            if (new_password !== confirm_password) {
                event.preventDefault();
                
                return false;
            } else {
                console.log("passwords validated");
                return true;
                
            }
        }
    //update info and sidebar functionality
    $(document).ready(function() {

        
        $("#update_password").submit(function (event) {

            if (!validatePassword()) {
                $('#error-message').text(" New Passwords must match!");
                return;
            }
            else{
                var formData = {
                old_password: $("#old_password").val(),
                new_password: $("#new_password").val(),
                confirm_password: $("#confirm_password").val(),
                };

                $.ajax({
                type: "POST",
                url: "update_password.php",
                data: formData,
                dataType: "json",
                encode: true,
                }).done(function (data) 
                {
                    console.log(data);
                    if(!data.success) {
                        if (data.errors.old_password) {
                            $('#error-message').text(data.errors['old_password']);
                        }
                        else if (data.errors.password_not_updated) {
                            $('#error-message').text(data.errors['password_not_updated']);
                        }
                    }
                    else {
                        $('#error-message').text(data.message);
                        $('#old_password').val('');
                        $('#new_password').val('');
                        $('#confirm_password').val('');
                    }
                });

                event.preventDefault();
            }
        });

        $("#contact-info-form").submit(function (event) {

                var formData = {
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                };

                $.ajax({
                type: "POST",
                url: "update_contact.php",
                data: formData,
                dataType: "json",
                encode: true,
                }).done(function (data) 
                {
                    console.log(data);
                    if(!data.success) {
                        if (data.errors.no_changes) {
                            $('#contact-error-message').text("No changes were made");
                        }
                    }
                    else {
                        $('#contact-error-message').text(data.message);
                    }
                });

                event.preventDefault();
            
        });

        $("#delivery-info-form").submit(function (event) {

            var formData = {
            street_name: $("#street_name").val(),
            apartment_number: $("#apartment_number").val(),
            city: $("#city").val(),
            zipcode: $("#zipcode").val(),
            };

            $.ajax({
            type: "POST",
            url: "update_delivery.php",
            data: formData,
            dataType: "json",
            encode: true,
            }).done(function (data) 
            {
                console.log(data);
                if(!data.success) {
                    if (data.errors.no_changes) {
                        $('#delivery-error-message').text("No changes were made");
                    }
                }
                else {
                    $('#delivery-error-message').text(data.message);
                }
            });

            event.preventDefault();

        });



        // Sidebar functionality
        $('.sidebar a').click(function() {
            $('.sidebar a.active').removeClass('active');
            $(this).addClass('active');
            var tab = $(this).attr('href').slice(1);
            localStorage.setItem('activeTab', $(this).attr('href'));

            if (tab === 'account-info') {
                $('.contact-info').hide();
                $('.delivery-info').hide();
                $('.account-info').show();
                
            } 
            else if (tab === 'contact-info') {
                $('.account-info').hide();
                $('.delivery-info').hide();
                $('#contact-info-update').show();
            }
            else if (tab === 'delivery-info') {
                $('.account-info').hide();
                $('.contact-info').hide();
                $('#delivery-info-update').show();
            }  
            else if (tab === 'home-button') {
                location.assign("../PHP/index.php");
            }
        }); 
});

    
    
</script>



<script src="../JS/topbar.js"></script>

</html>