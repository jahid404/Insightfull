$(document).ready(function() {
  $(".view-more").click(function() {
    var offset = $(this).data("offset");
    $.ajax({
      url: "../php/get-products.php",
      type: "POST",
      data: {offset: offset},
      success: function(data) {
        $("#product-grid").append(data);
        $(".view-more").data("offset", offset + 8);
      }
    });
  });
});