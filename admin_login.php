<?php
session_start();

// Hardcoded example — ideally, use a database
$adminUsername = 'admin';
$adminPassword = 'admin123'; // Use hashed passwords in real applications

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!-- HTML FORM -->
<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
    <h2>Admin Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Admin username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</body>
</html>
