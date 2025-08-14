<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sakec_airline");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password']; // Plain text password

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password == $user['password']) { // Comparing plain text password
            $_SESSION['username'] = $user['name'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SAKEC Airline</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <form action="" method="post" class="bg-white p-5 rounded shadow" style="width: 350px;">
        <h4 class="mb-4 text-center">Login</h4>

        <?php if (isset($_GET['signup']) && $_GET['signup'] === 'success'): ?>
            <div class="alert alert-success text-center">
                Signup successful! Please log in.
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>
        <button type="submit" class="btn btn-warning btn-block">Login</button>
        <p class="mt-3 text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>
</body>
</html>
