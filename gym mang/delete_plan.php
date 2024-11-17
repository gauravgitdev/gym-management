<?php
session_start(); 
    if (!isset($_SESSION['loggedin'])) { 
        header("Location:index.php");
        exit;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'dbconn.php';
 
    $plan_id = mysqli_real_escape_string($conn, $_POST["plan_id"]);
 
    $sql = "DELETE FROM plantype WHERE planId='$plan_id' AND instruc_id='" . $_SESSION['username'] . "'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Plan deleted successfully.'); window.location.href = 'instrProfile.php';</script>";
    } else {
        echo "<script>alert('Error deleting plan.'); window.location.href = 'instrProfile.php';</script>";
    }
}
?>
