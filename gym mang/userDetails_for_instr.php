
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Plan Data</title> 
    <link rel="stylesheet" href="userDetails_for_instr.css">
 </head>
<body>
    <div class="container">
    <!-- <div class="search"> -->
            <form action="userDetails_for_instr.php" method="POST">
                <h1>Search user in Database</h1>
                <input type="text" name="searchquery" class="searchbox" placeholder="Enter name">
                <button type="submit">Search</button><br> 
                
                <div id="results">
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
                            <?php if (!empty($searchResults)): ?>
                                <?php foreach ($searchResults as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['height']); ?></td>
                                        <td><?php echo htmlspecialchars($row['weight']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                         
                                         
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <!-- </div> -->
            </form>
        <!-- </div> -->
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
    <!-- </div> -->
</body>
</html>
