$(document).ready(function() {
  // Function to retrieve orders for current logged-in user
  function showOrders() {
    // Retrieve current logged-in user ID from session storage
    let current_user = JSON.parse(sessionStorage.getItem('currentloggedin'));
    let user_id = current_user.id;

    // Send an AJAX request to retrieve orders for the user from MongoDB
    $.ajax({
      url: "get_orders.php",
      type: "POST",
      data: { user_id: user_id },
      success: function(response) {
        // Display the orders in a table
        $("#orders-table tbody").html(response);
      },
      error: function(xhr, status, error) {
        console.log("Error: " + error);
      }
    });
  }

  // Bind the showOrders function to the "View Orders" button
  $("#view-orders-btn").click(function() {
    showOrders();
  });
});
