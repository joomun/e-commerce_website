<?php
// connect to MongoDB
include "./website/php/server/db.php";


$collection = $db->customer_tracking;

// get the customer ID from the HTML session storage
session_start();
$customerId = $_SESSION['currentloggedin'][0]['id'];

// query the collection for search queries by the customer
$query = array('customer_id' => $customerId);
$cursor = $collection->find($query);

// get a list of distinct search queries by the customer
$searchQueries = array();
foreach ($cursor as $document) {
    $searchQueries[] = $document['search_query'];
}
$searchQueries = array_unique($searchQueries);

// generate recommendations based on the customer's search history
$recommendations = array();
foreach ($searchQueries as $query) {
    // query the products collection for products matching the search query
    $products = $db->products->find(array('name' => new MongoDB\BSON\Regex($query, 'i')));
    foreach ($products as $product) {
        $recommendations[] = $product;
    }
}

// limit the number of recommendations to 5
$recommendations = array_slice($recommendations, 0, 5);

// encode the recommendations array as JSON and return it to the AJAX request
echo json_encode($recommendations);
?>