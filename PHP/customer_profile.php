<?php
    session_start();

    if(isset($_SESSION["user"]))
    {
        $email = $_SESSION["user"];

        // Create connection to userinfo
        $conn = mysqli_connect("localhost", "root", "", "userinfo");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind to protect against SQL injection
            $select_sql = "SELECT firstName, lastName, phoneNumber, Address FROM customer_info WHERE email = ?";
            $select_stmt = $conn->prepare($select_sql);
            $select_stmt->bind_param("s", $email);

       // Execute the query
            $select_stmt->execute();
            $select_result = $select_stmt->get_result();

            if ($select_result->num_rows > 0) {
                $customer = $select_result->fetch_assoc();
                $firstName = $customer["firstName"];
                $lastName = $customer["lastName"];
                $phoneNumber = $customer["phoneNumber"];
                $address = $customer["Address"];
            }
    }
    else{
        echo "User Not Signed in";
        echo "<script>window.location.href='../HTML/customer_login.html';</script>";
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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .user-info-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .user-info-box h2 {
            text-align: center; 
        }

        .user-info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-info-table th,
        .user-info-table td {
            padding: 10px;
            border: 1px solid #ccc;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="user-info-box">
            <h2>Your Information</h2>
            <table class="user-info-table">
                <tr>
                    <th>First Name</th>
                    <td> <?php echo $firstName; ?> </td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td> <?php echo $lastName; ?> </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td> <?php echo $email; ?> </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td> <?php echo $phoneNumber; ?> </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $address; ?></td>
                </tr>
            </table>

           
        </div>
    </div>

    <div class="bottom-bar">
        <a href="../HTML/aboutpage.html">Need Support?</a>
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
    </script>
</body>
</html>


