/* This script runs when the document is ready */
$(document).ready(function () {
// When the form with the id "addSeries" is submitted, this function is run
    $("#editSeries").on('submit', function (e) {
// This prevents the default action of the form submission
        e.preventDefault();
        // These variables store the values of the form input fields with the corresponding ids
        const name = $("#name").val();
        const id = $("#mangaId").val();
        const description = $("#textarea").val();
        const genre = $("#genre").val();
        const image = $("#image").val();
        const author = $("#author").val();
        const status = $("#status").val();

        // This sends an AJAX request to the specified URL with the form data as an object
        $.ajax({
            type: "POST",
            url: "page-edit-data.php",
            data: {
                name:name,
                id:id,
                description:description,
                genre:genre,
                image:image,
                author:author,
                status:status
            },
            // If the request is successful, this function is run
            success: function (data) {
                // If the server sends back the message "Series is in the database", the error message is displayed and the data returned by the server is written in the error message
                if (data === "Name already is in the database") {
                    $("#nameError").css("display", "block").html(data);
                    // Otherwise, the page is redirected to the main page
                } else {
                    window.location.replace(data);
                }
            }
        });
    });

    // When the textarea element is keyed up, this function is run
    $('textarea').keyup(function () {

        // This counts the number of characters in the textarea
        var characterCount = $(this).val().length,
            // These variables store the elements with the corresponding ids
            current = $('#current'),
            maximum = $('#maximum'),
            theCount = $('#count');

        // The text of the element with the id "current" is set to the character count
        current.text(characterCount);

        // If the character count is less than 500, the color of the text is set to grey
        if (characterCount < 500) {
            current.css('color', '#666');
        }
        // If the character count is between 500 and 1000, the color of the text is set to dark red
        if (characterCount > 500 && characterCount < 1000) {
            current.css('color', '#6d5555');
        }
        // If the character count is between 1000 and 1500, the color of the text is set to medium red
        if (characterCount > 1000 && characterCount < 1500) {
            current.css('color', '#793535');
        }
        // If the character count is between 1500 and 2000, the color of the text is set to light red
        if (characterCount > 1500 && characterCount < 2000) {
            current.css('color', '#841c1c');
        }
        // If the character count is between 2000 and 2500, the color of the text is set to bright red
        if (characterCount > 2000 && characterCount < 2500) {
            current.css('color', '#8f0001');
        }
        // If the character count is greater than or equal to 2500, the text and maximum text are set to bright red and the font weight is set to bold
        if (characterCount >= 2500) {
            maximum.css('color', '#8f0001');
            current.css('color', '#8f0001');
            theCount.css('font-weight', 'bold');
        }
        // Otherwise, the maximum text color is set to grey and the font weight is set to normal
        else {
            maximum.css('color', '#666');
            theCount.css('font-weight', 'normal');
        }
    });
});