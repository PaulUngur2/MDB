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
                    if(e.target.value.length > 0 && e.target.value.length < 6) {
                        setInputError(inputElement, "Username must be at least 6 characters in length");
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