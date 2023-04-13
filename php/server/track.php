<?php
// connect to MongoDB
include "./website/php/server/db.php";


$collection = $db->customer_tracking;

// get the customer ID from the HTML session storage
session_start();
$customerId = $_SESSION['currentloggedin'][0]['id'];

// get the search query from the AJAX request
$searchQuery = $_POST['searchQuery'];

// create a new document to store the tracking data
$document = array(
    'customer_id' => $customerId,
    'search_query' => $searchQuery,
    'timestamp' => new MongoDB\BSON\UTCDateTime(time() * 1000)
);

// insert the document into the collection
$result = $collection->insertOne($document);

// return success message to the AJAX request
echo "Tracking data for customer $customerId saved successfully.";
?>