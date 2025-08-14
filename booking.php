<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flightId = $_POST['flight_id'] ?? '';
    $name = $_POST['customer_name'] ?? '';
    $email = $_POST['customer_email'] ?? '';

    // Connect to database
    $host = 'localhost';
    $db = 'sakec_airline';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert booking into database
        $stmt = $pdo->prepare("INSERT INTO bookings (flight_id, customer_name, customer_email) VALUES (:flight_id, :name, :email)");
        $stmt->execute([
            ':flight_id' => $flightId,
            ':name' => $name,
            ':email' => $email
        ]);

        echo "<h2>Booking Successful!</h2>";
        echo "<p>Thank you, " . htmlspecialchars($name) . ". Your flight has been booked.</p>";
        echo "<p>A confirmation has been sent to " . htmlspecialchars($email) . ".</p>";

    } catch (PDOException $e) {
        echo "<p>Booking failed: " . $e->getMessage() . "</p>";
    }

} else {
    echo "<p>Invalid request.</p>";
}
?>
