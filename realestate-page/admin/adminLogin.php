<!DOCTYPE html>
<html>

<head>

    <title>Real Estate | Admin Login</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="css/adminLogin.css">

</head>

<body>

    <div class="center">
        <h1>Admin Login</h1>

        <form method="post">

            <div class=txt_field>
                <input type="text" id="username" name="username" required>
                <label>Username</label>
            </div>

            <div class=txt_field>
                <input type="password" id="password" name="password" required>
                <label>Password</label>
            </div>
            
            <input type="submit" value="Login" name="submit">

            <div class="signup_link">
                Don't have an account? <a href="adminRegister.php">Signup</a>
            </div>

            <div class="signup_link">
                <a href="../index.php">Back to Home</a>
            </div>

        </form>

    </div>
    
    <?php
      session_start();

      // Connect to database
      $conn = mysqli_connect('localhost','root', '', 'realestatedb') or die(mysqli_error());

      
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        if (empty($username) || empty($password)) {
            echo "<script>alert('Please enter a username and password.');</script>";
        } else {
            $stmt = $conn->prepare("SELECT * FROM adminaccount WHERE adminUsername = ? AND adminPassword = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $_SESSION['loggedin'] = true;
                $_SESSION['adminUsername'] = $username;
                $_SESSION['accountType'] = $row['acctype'];
                if($row['accountType'] == 'Admin'){
                    header("location: adminDashboard.php");
                    exit;
                } 
            } 
            else {
              echo "<script>alert('Incorrect username or password.');</script>";
            }
        }
    }

    ?>

</body>

</html>