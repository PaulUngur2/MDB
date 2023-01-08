/*This script runs when the document is ready */
$(document).ready(function () {

    // Attach a keyup event handler to the liveSearch element
    $("#liveSearch").keyup(function () {
        // Get the value of the liveSearch element
        var input = $(this).val();

        // If the input is not an empty string
        if (input != ""){
            // Send an AJAX POST request to the browse-data.php file
            $.ajax({
                url:"browse-data.php",
                method:"POST",
                data:{input,input},
                // When the request is successful, update the searchResult element with the returned data and display it
                success: function (data){
                    $("#searchResult").html(data).css("display","block");
                }
            });
        }
        // If the input is an empty string, hide the searchResult element
        else {
            $("#searchResult").css("display","none");
        }
    });
});