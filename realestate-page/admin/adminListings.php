<?php
include_once 'process.php';
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Real Estate | House Listing</title>

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
                <a class="nav-link" href="adminDashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="adminListings.php"><i class="fas fa-bed"></i> House Listings</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>


    </div>

    <!-- House Listings Section -->
    <div class="admin-main-content">
        <div class="col mt-4">
            <h1 class="mb-4 text-uppercase" style="margin-top: -8%;">House Listings</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                Add New
            </button>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>House ID</th>
                            <th>House Image</th>
                            <th>House Name</th>
                            <th>House Price</th>
                            <th>House Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $query = "SELECT * FROM `houselistings`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) :
                                    $id = $row['houseID'];
                                    $image = $row['houseImage'];
                                    $name = $row['houseName'];
                                    $price = $row['housePrice'];
                                    $description = $row['houseDescription'];
                            ?>
                        <tr>
                            <td><?= $id ?></td>
                            <td><img src="img/<?= $image ?>" alt="House Image" width="110"></td>
                            <td><?= $name ?></td>
                            <td><?= $price ?></td>
                            <td><?= $description ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewProductModal<?= $id ?>" title="VIEW"><a> <i
                                            class="fa fa-eye"></i> </a></button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal<?= $id ?>" title="EDIT"><a> <i
                                            class="fa fa-edit"></i> </a></button>
                                <button type="button" style="background-color: red; outline: red;"
                                    class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#deleteProductModal<?= $id ?>" title="DELETE"><a> <i
                                            class="fa fa-trash"></i> </a></button>
                            </td>
                        </tr>

                        <!-- View House Modal -->
                        <div class="modal fade" id="viewProductModal<?= $id ?>" tabindex="-1"
                            aria-labelledby="viewProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewProductModalLabel">View House Listing</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>House ID: <?= $id ?></p>
                                        <img src="img/<?= $image ?>" alt="House Image" width="100">
                                        <p>House Name: <?= $name ?></p>
                                        <p>House Price: <?= $price ?></p>
                                        <p>House Description: <?= $description ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit House Modal -->
                        <div class="modal fade" id="editProductModal<?= $id ?>" tabindex="-1"
                            aria-labelledby="editProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel">Edit House Listings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editListings.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="product_id" value="<?= $id ?>">
                                            <div class="mb-3">
                                                <label for="current_image" class="form-label">House Image</label>
                                                <input type="file" class="form-control" id="current_image"
                                                    name="current_image">
                                                <input type="hidden" name="current_image" value="<?= $image ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductName" class="form-label">House Name</label>
                                                <input type="text" class="form-control" id="editProductName"
                                                    name="product_name" value="<?= $name ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductPrice" class="form-label">House
                                                    Price</label>
                                                <input type="number" class="form-control" id="editProductPrice"
                                                    name="product_price" value="<?= $price ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductDescription" class="form-label">House
                                                    Description</label>
                                                <textarea class="form-control" id="editProductDescription"
                                                    name="product_description" required><?= $description ?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    name="submit">Update</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete House Modal -->
                        <div class="modal fade" id="deleteProductModal<?= $id ?>" tabindex="-1"
                            aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductModalLabel">Delete House Listing</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this house listing?</p>
                                        <p><strong>House ID:</strong> <?= $id ?></p>
                                        <img src="img/<?= $image ?>" alt="Product Image" width="100">
                                        <p><strong>House Name:</strong> <?= $name ?></p>
                                        <p><strong>House Price:</strong> <?= $price ?></p>
                                        <p><strong>House Description:</strong> <?= $description ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="deleteListings.php" method="POST">
                                            <!-- Pass the house ID as a hidden input -->
                                            <input type="hidden" name="house_id" value="<?= $id ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
                addHouseListings();
            ?>

        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add House Listing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="productName" class="form-label">House Name</label>
                                <input type="text" class="form-control" id="productName" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">House Price</label>
                                <input type="text" class="form-control" id="productPrice" name="product_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">House Description</label>
                                <textarea class="form-control" id="productDescription" name="product_description"
                                    rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">House Image</label>
                                <input type="file" class="form-control" id="productImage" name="product_image" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/adminjs1.js"></script>
    <script src="js/adminjs2.js"></script>
    <script src="js/adminjs3.js"></script>
    <script>
    // Logout functionality
    function logout() {
        if (confirm("Are you sure you want to logout?")) {
            // Perform logout actions here
            window.location.href = "adminLogin.php"; // Redirect to the logout page
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/js.js"></script>
    <script>
    // Delete functionality
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this?")) {
            alert('Data deleted sucessfully');
            window.location.href = "adminListings.php";
        }
    }
    </script>
</body>

</html>