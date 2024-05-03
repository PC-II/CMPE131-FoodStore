<?php
session_start();

// Check if email and password are provided
if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["password"])) {
    if($_POST["first_name"] && $_POST["last_name"]&& $_POST["password"]) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        
        // Create connection
        $conn = mysqli_connect("localhost", "root", "", "store_database");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind to protect against SQL injection
        $stmt = $conn->prepare("SELECT password FROM employee_info WHERE first_name = ? AND last_name = ?");
        $stmt->bind_param("ss", $first_name, $last_name); 

        // Execute query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Check if password is correct
            if ($row["password"] === $password) { 
                $_SESSION["user"] = $first_name;


                // Close connections
                $stmt->close();
                mysqli_close($conn); 
                
                echo "<script>window.location.href='employee_page.php';</script>";
                exit();
            } 
            else {
                $errorMessage = "Password incorrect";
            }
        }  
        else {
            $errorMessage = "Employee does not exist";
        }

        // Close connections
        $stmt->close();
        mysqli_close($conn); 
    } 
    else {
        $errorMessage = "Name or password is empty.";
    }
}

if (isset($errorMessage)) {
    echo "<script>window.location.href='/HTML/employee_login.html?error=" . urlencode($errorMessage) . "';</script>";
    
}

?>
