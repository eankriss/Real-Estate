<?php
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

// Check if the house_id is provided
if (isset($_POST['house_id'])) {
    $house_id = $_POST['house_id'];

    // Prepare the DELETE query
    $query = "DELETE FROM houselistings WHERE houseID = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $house_id);
        if (mysqli_stmt_execute($stmt)) {
            // Success: Display alert and redirect
            echo "<script> 
                    alert('House listing deleted successfully.'); 
                    window.location='adminListings.php'; 
                  </script>";
        } else {
            // Error: Could not execute the query
            echo "<script> 
                    alert('Failed to delete house listing. Please try again.'); 
                    window.location='adminListings.php'; 
                  </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        // Error: Could not prepare the query
        echo "<script> 
                alert('Failed to prepare the delete query. Please try again.'); 
                window.location='adminListings.php'; 
              </script>";
    }
} else {
    // Error: No house_id provided
    echo "<script> 
            alert('No house ID provided. Please try again.'); 
            window.location='adminListings.php'; 
          </script>";
}

mysqli_close($conn);
?>
