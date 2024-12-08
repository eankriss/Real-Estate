<?php
    include 'connection.php';
    
    function addHouseListings()
    {
        global $conn;
    
        if (isset($_POST['submit'])) {
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_description = $_POST['product_description'];
    
            // File upload
            $target_directory = "img/";
            $file_name = basename($_FILES["product_image"]["name"]);
            $target_file = $target_directory . $file_name;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check file size
            if ($_FILES["product_image"]["size"] > 1000000) {
                echo "<script> alert('Sorry, your file is too large.'); window.location='adminListings.php' </script>";
                $uploadOk = 0;
            }
    
            // Allow only certain file formats
            $allowed_formats = array("jpg", "jpeg", "png", "webp");
            if (!in_array($imageFileType, $allowed_formats)) {
                echo "<script> alert('Sorry, only JPG, JPEG, PNG & WEBP files are allowed.'); window.location='adminListings.php' </script>";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<script> alert('Sorry, your file was not uploaded.'); window.location='adminListings.php' </script>";
            } else {
                // Move uploaded file to target directory
                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                    // Update the database with the new information
                    $query = "INSERT INTO houselistings (houseName, housePrice, houseDescription, houseImage) VALUES (?, ?, ?, ?)";
                    $sql = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($sql, "ssss", $product_name, $product_price, $product_description, $file_name);
    
                    if (mysqli_stmt_execute($sql)) {
                        echo "<script>alert('New House uploaded successfully.'); window.location.href='adminListings.php';</script>";
                    } else {
                        echo "<script> alert('Error updating house: '); window.location='adminListings.php' </script>" . mysqli_error($conn);
                        //echo "Error updating house: " . mysqli_error($conn);
                    }
                } else {
                    echo "<script> alert('Sorry, there was an error uploading your file.'); window.location='adminListings.php' </script>";
                    //echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }      
?>