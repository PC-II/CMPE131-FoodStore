<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login Page</title>
    <style>
        hr {
          display: block;
          margin-top: 0.5em;
          margin-bottom: 0.5em;
          margin-left: auto;
          margin-right: auto;
          border-style: inset;
          border-width: 1px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #d8f0d1;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #edebeb;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
        text-align: center;
    }

        .link {
            text-align: center;
            margin-top: 10px;
        }
        .container2 {
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
    </style>
</head>
<body>

<div class="container">
    <div class="login-box" >
    <?php
    include 'config.php';
      if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])){
        if ($_POST["name"] && $_POST["email"] && $_POST["subject"] && $_POST["message"]){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

       
          
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES('$name','$email','$subject','$message')";

        $results = mysqli_query($conn,$sql);

        if ($results) {
          echo "Your message has been submitted. Thank you for contacting us. We will reach out with a reply as soon as possible.";
        } else{
          echo mysqli_error($conn);
        }

        mysqli_close($conn);


      }
      else {
        echo "One or more of the boxes are empty.";
      }
    } else{
        echo "Form was not submitted.";
      }
     ?>


        <hr>

        <div class="link">
            <p><a href="../PHP/index.php">Home Page</a></p>
        </div>

    </div>
</div>

</body>

<script src = "../SRC/index.js"></script>
</html>
