$(document).ready(function() {

  // When Enter Key is Pushed in Input
  $("#data").keypress(function(event) {
    if (event.keyCode === 13) {
        $("#send-btn").click();
    }
    });

  $("#send-btn").on("click", function() {
    $value = $("#data").val();
    $(".message").append($value);
    $("#data").val('');

    // Ajax Code to Connect to PHP File
    $.ajax({
      url: './index.php',
      type: 'POST',
      data: {value: $value},
      success: function(result) {
        $(".message").html(result);
      }
    });
  });

});
