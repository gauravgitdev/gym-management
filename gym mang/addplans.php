<?php
$showalert = false;
$showerror = false;
session_start();
if (!isset($_SESSION['loggedin'])) { 
    header("Location:index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'dbconn.php'; 
    $plan_name = mysqli_real_escape_string($conn, $_POST["plan_name"]);
    $plan_description = mysqli_real_escape_string($conn, $_POST["plan_description"]);
    $plan_id = $_POST["plan_id"];
    $instruc_id = $_SESSION['username'];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
 
    $sql_check = "SELECT * FROM plantype WHERE type='$plan_name' OR planId='$plan_id'";
    $result_check = mysqli_query($conn, $sql_check);
    $rows = mysqli_num_rows($result_check);

    if ($rows > 0) { 
        $showerror = true;
    } else { 
        $sql = "INSERT INTO plantype (type, description, planId, instruc_id, start_time, end_time) VALUES ('$plan_name', '$plan_description','$plan_id','$instruc_id', '$start_time', '$end_time')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showalert = true;  
            echo " <script>alert('Plan has been Added Successfully ! '); </script>";
        } else {
             
            echo " <script>alert('Failed to create plan. Please try again.'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Plan Form</title>
    <link rel="stylesheet" href="addplan.css"> 
    <script> 
        <?php if ($showerror): ?>
            alert("Plan name or Plan Id already exists. Please choose a different name or id.");
        <?php endif; ?>
    </script>

</head>
<body>
    <h2>Add Plan</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="plan_name">Plan Name:</label>
        <input type="text" id="plan_name" name="plan_name" required>
        
        <label for="plan_description">Plan Description:</label>
        <textarea id="plan_description" name="plan_description" rows="4" required></textarea>

        <label for="plan_id">Plan Id:</label>
        <input type="number" id="plan_id" name="plan_id" required>

        <label for="start_time">Starting Time:</label>
        <input type="time" id="start_time" name="start_time" required>

        <label for="end_time">Ending Time:</label>
        <input type="time" id="end_time" name="end_time" required>
        
        <button type="submit" name="submit">Add Plan</button>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$showerror && $showalert) {
      
        $plan_name = $_POST['plan_name'];
        $plan_description = $_POST['plan_description'];
        $plan_id = $_POST['plan_id'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
         
        echo "<div class='plan-details'>";
        echo "<h3>Plan Details:</h3>";
        echo "<p><strong>Plan Name:</strong> " . htmlspecialchars($plan_name) . "</p>";
        echo "<p><strong>Plan Description:</strong> " . htmlspecialchars($plan_description) . "</p>";
        echo "<p><strong>Plan Id:</strong> " . htmlspecialchars($plan_id) . "</p>";
        echo "<p><strong>Starting Time:</strong> " . htmlspecialchars($start_time) . "</p>";
        echo "<p><strong>Ending Time:</strong> " . htmlspecialchars($end_time) . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
