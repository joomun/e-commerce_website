// ON LOADING

$(document).ready(function () {
  // Use the AJAX function to retrieve data from a URL
  $.ajax({
    type: "GET",
    url: "/website/php/server/product_builder.php",
    success: function (repsonse) {
      // response == reply from server

      // If the request is successful, run this function
      // The data returned from the server will be stored in the "data" variable
      // Do something with the data here
      $("#product-container").html(repsonse).hide().fadeIn(1000);
    },
  });
});

//ON SEARCH
$(document).ready(function () {
  $("#searchInput").on("keyup", function () {
    // Get the value of the search input field
    var keyword = $("#searchInput").val();

    // Make an AJAX request to the server to search for products with the keyword
    $.ajax({
      type: "GET",
      url: "/website/php/server/search.php",
      data: {
        keyword: keyword,
      },
      success: function (response) {
        // If the request is successful, update the product container with the returned data
        $("#product-container").html(response).hide().fadeIn(1000);
    
        // Send customer tracking data to the server
        var customerId = sessionStorage.getItem("currentloggedin");

        // Send customer tracking data to the server
        var searchQuery = keyword;
        $.ajax({
          type: "POST",
          url: "/website/php/server/track.php",
          data: {
            customerId: customerId,
            searchQuery: searchQuery
          }
        });
        
        // Get customer recommendations from the server
        $.ajax({
          type: "GET",
          url: "/website/php/server/recommendations.php",
          data: {
            customerId: customerId
          },
          success: function (recommendations) {
            // If the request is successful, update the recommended products container with the returned data
            $("#recommended-products-container").html(recommendations).hide().fadeIn(1000);
          }
        });
      },
    });
    
});



function add_tocart() {
  // Get the product ID from the div tag's id attribute
  var product_id = event.target.parentNode.querySelector('div').id;

  // Send an AJAX request to the server to add the product to the cart
  $.ajax({
    type: 'POST',
    url: '/website/php/server/add_to_cart.php',
    data: {product_id: product_id},
    success: function(data) {
      // Show a success message to the user
      Swal.fire({
        title: "Item added to cart!",
        text: "Your item has been successfully added to the cart.",
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("AJAX error: " + errorThrown);
    }
  });
}

$(document).ready(function () {
  $("#selectOption").on("change", function () {
    var selectedOption = $(this).val();

    // Make an AJAX request to the server with the selected option
    $.ajax({
      type: "GET",
      url: "/website/php/server/sort.php",
      data: {
        option: selectedOption,
      },
      success: function (response) {
        // If the request is successful, update the product container with the returned data
        $("#product-container").html(response).hide().fadeIn(1000);
      },
    });
  });
});

