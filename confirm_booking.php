<?php
$conn = new mysqli("localhost", "root", "", "sakec_airline");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flight_id = $_POST['flight_id'];
$price = floatval($_POST['price']);
$class = $_POST['class'];
$passenger_names = $_POST['passenger_names']; // should be an array
$passengers = count($passenger_names);
$total_price = $price * $passengers;

// Prepare the insert query
$stmt = $conn->prepare("INSERT INTO bookings (flight_id, passenger_name, class, passengers, price) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("SQL error: " . $conn->error); // Helpful debug info
}

// Loop and bind values
foreach ($passenger_names as $name) {
    $safe_name = trim($name);
    $one_passenger = 1;
    $stmt->bind_param("sssii", $flight_id, $safe_name, $class, $one_passenger, $price);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h2 class="text-success">Booking Confirmed</h2>
            <p><strong>Flight ID:</strong> <?php echo htmlspecialchars($flight_id); ?></p>
            <p><strong>Class:</strong> <?php echo htmlspecialchars($class); ?></p>
            <p><strong>No. of Passengers:</strong> <?php echo $passengers; ?></p>
            <p><strong>Price per Ticket:</strong> ₹<?php echo number_format($price, 2); ?></p>
            <p class="text-primary font-weight-bold"><strong>Total Price:</strong> ₹<?php echo number_format($total_price, 2); ?></p>

            <h5 class="mt-4">Passenger Names:</h5>
            <ul>
                <?php foreach ($passenger_names as $name): ?>
                    <li><?php echo htmlspecialchars($name); ?></li>
                <?php endforeach; ?>
            </ul>

            <a href="home.php" class="btn btn-primary mt-3">Book Another Flight</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
