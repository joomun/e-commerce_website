<?php
    include './get.php';


	$received = $_GET['keyword'] ;

	if (!empty($received))
	
	{
	load_item($_GET['keyword']);
	}

	else load_item();
?>
