<?php

//check if at least email and password are provided
if(isset($_POST["email"]) && isset($_POST["password"]))
{
    if($_POST["email"] && $_POST["password"])
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        
        //create connection
        $conn = mysqli_connect("localhost", "root", "","store_database");

        //check connection
        if (!$conn)
        {
            die(("Connection failed: ") . mysqli_connect_error());
        }

        // Prepare a statement to check if the email already exists to protect against sql injection
        $check_sql = "SELECT * FROM customer_info WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if(mysqli_num_rows($check_result) > 0) 
        {
            //Email already exists
            echo "Email already exists!";
        } 
        else 
        {
            // Prepare a statement to insert new user data
            $register_sql = "INSERT INTO customer_info (email, password, firstName, lastName, phoneNumber, Address) VALUES (?, ?, ?, ?, ?, ?)";
            $register_stmt = $conn->prepare($register_sql);
            $register_stmt->bind_param("ssssss", $email, $password, $first_name, $last_name, $phone, $address);
            $register_result = $register_stmt->execute();

            if($register_result) 
            {
                echo "You were registered successfully :) ";
                echo "\nRedirecting to login page...";

                echo "<script>window.location.href='../HTML/customer_login.html';</script>";
                exit();
            } 
            else 
            {
                echo "Error: " . mysqli_error($conn);
            }
        }

        // Close statements and connection
        $check_stmt->close();
        $register_stmt->close();
        mysqli_close($conn); //closes connection
    } 
    else 
    {
        echo "Email or password is empty.";
    }
}

if (isset($errorMessage)) {
    echo "<script>window.location.href='../HTML/customer_login.html?error=" . urlencode($errorMessage) . "';</script>";
}
?>
