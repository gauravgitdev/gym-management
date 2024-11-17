<?php
 
$showalert = false;
$showerror = false;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'C:\xampp\htdocs\gym mang\dbconn.php';
     
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $weight = mysqli_real_escape_string($conn, $_POST["weight"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
     
    $username=$_SESSION['username'];
    $existSql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    
    if ($numExistRows > 0) { 
        $sql = "UPDATE users SET phone='$phone', weight='$weight', age='$age' WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $showalert = true;
        } else {
            $showerror = "There was an error in updating your details. Please try again.";
        }
    } else {
        $showerror = "User does not exist.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
     <link rel="stylesheet" href="Update_plan.css">
        
</head>
<body>
<?php 
    if ($showalert) {
        echo "<script>
        alert('Account has been updated.');
        window.location.href = 'home.php';
      </script>";
exit(); 
    } 
    if ($showerror) {
        echo ' <script>alert("'.$showerror.'") </script>';
    }
?>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
        <ul class="nav-links"> 
            <li><a href="/gym mang/about1.php">About</a></li>
            <li><a href="/gym mang/contact.php">Contact Us</a></li>
        </ul>
    </nav>
    <div class="form-container">
        <h2>Update Details</h2>
        <form action="update.php" method="POST" id="updateForm">
            
            
            <div class="input-group">
                <label for="phone">New Phone No:</label>
                <input type="tel" id="phone" name="phone" pattern="^\d{10}$" title="Phone number must be 10 digits long." required>
            </div>
            <div class="input-group">
                <label for="weight">New Weight (kg):</label>
                <input type="number" id="weight" name="weight" pattern="^\d{1,3}$" title="Enter a valid weight in kg." required>
            </div>
            <div class="input-group">
                <label for="age">New Age:</label>
                <input type="number" id="age" name="age" pattern="^\d{1,3}$" title="Enter a valid age." required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
