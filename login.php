<?php
$con = mysqli_connect("localhost", "root", "", "airline");
if (!$con) {
    die(" Connection Error ");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND id=1";
    $result=mysqli_query($con, $query);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];
        header("Location: admin.php?data=$userId");
        exit();
    }
    $query1 = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result1=mysqli_query($con,$query1);
    if (mysqli_num_rows($result1)>0) {
        $row = mysqli_fetch_assoc($result1);
        $userId = $row['id'];
        header("Location:passanger.php?data=$userId");
        exit();
    } else {
        echo "Error: Email and password does not match" . mysqli_error($con);
    }
}
mysqli_close($con);
