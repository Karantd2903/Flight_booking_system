<?php
$conn = new mysqli("localhost", "root", "", "sakec_airline");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$src = $_GET['from'];
$dest = $_GET['to'];
$date = $_GET['date'];
$passengers = intval($_GET['passengers']);

// Fetch flights matching source, destination, and departure date
$stmt = $conn->prepare("SELECT * FROM flights WHERE src = ? AND dest = ? AND DATE(departure_time) = ?");
$stmt->bind_param("sss", $src, $dest, $date);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Flights</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Available Flights</h3>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th>Flight ID</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Price</th>
                        <th>Book</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['flight_no']; ?></td>
                        <td><?php echo $row['src']; ?></td>
                        <td><?php echo $row['dest']; ?></td>
                        <td><?php echo $row['departure_time']; ?></td>
                        <td><?php echo $row['arrival_time']; ?></td>
                        <td>
                            ₹<?php echo $row['price']; ?><br>
                            <small class="text-success font-weight-bold">Total: ₹<?php echo $row['price'] * $passengers; ?></small>
                        </td>
                        <td>
                            <form action="confirm_booking.php" method="post">
                                <input type="hidden" name="flight_id" value="<?php echo $row['flight_id']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="class" value="<?php echo htmlspecialchars($_GET['class']); ?>">
                                <input type="hidden" name="passengers" value="<?php echo $passengers; ?>">

                                <?php for ($i = 1; $i <= $passengers; $i++): ?>
                                    <input type="text" name="passenger_names[]" class="form-control form-control-sm mb-1" placeholder="Passenger <?php echo $i; ?> Name" required>
                                <?php endfor; ?>

                                <button type="submit" class="btn btn-success btn-sm mt-2">Book</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No flights found matching your search.</div>
        <?php endif; ?>

        <a href="home.php" class="btn btn-secondary mt-3">Back to Search</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
