<?php
session_start();
if (!isset($_SESSION['loggedin'])) { 
    header("Location:index.php");
}
require 'dbconn.php';
$sql="SELECT * FROM  aprove";
$result2 = mysqli_query($conn, $sql);
$row = null;
if ($result2) {
    while ($row = mysqli_fetch_assoc($result2)) {
        if ($row['instruc_id'] == $_SESSION['username']) {
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="instrProfile.css">
     
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Profile Information</h1>
            <div class="breadcrumbs">
                <h2><b><?php echo $_SESSION['username'] ?></b></h2>
            </div>
        </div>
        <div class="profile-header">
            <div class="profile-image">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/020/765/399/small/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" alt="Profile Picture">
            </div>
            <div>
                <h2><b><?php echo $_SESSION['username'] ?></b></h2>
                <div class="stats">
                    <h3><b>
                    <table style="background-color:#333; width:440px;">Created Plan
                        <tr>
                            <th>Plan</th>
                            <th>Enrolled Student</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        require 'dbconn.php';
                        $sql2 = "SELECT * FROM plantype";
                        $result2 = mysqli_query($conn, $sql2);

                        if ($result2) {
                            while ($row2 = mysqli_fetch_assoc($result2)) { 
                                if ($row2['instruc_id'] == $_SESSION['username']) {
                                    echo "<tr>";
                                    echo "<td><center> " . $row2['type'] . "</center> </td> ";

                                    $planType = $row2['type'];
                                    $sql_check = "SELECT COUNT(*) as plan_count FROM plans WHERE plan='$planType'";
                                    $result_check = mysqli_query($conn, $sql_check);
                                    $row_check = mysqli_fetch_assoc($result_check);
                                    echo "<td>" . htmlspecialchars($row_check['plan_count'], ENT_QUOTES, 'UTF-8') . "</td>";

                                    echo "<td>
                                            <form action='delete_plan.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this plan?\");'>
                                                <input type='hidden' name='plan_id' value='" . $row2['planId'] . "'>
                                                <button type='submit' class='delete-btn'>Delete Plan</button>
                                            </form> 
                                          </td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                    </table>
                    </b></h3>
                </div>
            </div>
        </div>
        <div class="main">
            <h2>About Me</h2>
            <table>
                <tr>
                    <td>UserName &nbsp;  &nbsp;</td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['instruc_id']; ?></td>
                </tr>
                <tr>
                    <td>Name </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['name']; ?></td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['addresss']; ?></td>
                </tr>
                <tr>
                    <td>Phone </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['phone']; ?></td>
                </tr>
                <tr>
                    <td> Experience </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['experience']; ?></td>
                </tr>
                <tr>
                    <td>Gender </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['gender']; ?></td>
                </tr>
                <tr>
                    <td> Age </td>
                    <td><?php echo "<b></b> &nbsp;&nbsp;" . $row['age']; ?></td>
                </tr>
            </table>
            <p>
                <?php
                require 'dbconn.php'; 
                $sql2 = "SELECT * FROM feedback";
                $result2 = mysqli_query($conn, $sql2);
                
                if ($result2) {
                    while ($row2 = mysqli_fetch_assoc($result2)) { 
                        if ($row2['username'] == $_SESSION['username']) {
                            echo " ' " . $row2['feedback'] . "' &nbsp; - &nbsp; <b> " . $row2['username'] . "</b> <br>";
                            echo "<br>";
                            break;
                        }
                    }
                }
                ?>
            </p>
        </div>
    </div>
</body>
</html>
