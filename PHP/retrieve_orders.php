<?php
session_start();
include 'config.php';


$customer_id = $_SESSION["user"];
$order_sql = "SELECT order_id, name, number, email, street_name, apartment_number, city, state, zipcode, total_product, total_price FROM orders_history WHERE customer_id = ?";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("s", $customer_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows > 0) {
    $fetch_order = $order_result->fetch_assoc();
    $order_id = $fetch_order['order_id'];
    $name = $fetch_order['name'];
    $number= $fetch_order['number'];
    $email = $fetch_order['email'];
    
    $street_name = $fetch_order['street_name'];
    $apartment_number = $fetch_order['apartment_number'];
    $city = $fetch_order['city'];
    $state = $fetch_order['state'];
    $zipcode = $fetch_order['zipcode'];

    $total_product = $fetch_order['total_product'];
    $total_price = $fetch_order['total_price'];

    $order_data = [
        'order_id' => $order_id,
        'name' => $name,
        'number' => $number,
        'email' => $email,
        'street_name'=> $street_name,
        'apartment_number' => $apartment_number,
        'city' => $city,
        'state' => $state,
        'zipcode' => $zipcode,
        'total_product' => $total_product,
        'total_price' => $total_price
    ];
    
    
}
?>