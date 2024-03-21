<?php

//check if at least email and password are provided
if(isset($_POST["email"]) && isset($_POST["password"]))
{
    if($_POST["email"] && $_POST["password"])
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        //create connection
        $conn = mysqli_connect("localhost", "root", "","userinfo");

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
            $register_sql = "INSERT INTO customer_info (email, password) VALUES (?, ?)";
            $register_stmt = $conn->prepare($register_sql);
            $register_stmt->bind_param("ss", $email, $password);
            $register_result = $register_stmt->execute();

            if($register_result) 
            {
                echo "You were registered successfully :) ";
                echo "\nRedirecting to home page...";

                

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
?>
