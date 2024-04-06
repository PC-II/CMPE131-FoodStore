<?php
session_start();

if (isset($_SESSION["user"])) {
    $email = $_SESSION["user"];

    // Create connection to userinfo
    $conn = mysqli_connect("localhost", "root", "", "store_database");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind to protect against SQL injection
    $select_sql = "SELECT first_name, last_name, phone FROM customer_info WHERE email = ?";
    $select_stmt = $conn->prepare($select_sql);
    $select_stmt->bind_param("s", $email);

    // Execute the query
    $select_stmt->execute();
    $select_result = $select_stmt->get_result();

    if ($select_result->num_rows > 0) {
        $customer = $select_result->fetch_assoc();
        $first_name = $customer["first_name"];
        $last_name = $customer["last_name"];
        $phone = $customer["phone"];
    }
} else {
    echo "User Not Signed in";
    echo "<script>window.location.href='customer_login.php';</script>";
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
    <title>User Information Page</title>
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

        .user-info {
            margin: 0rem;
        }

        .user-info input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #75e254;
            color: #fff;
            cursor: pointer;
        }

        .user-info input[type="submit"]:hover {
            background-color: #2baa04;
        }

        .textBox {
            display: inline-block;
            margin-right:5rem;
            margin-block: 2rem;

        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="#profile" class="active">Profile</a>
        <a href="#past-orders">Past Orders</a>
    </div>

    <div class="container">
        <div class="content">
           
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
            errorMessageElement = document.getElementById('registration-error-message');
            errorMessageElement.innerText = errorMessage;
        }

        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', clicked => {
                document.querySelector('.sidebar a.active').classList.remove('active');
                clicked.target.classList.add('active');
                const tab = clicked.target.getAttribute('href').slice(1);

                if (tab === 'profile') {
                    document.querySelector('.content').innerHTML = `
                    <div class="user-info">

<div class = "infoContainer">
    <div class="textBox">
        <p>First Name </p>
    </div>
    <div class="textBox">
        <p><?php echo $first_name ?></p>
    </div>

<div class = "infoContainer">
    <div class="textBox">
        <p>Last Name </p>
    </div>
    <div class="textBox">
        <p><?php echo $last_name ?></p>
    </div>
 </div>

 <div class = "infoContainer">
    <div class="textBox">
        <p>Email </p>
    </div>
    <div class="textBox">
        <p><?php echo $email ?></p>
    </div>

    <div class = "infoContainer">
    <div class="textBox">
        <p>Mobile Phone</p>
    </div>
    <div class="textBox">
        <p><?php echo $phone ?></p>
    </div>

</div>
<input type="submit" value="edit">
</div>

    `;
                }
                else if(tab === 'past-orders'){
                    document.querySelector('.content').innerHTML = '';
                }
                

            });
        });
    </script>




</body>

</html>