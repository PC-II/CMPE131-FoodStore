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
$street_name = json_decode(file_get_contents("php://input"))->street_name;
$apartment_number = json_decode(file_get_contents("php://input"))->apartment_number;
$city = json_decode(file_get_contents("php://input"))->city;
$zipcode = json_decode(file_get_contents("php://input"))->zipcode;

// Validate the data
if (empty($street_name) || empty($city) || empty($zipcode)) {
    // Display an error message
    $response = array(
        'success' => false,
        'message' => 'Please fill in all the fields.'
    );
} else {
    // Update the database
    $update_sql = "UPDATE customer_info SET street_name =?, apartment_number =?, city =?, zipcode =? WHERE customer_id = $customer_id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssss", $street_name, $apartment_number, $city, $zipcode);
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