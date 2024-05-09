<?php
//check if employee ename and password are provided
if(isset($_POST["first_name"]) && isset($_POST["last_name"])  && isset($_POST["password"]))
{
    if($_POST["first_name"] && $_POST["first_name"] && $_POST["password"])
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        
        //create connection
        $conn = mysqli_connect("localhost", "root", "","store_database");

        //check connection
        if (!$conn)
        {
            die(("Connection failed: ") . mysqli_connect_error());
        }

        //prepare and bind to protect against sql injection
        $stmt = $conn->prepare("SELECT password FROM employee_info WHERE first_name = ? AND last_name = ?");
        $stmt->bind_param("ss", $first_name, $last_name);
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
                
                $stmt->close();
                mysqli_close($conn); 

                echo "Logged in Successfully.";
                echo "\r\n". "Redirecting to employee page...";

                $_SESSION["admin"] = "true";
                echo "<script>window.location.href='../PHP/admin.php';</script>";
                exit();
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
        echo "Name or password is empty.";
    }
}
?>
