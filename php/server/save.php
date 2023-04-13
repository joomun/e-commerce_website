
<?php
include './db.php';



// Select the database and collection
$collection = $db->selectCollection("customers");

// Retrieve input data
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$address = $_POST["address"];

// Check if user already exists
$user = $collection->findOne(['name' => $username]);
if (!empty($user)) {
    // User already exists
    echo json_encode(array('success' => false, 'message' => 'User already exists!'));
} else {
    // User doesn't exist, insert into database
    $result = $db->customers->insertOne(array(
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'address' => $address,
    ));

    if ($result->getInsertedCount() == 1) {
        // Registration successful
        echo json_encode(array('success' => true, 'message' => 'Registration successful. Click on sign in and Shop in our store'));
    } else {
        // Registration failed
        echo json_encode(array('success' => false, 'message' => 'Registration failed. Please try again later.'));
    }
}

?>
