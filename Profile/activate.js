// Script starts when the document is ready
$(document).ready(function () {
    // Set up a click event listener for the resendEmail button
    $("#resendEmail").on('click',function (e) {
        // Prevent the default action of the event
        e.preventDefault();
        // Send a POST request to the not-activated.php script
        $.ajax({
            type: "POST",
            url: "not-activated.php",
            data: {}
        });
    });

    // Set up a click event listener for the resetProfile button
    $("#resetProfile").on('click',function (e) {
        // Prevent the default action of the event
        e.preventDefault();
        // Send a POST request to the reset-password-link.php script
        $.ajax({
            type: "POST",
            url: "reset-password-link.php",
            data: {email:email},
            success: function (data) {
                // Redirect to the reset-password-page.php script with the token in the URL
                window.location.replace("http://localhost/Reset%20Password/reset-password-page.php?token="+data);
            }

        });
    });
});
