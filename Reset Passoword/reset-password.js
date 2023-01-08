// Sets a message in the form (success or error)
function setFormMessage(formElement, type, message) {
    // Reference to the message element
    const messageElement = formElement.querySelector(".formMessage");

    // Empties the messages, then adds the message depending on the type
    messageElement.textContent = message;
    messageElement.classList.remove("formMessage--Success", "formMessage--Error");
    messageElement.classList.add(`formMessage--${type}`);
}

// Shows an error message for an input element
function setInputError(inputElement, message) {
    inputElement.classList.add("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = message;
}

// Clears the error message for an input element
function clearInputError(inputElement) {
    inputElement.classList.remove("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = "";
}

$(document).ready(function () {
    // Add event listeners for form input elements
    document.querySelectorAll(".formInput").forEach(inputElement => {
        // Once the field isn't focused on anymore, it gets checked
        inputElement.addEventListener("blur", e => {
            // Check input values based on input element ID
            switch (e.target.id) {
                case "password":
                    // Check if password is at least 8 characters long
                    const size = new RegExp('^[\\S]{8,}$');
                    if (!e.target.value.match(size)){
                        setInputError(inputElement, "Password needs to be at least 8 characters");
                    }
                    break;
                case "cPassword":
                    // Check if password and confirm password match
                    const pass = document.getElementById("password").value;
                    if (e.target.value !== pass) {
                        setInputError(inputElement, "Passwords do not match");
                    }
                    break;
                // Check if email is a valid format
                case "email":
                    const emailFormat = new RegExp (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
                    if(!e.target.value.match(emailFormat)){
                        setInputError(inputElement, "Not a valid email");
                    }
                    break;

                default:
                    break;
            }
        });
        // When the user writes on the field, the error is cleared
        inputElement.addEventListener("input", e =>{
            clearInputError(inputElement);
        });
    });

    // Submit event for resetting password
    $("#resetPassword").on('submit',function (e) {
        // Prevent form submission
        e.preventDefault();

        // Get form input values
        const email = $("#email").val();
        const password = $("#password").val();
        const cPassword = $("#cPassword").val();

        // Send ajax request to reset-password-data.php
        $.ajax({
            type:"POST",
            url:"reset-password-data.php",
            // send the form data as an object
            data:{email:email,
                password:password,
                cPassword:cPassword,
                token: token
            },

            success:function (data) {
                // variable to store the input element that needs to be highlighted
                let inputElement;
                // check the data returned from the server and select the appropriate input field
                if (data === "Passwords do not match") {
                    inputElement = document.querySelector("#cPassword");
                } else if (data === "Password must be at least 8 characters long") {
                    inputElement = document.querySelector("#password");
                } else if (data === "Wrong email") {
                    inputElement = document.querySelector("#email");
                }else if (data === "All fields are required"){
                    inputElement = document.querySelector("#email");
                }else {
                    // if no error is returned, print the message
                    $(".formSuccessMessage").css("display","block").html((data));
                }
                // call the setInputError function to highlight the appropriate input field
                setInputError(inputElement, data);
                // clear the error message when the input field is changed
                inputElement.addEventListener("input", e => {
                    clearInputError(inputElement);
                });
            }
        });
    });
});