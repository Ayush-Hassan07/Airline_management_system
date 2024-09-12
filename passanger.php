<?php
require_once('dbconnection.php');
$query_flights = "SELECT * FROM flights";
$result_flights = mysqli_query($con, $query_flights);
$user_id = 0;
if (isset($_GET['data'])) {
    $user_id = intval($_GET['data']);
}
$query_bookings = " SELECT * FROM bookings WHERE user_id = $user_id";
$result_bookings = mysqli_query($con, $query_bookings);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header id="header" class="fixed-top bg-light">
        <div class="container">
            <h1 class="logo me-auto"><a href="login.html">AHR Airlines</a></h1>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="passanger.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="profile.php?data=<?php echo htmlspecialchars($user_id) ?>">Profile</a>
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

    <div class="container mt-5 pt-5">
        <h3 class="mt-5">Flight Schedule</h3>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Departure</th>
                    <th scope="col">Seat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_flights) > 0) {
                    $serial = 1;
                    while ($row = mysqli_fetch_assoc($result_flights)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['id'] . "</th>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['destination'] . "</td>";
                        echo "<td>" . $row['departure'] . "</td>";
                        echo "<td>" . $row['seat'] . "</td>";
                        $flight_id = $row['id'];
                        $id = $user_id;
                        $destination = $row['destination'];
                        $departure = $row['departure'];
                        $seat = $row['seat'];
                        $date = $row['date'];

                        // echo "<td><button class='btn btn-success'>Book Now</button></td>";
                        // echo "</tr>";
                        echo "<td>
                        <form action='book.php' method='post'>
                            <input type='hidden' name='flight_id' value='" . htmlspecialchars($flight_id) . "'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>
                            <input type='hidden' name='destination' value='" . htmlspecialchars($destination) . "'>
                            <input type='hidden' name='departure' value='" . htmlspecialchars($departure) . "'>
                            <input type='hidden' name='seat' value='" . htmlspecialchars($seat) . "'>
                            <input type='hidden' name='date' value='" . htmlspecialchars($date) . "'>
                            <button type='submit' class='btn btn-success'>Book Now</button>
                        </form>
                        </td>";
                        echo "</tr>";
                        $serial++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No flights available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5 pt-5">
        <h3 class="mt-5">Booking Schedule</h3>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Flight Number</th>
                    <th scope="col">Seats</th>
                    <th scope="col">Departure</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Date</th>

                </tr>
            </thead>
            <tbody>
                <?php $rowNumber = 1;
                while ($row = mysqli_fetch_assoc($result_bookings)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $rowNumber++; ?></th>
                        <td><?php echo $row['flight_id']; ?></td>
                        <td><?php echo $row['seat']; ?></td>
                        <td><?php echo $row['departure']; ?></td>
                        <td><?php echo $row['destination']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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