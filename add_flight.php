<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Replace with your actual DB config
$conn = new mysqli("localhost", "root", "", "airline_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flight_no = $_POST['flight_no'];
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];
$seats = $_POST['seats'];

$sql = "INSERT INTO flights (flight_no, origin, destination, date, seats) VALUES ('$flight_no', '$from', '$to', '$date', '$seats')";

if ($conn->query($sql) === TRUE) {
    echo "Flight added successfully! <a href='admin_dashboard.php'>Back</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
