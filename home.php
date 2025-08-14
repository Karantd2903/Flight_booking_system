<?php
session_start();
$loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAKEC Airline Service</title>

    <link rel="icon" type="image/png" href="img/image.png" />

    <!-- CSS Libraries -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link href="css/common.css" rel="stylesheet" />
    <link href="css/home.css" rel="stylesheet" />
</head>

<body>

    <!-- Header/Navbar -->
    <div class="header sticky-top">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="img/sakec logo.jpeg" alt="SAKEC Logo" height="40">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="my-navbar">
                <ul class="navbar-nav">
                    <?php if ($loggedInUser): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-warning text-dark font-weight-bold mr-2"
                                 style="width: 40px; height: 40px; font-size: 1.2rem;">
                                <?php echo strtoupper($loggedInUser[0]); ?>
                            </div>
                            <span class="text-dark"><?php echo htmlspecialchars($loggedInUser); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="home.php"><i class="fas fa-home mr-2"></i>Home</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="my_bookings.php"><i class="fas fa-ticket-alt mr-2"></i>My Bookings</a>

                        </div>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php"><i class="fas fa-user"></i> Signup</a>
                    </li>
                    <div class="nav-vl"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    

                    <?php endif; ?>
                    
                </ul>
            </div>
        </nav>
    </div>

    <!-- Hero / Banner Section -->
    <div class="banner-container text-white d-flex flex-column align-items-center justify-content-center"
         style="min-height: 100vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/sakec_airline.png'); background-size: cover; background-position: center;">

        <h1 class="display-4 font-weight-bold mb-3 text-center">
            Fly with <span style="color: #FFD700;">SAKEC Airlines</span>
        </h1>
        <p class="lead mb-5 text-center">Your journey begins here > book your next adventure now!</p>



        <!-- Flight Search Form -->
        
        <form action="listings.php" method="get" id="search-form" class="w-75 bg-light p-4 rounded shadow-lg" style="max-width: 800px;">
            <div class="form-row">
                <div class="form-group col-md-4 mb-2">
                    <input type="text" class="form-control" name="from" placeholder="source" required>
                </div>
                <div class="form-group col-md-4 mb-2">
                    <input type="text" class="form-control" name="to" placeholder="destination" required>
                </div>
                <div class="form-group col-md-4 mb-2">
                    <input type="date" class="form-control" name="date" required>
                </div>
            </div>

            <div class="form-row align-items-center">
                <div class="form-group col-md-4 mb-2">
                    <select class="form-control" name="class">
                        <option selected disabled>Class</option>
                        <option value="economy">Economy</option>
                        <option value="business">Business</option>
                        <option value="first">First Class</option>
                    </select>
                </div>
                <div class="form-group col-md-4 mb-2">
                    <input type="number" class="form-control" name="passengers" min="1" placeholder="Passengers" required>
                </div>
                <div class="form-group col-md-4 mb-2">
                    <button type="submit" class="btn btn-warning btn-block font-weight-bold">
                        <i class="fa fa-search mr-1"></i> Search Flights
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-light" style="font-size: 0.95rem;">
        <p class="mb-0">
            Project by <strong>Karan</strong> & <strong>Sharvari</strong> | Guided by <strong>Prof. Gauri Chavan</strong><br>
            SAKEC Airline Ticketing System © 2025
        </p>
    </footer>

    <!-- JS for Dropdown -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
