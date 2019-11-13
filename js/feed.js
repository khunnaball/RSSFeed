// Anything inside document.ready will only run when the DOM is ready to recieve JS code.
$(document).ready(function() {
  // On click function that is triggered when the showMore button is clicked.
  $("#showMore").on("click", function() {
    // Setup variables with the value of the hidden inputs in index.php.
    var feedURL = $("#feedURL").val();
    var limit = $("#limit").val();

    // Empty the feed div, show the loading div, and hide the showMore button.
    $("#feed").empty();
    $("#loading").show();
    $("#showMore").hide();

    /* Ajax request to send the feedURL and limit variables to the functions.php file.
       in the data section the the word before the colon is whatever you want to call the data
       and the name used to get the data in the PHP file and after the colon is the name of variable,
       or raw data e.g. "Hello there", 123, true, etc.
    */
    $.ajax({
      type: "POST",
      url: "php/functions.php",
      async: true,
      data: {
        feedURL: feedURL,
        limit: limit
      },
      /* On success of the AJAX call when a response is recieved hide the loading div
         and update the content of the HTML with the response from the PHP file.      
      */
      success: function(response) {
        $("#loading").hide();
        $("#feed").html(response);
      }
    });
  });

  // End ready
});
