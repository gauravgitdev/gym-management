<?php
session_start();
require 'C:\xampp\htdocs\gym mang\dbconn.php';
if (!isset($_SESSION['loggedin'])) { 
    header("Location:index.php");
    exit;
}

$users = [];
$searchResults = [];
 
$sql_users = "SELECT * FROM feedback";
$result_users = mysqli_query($conn, $sql_users);

if ($result_users) {
    while ($row = mysqli_fetch_assoc($result_users)) {
        $users[] = $row;
    }
} 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["searchquery"]) && !empty($_POST["searchquery"])) {
        $search = mysqli_real_escape_string($conn, $_POST["searchquery"]);
        $sql = "SELECT * FROM feedback WHERE username LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 
    if (isset($_POST["deletefeed"]) && !empty($_POST["deletefeed"])) {
        $deletefeed = mysqli_real_escape_string($conn, $_POST["deletefeed"]);
        $sql2 = "DELETE FROM feedback WHERE username='$deletefeed'";
        $result2 = mysqli_query($conn, $sql2);
        
        if ($result2) {
            echo '<script>alert("User feedback deleted!");</script>'; 

        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Plan Data</title>
    <link rel="stylesheet" href="deleteFeedback.css">
    
</head>
<body> 
        <center>
        <form action="deleteFeedback.php" method="POST">
            <h1>Search user in Database</h1>
            <input type="text" name="searchquery" class="searchbox" placeholder="Enter username">
            <button type="submit">Search</button><br></center>
            
            <div id="results">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                                <td>
                                    <form action="deleteFeedback.php" method="POST">
                                        <input type="hidden" name="deletefeed" value="<?php echo htmlspecialchars($row['username']); ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user feedback?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>

        <h2>All Feedback</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Feedback</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['feedback']); ?></td>
                        <td>
                            <form action="deleteFeedback.php" method="POST">
                                <input type="hidden" name="deletefeed" value="<?php echo htmlspecialchars($user['username']); ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user feedback?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
</body>
</html>

