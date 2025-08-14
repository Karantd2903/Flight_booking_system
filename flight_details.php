<?php
$host = 'localhost';
$db = 'sakec_airline';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$flight = null;

if (!empty($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM flights WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $flight = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php if ($flight): ?>
    <h2>Flight Details</h2>
    <p><strong>Airline:</strong> <?= htmlspecialchars($flight['airline']) ?></p>
    <p><strong>Flight number:</strong> <?= htmlspecialchars($flight['flight_number']) ?></p>
    <p><strong>From:</strong> <?= htmlspecialchars($flight['origin']) ?></p>
    <p><strong>To:</strong> <?= htmlspecialchars($flight['destination']) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($flight['departure_date']) ?></p>
    <p><strong>Ticket Price:</strong> Rs. <?= htmlspecialchars($flight['price']) ?></p>
    

    <form action="booking.php" method="POST">
        <input type="hidden" name="flight_id" value="<?= $flight['id'] ?>">
        <label>Your Name: <input type="text" name="customer_name" required></label><br>
        <label>Your Email: <input type="email" name="customer_email" required></label><br>
        <button type="submit">Book Now</button>
    </form>
<?php else: ?>
    <p>Flight not found.</p>
<?php endif; ?>
