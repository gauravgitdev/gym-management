<?php
session_start();
 
if (!isset($_SESSION['loggedin'])) { 
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gym Management</title>
    <link rel="stylesheet" href="about1.css">
</head>

<body> 

    <section class="about-section">
        <div class="about-container">
            <h1>About Our Gym</h1>
            <p>Welcome to StayFit fitness center, where your fitness journey is our top priority. We are dedicated to
                providing a comprehensive and welcoming fitness environment for all levels of experience.</p>

            <h2>Our Mission</h2>
            <p>Our mission is to empower individuals to achieve their fitness goals through top-notch facilities, expert
                trainers. We believe in holistic fitness and strive to offer a variety of
                programs that cater to both physical and mental well-being.</p>

            <h2>Facilities</h2>
            <p>We offer state-of-the-art equipment, spacious workout areas, and specialized zones for weight training,
                cardio, and group classes. Our facilities also include a swimming pool, sauna, and wellness center.</p>

            <h2>Expert Trainers</h2>
            <p>Our team of experienced trainers is here to guide you every step of the way. Whether you're looking for
                personalized training or nutritional advice, our experts are dedicated to helping you
                succeed.</p>

            <h2>Join Us</h2>
            <p>Become a part of our gym community and start your fitness journey today. With a range of membership
                options and flexible plans, we make it easy for you to stay committed to your health and fitness goals.
            </p>
            </div>
         
            </section>
            <section>
                <div class="about-container">
                     <?php include 'feedback.php';     ?>
                </div>
            </section>
            </body>

</html>