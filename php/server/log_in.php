<?php
include './db.php';

// select the database and collection to use
$collection = $db->customers;

// handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // create a new document to insert into the collection
    $document = array(
        'name' => $username,
        'email' => $email,
        'password' => $password,
        'address' => $address,
    );

    // insert the new document into the collection
    $result = $collection->insertOne($document);

    // check if the insertion was successful
    if ($result->getInsertedCount() == 1) {
        exit;
    } else {
        // handle insertion error
        echo "An error occurred while inserting the data.";
    }
}


?>