
<?php
require 'C:\xampp\htdocs\gym mang\dbconn.php';

$instructors = [];

$sql_users = "SELECT * FROM aprove";
$result_instr = mysqli_query($conn, $sql_users);

if ($result_instr) {
    while ($row = mysqli_fetch_assoc($result_instr)) {
        $instructors[] = $row;
    }
} 

$deleteinstr = null;
$search = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["searchquery"]) && !empty($_POST["searchquery"])) {
        $search = $_POST["searchquery"];
        $sql = "SELECT * FROM aprove WHERE instruc_id LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            
            $searchResults = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        }
    }

    
    if (isset($_POST["deleteUser"]) && !empty($_POST["deleteUser"])) {
        $deleteinstr = $_POST["deleteUser"];
        $sql2 = "DELETE FROM aprove WHERE instruc_id='$deleteinstr'";
        $result2 = mysqli_query($conn, $sql2);
        
        if (!$result2) {
            echo "Error deleting user: " . mysqli_error($conn);
           
        } else{
            echo '<script>alert("instructor deleted!");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Data</title>
    <link rel="stylesheet" href="instrdetails.css">
</head>
<body>
    <div class="container">

            <form action="instrdetails.php" method="POST">
                         <h1>Search Instructor in Database</h1>
                <input type="text" name="searchquery" class="searchbox" placeholder="Enter username">
                         <button type="submit">Search</button><br>
                
                <div id="results">
                    <?php if (!empty($searchResults)): ?>
                        <?php foreach ($searchResults as $row): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>instructorid</th>
                                        <th>Name</th>
                                        <th>phone</th> 
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>gender</th>
                                        <th>Year of exp</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['instruc_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                                        <td><?php echo htmlspecialchars($row['addresss']); ?></td>
                                        <td>
                                            <form action="instrdetails.php" method="POST">
                                                <input type="hidden" name="deleteUser" value="<?php echo $row['instruc_id']; ?>">
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

    
        <h2 style="text-align:center;">All Instructor</h2>
        <table>
            <thead>
                <tr>
                                      <th>instructorid</th>
                                        <th>Name</th>
                                        <th>phone</th> 
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>gender</th>
                                        <th>Year of exp</th>
                                        <th>Address</th>
                                     
                </tr>
            </thead>
            <tbody>
            <?php foreach ($instructors as $instructor): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($instructor['instruc_id']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['name']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['phone']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['age']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['email']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['gender']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['experience']); ?></td>
                        <td><?php echo htmlspecialchars($instructor['addresss']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</body>
</html>
