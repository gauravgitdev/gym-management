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
    <link rel="stylesheet" href="instrhome.css">
         
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
        <ul class="nav-links">
            <li><a href="instrHome.php">Home</a></li>
            <li><a href="about1.php">About</a></li>
            <li><a href="instrProfile.php">Profile</a></li>
            <li><a href="userDetails_for_instr.php">User-Details</a></li>
            <li><a href="addplans.php">Plan</a></li>
            <?php 
            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            }
            ?>
            
        </ul>
    </nav>
    <center><h1>“Once you are exercising regularly, the hardest thing is to stop it.”</h1></center>
    <header class="hero-section">
        
        <video autoplay muted loop>
            <source src="\gym mang\videoplayback.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>
        <div class="hero-container">
            <h1>Welcome - Instructor "<?php echo $_SESSION['username']?>"<br>to StayFit Fitness Center</h1>
            <p>Your ultimate destination for fitness and wellness</p>
        </div>
    </header>

    <section class="services-section">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service">
                <h3>Advanced Equipment</h3>
                <img src="david-marioni-F_lns58a_ec-unsplash.jpg" alt="Advanced Equipment">
                <p>User will get modern equipment for their fitness journey training with our advanced equipment.</p>
            </div>
            <div class="service">
                <h3>Experienced Trainers</h3>
                <img src="total-shape-TY_Ce5d2G-k-unsplash.jpg" alt="Experienced Trainers">
                <p>We have experienced trainers to guide our users.</p>
            </div>
            <div class="service">
                <h3>Friendly Environment</h3>
                <img src="victor-freitas-nlZTjUZX2qo-unsplash.jpg" alt="Friendly Environment">
                <p>User will experience a friendly environment which enlightens a friendly atmosphere.</p>
            </div>
        </div>
    </section>

    <section class="packages-section">
        <div class="plan_table">
            <h2 style="color: green">Packages</h2>
            <table>
                <tr>
                    <th>Plan Type</th>
                    <th>Description</th>
                    <th>Plan Id</th>
                    <th>Instructor</th>
                    <th>Enrolled</th>
                    <th>Starting</th>
                    <th>Ending</th>
                </tr>
                <?php
                require 'dbconn.php';
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
                }
                ?>
            </table>
            <br> 
        </div>
    </section>

    <section class="testimonials-section">
        <div class="testimonials-container">
            <h2>What Our Members Say</h2>
            <div class="testimonial">
                <p>"StayFit has transformed my life. The trainers are amazing, and the facilities are top-notch!" - Manas</p>
            </div>
            <div class="testimonial">
                <p>"I love the Friendly Environment! They're fun, engaging, and perfect for all fitness levels." - Aryan</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 StayFit Fitness Center. All rights reserved.</p>
    </footer>
</body>
</html>
