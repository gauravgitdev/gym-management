<?php
session_start();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instrucId = $_POST['instruc-id'];
    $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience = $_POST['experience'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $uploadOk = 1;
    $targetDir = "gym mang/";
    $targetFile = $targetDir . basename($_FILES['document']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    
    if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
        $document = $_FILES['document'];

        
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        
        if ($document["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

    
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
            echo "Sorry, only PDF, DOC, DOCX files are allowed.";
            $uploadOk = 0;
        }

    
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {

            if (move_uploaded_file($document["tmp_name"], "".$document['name'] )) {
                
                require 'dbconn.php';
                $sql = "INSERT INTO instructors (instruc_id, password, name, email, addresss, phone, experience, gender, age, document) VALUES ('$instrucId', '$hashedPassword', '$name', '$email', '$address', '$phone', '$experience', '$gender', '$age', '$targetFile')";
                
                if ($conn->query($sql) === TRUE) {
                   
                    echo "<script>
                    alert('Signup successful! wait for admin approval.');
                    window.location.href = 'index.php';
                  </script>";

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded or there was an error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Signup</title>
    <link rel="stylesheet" href="instrsignup.css">
</head>
<body>
    <div class="container">
        <h1>Instructor Signup</h1>
        <form action="instructor_signin.php" method="POST" enctype="multipart/form-data" id="instrsign">
            <div class="form-group">
                <label for="instruc-id">Instructor ID</label>
                <input type="text" id="instruc-id" name="instruc-id" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="experience">Years of Experience</label>
                <input type="number" id="experience" name="experience" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="document">Upload Resume/Certificate</label>
                <input type="file" id="document" name="document" required>
            </div>
            <button type="submit" class="btn">Signup</button>
        </form>
    </div>
    <script src="instrvalid.js"></script>
</body>
</html>
