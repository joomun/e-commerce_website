<?php

session_start();
$product_id = $_POST['product_id'];

// Retrieve product ID array from session storage
$product_ids_json = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] : '[]';

// Decode the JSON string to an array
$product_ids = json_decode($product_ids_json, true);

// Remove one instance of the product ID from the array
$key = array_search($product_id, $product_ids);
if ($key !== false) {
  unset($product_ids[$key]);
}

// Encode the array as a JSON string and store it in the session storage
$_SESSION['cart_items'] = json_encode(array_values($product_ids));
session_write_close();
// Return the updated cart content
include "./cart_builder.php";
?>
