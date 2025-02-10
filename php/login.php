<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
        session_start();
        include('../config/conn.php');

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']); // Hash input password using MD5

            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $row['name']; // Store user session
                
                echo "Login successful! Redirecting...";
                header("refresh:1; url=home.php"); // Redirect to home page after 1 second
                exit();
            } else {
                echo "<p style='color:red;'>Invalid email or password.</p>";
            }
        }
        ?>
        
        <form action="login.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
</body>
</html>
