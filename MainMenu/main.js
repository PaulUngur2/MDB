$(document).ready(function(){
    // Set up event listener for search input
    $('.search-box input[type="text"]').on("keyup input", function(){

        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");

        // If there is input text, make a request to the server
        if(inputVal.length){
            $.get("main-data.php", {term: inputVal}).done(function(data){

                // Display the returned data in the results dropdown
                resultDropdown.html(data);
            });
        } else{
            // Clear the results dropdown if there is no input text
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        // Set the value of the search input to the clicked item
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        // Clear the results dropdown
        $(this).parent(".result").empty();
    });
});
