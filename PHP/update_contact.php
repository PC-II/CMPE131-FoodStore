<?php
session_start();
include 'config.php';

$errors = [];
$data = [];

if (empty($_POST['first_name'])) {
    $errors['first_name'] = 'First name  is required.';
}

if (empty($_POST['last_name'])) {
    $errors['last_name'] = 'Last name is required.';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
}

if (empty($_POST['phone'])) {
    $errors['phone'] = 'Phone is required.';
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} 
else {
    $customer_id = $_SESSION["user"];
    if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["phone"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
    }

    //updates contact info
    $update_sql_c = "UPDATE customer_info SET first_name =?, last_name =?, email =?, phone =? WHERE customer_id = $customer_id";
    $update_stmt_c = $conn->prepare($update_sql_c);
    $update_stmt_c->bind_param("ssss", $first_name, $last_name, $email, $phone);
    $update_stmt_c->execute();
    $update_contact = $update_stmt_c->get_result();

    if(($update_stmt_c->affected_rows) > 0) {
        $data['success'] = true;
        $data['message'] = 'Contact info updated successfully!';
    }
    else {
        $errors['no_changes'] = "No Changes were made!";
        $data['success'] = false;
        $data['errors'] = $errors;
    }   
    
    
    
    echo json_encode($data);
}

?>