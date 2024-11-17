 document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signupForm');
            const username = document.getElementById('username');
            const name = document.getElementById('name');
            const password = document.getElementById('password');
            const address = document.getElementById('address');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const weight = document.getElementById('weight');
            const height = document.getElementById('height');
            const age = document.getElementById('age');
            const message = document.getElementById('message');

function validateField(field, pattern, errorMsg) {
                if (!pattern.test(field.value)) {
                    field.classList.add('invalid');
                    message.textContent = errorMsg;
                    return false;
                } else {
                    field.classList.remove('invalid');
                    message.textContent = '';
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
                    address.classList.add('invalid');
                    message.textContent = 'Address is required.';
                    return false;
                } else {
                    address.classList.remove('invalid');
                    message.textContent = '';
                    return true;
                }
            });

     email.addEventListener('input', function() {
                validateField(email, /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Enter a valid email address.');
            });

    phone.addEventListener('input', function() {
                validateField(phone, /^\d{10}$/, 'Phone number must be 10 digits long.');
            });

     weight.addEventListener('input', function() {
                validateField(weight, /^\d{1,3}$/, 'Enter a valid weight in kg.');
            });

    height.addEventListener('input', function() {
                validateField(height, /^\d{2,3}$/, 'Enter a valid height in cm.');
            });

     age.addEventListener('input', function() {
                validateField(age, /^\d{1,3}$/, 'Enter a valid age.');
            });

     form.addEventListener('submit', function(event) {
                let isValid = true;
                isValid &= validateField(username, /^[a-zA-Z0-9]{5,}$/, 'Username must be at least 5 characters long and contain only letters and numbers.');
                isValid &= validateField(name, /^[a-zA-Z\s]{3,}$/, 'Name must be at least 3 characters long and contain only letters and spaces.');
                isValid &= validateField(password, /.{6,}/, 'Password must be at least 6 characters long.');
                isValid &= address.value.trim() !== '' ? true : (address.classList.add('invalid'), message.textContent = 'Address is required.', false);
                isValid &= validateField(email, /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Enter a valid email address.');
                isValid &= validateField(phone, /^\d{10}$/, 'Phone number must be 10 digits long.');
                isValid &= validateField(weight, /^\d{1,3}$/, 'Enter a valid weight in kg.');
                isValid &= validateField(height, /^\d{2,3}$/, 'Enter a valid height in cm.');
                isValid &= validateField(age, /^\d{1,3}$/, 'Enter a valid age.');

                if (!isValid) {
                    event.preventDefault();
                    message.textContent = 'Please correct the highlighted fields.';
                }
            });
        });
    