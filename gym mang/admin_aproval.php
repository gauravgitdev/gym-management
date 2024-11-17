<?php
session_start();
require 'dbconn.php';
if  ($_SESSION['loggedin']!=true) { 
    header("Location:index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $instrucId = $_POST['instruc-id'];
    $sql = "SELECT * FROM instructors WHERE instruc_id='$instrucId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sql = "INSERT INTO aprove (instruc_id, password, name,email, addresss, phone, experience, gender, age, document)
                VALUES ('{$row['instruc_id']}', '{$row['password']}', '{$row['name']}','{$row['email']}', '{$row['addresss']}', '{$row['phone']}', '{$row['experience']}', '{$row['gender']}', '{$row['age']}', '{$row['document']}')";

        if ($conn->query($sql) === TRUE) {
            $sql = "DELETE FROM instructors WHERE instruc_id='$instrucId'";
            $conn->query($sql);
           
            echo "<script>
                     alert('  Instructor approved and added to the database.!');
                     window.location.href = 'adminHome1.php';
                  </script>";
                 exit();
            
        } else {
            
           echo '<script>alert("Failed to add instructor to the database.!");</script>';
        }
    } else {
        echo '<script>alert("instructor not found.!");</script>';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {
    $instrucId = $_POST['instruc_id'];
    $sql = "DELETE FROM instructors WHERE instruc_id='$instrucId'";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Instructor request rejected and deleted from the database.");</script>';
    } else {
        echo "Failed to reject and delete instructor request.";
    }
}

$sql = "SELECT * FROM instructors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Aproval</title>
    <link rel="stylesheet" href="admin_aproval.css">
</head>
<body>
    <h1>Admin Profile</h1>
    <h2>Pending Instructor Applications</h2>
    <table>
        <thead>
            <tr>
                <th>Instructor ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Experience</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Document</th>
                <th colspan="2"><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['instruc_id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['addresss']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['experience']}</td>";
                echo "<td>{$row['gender']}</td>";
                echo "<td>{$row['age']}</td>";
                    
                echo "<td><a href='/{$row['document']}' target='_blank'>View Document<p> </a></td>";
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='instruc-id' value='{$row['instruc_id']}'>
                            <button type='submit' name='approve'>Approve</button>
                        </form>
                      </td>";
                echo " <td>
                      <form method='post'>
                          <input type='hidden' name='instruc_id' value='{$row['instruc_id']}'>
                          <button type='submit' name='reject'>Reject</button>
                      </form>
                    </td>";
                      

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
