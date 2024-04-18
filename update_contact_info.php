<?php
session_start();

// Get the customer ID from the session
$customer_id = $_SESSION["user"];
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "store_database");

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Get the updated contact details from the POST data
$first_name = json_decode(file_get_contents("php://input"))->first_name;
$last_name = json_decode(file_get_contents("php://input"))->last_name;
$email = json_decode(file_get_contents("php://input"))->email;
$phone = json_decode(file_get_contents("php://input"))->phone;

// Validate the data
if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
    // Display an error message
    $response = array(
        'success' => false,
        'message' => 'Please fill in all the fields.'
    );
} else {
    // Update the database
    $update_sql = "UPDATE customer_info SET first_name =?, last_name =?, email =?, phone =? WHERE customer_id = $customer_id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);
    $update_stmt->execute();

    // Check if the update is successful
    if ($update_stmt->affected_rows > 0) {
        // Set the success flag to true
        $response = array(
            'success' => true,
            'message' => 'Contact details updated successfully.'
        );
    }
    else{
        // Set the success flag to true
        $response = array(
            'success' => true,
            'message' => 'no new data.'
        );
    }
    

    // Close the statement
    $update_stmt->close();
}

// Close the connection
$conn->close();

// Send the response to the client
echo json_encode($response);
?>