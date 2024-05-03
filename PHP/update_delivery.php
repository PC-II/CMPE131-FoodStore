<?php
session_start();
include 'config.php';

$errors = [];
$data = [];

if (empty($_POST['street_name'])) {
    $errors['street_name'] = 'Street name  is required.';
}

if (empty($_POST['city'])) {
    $errors['city'] = 'City name is required.';
}

if (empty($_POST['zipcode'])) {
    $errors['zipcode'] = 'Zipcode is required.';
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} 
else {
    $customer_id = $_SESSION["user"];
    if (isset($_POST["street_name"]) && isset($_POST["apartment_number"]) && isset($_POST["city"]) && isset($_POST["zipcode"])) {
        $street_name = $_POST["street_name"];
        $apartment_number = $_POST["apartment_number"];
        $city = $_POST["city"];
        $zipcode = $_POST["zipcode"];
    }

    //updates delivery info
    $update_sql_d = "UPDATE customer_info SET street_name =?, apartment_number =?, city =?, zipcode =? WHERE customer_id = $customer_id";
    $update_stmt_d = $conn->prepare($update_sql_d);
    $update_stmt_d->bind_param("ssss", $street_name, $apartment_number, $city , $zipcode);
    $update_stmt_d->execute();
    $update_delivery = $update_stmt_d->get_result();

    if(($update_stmt_d->affected_rows) > 0) {
        $data['success'] = true;
        $data['message'] = 'Delivery info updated successfully!';
    }
    else {
        $errors['no_changes'] = "No Changes were made!";
        $data['success'] = false;
        $data['errors'] = $errors;
    }   
    
    
    
    echo json_encode($data);
}

?>