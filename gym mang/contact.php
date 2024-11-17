<?php
$showalert = false;
$showerror = false;
 session_start();
if (!isset($_SESSION['loggedin'])) {
     header("location:index.php");
}
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'dbconn.php';
 
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
 
   $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
   
   if (mysqli_query($conn, $sql)) { 
    
    echo "<script>
    alert('New record created sucessfully.');
    window.location.href = 'home.php';
  </script>";
exit(); 
   } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gym Management</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
        <ul class="nav-links">
        <?php 
            if (isset($_SESSION['loggedin'])) {
              echo '  <li><a href="home.php">Home</a></li>';
                echo '<li><a href="userProfile.php">Profile</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            }  
            ?>  
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

    <section class="contact-section">
        <div class="contact-container">
            <h1>Contact Us</h1>
            <p>If you have any questions or need further information, please feel free to contact us. We're here to help!</p>
            
            <h2>Contact Information</h2>
            <p><strong>Address:</strong> Pullincunno , alapuzha keral pin-688506</p>
            <p><strong>Phone:</strong> +91 8102408219, 91+ 8891837150</p>
            <p><strong>Email:</strong> bsssunny04@gmail.com</p>
            
            <h2>Send Us a Message</h2>
            <form action="contact.php" method="POST"id="contactForm">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
            <p id="form-message"></p>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>