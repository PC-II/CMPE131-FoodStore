<?php
//check if employee ename and password are provided
if(isset($_POST["eName"]) && isset($_POST["password"]))
{
    if($_POST["eName"] && $_POST["password"])
    {
        $eName = $_POST["eName"];
        $password = $_POST["password"];
        
        //create connection
        $conn = mysqli_connect("localhost", "root", "","userinfo");

        //check connection
        if (!$conn)
        {
            die(("Connection failed: ") . mysqli_connect_error());
        }

        //prepare and bind to protect against sql injection
        $stmt = $conn->prepare("SELECT password FROM employee_info WHERE eName = ?");
        $stmt->bind_param("s", $eName);

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
                echo "\r\n". "Redirecting to employee page...";
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
