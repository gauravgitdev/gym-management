<?php
 
session_start();
if (!isset($_SESSION['username'])) {
    die("User not logged in.");
}
 require 'dbconn.php';
$sql="SELECT * FROM  users";
$result2 = mysqli_query($conn, $sql);
 $user=null;
if ($result2) {
    while ($row = mysqli_fetch_assoc($result2)) {
           if ($row['username'] == $_SESSION['username']) {
            $user=$row;
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
  <link rel="stylesheet" href="userProfile.css">
  <style>
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h1>Profile Information</h1>
      <div class="breadcrumbs">
        <h2><b> <?php  echo $_SESSION['username']  ?> </b></h2>
        <h2>   <button><a href="update.php">Edit</a></button>  </h2>
      </div>
    </div>
    <div class="profile-header">
      <div class="profile-image">
        <img src=" https://static.vecteezy.com/system/resources/thumbnails/020/765/399/small/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" alt="Profile Picture">
      </div>
      <div>
        <h2><b> <?php  echo $_SESSION['username']  ?> </b></h2>
 
        <div class="stats"> 
            <h3><b> 
        <table style="background-color:#333; width:640px;">
          <tr>
            <th>Plan</th>
            <th>Expiry Date</th>
            <th>Instructor</th>
          </tr>
     
            <?php
              require 'dbconn.php';
                   $sql2 = "SELECT * FROM plans";
                   $result2 = mysqli_query($conn, $sql2);

                   if ($result2) {
                       while ($row2 = mysqli_fetch_assoc($result2) ) { 
                        if($row2['username']==$_SESSION['username']){
                          echo "<tr>";
                              echo "<td><center> ".$row2['plan']."</center> </td> ";
                              echo "<td><center>".$row2['expiration_date']."</center></td> ";
                              echo "<td><center>".$row2['instruc_id']."</center></td> ";
                              
                              echo "</td>";
                                   
                        }
                   }
                  }
                     
            ?></table>
            </b></h3> 
          
        </div>
      </div>
    </div>
      <div class="main">
        <h2>About Me</h2>
        <table>
             <tr>

             <td>UserName &nbsp;  &nbsp;</td>
             <td><?php  echo "<b></b> &nbsp;&nbsp;".$row['username'];?> </td>
             </tr>
            <tr>
                    <td>Name </td>
                    <td><?php  echo "<b></b> &nbsp;&nbsp;".$row['name'];   ?></td>
             </tr>
             <tr>
                    <td>Email-Id </td>
                    <td><?php  echo "<b></b> &nbsp;&nbsp;".$row['email'];   ?></td>
            </tr>
             <tr>
                    <td>Phone </td>
                    <td><?php  echo "<b></b> &nbsp;&nbsp;".$row['phone'];   ?></td>
             </tr>
             <tr>
                    <td> Weight </td>
                    <td> <?php  echo "<b></b> &nbsp;&nbsp;".$row['weight'];   ?></td>
            </tr>
             <tr>
                    <td>Height   </td>
                    <td> <?php  echo "<b></b> &nbsp;&nbsp;".$row['height'];   ?></td>
            </tr>
             <tr>
                    <td> Age  </td>
                    <td> <?php  echo "<b></b> &nbsp;&nbsp;".$row['age'];   ?></td>
             </tr> 
          </table>
          <td>

          </td>
        <p><h2>feedback</h2> </p>
        <p> 

        <?php
          
          require 'dbconn.php';
               $sql2 = "SELECT * FROM feedback";
               $result2 = mysqli_query($conn, $sql2);
              
               if ($result2) {
                   while ($row2 = mysqli_fetch_assoc($result2)) { 
                    if($row2['username']==$_SESSION['username']){
                          echo " ' ".$row2['feedback']."' &nbsp;   - &nbsp; <b> ".$row2['username']."</b> <br>";
                            echo "<br>";
                            break;
                    }
                }
               }
                ?>
        </p>
      </div>
    </div>
  </div>
</body>
</html>