<!DOCTYPE html>
<html>

<head>
    <title>Real Estate | Admin Registration</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="css/adminRegister.css">
</head>

<body>
    <div class="container">
        <div class="title">Create Admin Account</div>

    

        <form method="post" action="adminRegister.php">

            <div class="user-details">

                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" id="username" name="fname" placeholder="Enter your First name" required>
                </div>

                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" id="username" name="lname" placeholder="Enter your Last name" required>
                </div>

                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" id="username" name="username" placeholder="Enter your Username" required>
                </div>

                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" id="username" name="email" placeholder="Enter your Email" required>
                </div>

                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" id="password" name="password" placeholder="Enter your Password" required>
                </div>

                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="confirm_password" placeholder="Confirm your Password" required>
                </div>

                <div class="input-box">
                    <span class="details">Contact Number</span>
                    <input type="text" id="username" name="contactnum" placeholder="Enter your Phone Number" required>
                </div>

            </div>
            <div class="button">
                <input type="submit" value="Register" name="submit">
            </div>

            <div class="button">
                <input type="reset" value="Clear">
            </div>

            <div class="backlink">
                <a href="adminLogin.php">Go Back</a>
            </div>
            
        </form>

    </div>

    <?php
// Start session
session_start();

    // Connect to database
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'realestatedb';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    

    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $contactnum = $_POST['contactnum'];
        $accounttype = 'Admin';
    
        $query = "SELECT * FROM `adminaccount` WHERE `adminUsername` = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.'); window.location='adminRegister.php' </script>";
        } else {
            $sql = "INSERT INTO `adminaccount` (`adminFirstname`, `adminLastname`, `adminUsername`, `adminEmail`, `adminPassword`, `adminPhone`, `accountType`) VALUES ('$fname', '$lname', '$username', '$email', '$password', '$contactnum', '$accounttype')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script> alert('Account created successfully! Please log in.'); window.location='adminLogin.php' </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
?>


    <script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() 
    {
        if (password.value != confirm_password.value) 
        {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } 
        
        else 
        {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>

</body>

</html>