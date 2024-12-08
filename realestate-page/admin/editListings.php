<?php
    include 'connection.php';

    if(isset($_POST['submit'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];
        $current_image = $_POST['current_image'];

        // File upload
        $target_directory = "img/";
        $file_name = basename($_FILES["current_image"]["name"]);
        $target_file = $target_directory . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["current_image"]["size"] > 1000000) {
            echo "<script> alert('Sorry, your file is too large.'); window.location='adminListings.php' </script>";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp") {
            echo "<script> alert('Sorry, only JPG, JPEG, PNG & WEBP files are allowed.'); window.location='adminListings.php' </script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script> alert('Sorry, your file was not uploaded.'); window.location='adminListings.php' </script>";
        } 
        
        else {
            // Read the contents of the image file and convert it to base64
            $image_data = basename($_FILES["current_image"]["name"]);

            // Update the database with the new information
            $query = "UPDATE `houselistings` SET `houseName` = ?, `housePrice` = ?, `houseDescription` = ?, `houseImage` = ? WHERE `houseID` = ?";
            $sql = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($sql, "ssssi", $product_name, $product_price, $product_description, $image_data, $product_id);

            if (mysqli_stmt_execute($sql)) {
                echo "<script>alert('Product updated successfully.'); window.location.href='adminListings.php';</script>";
            } else {
                echo "<script> alert('Error updating house:'); window.location='adminListings.php' </script>" . mysqli_error($conn);
                //echo "Error updating house: " . mysqli_error($conn);
            }
        }
    }
?>