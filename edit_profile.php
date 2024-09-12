<?php
$con = mysqli_connect("localhost", "root", "", "airline");
if (!$con) {
    die(" Connection Error ");
}
$user_id = 0;
if (isset($_GET['data'])) {
    $user_id = intval($_GET['data']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id=intval($_POST['data']);
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $query = "SELECT * FROM profile WHERE user_id = $user_id";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $query1 = "UPDATE profile SET name = '$name', address = '$address', phone = '$phone' WHERE user_id = $user_id";
        if (!mysqli_query($con, $query1)) {
            echo "Error: " . mysqli_error($con);
        }else{
            header("Location: profile.php?data=$user_id");

            exit();
        }
    } else {
        $query2 = "INSERT INTO profile (user_id, name, address, phone) VALUES ('$user_id','$name', '$address', '$phone')";
        if (!mysqli_query($con, $query2)) {
            echo "Error: " . mysqli_error($con);
        }else{
            header("Location: profile.php?data=$user_id");

            exit();
        }
    }

}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <header id="header" class="fixed-top bg-light">
        <div class="container ">
            <h1 class="logo me-auto"><a href="login.html">AHR Airlines</a></h1>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="passanger.php?data=<?php echo htmlspecialchars($user_id)?>">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="profile.php?data=<?php echo htmlspecialchars($user_id)?>">Profile</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="card mt-5 pt-5 p-3">
        <div class="card-body">
            <form method="post" action="edit_profile.php">
            <input type="hidden" name="data" value="<?php echo htmlspecialchars($user_id); ?>">
            
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
<footer class="mt-5 pt-5"></footer>

</html>