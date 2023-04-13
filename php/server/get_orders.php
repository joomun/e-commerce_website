<?php

session_start();

if (!isset($_SESSION['currentloggedin'])) {
  $response_array['error'] = 'Please login first.';
  echo json_encode($response_array);
  exit();
}

$Object_id = $_SESSION['currentloggedin'];

include "/db.php";
// connect to MongoDB
$mongo = $db;

// query orders with matching Object_id
$filter = ['Object_id' => $Object_id];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mongo->executeQuery('orders', $query);

// check if there are any orders
if (!$rows->isDead()) {
  $response_array = array();
  foreach ($rows as $row) {
    $order = array(
      'Object_id' => $row->Object_id,
      'Name' => $row->Name
    );
    array_push($response_array, $order);
  }
  echo json_encode($response_array);
} else {
  $response_array['error'] = 'No orders yet.';
  echo json_encode($response_array);
}

?>
