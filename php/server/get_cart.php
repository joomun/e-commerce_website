<?php
function load_items()
{
  session_start();
  include "./db.php";
  $db = $mongoClient->selectDatabase("store");
  $collection = $db->selectCollection("products");

  // Retrieve product ID array from session storage
  $product_ids_json = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] : '[]';

  // Decode the JSON string to an array
  $product_ids = json_decode($product_ids_json, true);

  if (count($product_ids) == 0) {
    echo '<div class="text-center">
    <h4>No items in cart</h4>
    <button onclick="window.location.href=\'/website/product.php\'" class="button">Shop Now</button>
  </div>';
  }

  
  // Use the $product_ids array in your code
  $products = $collection->find(array("_id" => array('$in' => array_map(function($id) {
    return new MongoDB\BSON\ObjectID($id);
  }, $product_ids))));

  $products = $collection->find(array("_id" => array('$in' => array_map(function($id) {
    return new MongoDB\BSON\ObjectID($id);
}, $product_ids))), array('quantity' => 1));
  // Display product data
  echo '<div class="row">';
  $i = 1;
  foreach ($products as $product) {
    $product_quantity = $product["quantity"];
    $product_price = $product["price"];
    $product_name = $product["name"];
    $product_image = $product["url"];

    echo '<div class="Cart-Items">
        <div class="image-box">
            <img src=".' . $product_image . '" style={{ height="120px" }} />
        </div>
        <div class="about">
            <h1 class="title product-title" >' . $product_name . '</h1>
        </div>
        <div class="counter">
            <div class="btn plus' . $product["_id"] . '">+</div>
            <div class="count' . $product["_id"] . '">1</div>
            <div class="btn minus' . $product["_id"] . '">-</div>

            <div class="prices">
                <div class="amount">$'. $product_price .'</div>
                <div class="remove" data-product-id="' . $product["_id"] . ' " onclick=remove_one()><u>Remove</u></div>
            </div>
        </div>
    </div>';

    // Add an event listener for the "+" button
    echo '<script>
        $(".plus' . $product["_id"] . '").click(function() {
            var count = parseInt($(".count' . $product["_id"] . '").text());
            if (count < ' . $product_quantity . ') {
                count++;
                $(".count' . $product["_id"] . '").text(count);
            }
        });
    </script>';

    // Add an event listener for the "-" button
    echo '<script>
        $(".minus' . $product["_id"] . '").click(function() {
            var count = parseInt($(".count' . $product["_id"] . '").text());
            if (count > 1) {
                count--;
                $(".count' . $product["_id"] . '").text(count);
            }
        });
    </script>';

    // Disable the "+" button if the product quantity is 0
    if ($product_quantity == 0) {
        echo '<script>
            $(".plus' . $product["_id"] . '").attr("disabled", true);
        </script>';
    }

    if ($i % 3 == 0) {
      echo '</div><div class="row">';
    }
    $i++;
  }
  echo '</div>';
}
?>