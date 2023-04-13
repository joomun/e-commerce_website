<?php

session_start();

// Clear cart in session
$_SESSION['cart'] = array();
session_unset();session_destroy();
// Return success response
echo json_encode(array('success' => true));

session_unset();session_destroy();

?>