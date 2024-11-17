document.addEventListener("DOMContentLoaded", function() {
    // Get references to form fields and error message spans
    const fields = {
        username: document.getElementById("username"),
        name: document.getElementById("name"),
        password: document.getElementById("password"),
        address: document.getElementById("address"),
        email: document.getElementById("email"),
        phone: document.getElementById("phone"),
        weight: document.getElementById("weight"),
        height: document.getElementById("height"),
        age: document.getElementById("age")
    };

    const errorMessages = {
        usernameError: document.getElementById("usernameError"),
        nameError: document.getElementById("nameError"),
        passwordError: document.getElementById("passwordError"),
        addressError: document.getElementById("addressError"),
        emailError: document.getElementById("emailError"),
        phoneError: document.getElementById("phoneError"),
        weightError: document.getElementById("weightError"),
        heightError: document.getElementById("heightError"),
        ageError: document.getElementById("ageError")
    };

    // Function to validate individual fields
    function validateField(field, errorElement) {
        if (field.checkValidity()) {
            errorElement.textContent = ''; // Clear error message if valid
        } else {
            errorElement.textContent = field.title; // Show the title attribute as error message
        }
    }

    // Attach input event listeners to all fields for real-time validation
    Object.keys(fields).forEach(fieldName => {
        fields[fieldName].addEventListener("input", function() {
            validateField(fields[fieldName], errorMessages[`${fieldName}Error`]);
        });
    });
});
