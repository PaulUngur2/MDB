// Success/Error message
function setFormMessage(formElement, type, message) {
    // Reference to the message
    const messageElement = formElement.querySelector(".formMessage");
    
    // Empties the messages, then adds the message depending on the type*/
    messageElement.textContent = message;
    messageElement.classList.remove("formMessage--Success", "formMessage--Error");
    messageElement.classList.add(`formMessage--${type}`);
}

// Sends error message
function setInputError(inputElement, message) {
    inputElement.classList.add("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = message;
}

// Clears error message
function clearInputError(inputElement) {
    inputElement.classList.remove("formInputError");
    inputElement.parentElement.querySelector(".formInputErrorMessage").textContent = "";
}

// Once the document is loaded the script can run
document.addEventListener("DOMContentLoaded", () => {
    // References
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");

    // Scripts that hide or show the Login and Sign-up forms
    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        // Prevents default*/
        e.preventDefault();
        loginForm.classList.add("formHidden");
        createAccountForm.classList.remove("formHidden");
    });
    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        createAccountForm.classList.add("formHidden");
        loginForm.classList.remove("formHidden");
    });

    // Script to check the input and send errors
    document.querySelectorAll(".formInput").forEach(inputElement => {
        // Once the field isn't focused on anymore, it gets checked
        inputElement.addEventListener("blur", e => {
            switch(e.target.id){
                // Sign-up username checker*/
                case "signupUsername":
                    const usernameFormat = new RegExp ('/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}/');
                    if(!e.target.value.match(usernameFormat)) {
                        const dotsFormat = new RegExp('^[^\\W][\\w.]*(?<!\\.)(?<!\\.\\.)[\\w.]*[^\\W]$');
                        const sizeFormat = new RegExp('^[a-zA-Z0-9]{6,29}$');
                        if(!e.target.value.match(dotsFormat)){
                            setInputError(inputElement, "Username mustn't start/end with dots or have double dots");
                        } else if (!e.target.value.match(sizeFormat)) {
                            setInputError(inputElement, "Username must be between 6 and 29 characters");
                        }
                    }
                    break;
                // Sign-up password checker
                case "signupPassword":
                    let timeout;
                    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
                    let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');
                // Visualizer for the strength of the password
                function strengthChecker(passwordParameter) {
                    if(strongPassword.test(passwordParameter)) {
                        strengthBadge.style.backgroundColor = "green";
                        strengthBadge.textContent = 'Strong';
                    } else if(mediumPassword.test(passwordParameter)) {
                        strengthBadge.style.backgroundColor = 'blue';
                        strengthBadge.textContent = 'Medium';
                    } else {
                        strengthBadge.style.backgroundColor = 'red';
                        strengthBadge.textContent = 'Weak';
                    }
                }
                    // Reference
                    let strengthBadge = document.getElementById('strengthDisplay');
                    
                    // Showing the badge
                    strengthBadge.style.display = 'block';
                    clearTimeout(timeout);
                    
                    // Calling the strength checker
                    timeout = setTimeout(() => strengthChecker(e.target.value), 1);
                    
                    // If the user clears text, the badge is hidden
                    if(e.target.length !== 0){
                        strengthBadge.style.display != 'block';
                    }else {
                        strengthBadge.style.display = 'none';
                    }
                    break;
                // Sign-up confirm password checker
                case "signupConfirmPassword":
                        const pass = document.getElementById("signupPassword").value;
                        if(e.target.value !== pass){
                            setInputError(inputElement, "Passwords do not match");
                        }
                    break;
                // Sign-up email checker
                case "signupEmail":
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
});

$(document).ready(function () {
    // jQuery code to submit the form data to the server
    $("#createAccount").on('submit',function (e) {
        // prevent the default form submission behavior
        e.preventDefault();

        // get the values of the form input fields
        const signupUsername = $("#signupUsername").val();
        const signupEmail = $("#signupEmail").val();
        const signupPassword = $("#signupPassword").val();
        const signupConfirmPassword = $("#signupConfirmPassword").val();

        // Create an AJAX request to submit the form data to the server
        $.ajax({
            type: "POST",
            url: "registration.php",
            // send the form data as an object
            data: {signupUsername:signupUsername,signupEmail:signupEmail,signupPassword:signupPassword,signupConfirmPassword:signupConfirmPassword},
            success: function(data) {
                // variable to store the input element that needs to be highlighted
                let inputElement;
                // check the data returned from the server and select the appropriate input field
                if (data === "Username already exists") {
                    inputElement=document.querySelector("#signupUsername");
                }
                else if (data === "Email already exists") {
                    inputElement=document.querySelector("#signupEmail");
                }else if (data === "Email is not valid") {
                    inputElement=document.querySelector("#signupEmail");
                }else if (data === "Username is not valid") {
                    inputElement=document.querySelector("#signupUsername");
                }else if (data === "Password must be between at least 8 characters long") {
                    inputElement=document.querySelector("#signupPassword");
                }else if (data === "Passwords are not matching") {
                    inputElement = document.querySelector("#signupConfirmPassword");
                }else if (data === "Failed to send to your mail"){
                    inputElement = document.querySelector("#signupEmail");
                }
                // if no error messages are returned, show the success message
                else {
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

    // jQuery code to submit the login form data to the server
    $("#login").on('submit',function (e) {
        // prevent the default form submission behavior
        e.preventDefault();

        // get the values of the form input fields
        const username = $("#username").val();
        const password = $("#password").val();

        // Create an AJAX request to submit the form data to the server
        $.ajax({
            type: "POST",
            url: "login.php",
            // send the form data as an object
            data: {username:username,password:password},
            success: function(data) {
                // variable to store the input element that needs to be highlighted
                let inputElement;
                // check the data returned from the server and select the appropriate input field
                if (data === "Incorrect Username/Email") {
                    inputElement=document.querySelector("#username");
                }else if (data === "Incorrect Password") {
                    inputElement=document.querySelector("#password");
                }
                // if no error messages are returned, redirect to the profile page
                else {
                    window.location.replace("http://localhost/Profile/profile-page.php");
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
