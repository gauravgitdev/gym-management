
<?php
require 'C:\xampp\htdocs\gym mang\dbconn.php';

$users = []; 
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

if ($result_users) {
    while ($row = mysqli_fetch_assoc($result_users)) {
        $users[] = $row;
    }
} 

$deleteUser = null;
$search = null;
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["searchquery"]) && !empty($_POST["searchquery"])) {
        $search = $_POST["searchquery"];
        $sql = "SELECT * FROM users WHERE username LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) { 
            $searchResults = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        }
    } 
    if (isset($_POST["deleteUser"]) && !empty($_POST["deleteUser"])) {
        $deleteUser = $_POST["deleteUser"];
        $sql2 = "DELETE FROM users WHERE username='$deleteUser'";
        $result2 = mysqli_query($conn, $sql2);
        
        if (!$result2) {
            echo "Error deleting user: " . mysqli_error($conn);
           
        } else{
            echo '<script>alert("User deleted!");</script>';
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
    <link rel="stylesheet" href="userdetails.css">
</head>
<body>
    <div class="container"> 
            <form action="userdetails.php" method="POST">
                <h1>Search user in Database</h1>
                <input type="text" name="searchquery" class="searchbox" placeholder="Enter name">
                <button type="submit">Search</button><br> 
                <div id="results">
                    <?php if (!empty($searchResults)): ?>
                        <?php foreach ($searchResults as $row): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['height']); ?></td>
                                        <td><?php echo htmlspecialchars($row['weight']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td>
                                            <form action="userdetails.php" method="POST">
                                                <input type="hidden" name="deleteUser" value="<?php echo $row['username']; ?>">
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                         
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table> 
            </form> 
    </div>
 
        <h2 style="text-align:center;">All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Age</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td><?php echo htmlspecialchars($user['age']); ?></td>
                        <td><?php echo htmlspecialchars($user['height']); ?></td>
                        <td><?php echo htmlspecialchars($user['weight']); ?></td>
                        <td><?php echo htmlspecialchars($user['address']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
</body>
</html>
