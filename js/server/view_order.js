function display_orders(){

    console.log("[ljkfwnbe")
    $.ajax({
      type: "POST",
      url: "/website/php/server/get_orders.php",
      dataType: "json",
      success: function(data) {
        if (data.error) {
          $("#result").html(data.error);
        } else {
          var html = "<h2>Orders</h2>";
          html += "<table><tr><th>Order ID</th><th>Name</th></tr>";
          $.each(data, function(index, value) {
            html += "<tr><td>" + value.Object_id + "</td><td>" + value.Name + "</td></tr>";
          });
          html += "</table>";
          $("#result").html(html);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });

}