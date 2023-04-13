<?php

include './php/server/db.php';
include './php/server/get.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Keymaster | Products</title>

	<!-- Font Awesome Icons -->
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<!-- Custom CSS -->
	<link href="./css/product_style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="./js/server/load_product.js"></script>

</head>

<?php
include './php/common.php';
links("Homepage");
title("Homepage");

?>


<body id="page-top">

	<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
		<div class="container">
			<img src="./Assests/Images/keymaster_circle.png" width="80px" height="80x" />
		</div>

		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto my-2 my-lg-0">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="index.php">Home</a>
				</li>

				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="product.php">Products</a>
				</li>

				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="dashboard.php">Dashboard</a>
				</li>

				<li class="nav-item" id="login-nav-item">
					<a class="nav-link js-scroll-trigger" href="log_in.php">Login</a>
				</li>

				<li class="nav-item" id="logout-nav-item" style="display:none;">
					<a class="nav-link js-scroll-trigger" href="#" onclick="log_out()">Log out</a>
				</li>

				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="cart.php">Cart</a>
				</li>
			</ul>
		</div>


		<script>
			// Check if user is logged in
			update_navbar();
			if (sessionStorage.getItem('currentloggedin')) {
				// User is logged in, retrieve user ID and name from session storage
				let user = JSON.parse(sessionStorage.getItem('currentloggedin'));
				let user_id = user.id;
				let username_logged_in = user.name;

				// Hide the Login button and show the Logout button
				$('#login-nav-item').hide();
				$('#logout-nav-item').show();
			} else {
				// User is not logged in, hide the Logout button and show the Login button
				$('#logout-nav-item').hide();
				$('#login-nav-item').show();
			}

			function update_navbar() {
				let login_nav_item = document.getElementById("login-nav-item");
				let logout_nav_item = document.getElementById("logout-nav-item");

				// Check if there is a logged in user in the session storage
				let logged_in_user = sessionStorage.getItem('currentloggedin');

				if (logged_in_user) {
					// Show the "Log out" button and hide the "Login" button
					login_nav_item.style.display = "none";
					logout_nav_item.style.display = "block";
				} else {
					// Show the "Login" button and hide the "Log out" button
					login_nav_item.style.display = "block";
					logout_nav_item.style.display = "none";
				}
			}

			function log_out() {
				// Remove the current logged-in user from the session storage
				sessionStorage.removeItem('currentloggedin');

				// Show a SweetAlert to confirm that the user has been logged out
				Swal.fire({
					icon: 'success',
					title: 'Logged out',
					text: 'You have been logged out.',
					timer: 3000, // 3 seconds
					timerProgressBar: true,
					showConfirmButton: false
				}).then(() => {
					// Redirect the user to the home page
					window.location.href = 'index.php';
				});
			}
		</script>

	</nav>


	<header class="page-section masthead2">
		<section>
			<!-- fetch background video  -->

			<div class="container h-50" id="header">
				<video autoplay muted loop plays-inline>
					<source src="./assests/video/banner_vid.mp4" type='video/mp4' />
				</video>
				<div class="caption">
					<h1 class="section-header text-white font-weight-bold">Products</h1>
					<p class="main-menu text-white-75 font-weight-light mb-5"><a class="link-menu" href="home.html">Keymaster > <span style="color:white;">Products</span></a></p>
				</div>
			</div>
		</section>
	</header>

	<section class="page-section">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 blog-form">
					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<h2 class="blog-sidebar-title"><b>Filter</b></h2>
					<hr />

					<div class="input-group mb-3">
						<div class="form-group">
							<input type="text" class="form-control" id="searchInput" placeholder="Search for products">
						</div>

					</div>

					<div>&nbsp;</div>
					<div>&nbsp;</div>



				</div>
				<!--END  <div class="col-lg-3 blog-form">-->

				<div class="col-lg-9" style="padding-left: 30px;">
					<div class="row">
						<div class="col">

						</div>

						<div class="col">

							<select id="selectOption" class="form-control">
								<?php
								// Code to retrieve options from database or any other source
								$options = ['Default', 'Low to High', 'High to Low'];
								foreach ($options as $option) {
									echo '<option value="' . $option . '">' . $option . '</option>';
								}
								?>
							</select>
						</div>


					</div>
					<!-- Sorting by <div class="row"> -->
					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<div id="product-container">

					</div>


				</div>
				<!--END  <div class="col-lg-9">-->
				<!-- Back to Homepage box overflow  -->

			</div>
			<a href="#" class="gotobottom"><i class="fas fa-arrow-up"></i></a>
		</div>
	</section>

	<button id="btn">Click to load</button>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>



	<!-- Bootstrap JavaScript -->

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!-- SweetAlert CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.min.css">

	<!-- SweetAlert JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.min.js"></script>

</body>


<?php
footer_function();
?>

</html>