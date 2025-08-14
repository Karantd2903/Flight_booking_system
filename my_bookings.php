<?php
$conn = new mysqli("localhost", "root", "", "sakec_airline");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Join bookings with flights table
$query = "
    SELECT 
        b.passenger_name, b.class, b.passengers, b.price,b.status,
        f.flight_no, f.src, f.dest, f.departure_time, f.arrival_time
    FROM bookings b
    JOIN flights f ON b.flight_id = f.flight_id
    ORDER BY f.departure_time ASC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">My Bookings</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>Flight No</th>
                    <th>From → To</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Passenger</th>
                    <th>Class</th>
                    <th>Passenger count</th>
                    <th>Total Price (₹)</th>
                    <th>Status </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['flight_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['src'] . " → " . $row['dest']); ?></td>
                        <td><?php echo htmlspecialchars($row['departure_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['arrival_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['passenger_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['class']); ?></td>
                        <td><?php echo $row['passengers']; ?></td>
                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No bookings found.</div>
    <?php endif; ?>

    <a href="home.php" class="btn btn-secondary mt-3">Back to Home</a>
</div>
</body>
</html>

<?php $conn->close(); ?>
