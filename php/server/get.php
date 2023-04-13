<?php
function load_item($keyword = "")
{
  include "./db.php";
  $db = $mongoClient->selectDatabase("store");
  $collection = $db->selectCollection("products");

  $products = [];
  if (!empty($keyword)) {
    $result = $collection->find(array("details" => new MongoDB\BSON\Regex($keyword, "i")));
  } else {
    $result = $collection->find();
  }

  foreach ($result as $product) {
    $products[] = $product;
  }

  echo '<div class="row">';
  $i = 1;
  foreach ($products as $product) {
    $product_id=(string)$product['_id'];
    echo '<div class="col-sm-3 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body text-center">
            <img src="./' . $product['url'] . '" class="product-image">
            <h5 class="card-title"><b>' . $product['name'] . '</b></h5>
            <p class="card-text smaller">' . $product['details'] . '</p>
            <p class="tags">Price $' . $product['price'] . '</p>
            
            <a class="btn btn-success button-text add-to-cart" onclick="add_tocart()"><i class="fa fa-shopping-cart" aria-hidden="true" onclick="add_tocart()"></i> Add to cart</a>
            <div id='.$product_id.'></div>
            </div>
        </div>
      </div>';
  
    if ($i % 3 == 0) {
      echo '</div><div class="row">';
      
    }
    $i++;
  }
  echo '</div>';
}


