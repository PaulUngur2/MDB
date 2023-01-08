$(document).ready(function () {
    // Set up event listener for form submission
    $("#pageAdd").on('submit',function (e) {
        // Prevent default form submission
        e.preventDefault();

        // Get the manga ID from the form input
        const mangaId = $("#mangaId").val();
        // Make an AJAX request to page-add.php
        $.ajax({
            type:'POST',
            url:'page-add.php',
            data:{mangaId:mangaId},
            success: function (data){
                // If the manga was deleted from the list, update the button text and hide the rating select
                if (data === "Deleted") {
                    $('.btn').text('Add it to list');
                    $('.yourRating').css('display','none');
                }
                // If the manga was added to the list, update the button text and show the rating select
                else{
                    $('.btn').text('Added');
                    $('.yourRating').css('display','block');
                }
            }
        });
    });

    // Set up event listener for rating select
    $('#ratingSelect').change(function() {
        // Get the selected rating value
        const rating = $(this).val();
        // Make an AJAX request to page-data.php
        $.ajax({
            type: 'POST',
            url: 'page-data.php',
            data: {rating: rating,
                id: id},
        });
    });
});
