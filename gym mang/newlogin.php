<?php
$login = false;
$showError = false;
require 'dbconn.php';
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $sql_user = "SELECT * FROM users WHERE username='$username'";
    $result_user = mysqli_query($conn, $sql_user);
    $user_data = mysqli_fetch_assoc($result_user);

    $sql_instructor = "SELECT * FROM aprove WHERE instruc_id='$username'";
    $result_instructor = mysqli_query($conn, $sql_instructor);
    $instructor_data = mysqli_fetch_assoc($result_instructor);

    $sql_admin = "SELECT * FROM admin WHERE admin='$username'";
    $result_admin = mysqli_query($conn, $sql_admin);
    $admin_data = mysqli_fetch_assoc($result_admin);
  
    if ($user_data && password_verify($password, $user_data['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user'] = true;
        header("location: home.php");
        exit();
    } elseif ($instructor_data && password_verify($password, $instructor_data['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['instructor'] = true;
        header("location: instrHome.php");
        exit();
    } elseif ($admin_data) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = true;
        header("location: adminHome1.php");
        exit();
    } else {
        $showError = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="newlogin1.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
    </nav>

    <?php 
        if ($login) {
            echo "<div class='alert alert-success'>You are logged in</div>";
        } elseif ($showError) {
            echo "<div class='alert alert-danger'>$showError</div>";
        }
    ?>
    
    <div class="login-container">
        <h2>Login</h2>
        <form action="newlogin.php" method="POST" id="loginForm">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
<script>document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    
    usernameInput.addEventListener("input", function() {
        validateUsername();
    });

    passwordInput.addEventListener("input", function() {
        validatePassword();
    });

    
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        validateUsername();
        validatePassword();

      
        if (document.querySelector('.error')) {
            event.preventDefault();
        }
    });

    
    function validateUsername() {
        const username = usernameInput.value.trim();
        clearError(usernameInput);

        if (username === "") {
            showError(usernameInput, "Username is required");
        } else if (username.length < 3 || username.length > 20) {
            showError(usernameInput, "Username must be between 3 and 20 characters");
        }
    }

    
    function validatePassword() {
        const password = passwordInput.value.trim();
        clearError(passwordInput);

        if (password === "") {
            showError(passwordInput, "Password is required");
        } else if (password.length < 6) {
            showError(passwordInput, "Password must be at least 6 characters long");
        }
    }

    
    function showError(inputField, message) {
        const errorDiv = document.createElement("div");
        errorDiv.className = "error";
        errorDiv.innerText = message;
        inputField.parentNode.insertBefore(errorDiv, inputField.nextSibling);
    }

   
    function clearError(inputField) {
        const errorDiv = inputField.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error')) {
            errorDiv.remove();
        }
    }
});
</script>
    
    
</body>
</html>
