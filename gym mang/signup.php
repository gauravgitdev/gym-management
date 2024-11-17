<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="usersignup.css">
</head>
<body>
    
<div class="form-container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST" id="signupForm">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" 
                   pattern="[a-zA-Z0-9]{3,20}" 
                   title="Username must be 3-20 characters long and contain only letters and numbers."
                   required>
            <span class="error-message" id="usernameError"></span>
        </div>
        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" 
                   pattern="[a-zA-Z\s]{1,50}" 
                   title="Name should be up to 50 characters long and contain only letters and spaces."
                   required>
            <span class="error-message" id="nameError"></span>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" 
                   pattern=".{6,}" 
                   title="Password must be at least 6 characters long."
                   required>
            <span class="error-message" id="passwordError"></span>
        </div>
        <div class="input-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" 
                   pattern=".{1,}" 
                   title="Please enter your address."
                   required>
            <span class="error-message" id="addressError"></span>
        </div>
        <div class="input-group">
            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" 
                   title="Please enter a valid email address."
                   required>
            <span class="error-message" id="emailError"></span>
        </div>
        <div class="input-group">
            <label for="phone">Phone No:</label>
            <input type="tel" id="phone" name="phone" 
                   pattern="\d{10}" 
                   title="Phone number must be exactly 10 digits."
                   required>
            <span class="error-message" id="phoneError"></span>
        </div>
        <div class="input-group">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" 
                   min="1" 
                   title="Please enter your weight in kilograms. It must be a positive number."
                   required>
            <span class="error-message" id="weightError"></span>
        </div>
        <div class="input-group">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" 
                   min="1" 
                   title="Please enter your height in centimeters. It must be a positive number."
                   required>
            <span class="error-message" id="heightError"></span>
        </div>
        <div class="input-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" 
                   min="1" 
                   title="Please enter your age. It must be a positive number."
                   required>
            <span class="error-message" id="ageError"></span>
        </div>
        <button type="submit">Sign Up</button>
        <p id="message" class="error-message">
            <?php 
            $showalert = false;
            $showerror = false;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require 'dbconn.php';  
                 
                $username = mysqli_real_escape_string($conn, $_POST["username"]);
                $name = mysqli_real_escape_string($conn, $_POST["name"]);
                $password = mysqli_real_escape_string($conn, $_POST["password"]);
                $address = mysqli_real_escape_string($conn, $_POST["address"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
                $weight = mysqli_real_escape_string($conn, $_POST["weight"]);
                $height = mysqli_real_escape_string($conn, $_POST["height"]);
                $age = mysqli_real_escape_string($conn, $_POST["age"]);

                 
                $existSql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
                $result = mysqli_query($conn, $existSql);
                $numExistRows = mysqli_num_rows($result);

                if ($numExistRows > 0) {
                    $showerror = "Username or Email already exists";
                } else { 
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
 
                    $sql = "INSERT INTO users (username, name, password, address, email, phone, weight, height, age) VALUES ('$username', '$name', '$hashed_password', '$address', '$email', '$phone', '$weight', '$height', '$age')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $showalert = true;
                    } else {
                        $showerror = "There was an error in creating your account. Please try again.";
                    }
                }
            }

            if ($showalert) {
                echo "<script>
                        alert('Account has been Created.');
                        window.location.href = 'newlogin.php';
                      </script>";
                exit(); 
            }
            
            if ($showerror) {
                echo '<script> alert("'.$showerror.'")</script>';
            }
            ?>
        </p>
    </form>
</div>

<script src="signup1.js"></script>
</body>
</html>
