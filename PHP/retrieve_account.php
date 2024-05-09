<?php
session_start();
include 'config.php';


$customer_id = $_SESSION["user"];
$account_sql = "SELECT email, password, first_name, last_name, phone, street_name, apartment_number, city, state, zipcode FROM customer_info WHERE customer_id = ?";
$account_stmt = $conn->prepare($account_sql);
$account_stmt->bind_param("s", $customer_id);
$account_stmt->execute();
$account_result = $account_stmt->get_result();

if ($account_result->num_rows > 0) {
    $fetch_account = $account_result->fetch_assoc();
    $email = $fetch_account['email'];
    $first_name = $fetch_account['first_name'];
    $last_name = $fetch_account['last_name'];
    $phone = $fetch_account['phone'];
    $street_name = $fetch_account['street_name'];
    $apartment_number = $fetch_account['apartment_number'];
    $city = $fetch_account['city'];
    $state = $fetch_account['state'];
    $zipcode = $fetch_account['zipcode'];

    $data = [
        'email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'phone' => $phone,
        'street_name'=> $street_name,
        'apartment_number' => $apartment_number,
        'city' => $city,
        'state' => $state,
        'zipcode' => $zipcode,
    ];
    
    
}
?>