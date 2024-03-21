<?php
//check if email and password are provided
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

        //prepare and bind to protect against sql injection
        $stmt = $conn->prepare("SELECT password FROM customer_info WHERE email = ?");
        $stmt->bind_param("s", $email);

        //execute query
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        if($result->num_rows === 1)
        {
            $row = $result->fetch_assoc();
            //check if password is correct
            if ($row["password"] === $password)
            { 
                echo "Logged in Successfully.";
                
                echo "\r\n". "Redirecting to home page...";
            }
            else
            {
                echo "Password incorrect";
            }
        }
        else
        {
            echo "User does not exist";
        }

        //close connections
        $stmt->close();
        mysqli_close($conn); 
    } 
    else 
    {
        echo "Email or password is empty.";
    }
}
?>
