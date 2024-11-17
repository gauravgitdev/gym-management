<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Include database connection file
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user details.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-brand">StayFit</div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="profile-section">
        <div class="profile-container">
            <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Joined on:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>

            <h2>Your Feedback</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM feedback2 WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . htmlspecialchars($row['feedback']) . "</li>";
                    }
                } else {
                    echo "<li>No feedback submitted yet.</li>";
                }
                ?>
            </ul>
        </div>
    </section>
</body>

</html>

<?php
mysqli_close($conn);
?>
