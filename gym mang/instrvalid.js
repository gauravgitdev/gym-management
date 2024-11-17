document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('instrsignup');
    const username = document.getElementById('instruc-id');
    const name = document.getElementById('name');
    const password = document.getElementById('password');
    const address = document.getElementById('address');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const experience = document.getElementById('experience');
    const  gender = document.getElementById('gender');
    const age = document.getElementById('age');
    const message = document.getElementById('message');

    function validateField(field, pattern, errorMsg) {
        if (!pattern.test(field.value)) {
            field.setCustomValidity(errorMsg);
            field.reportValidity();
            return false;
        } else {
            field.setCustomValidity('');
            return true;
        }
    }

               username.addEventListener('input', function() {
        validateField(username, /^[a-zA-Z0-9]{5,}$/, 'Username must be at least 5 characters long and contain only letters and numbers.');
    });
        
           name.addEventListener('input', function() {
        validateField(name, /^[a-zA-Z\s]{3,}$/, 'Name must be at least 3 characters long and contain only letters and spaces.');
    });

           password.addEventListener('input', function() {
                   validateField(password, /.{6,}/, 'Password must be at least 6 characters long.');
    });

               address.addEventListener('input', function() {
        if (address.value.trim() === '') {
            address.setCustomValidity('Address is required.');
            address.reportValidity();
        } else {
            address.setCustomValidity('');
        }
    });

               email.addEventListener('input', function() {
        validateField(email, /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Enter a valid email address.');
    });

    phone.addEventListener('input', function() {
        validateField(phone, /^\d{10}$/, 'Phone number must be 10 digits long.');
    });

    experience.addEventListener('input', function() {
        validateField(experience, /^\d{1,3}$/, 'Enter a valid experience in kg.');
    });

    gender.addEventListener('input', function() {
                   validateField(gender, /^[a-zA-Z\s]{3,}$/, 'Enter a valid gender in cm.');
    });

               age.addEventListener('input', function() {
        validateField(age, /^\d{1,3}$/, 'Enter a valid age.');
    });

    form.addEventListener('submit', function(event) {
        let isValid = true;
        isValid &= validateField(username, /^[a-zA-Z0-9]{5,}$/, 'Username must be at least 5 characters long and contain only letters and numbers.');
        isValid &= validateField(name, /^[a-zA-Z\s]{3,}$/, 'Name must be at least 3 characters long and contain only letters and spaces.');
        isValid &= validateField(password, /.{6,}/, 'Password must be at least 6 characters long.');
        isValid &= address.value.trim() !== '' ? address.setCustomValidity('') : (address.setCustomValidity('Address is required.'), false);
        isValid &= validateField(email, /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Enter a valid email address.');
        isValid &= validateField(phone, /^\d{10}$/, 'Phone number must be 10 digits long.');
        isValid &= validateField(experience, /^\d{1,3}$/, 'Enter a valid experience in kg.');
        isValid &= validateField(gender, /^\d{2,3}$/, 'Enter a valid gender in cm.');
        isValid &= validateField(age, /^\d{1,3}$/, 'Enter a valid age.');

        if (!isValid) {
            event.preventDefault();
            message.textContent = 'Please correct the highlighted fields.';
        } else {
            message.textContent = '';
        }
    });
});
