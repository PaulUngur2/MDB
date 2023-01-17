// Function for setting the form message
function setFormMessage(formElement, type, message) {
    // Reference to the message element
    const messageElement = formElement.querySelector(".formMessage");

    // Empties the messages, then adds the message depending on the type
    messageElement.textContent = message;
    messageElement.classList.remove("formMessage--Success", "formMessage--Error");
    messageElement.classList.add(`formMessage--${type}`);
}

// Function for displaying an error message for an input element
function setInputError(inputElement, message) {
    inputElement.classList.add("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = message;
}

// Function for clearing the error message for an input element
function clearInputError(inputElement) {
    inputElement.classList.remove("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = "";
}

$(document).ready(function () {
    // Submit event listener for the forgot password form
    $("#forgotPassword").on('submit',function (e) {
        e.preventDefault();

        // Get the email value from the form
        const email = $("#email").val();

        // Send an AJAX request to the forgot-password-data.php file
        $.ajax({
            type:"POST",
            url:"forgot-password-data.php",
            data:{email:email},
            success:function (data){
                // Get the email input element
                let inputElement = document.querySelector("#email");
                // If the response is a success message
                if (data === "Password link has been sent to your mail") {
                    // Display the success message
                    $(".formSuccessMessage").css("display","block");
                    $(".formSuccessMessage").html((data));
                }else{
                    // Display an error message for the email input
                    setInputError(inputElement,data);
                }
                // Add an input event listener to clear the error message when the input is changed
                inputElement.addEventListener("input", e => {
                    clearInputError(inputElement);
                });
            }
        });
    });
});
