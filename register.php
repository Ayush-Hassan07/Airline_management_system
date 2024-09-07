<?php
$con = mysqli_connect("localhost", "root", "", "airline");
if (!$con) {
    die(" Connection Error ");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['confirmpassword'];

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (mysqli_query($con, $query)) {
        header("Location: login.html");
        exit(); 
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
mysqli_close($con);

?>