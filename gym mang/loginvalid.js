document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    // Real-time validation as the user types
    usernameInput.addEventListener("input", function() {
        validateUsername();
    });

    passwordInput.addEventListener("input", function() {
        validatePassword();
    });

    // Validate the form on submission
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        validateUsername();
        validatePassword();

        // Prevent form submission if there are errors
        if (document.querySelector('.error')) {
            event.preventDefault();
        }
    });

    // Validate the username
    function validateUsername() {
        const username = usernameInput.value.trim();
        clearError(usernameInput);

        if (username === "") {
            showError(usernameInput, "Username is required");
        } else if (username.length < 3 || username.length > 20) {
            showError(usernameInput, "Username must be between 3 and 20 characters");
        }
    }

    // Validate the password
    function validatePassword() {
        const password = passwordInput.value.trim();
        clearError(passwordInput);

        if (password === "") {
            showError(passwordInput, "Password is required");
        } else if (password.length < 6) {
            showError(passwordInput, "Password must be at least 6 characters long");
        }
    }

    // Show error message
    function showError(inputField, message) {
        const errorDiv = document.createElement("div");
        errorDiv.className = "error";
        errorDiv.innerText = message;
        inputField.parentNode.insertBefore(errorDiv, inputField.nextSibling);
    }

    // Clear any existing error messages
    function clearError(inputField) {
        const errorDiv = inputField.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error')) {
            errorDiv.remove();
        }
    }
});
