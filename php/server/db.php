<?php
  require __DIR__.'/../../vendor/autoload.php';
  $mongoClient = new MongoDB\Client;
  $db = $mongoClient->selectDatabase("store");
  ;

?>