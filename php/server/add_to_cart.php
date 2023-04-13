<?php
session_start();

if (isset($_POST['product_id'])) {
  // Get the product ID from the POST parameters
  $product_id = $_POST['product_id'];

  // Get the current cart items from the session, or initialize an empty array
  $cart_items = isset($_SESSION['cart_items']) ? json_decode($_SESSION['cart_items']) : [];

  // Add the product ID to the cart items array
  $cart_items[] = $product_id;

  // Update the cart items in the session
  $_SESSION['cart_items'] = json_encode($cart_items);

  // Return a success response
  echo "success";
} else {
  // Return an error response if the product ID is not specified
  http_response_code(400);
  echo "error";
}
?>