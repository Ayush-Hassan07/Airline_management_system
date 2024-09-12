<?php
require_once('dbconnection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 0;
    if (isset($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);
    }
    $query_users = "DELETE FROM users WHERE id = '$user_id' ";
    if (mysqli_query($con, $query_users)) {
        header("Location: admin.php?data=$user_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
mysqli_close($con);
?>