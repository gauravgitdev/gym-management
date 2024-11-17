<?php 
session_start();
if (!isset($_SESSION['loggedin'])) { 
    header("Location:index.php");
}
include 'dbconn.php';

$sql = "SELECT * FROM contact";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Table</title>
    <link rel="stylesheet" href="contact_display1.css">
     
</head>
<body>
    <h2>MASSAGES</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td data-label='Name'>" . $row["name"]. "</td>";
                echo "<td data-label='Email'>" . $row["email"]. "</td>";
                echo "<td data-label='Message'>" . $row["message"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
