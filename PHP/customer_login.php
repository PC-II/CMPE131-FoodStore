<?php
session_start();

// Check if email and password are provided
if(isset($_POST["email"]) && isset($_POST["password"])) {
    if($_POST["email"] && $_POST["password"]) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Create connection
        $conn = mysqli_connect("localhost", "root", "", "store_database");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind to protect against SQL injection
        $stmt = $conn->prepare("SELECT customer_id, password FROM customer_info WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Check if password is correct
            if ($row["password"] === $password) { 
                $_SESSION["user"] = $row["customer_id"];
                
                
                // Close connections
                $stmt->close();
                mysqli_close($conn); 
                
                echo "<script>window.location.href='/PHP/index.php';</script>";
                exit();
            } 
            else {
                $errorMessage = "Password incorrect";
            }
        }  
        else {
            $errorMessage = "User does not exist";
        }

        // Close connections
        $stmt->close();
        mysqli_close($conn); 
    } 
    else {
        $errorMessage = "Email or password is empty.";
    }
}

if (isset($errorMessage)) {
    echo "<script>window.location.href='/HTML/customer_login.html?error=" . urlencode($errorMessage) . "';</script>";
    
}


