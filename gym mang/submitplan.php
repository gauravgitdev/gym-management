<?php
session_start();
$showalert = false;
$showerror = false;
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'C:\xampp\htdocs\gym mang\dbconn.php';

    if (isset($_POST['Uplan_id'])) {
        $planID = $_POST['Uplan_id'];
        $username = $_SESSION['username'];

        $sql_check_enrollment = "SELECT * FROM plantype WHERE planId='$planID'";
        $result_check_enrollment = mysqli_query($conn, $sql_check_enrollment);
        $check_enrollment_plantype = mysqli_fetch_assoc($result_check_enrollment);
        $plan_type = $check_enrollment_plantype['type'];
 
        $sql_check = "SELECT COUNT(*) as plan_count FROM plans WHERE plan='$plan_type'";
        $result_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_fetch_assoc($result_check);

        if ($row_check['plan_count'] < 10) { 
            $sql_check_enrollment = "SELECT * FROM plans WHERE plan='$plan_type' AND username='$username'";
            $result_check_enrollment = mysqli_query($conn, $sql_check_enrollment);

            if (mysqli_num_rows($result_check_enrollment) > 0) {
            
                $showerror = "You have already enrolled in this plan.";
            } else {
               
                $sql_select_plan = "SELECT * FROM plantype WHERE planId='$planID'";
                $result_select_plan = mysqli_query($conn, $sql_select_plan);

                if ($result_select_plan && mysqli_num_rows($result_select_plan) > 0) {
                    $row = mysqli_fetch_assoc($result_select_plan);
                    $plantype = $row['type'];
                    $instruc_id = $row['instruc_id'];
 
                    $sql_check_plans_count = "SELECT COUNT(*) as plan_count FROM plans WHERE username='$username'";
                    $result_check_plans_count = mysqli_query($conn, $sql_check_plans_count);
                    $row_check_plans_count = mysqli_fetch_assoc($result_check_plans_count);

                    if ($row_check_plans_count['plan_count'] < 2) { 
                        $start_date = date("Y-m-d");
                        $expiration_date = date("Y-m-d", strtotime("+30 days"));

                        $sql_insert_enrollment = "INSERT INTO plans (username, plan, instruc_id, start_date, expiration_date) VALUES ('$username', '$plantype', '$instruc_id', '$start_date', '$expiration_date')";
                        $result_insert_enrollment = mysqli_query($conn, $sql_insert_enrollment);

                        if ($result_insert_enrollment) {
                            $showalert = "Plan has been successfully added.";
                            echo "<script>
                        alert('".$showalert."');
                        window.location.href = 'home.php';
                      </script>";
                exit(); 
  

                        } else {
                            $showerror = "There was an error in adding the plan. Please try again.";
                        }
                    } else {
                        $showerror = "You can only have a maximum of 2 plans.";
                    }
                } else {
                    $showerror = "Invalid Plan ID.";
                }
            }
        } else {
            $showerror = "There is no vacant seat!";
        }
    }
}

// if ($showalert) {
//     echo '<script> alert("'.$showalert.'");</script>';
//     header("Location: home.php"); 
//     exit();
// }

if ($showerror) {
    echo '<script> alert("'.$showerror.'")</script>';
}
?>
