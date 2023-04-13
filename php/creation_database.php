<?php
  // Connect to MongoDB
  $client = new MongoDB\Client("mongodb://localhost:27017");

  // Check if the request is to create a product collection
  if ($_POST["action"] == "createProductCollection") {
    // Get the product_db database
    $db = $client->product_db;
  
    // Create the products collection
    $db->createCollection("products");
    
    // Insert product details into the collection
    $productDetails = [
      [ "name" => "Product 1", "price" => 20, "quantity" => 10 ],
      [ "name" => "Product 2", "price" => 25, "quantity" => 5 ],
      [ "name" => "Product 3", "price" => 30, "quantity" => 15 ]
    ];
    
    $db->products->insertMany($productDetails);
    
    echo "Product collection created successfully.";
  }
?>