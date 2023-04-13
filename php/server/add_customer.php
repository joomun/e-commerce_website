<?php

//Include libraries

    include './get.php';


//Select a collection 
$collection = $db->customers;

//Extract the data that was sent to the server
$username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$address= filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Convert to PHP array
$dataArray = [
    "username" => $username, 
    "email" => $email, 
    "address" => $address, 
    "password" => $password
 ];

//Add the new product to the database
$insertResult = $collection->insertOne($dataArray);
    
//Echo result back to user
if($insertResult->getInsertedCount()==1){
    include './website/modal_window_registration.html';
    include "./website/log_in.php";
}
else {
    echo 'Error adding customer';
}






