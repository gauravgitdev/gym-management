<?php 
$showalert = false;
$showerror = false;
require 'dbconn.php';
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["feedback"])) { 
    $feedback = mysqli_real_escape_string($conn, $_POST["feedback"]);
     
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    } else {
        $sql = "INSERT INTO feedback (username, feedback) VALUES ('" . $_SESSION['username'] . "', '$feedback')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $showalert = true;
        } else {
            $showerror = "Feedback not submitted.";
        }
    }
} else {
    $showerror = "All fields are required.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Section</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="feedback-section">
        <?php
        if ($showalert) {
            echo '<div class="alert success">Feedback submitted successfully!</div>';
            header("refresh:2;url=about1.php"); 
        }
        if ($showerror) {
            echo '<div class="alert error">' . $showerror . '</div>';
        }
        ?>
        <h2>Feedback</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" rows="4" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="feedback-display">
        <h2>Feedback from other users:</h2>
        <p>
            <?php  
            $sql2 = "SELECT * FROM feedback";
            $result2 = mysqli_query($conn, $sql2); 
            if ($result2) {
                while ($row = mysqli_fetch_assoc($result2)) { 
                    echo "<div class='feedback-item'>";
                    echo "<p>" . htmlspecialchars($row['feedback']) . " &nbsp; - &nbsp; <b>" . htmlspecialchars($row['username']) . "</b></p>";
                    echo "</div>";
                }
            }
            ?>
        </p>
    </div>
</body>
</html>
