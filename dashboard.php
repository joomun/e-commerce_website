<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/mainpage.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="./js/server/view_order.js"> </script>
</head>

<body>
    <video autoplay muted loop plays-inline class='backvid'>
        <source src='./assests/video/cms_vid.mp4' type='video/mp4' />
    </video>
    <div class="container">
        <h1>Welcome</h1>
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./dashboard.php">Customer Dashboard</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./php/server/get_orders.php">Orders</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li class="nav-item" id="login-nav-item">
                <li><a href="log_in.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </li>
                <li class="nav-item" id="logout-nav-item" style="display:none;">
                    <a class="nav-link js-scroll-trigger" href="#" onclick="log_out()">Log out</a>
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

                // Display the user's name next to the "Welcome" greeting
                $('h1').append(', ' + username_logged_in);
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
                    // Redirect the user to the dashboard page
                    window.location.href = 'dashboard.php';
                });
            }
        </script>

    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2>Orders</h2>
                <p>View and manage your orders here.</p>
                <a id="view_order_btn" class="btn btn-primary" onclick=display_orders()>View Orders</a>
            </div>
            <div class="col-sm-4">
                <h2>Profile</h2>
                <p>Update your profile information.</p>
                <a href="#" class="btn btn-primary">Edit Profile</a>
            </div>
            <div class="col-sm-4">
                <h2>Support</h2>
                <p>Get help with your account.</p>
                <a href="#" class="btn btn-primary">Contact Support</a>
            </div>
        </div>
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Orders</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table-body">
                            <!-- Order rows will be added dynamically by JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>