<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Add Flight Details</h3>
    <form method="POST" action="add_flight.php">
        <input type="text" name="flight_no" placeholder="Flight No" required><br>
        <input type="text" name="from" placeholder="From" required><br>
        <input type="text" name="to" placeholder="To" required><br>
        <input type="date" name="date" required><br>
        <input type="number" name="seats" placeholder="Total Seats" required><br>
        <button type="submit">Add Flight</button>
    </form>
</body>
</html>
