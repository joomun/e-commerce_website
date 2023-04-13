$(document).ready(function () {
  // Use the AJAX function to retrieve data from a URL
  $.ajax({
    type: "GET",
    url: "/website/php/server/cart_builder.php",
    success: function (repsonse) {
      // response == reply from server

      // If the request is successful, run this function
      // The data returned from the server will be stored in the "data" variable
      // Do something with the data here
      $("#cart-container").html(repsonse).hide().fadeIn(1000);
    },
  });
});

$(document).ready(function () {
  // Handle click event on "Remove all" button
  $("#remove-all").click(function () {
    $.ajax({
      type: "POST",
      url: "/website/php/server/clear_cart.php",
      success: function () {
        // clear the cart container and content
        $("#cart-container").html("");
        $("#cart-content").html("");
        // display a success message using SweetAlert
        Swal.fire({
          icon: "success",
          title: "Cart cleared",
          text: "All items have been removed from your cart.",
        });

        var message =
          '<div class="text-center">' +
          "<h4>No items in cart</h4>" +
          '<button onclick="window.location.href=\'/website/product.php\'" class="button">Shop Now</button>' +
          "</div>";

        $("#cart-container").html(message);
      },
    });
  });
});

function remove_one(product_id) {
  $.ajax({
    type: "POST",
    url: "/website/php/server/remove_from_cart.php",
    data: { product_id: product_id },
    success: function (response) {
      Swal.fire({
        icon: "success",
        title: "Cart cleared",
        text: "Item.",
      });
      // Update the cart container with the new content
      $("#cart-container").html(response).hide().fadeIn(1000);
    },
  });
}

function check_out() {

    if (!sessionStorage.getItem("currentloggedin")) {
      // Display a confirmation dialog using SweetAlert
      Swal.fire({
        icon: "warning",
        title: "You are not logged in",
        text: "Please log in to proceed with your order.",
        showCancelButton: true,
        confirmButtonText: "Log In",
        cancelButtonText: "Cancel",
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to the login page
          window.location.href = "/website/log_in.php";
        }
      });
    } else {
      // User is logged in, proceed with checkout
      var subtotal = $("#subtotal").text();

      // Display a confirmation dialog using SweetAlert
      Swal.fire({
        icon: "info",
        title: "Confirm your order",
        html: "Subtotal: " + subtotal + "<br><br>Are you sure you want to proceed?",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
      }).then((result) => {
        if (result.isConfirmed) {
          // Proceed with the order
          // ...
        }
      });
    }
  }
