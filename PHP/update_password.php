<?php
session_start();
include 'config.php';

$errors = [];
$data = [];

if (empty($_POST['old_password'])) {
    $errors['old_password'] = 'old password is required.';
}

if (empty($_POST['new_password'])) {
    $errors['new_password'] = 'new password is required.';
}

if (empty($_POST['confirm_password'])) {
    $errors['confirm_password'] = 'confirm password is required.';
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    $customer_id = $_SESSION["user"];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $account_sql = "SELECT password FROM customer_info WHERE customer_id = ?";
    $account_stmt = $conn->prepare($account_sql);
    $account_stmt->bind_param("s", $customer_id);
    $account_stmt->execute();
    $account_result = $account_stmt->get_result();

    if ($account_result->num_rows > 0) {
        $row = $account_result->fetch_assoc();
        $old_password_db = $row['password'];

        if ($old_password !== $old_password_db)
        {
            $errors['old_password'] = "Old password is incorrect";
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        else {
            $update_sql = "UPDATE customer_info SET password =? WHERE customer_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_password, $customer_id);
            $update_stmt->execute();
            if($update_stmt->affected_rows > 0)
            {
                
                $data['success'] = true;
                $data['message'] = 'Password updated!';
            }
            else{
                $errors['password_not_updated'] = 'Password not updated! ';
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        }
    }
    else {
        $data['success'] = false;
        $data['message'] = 'Could not Find account';
    }
    
    
    echo json_encode($data);
}

?>