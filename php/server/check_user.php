<?php

// Connect to MongoDB
include './db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$users = $db->customers;
$user = $users->findOne(['name' => $username, 'password' => $password]);

// Check if user was found
if ($user) {
    // User was found, return a success response
    $response = array(
        'success' => true,
        'name' => $user['name'],
        'id' => $user['_id'], // add ObjectID to the response
    );
} else {
    // User not found, return an error response
    $response = array(
        'success' => false,
        'message' => 'Invalid username or password'
    );
}

// Convert the response to JSON and return it
echo json_encode($response);

?>