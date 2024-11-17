<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - StayFit</title> 

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004d40;
            padding: 10px 20px;
        }

        .nav-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #1abc9c;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .hero-section video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 75%;
            object-fit: cover;
            z-index: 1;
            transform: translate(-50%, -50%);
        }

        .hero-section .hero-container {
            position: relative;
            z-index: 2;
        }

        .packages-section {
            padding: 20px;
            background-color: #e5e1e1;
        }

        .packages-section .plan_table {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: auto;
        }

        .packages-section h2 {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        .packages-section table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .packages-section table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .packages-section th,
        .packages-section td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .packages-section th {
            background-color: #004d40;
            color: #fff;
            font-weight: bold;
        }

        .packages-section form {
            margin-top: 20px;
            text-align: center;
        }

        .packages-section input[type="number"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 200px;
        }

        .packages-section input[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .packages-section input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .services-section {
            padding: 50px 20px;
            background-color: #fff;
        }

        .services-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #e74c3c;
        }

        .services-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .service {
            /* border: 2px; */
            text-align: center;
            max-width: 300px;
            margin: 20px;
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .service:hover {
            transform: translateY(-15px);
        }

        .service img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .testimonials-section {
            padding: 50px 20px;
            background-color: #fff;
        }

        .testimonials-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #e74c3c;
        }

        .testimonials-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .testimonial {
            background-color: #ecf0f1;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #004d40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="about1.php">About</a></li>
            <?php 
            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="userProfile.php">Profile</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="newlogin.php">Login</a></li>';
                echo '<li><a href="signup.php">User</a></li>';
                echo '<li><a href="instrsignup.php">InstSignup</a></li>';
            }
            ?>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

    <center><h1>“Once you are exercising regularly, the hardest thing is to stop it.”</h1></center>

    <header class="hero-section">
        <video autoplay muted loop>
            <source src="videoplayback.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>
    </header>

    <section class="services-section">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service">
                <h3>Advanced Equipment</h3>
                <img src="david-marioni-F_lns58a_ec-unsplash.jpg" alt="image">
                <p>User will get modern equipment for their fitness journey training with our advanced equipment.</p>
            </div>
            <div class="service">
                <h3>Experienced Trainers</h3>
                <img src="total-shape-TY_Ce5d2G-k-unsplash.jpg" alt="image">
                <p>We have experienced trainers to guide our users.</p>
            </div>
            <div class="service">
                <h3>Friendly Environment</h3>
                <img src="victor-freitas-nlZTjUZX2qo-unsplash.jpg" alt="image">
                <p>Users will experience a friendly environment which enlightens a friendly atmosphere.</p>
            </div>
        </div>
    </section>

    <section class="packages-section">
        <div class="plan_table">
            <h2>Packages</h2>
            <table>
                <tr>
                    <th>Plan Type</th>
                    <th>Description</th>
                    <th>Plan Id</th>
                    <th>Instructor</th>
                    <th>Enrolled</th>
                    <th>Startind</th>
                    <th>Ending</th>
                </tr>
                <?php
                require 'C:\xampp\htdocs\gym mang\dbconn.php';
                $sql2 = "SELECT * FROM plantype";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo "<tr><td>" . htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row['planId'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row['instruc_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                        $planType = mysqli_real_escape_string($conn, $row['type']);
                        $sql_check = "SELECT COUNT(*) as plan_count FROM plans WHERE plan='$planType'";
                        $result_check = mysqli_query($conn, $sql_check);
                        $row_check = mysqli_fetch_assoc($result_check);
                        echo "<td>" . htmlspecialchars($row_check['plan_count'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['start_time'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['end_time'], ENT_QUOTES, 'UTF-8') . "</td></tr>";
                   }
                } else {
                    echo "<tr><td colspan='5'>Error: " . mysqli_error($conn) . "</td></tr>";
                }
                
                ?>
            </table>
            <br>
            <form action="submitplan.php" method="POST">
                <input type="number" name="Uplan_id" placeholder="Enter Plan ID to Enroll">
                <input type="submit" value="Enroll Now">
            </form>
             
        </div>
    </section>

    <section class="testimonials-section">
        <div class="testimonials-container">
            <h2>What Our Members Say</h2>
            <div class="testimonial">
                <p>"StayFit has transformed my life. The trainers are amazing, and the facilities are top-notch!" - Manas</p>
            </div>
            <div class="testimonial">
                <p>"I love the friendly environment! They're fun, engaging, and perfect for all fitness levels." - Aryan</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 StayFit Fitness Center. All rights reserved.</p>
    </footer>
</body>
</html>
