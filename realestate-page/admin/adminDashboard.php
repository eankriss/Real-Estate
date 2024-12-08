<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realestatedb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Real Estate | Admin Dashboard</title>

    <link rel="icon" href="icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/admin.css">

    <!-- Icon Navigation Bootsrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
    /* Custom styles for the admin section */
    body {
        padding-top: 70px;
    }

    .admin-sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        width: 250px;
        /* Set the desired width */
        padding: 48px 20px;
        /* Adjust the padding */
        overflow-x: hidden;
        overflow-y: auto;
        background-color: #007bff;
        /* Background color */
        border-right: 1px solid #dee2e6;
    }

    .admin-sidebar .nav-link {
        color: white;
        /* Link color */
        padding: 10px;
        /* Add padding to increase clickable area */
        display: block;
        /* Make the link full-width */
        margin-bottom: 10px;
        /* Add margin between navigation items */
        position: relative;
        /* Enable positioning for ::after pseudo-element */
    }

    .admin-sidebar .nav-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: white;
    }

    .admin-sidebar .nav-link.active {
        font-weight: bold;
        /* Active link style */
    }

    .admin-main-content {
        margin-left: 250px;
        padding: 20px;
    }

    .admin-sidebar-top {
        color: white;
        margin-bottom: 10%;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
    <div class="admin-sidebar">
        <div class="admin-sidebar-top">
            <h2>Welcome, Admin <?php echo $_SESSION['adminUsername']; ?></h2>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="adminDashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="adminListings.php"><i class="fas fa-bed"></i> House Listings</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>


    </div>

    <!-- Main content -->
    <div class="admin-main-content">
        <h1>Welcome to Real Estate</h1>
        <!-- Rest of the content goes here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="./js/adminjs1.js"></script>
    <script src="./js/adminjs2.js"></script>
    <script src="./js/adminjs3.js"></script>
    <script>
    // Logout functionality
    function logout() {
        if (confirm("Are you sure you want to logout?")) {
            // Perform logout actions here
            window.location.href = "adminLogin.php"; // Redirect to the logout page
        }
    }
    </script>
</body>

</html>