<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sakec_airline");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Plain text password

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            header("Location: login.php?signup=success");
            exit();
        } else {
            $error = "Something went wrong. Try again.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - SAKEC Airline</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <form action="" method="post" class="bg-white p-5 rounded shadow" style="width: 350px;">
        <h4 class="mb-4 text-center">Sign Up</h4>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>
        <button type="submit" class="btn btn-warning btn-block">Sign Up</button>
        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>
